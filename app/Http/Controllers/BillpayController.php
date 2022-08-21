<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Provider;
use App\Model\Report;
use Carbon\Carbon;

use App\User;

class BillpayController extends Controller
{
    public function index($type)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('billpayment_service')) {
            abort(403);
        }

        $data['type'] = $type;
        $data['providers'] = Provider::where('type', $type)->where('status', "1")->get();
        return view('service.billpayment')->with($data);
    }
    
    public function bbps(Request $post, $type)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('billpayment_service')) {
            abort(403);
        }

        $data['type'] = $type;
        $data['providers'] = Provider::where('type', $type)->where('status', "1")->orderBy('name')->get();
        return view('service.bbpsrecharge')->with($data);
    }
    
    public function payment(Request $post)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('billpayment_service')) {
            return response()->json(['status' => "Permission Not Allowed"], 400);
        }
        
        $rules = array(
            'provider_id' => 'required|numeric'
        );

        $validator = \Validator::make($post->all(), $rules);
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $error = $value[0];
            }
            return response()->json(['status' => $error]);
        }
        
        $user = \Auth::user();
        $post['user_id'] = $user->id;
        if($user->status != "active"){
            return response()->json(['status' => "Your account has been blocked."], 400);
        }

        $provider = Provider::where('id', $post->provider_id)->first();

        if(!$provider){
            return response()->json(['status' => "Operator Not Found"], 400);
        }

        if($provider->status == 0){
            return response()->json(['status' => "Operator Currently Down."], 400);
        }

        if(!$provider->api || $provider->api->status == 0){
            return response()->json(['status' => "Bill Payment Service Currently Down."], 400);
        }
        
        $post['crno'] = "";
        for ($i=0; $i < $provider->paramcount; $i++) { 
            if($provider->ismandatory[$i] == "TRUE"){
                $rules['number'.$i] = "required";
                $post['crno'] .= $post['number'.$i]."|";
            }
        }
        
        switch ($post->type) {
            case 'getbilldetails':
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    foreach ($validator->errors()->messages() as $key => $value) {
                        $error = $value[0];
                    }
                    return response()->json(['status' => $error]);
                }
                
                $url = $provider->api->url."/validate?token=".$provider->api->username."&operator=".$provider->recharge1."&crno=".$post->crno."&mobile=".$post->mobile;
                $result = \Myhelper::curl($url, "GET", "", [], "no");
                
                //dd([$url, $result]);
                if(!$result['error']){
                    
                    if($result['response'] != ""){
                        $response = json_decode($result['response']);
                        if(isset($response->statuscode) && $response->statuscode == "TXN"){
                            return response()->json([
                                'statuscode' => "TXN",
                                'data'       => [
                                    "customername" => $response->data->customername,
                                    "duedate"      => $response->data->duedate,
                                    "dueamount"       => $response->data->dueamount,
                                    "TransactionId"=> $response->data->TransactionId,
                                    'balance'      => $response->data->balance
                                ]
                            ], 200);
                        }
                    }
                    return response()->json(['status' => isset($response->message) ? $response->message : "Something went wrong"], 400);
                }else{
                    return response()->json(['status' => $result['error']], 400);
                }
                break;
            
            case 'payment':
                if ($this->pinCheck($post) == "fail") {
                    return response()->json(['status' => "Transaction Pin is incorrect"]);
                }
                
                if($user->mainwallet < $post->amount){
                    return response()->json(['status'=> 'Low Balance, Kindly recharge your wallet.'], 400);
                }

                $previousrecharge = Report::where('number', $post->number)->where('amount', $post->amount)->where('provider_id', $post->provider_id)->whereBetween('created_at', [Carbon::now()->subMinutes(2)->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')])->count();
                if($previousrecharge > 0){
                    return response()->json(['status'=> 'Same Transaction allowed after 2 min.'], 400);
                }

                $post['profit'] = \Myhelper::getCommission($post->amount, $user->scheme_id, $post->provider_id, $user->role->slug);
                $debit = User::where('id', $user->id)->decrement('mainwallet', $post->amount - $post->profit);
                if ($debit) {
                    do {
                        $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                    } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);

                    $insert = [
                        'number' => $post->number0,
                        'mobile' => isset($post->number1)?$post->number1:$user->mobile,
                        'provider_id' => $provider->id,
                        'api_id' => $provider->api->id,
                        'amount' => $post->amount,
                        'profit' => $post->profit,
                        'txnid' => $post->txnid,
                        'option1' => $post->biller,
                        'option2' => $post->duedate,
                        'status' => 'pending',
                        'user_id'    => $user->id,
                        'credit_by'  => $user->id,
                        'rtype'      => 'main',
                        'via'        => 'portal',
                        'balance'    => $user->mainwallet,
                        'trans_type' => 'debit',
                        'product'    => 'billpay'
                    ];

                    $report = Report::create($insert);

                    $url = $provider->api->url."/payment";
                    $parameter = [
                        "token"=> $provider->api->username,
                        "operator" => $provider->recharge1,
                        "crno" => $post->crno,
                        "mobile" => $post->mobile,
                        "amount" => $post->amount,
                        "biller" => $post->biller,
                        "duedate" => $post->duedate,
                        "TransactionId" => $post->TransactionId,
                        "apitxnid" => $post->txnid,
                    ];

                    if (env('APP_ENV') != "local") {
                        $result = \Myhelper::curl($url, "POST", json_encode($parameter), ["Content-Type: application/json", "Accept: application/json"], "yes", "App\Model\Report", $post->txnid);
                        //dd($url,$result,$parameter);
                    }else{
                        $result = [
                            'error' => true,
                            'response' => '' 
                        ];
                    }

                    if($result['error'] || $result['response'] == ''){
                        $update['status'] = "pending";
                        $update['payid'] = "pending";
                        $update['description'] = "billpayment pending";
                    }else{
                        $doc = json_decode($result['response']);
                        //dd($doc);
                        if(isset($doc->statuscode)){
                            if($doc->statuscode == "TXN"){
                                $update['status'] = "success";
                                $update['payid'] = $doc->data->txnid;
                                $update['refno'] = $doc->data->refno;
                                $update['description'] = "Billpayment Accepted";
                            }elseif($doc->statuscode == "TXF"){
                                $update['status'] = "failed";
                                $update['description'] = (isset($doc->message)) ? $doc->message : "failed";
                            }else{
                                $update['status'] = "failed";
                                if($doc->status == "Insufficient Wallet Balance"){
                                    $update['description'] = "Service down for sometime.";
                                }else{
                                    $update['description'] = (isset($doc->message)) ? $doc->message : "failed";
                                }
                                $update['refno'] = $update['description'];
                            }
                        }else{
                            $update['status'] = "pending";
                            $update['payid'] = "pending";
                            $update['description'] = "billpayment pending";
                        }
                    }

                    if($update['status'] == "success" || $update['status'] == "pending"){
                        Report::where('id', $report->id)->update($update);
                        \Myhelper::commission($report);
                    }else{
                        User::where('id', $user->id)->increment('mainwallet', $post->amount - $post->profit);
                        Report::where('id', $report->id)->update($update);
                    }

                    return response()->json(['status' => $update['status'], 'data' => $report, 'description' => $update['description']], 200);
                }else{
                    return response()->json(['status'=> 'Transaction Failed, please try again.'], 400);
                }
                break;
        }
    }
    
    public function getprovider(Request $post)
    {
        return response()->json(Provider::where('id', $post->provider_id)->first());
    }
}
