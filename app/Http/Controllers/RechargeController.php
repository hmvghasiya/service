<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Provider;
use App\Model\Report;
use App\User;
use Carbon\Carbon;

class RechargeController extends Controller
{
    public function index($type)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('recharge_service')) {
            abort(403);
        }
        $data['type'] = $type;
        $data['providers'] = Provider::where('type', $type)->where('status', "1")->get();
        return view('service.recharge')->with($data);
    }

    public function payment(\App\Http\Requests\Recharge $post)
    {
        if ($this->pinCheck($post) == "fail") {
            return response()->json(['status' => "Transaction Pin is incorrect"]);
        }
        
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('recharge_service')) {
            return response()->json(['status' => "Permission Not Allowed"], 400);
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
            return response()->json(['status' => "Recharge Service Currently Down."], 400);
        }

        if($user->mainwallet < $post->amount){
            return response()->json(['status'=> 'Low Balance, Kindly recharge your wallet.'], 400);
        }
        
        switch ($provider->api->code) {
            case 'recharge1':
                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);
                $url = $provider->api->url."/pay?token=".$provider->api->username."&number=".$post->number."&operator=".$provider->recharge1."&amount=".$post->amount."&apitxnid=".$post->txnid;
                break;
                
            case 'recharge2':
                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);

                $isstv = "false";
                if(in_array($provider->id, ['5'])){
                    $isstv = "true";
                }

                $parameter['api_token']  = $provider->api->username;
                $parameter['mobile_no']  = $post->number;
                $parameter['company_id'] = $provider->recharge2;
                $parameter['amount']     = $post->amount;
                $parameter['order_id']   = $post->txnid;
                $parameter['is_stv']     = $isstv;
                
                $url = $provider->api->url."?".http_build_query($parameter);
                break;
        }  
        $previousrecharge = Report::where('number', $post->number)->where('amount', $post->amount)->where('provider_id', $post->provider_id)->whereBetween('created_at', [Carbon::now()->subMinutes(2)->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')])->count();
        if($previousrecharge > 0){
            return response()->json(['status'=> 'Same Transaction allowed after 2 min.'], 400);
        }
                
        $post['profit'] = \Myhelper::getCommission($post->amount, $user->scheme_id, $post->provider_id, $user->role->slug);
        $debit = User::where('id', $user->id)->decrement('mainwallet', $post->amount - $post->profit);
        if($debit){

            $insert = [
                'number' => $post->number,
                'mobile' => $user->mobile,
                'provider_id' => $provider->id,
                'api_id' => $provider->api->id,
                'amount' => $post->amount,
                'profit' => $post->profit,
                'txnid'  => $post->txnid,
                'status' => 'pending',
                'user_id'=> $user->id,
                'credit_by' => $user->id,
                'rtype' => 'main',
                'via'   => 'portal',
                'balance' => $user->mainwallet,
                'trans_type' => 'debit',
                'product'    => 'recharge'
            ];

            $report = Report::create($insert);

            if (env('APP_ENV') != "local") {
                $result = \Myhelper::curl($url, "GET", "", [], "yes", "App\Model\Report", $post->txnid);
                //dd($url,$result);
            }else{
                $result = [
                    'error' => true,
                    'response' => '' 
                ];
            }

            if($result['error'] || $result['response'] == ''){
                $update['status'] = "pending";
                $update['payid'] = "pending";
                $update['refno'] = "pending";
                $update['description'] = "recharge pending";
            }else{
                switch ($provider->api->code) {
                    case 'recharge1':
                        $doc = json_decode($result['response']);
                        if(isset($doc->status)){
                            if($doc->status == "TXN" || $doc->status == "TUP"){
                                $update['status'] = "success";
                                $update['payid'] = $doc->payid;
                                $update['refno'] = $doc->refno;
                            }elseif($doc->status == "TXF"){
                                $update['status'] = "failed";
                                $update['payid'] = $doc->payid;
                                $update['refno'] = (isset($doc->message)) ? $doc->message : "failed";
                            }else{
                                $update['status'] = "failed";
                                if(isset($doc->message) && $doc->message == "Insufficient Wallet Balance"){
                                    $update['refno'] = "Service down for sometime.";
                                }else{
                                    $update['refno'] = (isset($doc->message)) ? $doc->message : "failed";
                                }
                            }
                        }else{
                            $update['status'] = "pending";
                            $update['payid'] = "pending";
                            $update['refno'] = "pending";
                        }
                        break;
                        
                    case 'recharge2':
                        $doc = json_decode($result['response']);
                        if(isset($doc->status)){
                            if(isset($doc->status) && in_array(strtolower($doc->status), ['success', 'pending'])){
                                $update['status'] = "success";
                                $update['payid'] = $doc->id;
                                $update['refno'] = $doc->tnx_id;
                            }elseif(isset($doc->status) && in_array(strtolower($doc->status), ['failed', 'failure'])){
                                $update['status'] = "failed";
                                $update['payid'] = isset($doc->id)?$doc->id:'failed';
                                $update['refno'] = (isset($doc->response)) ? $doc->response : "Failed";
                            }else{
                                $update['status'] = "pending";
                                $update['payid'] = "pending";
                                $update['refno'] = "pending";
                            }
                        }else{
                            $update['status'] = "pending";
                            $update['payid'] = "pending";
                            $update['refno'] = "pending";
                        }
                        break;
                }
            }

            if($update['status'] == "success" || $update['status'] == "pending"){
                Report::where('id', $report->id)->update($update);
                \Myhelper::commission($report);
            }else{
                User::where('id', $user->id)->increment('mainwallet', $post->amount - $post->profit);
                Report::where('id', $report->id)->update($update);
            }
            return response()->json($update, 200);
        }else{
            return response()->json(['status' => "failed", "description" => "Something went wrong"], 200);
        }
    }
    
    public function getplan(Request $post)
    {
        $rules = array(
            'operator' => 'required|numeric',
            'number'   => 'required|numeric'
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }
        
        $provider = Provider::where('id', $post->operator)->first();
        
        if(!$provider){
            return response()->json(['statuscode' => "ERR", "message" => "Provider Not Found"]);
        }
        
        $provider = Provider::where('id', $post->operator)->first();
        $api = \App\Model\Api::where('code', "recharge1")->first();
        
        $url = $api->url."/getplan?token=".$api->username."&operator=".$provider->recharge1."&number=".$post->number;

        $result = \Myhelper::curl($url, "GET", "", [], "no");
        
        //dd([$url, $result]);
        if($result['response'] != ''){
            $response = json_decode($result['response']);

            if(isset($response->statuscode) && $response->statuscode == "TXN"){
                return response()->json(['statuscode' => "TXN", "message" => "Record Found", "data" => $response->data]);
            }

            return response()->json(['statuscode' => "ERR", "message" => "Something went wrong"]);
        }else{
            return response()->json(['statuscode' => "ERR", "message" => "Something went wrongs"]);
        }
    }
    
    public function operatorinfo(Request $post)
    {
        $rules = array(
            'number'   => 'required|numeric',
            'type'     => 'required'
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }
        
        $api = \App\Model\Api::where('code', "recharge1")->first();
        $url = $api->url."/getprovider?token=".$api->username."&number=".$post->number."&type=".$post->type;

        $result = \Myhelper::curl($url, "GET", "", [], "no");
        
        //dd($url, $result);
        if($result['response'] != ''){
            $response = json_decode($result['response']);
            if(isset($response->statuscode) && $response->statuscode == "TXN"){
                $provider = Provider::where('recharge1', $response->provider_id)->first();
                if($provider){
                    return response()->json(['statuscode' => "TXN", "message" => "Record Found", "provider_id" => $provider->id]);
                }else{
                    return response()->json(['statuscode' => "ERR", "message" => "Record Not Found"]);
                }
            }else{
                return response()->json(['statuscode' => "ERR", "message" => "Something went wrong"]);
            }
        }else{
            return response()->json(['statuscode' => "ERR", "message" => "Something went wrongs"]);
        }
    }
}
