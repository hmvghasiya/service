<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Api;
use App\Model\Provider;
use App\Model\Mahabank;
use App\Model\Report;
use App\Model\Commission;
use App\User;
use Carbon\Carbon;

class DmtController extends Controller
{
    protected $api;
    public function __construct()
    {
        $this->api = Api::where('code', 'dmt1')->first();
    }

    public function index()
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('dmt1_service')) {
            abort(403);
        }

        $data['banks'] = Mahabank::get();
        return view('service.dmt1')->with($data);
    }

    public function payment(Request $post)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('dmt1_service')) {
            return \Response::json(['status' => "Permission not allowed"], 400);
        }

        if(!$this->api || $this->api->status == 0){
            return response()->json(['status' => "Money Transfer Service Currently Down."], 400);
        }

        $post['user_id'] = \Auth::id();
        $userdata = User::where('id', $post->user_id)->first();

        if($post->type != "getdistrict"){
            $commission = Commission::where('scheme_id', $userdata->scheme_id)->get();
            if(!$commission || sizeof($commission) < 5){
                return response()->json(['status' => "Money Transfer charges not set, contact administrator."], 400);
            }
        }
        
        $validate = $this->myvalidate($post);
        if($validate['status'] != 'NV'){
            return response()->json($validate, 422);
        }

        $url = $this->api->url."/transaction";
        $header = array("Content-Type: application/json");
        $parameter["token"] = $this->api->username;
        $parameter["type"] = $post->type;
        $parameter["mobile"] = $post->mobile;

        switch ($post->type) {
            case 'getdistrict':
                $parameter["stateid"] = $post->stateid;
                break;
            
            case 'verification':
                break;
            
            case 'otp':
                break;
            
            case 'registration':
                $parameter["fname"] = $post->fname;
                $parameter["lname"] = $post->lname;
                $parameter["otp"] = $post->otp;
                $parameter["address"] = $userdata->address;
                $parameter["pincode"] = $post->pincode;
                break;
            
            case 'addbeneficiary':
                $parameter["benebank"] = $post->benebank;
                $parameter["beneaccount"] = $post->beneaccount;
                $parameter["benemobile"] = $post->benemobile;
                $parameter["benename"] = $post->benename;
                $parameter["beneifsc"] = $post->beneifsc;
                break;

            case 'beneverify':
                $parameter["otp"] = $post->otp;
                $parameter["beneaccount"] = $post->beneaccount;
                $parameter["benemobile"] = $post->benemobile;
                break;
            
            case 'accountverification':
                $post['amount'] = 1;
                $post['benename'] = 'test';
                $provider = Provider::where('recharge1', 'dmt1accverify')->first();
                $post['charge'] = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $provider->id, $userdata->role->slug);
                $post['provider_id'] = $provider->id;
                if($userdata->mainwallet < $post->amount + $post->charge){
                    return response()->json(["statuscode" => "IWB", 'status'=>'Low balance, kindly recharge your wallet.'], 400);
                }

                $parameter["benebank"] = $post->benebank;
                $parameter["beneaccount"] = $post->beneaccount;
                $parameter["benemobile"] = $post->benemobile;
                $parameter["benename"] = $post->benename;
                $parameter["beneifsc"] = $post->beneifsc;

                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);

                $parameter["apitxnid"] = $post->txnid;
                break;
            
            case 'transfer':
                return $this->transfer($post, $userdata);
                break;
            
            default:
                return response()->json(['statuscode'=> 'BPR', 'status'=> 'Bad Parameter Request','message'=> "Bad Parameter Request"]);
                break;
        }        

        $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", 'App\Model\Report', '0');
        //dd([$url, $parameter , $result]);
        if ($result['error'] || $result['response'] == "") {
            if($post->type == "beneaccvalidate"){
                $response = [
                    "message"=>"Success",
                    "statuscode"=>"001",
                    "availlimit"=>"0",
                    "total_limit"=>"0",
                    "used_limit"=>"0",
                    "Data"=>[["fesessionid"=>"CP1801861S131436",
                    "tranid"=>"pending",
                    "rrn"=>"pending",
                    "externalrefno"=>"MH357381218131436",
                    "amount"=>"0",
                    "responsetimestamp"=>"0",
                    "benename"=>"",
                    "messagetext"=>"Success",
                    "code"=>"1",
                    "errorcode"=>"1114",
                    "mahatxnfee"=>"10.00"
                    ]]
                ];

                return $this->output($post, json_encode($response), $userdata);
            }

            return response()->json(["statuscode" => "ERR", 'status'=>'System Error'], 400);
        }

        return $this->output($post, $result['response'] , $userdata);
    }

    public function myvalidate($post)
    {
        $validate = "yes";
        switch ($post->type) {
            case 'getdistrict':
                $rules = array('stateid' => 'required|numeric');
            break;

            case 'verification':
            case 'otp':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10');
            break;
            
            case 'registration':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'fname' => 'required|regex:/^[\pL\s\-]+$/u', 'lname' => 'required|regex:/^[\pL\s\-]+$/u', 'otp' => "required|numeric", 'pincode' => "required|numeric|digits:6");
            break;

            case 'addbeneficiary':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "benename" => "required|regex:/^[\pL\s\-]+$/u");
            break;

            case 'beneverify':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10','beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "otp" => 'required|numeric');
            break;

            case 'accountverification':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10');
            break;

            case 'transfer':
                $rules = array('user_id' => 'required|numeric','name' => 'required','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "benename" => "required|regex:/^[\pL\s\-]+$/u",'amount' => 'required|numeric|min:10|max:25000');
            break;

            default:
                return ['statuscode'=>'BPR', "status" => "Bad Parameter Request", 'message'=> "Invalid request format"];
            break;
        }

        if($validate == "yes"){
            $validator = \Validator::make($post->all(), $rules);
            if ($validator->fails()) {
                foreach ($validator->errors()->messages() as $key => $value) {
                    $error = $value[0];
                }
                $data = ['statuscode'=>'BPR', "status" => "Bad Parameter Request", 'message'=> $error];
            }else{
                $data = ['status'=>'NV'];
            }
        }else{
            $data = ['status'=>'NV'];
        }
        return $data;
    }

    public function transfer($post)
    {
        if ($this->pinCheck($post) == "fail") {
            return response()->json(['status' => "Transaction Pin is incorrect"]);
        }
                
        $url = $this->api->url."/transaction";
        $parameter['type'] = $post->type;
        $parameter['token'] = $this->api->username;

        $amount = $post->amount;
        for ($i=1; $i < 6; $i++) { 
            if(5000*($i-1) <= $amount  && $amount <= 5000*$i){
                if($amount == 5000*$i){
                    $n = $i;
                }else{
                    $n = $i-1;
                    $x = $amount - $n*5000;
                }
                break;
            }
        }

        $amounts = array_fill(0,$n,5000);
        if(isset($x)){
            array_push($amounts , $x);
        }

        foreach ($amounts as $amount) {
            $outputs['statuscode'] = "TXN";
            $post['amount'] = $amount;
            $user = User::where('id', $post->user_id)->first();
            $post['charge'] = $this->getCharge($post->amount);
            if($user->mainwallet < $post->amount + $post->charge){
                $outputs['data'][] = array(
                    'amount' => $amount,
                    'status' => 'TXF',
                    'data' => [
                        "statuscode" => "TXF",
                        "status" => "Insufficient Wallet Balance",
                    ]
                );
            }else{
                $post['amount'] = $amount;
                
                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);

                if($post->amount >= 100 && $post->amount <= 1000){
                    $provider = Provider::where('recharge1', 'dmt1')->first();
                }elseif($amount>1000 && $amount<=2000){
                    $provider = Provider::where('recharge1', 'dmt2')->first();
                }elseif($amount>2000 && $amount<=3000){
                    $provider = Provider::where('recharge1', 'dmt3')->first();
                }elseif($amount>3000 && $amount<=4000){
                    $provider = Provider::where('recharge1', 'dmt4')->first();
                }else{
                    $provider = Provider::where('recharge1', 'dmt5')->first();
                }
                
                $post['provider_id'] = $provider->id;
                $bank = Mahabank::where('bankid', $post->benebank)->first();
                $insert = [
                    'api_id' => $this->api->id,
                    'provider_id' => $post->provider_id,
                    'option1' => $post->name,
                    'mobile' => $post->mobile,
                    'number' => $post->beneaccount,
                    'option2' => $post->benename,
                    'option3' => $bank->bankname,
                    'option4' => $post->beneifsc,
                    'txnid' => $post->txnid,
                    'amount' => $post->amount,
                    'charge' => $post->charge,
                    'remark' => "Money Transfer",
                    'status' => 'pending',
                    'user_id' => $user->id,
                    'credit_by' => $user->id,
                    'product' => 'dmt',
                    'via'   => "portal",
                    'balance' => $user->mainwallet,
                    'description' => $post->benemobile,
                    'trans_type' => 'debit'
                ];
                $previousrecharge = Report::where('number', $post->beneaccount)->where('amount', $post->amount)->where('provider_id', $post->provider_id)->whereBetween('created_at', [Carbon::now()->subSeconds(5)->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')])->count();
                if($previousrecharge == 0){
                    $transaction = User::where('id', $user->id)->decrement('mainwallet', $post->amount + $post->charge);
                    if(!$transaction){
                        $outputs['data'][] = array(
                            'amount' => $amount,
                            'status' => 'TXF',
                            'data' => [
                                "statuscode" => "TXF",
                                "status" => "Transaction Failed",
                            ]
                        );
                    }else{
                        $report = Report::create($insert);
                        $post['report'] = $report->id;
                        $post['amount'] = $amount;
                        $parameter["mobile"] = $post->mobile;
                        $parameter["name"] = $post->name;
                        $parameter["benebank"] = $post->benebank;
                        $parameter["beneaccount"] = $post->beneaccount;
                        $parameter["benemobile"] = $post->benemobile;
                        $parameter["benename"] = $post->benename;
                        $parameter["beneifsc"] = $post->beneifsc;
                        $parameter['amount'] = $amount;
                        $parameter["apitxnid"] = $post->txnid;
                        $header = array("Content-Type: application/json");

                        $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", 'App\Model\Report', $post->txnid);

                        if($result['error'] || $result['response'] == ''){
                            $result['response'] = json_encode([
                                "message"=>"Pending",
                                "statuscode"=>"001",
                                "availlimit"=>"0",
                                "total_limit"=>"0",
                                "used_limit"=>"0",
                                "Data"=>[
                                    [
                                        "fesessionid"=>"CP1801861S131436",
                                        "tranid"=>"pending",
                                        "rrn"=>"pending",
                                        "externalrefno"=>"MH357381218131436",
                                        "amount"=>"0",
                                        "responsetimestamp"=>"0",
                                        "benename"=>"",
                                        "messagetext"=>"Success",
                                        "code"=>"1",
                                        "errorcode"=>"1114",
                                        "mahatxnfee"=>"10.00"
                                    ]
                                ]
                            ]);
                        }

                        $outputs['data'][] = array(
                            'amount' => $amount,
                            'status' => 'TXN',
                            'data' => $this->output($post, $result['response'], $user)
                        );
                    }
                }else{
                    $outputs['data'][] = array(
                        'amount' => $amount,
                        'status' => 'TXF',
                        'data' => [
                            "statuscode" => "TXF",
                            "status" => "Same Transaction Repeat",
                            "message" => "Same Transaction Repeat",
                        ]
                    );
                }
            }
            sleep(1);
        }
        return response()->json($outputs, 200);
    }

    public function output($post, $response, $userdata)
    {
        $response = json_decode($response);
        switch ($post->type) {
            case 'verification':
                if($response->statuscode == "RNF"){
                    $parameter["token"] = $this->api->username;
                    $parameter["mobile"] = $post->mobile;
                    $url = $this->api->url."/transaction";
                    $header = array("Content-Type: application/json");
                    \Myhelper::curl($url, "POST", $parameter, $header, "no");
                }
                break;

            case 'accountverification':
                if($response->statuscode == "TXN"){
                    $balance = User::where('id', $userdata->id)->first(['mainwallet']);
                    $insert = [
                        'api_id' => $this->api->id,
                        'provider_id' => $post->provider_id,
                        'option1' => $post->name,
                        'mobile' => $post->mobile,
                        'number' => $post->beneaccount,
                        'option2' => isset($response->message) ? $response->message : $post->benename,
                        'option3' => $post->benebank,
                        'option4' => $post->beneifsc,
                        'txnid' => $post->txnid,
                        'amount' => $post->amount,
                        'charge' => $post->charge,
                        'remark' => "Money Transfer",
                        'status' => 'pending',
                        'user_id' => $userdata->id,
                        'credit_by' => $userdata->id,
                        'product' => 'dmt',
                        'via' => 'portal',
                        'balance' => $balance->mainwallet,
                        'description' => $post->benemobile,
                        'trans_type' => 'debit'
                    ];

                    User::where('id', $post->user_id)->decrement('mainwallet', $post->charge + $post->amount);
                    $report = Report::create($insert);
                }
                break;
            
            case 'transfer':
                $report = Report::where('id', $post->report)->first();
                if($response->statuscode == "TXN"){
                    $charge = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $post->provider_id, $userdata->role->slug);
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge - $post->gst - $charge);
                    Report::where('id', $post->report)->update([
                        'status'=> "success",
                        'payid' => (isset($response->payid))?$response->payid : "Pending" ,
                        'refno' => (isset($response->rrn))?$response->rrn : "Pending",
                        'profit' => $report->charge - $charge
                    ]);
                    \Myhelper::commission($report);
                }elseif($response->statuscode == "TUP"){
                    $charge = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $post->provider_id, $userdata->role->slug);
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge - $post->gst - $charge);
                    Report::where('id', $post->report)->update([
                        'status'=> "pending",
                        'payid' => (isset($response->payid))?$response->payid : "Pending" ,
                        'refno' => (isset($response->rrn))?$response->rrn : "Pending",
                        'profit' => $report->charge - $charge
                    ]);
                    \Myhelper::commission($report);
                }elseif($response->statuscode == "TXF" || $response->statuscode == "ERR"){
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge + $report->amount);
                    Report::where('id', $post->report)->update([
                        'status'=> 'failed',
                        'refno' => "failed",
                    ]);
                    try {
                        if(isset($response->status) && $response->status == "Insufficient Wallet Balance"){
                            $response->message = "Service Down for some time";
                        }
                    } catch (\Exception $th) {}
                }else{
                    $charge = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $post->provider_id,$userdata->role->slug);
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge - $post->gst - $charge);
                    Report::where('id', $post->report)->update([
                        'status'=> "pending",
                        'payid' => (isset($response->payid))?$response->payid : "Pending" ,
                        'refno' => (isset($response->rrn))?$response->rrn : "Pending",
                        'profit' => $report->charge - $charge
                    ]);
                    \Myhelper::commission($report);
                }
                break;
        }
        
        if($post->type == "transfer"){
            return $response;
        }else{
            return response()->json($response);
        }
    }

    public function getCommission($scheme, $slab, $amount)
    {
        if($amount < 1000){
            $amount = 1000;
        }
        $userslab = Commission::where('scheme_id', $scheme)->where('product', 'money')->where('slab', $slab)->first();
        if($userslab){
            if ($userslab->type == "percent") {
                $usercharge = $amount * $userslab->value / 100;
            }else{
                $usercharge = $userslab->value;
            }
        }else{
            $usercharge = 7;
        }

        return $usercharge;
    }

    public function getCharge($amount)
    {
        if($amount < 1000){
            return 10;
        }else{
            return $amount*1/100;
        }
    }

    public function getGst($amount)
    {
        return $amount*100/118;
    }

    public function getTds($amount)
    {
        return $amount*5/100;
    }

    public function statementLog($post, $amount)
    {
        $statement['transaction_type'] = $post->transtype;
        $statement['statement_type'] = "Money Transfer";
        $statement['amount'] = $amount;
        $statement['pre_balance'] = $post->userprebalance;
        $statement['current_balance'] = $post->userpostbalance;
        $statement['report_type'] = "Main";
        $statement['txnid'] = $post->reportid;
        $statement['user_id'] = $post->user_id;
        $statement['credited_by'] = $post->user_id;
        $statement['remark'] = $post->remark;
        \Myhelper::statementLog($statement);
    }
}
