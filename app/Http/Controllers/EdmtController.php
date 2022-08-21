<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Api;
use App\Model\Provider;
use App\Model\Mahabank;
use App\Model\Report;
use App\Model\Commission;
use App\Model\Packagecommission;
use App\User;
use Carbon\Carbon;

class EdmtController extends Controller
{
    protected $api;
    public function __construct()
    {
        $this->api = Api::where('code', 'edmt')->first();
    }

    public function index()
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('edmt_service')) {
            abort(403);
        }
        
        $data['agent'] = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
        if(!$data['agent']){
            return redirect(route('newaeps'));
        }
        $data['banks'] = Mahabank::get();
        return view('service.edmt')->with($data);
    }

    public function payment(Request $post)
    {
        if (\Myhelper::hasRole('admin') || (!\Myhelper::can('edmt_service') && $post->type != 'getdistrict')) {
            return \Response::json(['statuscode' => 'ERR', 'status' => "Permission not allowed", 'message' => "Permission not allowed"], 400);
        }

        if(\Auth::id() != "489"){
            if(!$this->api || $this->api->status == 0){
                return response()->json(['statuscode' => 'ERR', 'status' => "Money Transfer Service Currently Down.", 'message' => "Money Transfer Service Currently Down."], 400);
            }
        }

        $post['user_id'] = \Auth::id();
        $userdata = User::where('id', $post->user_id)->first();

        if($post->type == "transfer"){
            $codes = ['dmt1', 'dmt2', 'dmt3', 'dmt4', 'dmt5'];
            $providerids = [];
            foreach ($codes as $value) {
                $providerids[] = Provider::where('recharge1', $value)->first(['id'])->id;
            }
            if($this->schememanager() == "admin"){
                $commission = Commission::where('scheme_id', $userdata->scheme_id)->whereIn('slab', $providerids)->get();
            }else{
                $commission = Packagecommission::where('scheme_id', $userdata->scheme_id)->whereIn('slab', $providerids)->get();
            }
            if(!$commission || sizeof($commission) < 5){
                return response()->json(['statuscode' => 'ERR', 'message' => "Money Transfer charges not set, contact administrator."], 400);
            }
        }
        
        $validate = $this->myvalidate($post);
        if($validate['status'] != 'NV'){
            return response()->json($validate, 400);
        }

        $encodedKey = base64_encode($this->api->optional1);
        $secret_key_timestamp = "".round(microtime(true) * 1000);
        $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
        $secret_key = base64_encode($signature);

        $header = array(
		    "cache-control: no-cache",
		    "developer_key: ".$this->api->password,
		    "secret-key: ".$secret_key,
		    "secret-key-timestamp: ".$secret_key_timestamp 
		);
        $method = "POST";
        $query = '';
        switch ($post->type) {
            case 'verification':
                $url= $this->api->url."customers/mobile_number:".$post->mobile."?initiator_id=9962981729&user_code=20810200";
                $parameter = [];
                $method = "GET";
                break;
            
            case 'otp':
                $url = $this->api->url."AIRTEL/airtelOTP";
                $parameter["initiator_id"] = "9962981729";
                $parameter["id_type"] = "mobile_number";
                $parameter["id"] = "mobile_number";
                $parameter["otp_ref_id"] = "d3e00033-ebd1-5492-a631-53f0dbf00d69";
                $parameter["user_code"] = "20810200";
                $parameter["pipe"] = "9";
                break;
            
            case 'registration':
                $url = $this->api->url."customers/mobile_number:".$post->mobile;
                $parameter["initiator_id"] = $this->api->username;
                $parameter["name"] = $post->name;
                $parameter["user_code"] = "20810200";
                $parameter["pipe"] = "9";
                $parameter["dob"] = $post->dob;
                
                $address['line'] = "India";
                $address['city'] = $post->city;
                $address['state'] = $post->state;
                $address['pincode'] = $post->pincode;
                $address['district'] = $post->district;
                $address['area'] = $post->city;
                
                $parameter["residence_address"] = json_encode($address);
                $method = "PUT";
                $query = http_build_query($parameter);
                $header[] = 'Content-Type: application/x-www-form-urlencoded';
		
                break;

            case 'registrationValidate':
                $url = $this->api->url."customers/verification/otp:".$post->otp;
                $parameter["otp_ref_id"] = $post->benemobile;
                $parameter["user_code"] = "20810200";
                $parameter["pipe"] = "9";
                $parameter["initiator_id"] = $this->api->username;
                $parameter["customer_id_type"] = "mobile_number";
                $parameter["customer_id"] = $post->mobile;
                $method = "PUT";
                $query = http_build_query($parameter);
                break;
            
            case 'addbeneficiary':
                $url = $this->api->url."customers/mobile_number:".$post->mobile."/recipients/acc_ifsc:".$post->beneaccount."_".$post->beneifsc;

                $parameter["initiator_id"] = $this->api->username;
                $parameter['user_code']  = "20810200";
                $parameter["bank_id"] = $post->benebank;
                $parameter["recipient_name"] = $post->benename;
                $parameter["recipient_mobile"] = $post->benemobile;
                $parameter["ifsc"] = $post->beneifsc;
                $parameter["recipient_type"] = "3";
                $method = "PUT";
                $query = http_build_query($parameter);
                break;

            case 'beneverify':
                $url = $this->api->url."AIRTEL/verifybeneotp";
                $parameter["custno"] = $post->mobile;
                $parameter["otp"]    = $post->otp;
                $parameter["beneaccno"] = $post->beneaccount;
                $parameter["benemobile"]= $post->benemobile;
                break;
            
            case 'accountverification':
                $url = $this->api->url."AIRTEL/VerifybeneApi";
                $post['amount'] = 1;
                $provider = Provider::where('recharge1', 'dmt1accverify')->first();
                $post['charge'] = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $provider->id, $userdata->role->slug);
                $post['provider_id'] = $provider->id;
                if($userdata->mainwallet < $post->amount + $post->charge){
                    return response()->json(["statuscode" => "IWB", 'status'=>'Low balance, kindly recharge your wallet.', 'message' => 'Low balance, kindly recharge your wallet.'], 400);
                }

                $parameter["custno"]    = $post->mobile;
                $parameter["bankname"]  = $post->benebank;
                $parameter["beneaccno"] = $post->beneaccount;
                $parameter["benemobile"]= $post->benemobile;
                $parameter["benename"]  = $post->benename;
                $parameter["ifsc"]      = $post->beneifsc;
                $parameter['bc_id']     = $post->bc_id;
                $parameter["saltkey"]   = $this->api->username;
                $parameter["secretkey"] = $this->api->password;
                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Report::where("txnid", "=", $post->txnid)->first() instanceof Report);
                $parameter["clientrefno"] = $post->txnid;
                break;
            
            case 'transfer':
                return $this->transfer($post);
                break;
            
            default:
                return response()->json(['statuscode'=> 'BPR', 'status'=> 'Bad Parameter Request','message'=> "Bad Parameter Request"]);
                break;
        }        

        if($post->type != "accountverification"){
            $result = \Myhelper::curl($url, $method, $query, $header, "yes", 'EkoDmt', '0', "25004");
        }else{
            $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", 'EkoDmt', $post->txnid, "25004");
        }
        
        //dd([$url,$header, $query, $parameter , $result]);
        
        if ($result['error'] && $result['response'] == "") {
            if($post->type == "accountverification"){
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

            return response()->json(["statuscode" => "ERR", 'status'=>'System Error', 'message'=>'System Error'], 400);
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
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'name' => 'required|regex:/^[\pL\s\-]+$/u');
            break;

            case 'registrationValidate':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10','otp' => 'required|numeric');
            break;

            case 'addbeneficiary':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "benename" => "required|regex:/^[\pL\s\-]+$/u");
            break;

            case 'beneverify':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10','beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "otp" => 'required|numeric');
            break;

            case 'accountverification':
                $rules = array('user_id' => 'required|numeric','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "benename" => "required|regex:/^[\pL\s\-]+$/u");
            break;

            case 'transfer':
                $rules = array('user_id' => 'required|numeric','name' => 'required','mobile' => 'required|numeric|digits:10', 'benebank' => 'required', 'beneifsc' => "required", 'beneaccount' => "required|numeric|digits_between:6,20", "benemobile" => 'required|numeric|digits:10', "benename" => "required", "mode" => "required",'amount' => 'required|numeric|min:100|max:25000');
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
        
        $totalamount = $post->amount;
        $url = $this->api->url."transactions";

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
            if ($totalamount < $amount) {
                continue;
            }

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
                        "message" => "Insufficient Wallet Balance",
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
                $post['service'] = $provider->type;
                $bank = Mahabank::where('bankid', $post->benebank)->first();
                $insert = [
                    'api_id' => $this->api->id,
                    'provider_id' => $post->provider_id,
                    'option1' => $post->name,
                    'mobile' => $post->mobile,
                    'number' => $post->beneaccount,
                    'option2' => $post->benename,
                    'option3' => $post->benebank,
                    'option4' => $post->beneifsc,
                    'txnid' => $post->txnid,
                    'amount' => $post->amount,
                    'charge' => $post->charge,
                    'remark' => "Money Transfer",
                    'status' => 'success',
                    'user_id' => $user->id,
                    'credit_by' => $user->id,
                    'product' => 'dmt',
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
                        $totalamount = $totalamount - $amount;
                        $report = Report::create($insert);
                        $post['reportid'] = $report->id;
                        $post['amount'] = $amount;

                        $parameter["initiator_id"] = $this->api->username;
                        $parameter["user_code"] = "20810200";
                        $parameter["amount"]    = $post->amount;
                        $parameter["timestamp"] = date('Y-m-d H:i:s');
                        $parameter["currency"]  = "INR";
                        $parameter["customer_id"]   = $post->mobile;
                        $parameter["recipient_id"]  = $post->rid;
                        $parameter["client_ref_id"] = $post->txnid;
                        $parameter["state"]   = "1";
                        $parameter["channel"] = $post->mode;
                        $parameter["merchant_document_id_type"] = "2";
                        $parameter["merchant_document_id"] = $post->aadhar;
                        $query = http_build_query($parameter);
                        
                        $encodedKey = base64_encode($this->api->optional1);
                        $secret_key_timestamp = "".round(microtime(true) * 1000);
                        $signature  = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
                        $secret_key = base64_encode($signature);

                        $header = array(
                            "cache-control: no-cache",
                            "content-type: application/x-www-form-urlencoded",
                            "developer_key: ".$this->api->password,
                            "secret-key: ".$secret_key,
                            "secret-key-timestamp: ".$secret_key_timestamp 
                        );

                        if (env('APP_ENV') == "server") {
                            $result = \Myhelper::curl($url, "POST", $query, $header, "yes", 'App\Model\Report', $post->txnid);
                        }else{
                            $result = [
                                'error' => true,
                                'response' => '' 
                            ];
                        }

                        if(env('APP_ENV') == "local" || $result['error'] || $result['response'] == ''){
                            $result['response'] = json_encode([
                                "message"=>"Pending",
                                "statuscode"=>"001",
                                "availlimit"=>"0",
                                "total_limit"=>"0",
                                "used_limit"=>"0",
                                "Data"=>[
                                    ["fesessionid"=>"CP1801861S131436",
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
                
                if($response->status == 0 && isset($response->data->state) && $response->data->state == 2){
                    $url = $this->api->url."customers/mobile_number:".$post->mobile."/recipients?initiator_id=".$this->api->username."&user_code=20810200";

                    $encodedKey = base64_encode($this->api->optional1);
                    $secret_key_timestamp = "".round(microtime(true) * 1000);
                    $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
                    $secret_key = base64_encode($signature);
        
                    $header = array(
                        "cache-control: no-cache",
                        "developer_key: ".$this->api->password,
                        "secret-key: ".$secret_key,
                        "secret-key-timestamp: ".$secret_key_timestamp 
                    );

                    $result1 = \Myhelper::curl($url, "GET", "", $header, "yes", 'EkoDmt', $post->mobile);
                    $response1 = json_decode($result1['response']);
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response, 'benedata'=> isset($response1->data->recipient_list) ? $response1->data->recipient_list : []]);
                }elseif($response->status == 0 && isset($response->data->state) && $response->data->state == 1){
                    $url = $this->api->url."customers/mobile_number:".$post->mobile."/otp";

                    $encodedKey = base64_encode($this->api->optional1);
                    $secret_key_timestamp = "".round(microtime(true) * 1000);
                    $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
                    $secret_key = base64_encode($signature);
        
                    $header = array(
                        "cache-control: no-cache",
                        "developer_key: ".$this->api->password,
                        "secret-key: ".$secret_key,
                        "secret-key-timestamp: ".$secret_key_timestamp ,
                        'Content-Type: application/x-www-form-urlencoded'
                    );
                    
                    $parameter["user_code"] = "20810200";
                    $parameter["pipe"] = "9";
                    $parameter["initiator_id"] = $this->api->username;
                    $query = http_build_query($parameter);

                    $result1 = \Myhelper::curl($url, "POST", $query, $header, "yes", 'EkoDmt', $post->mobile);
                    $response1 = json_decode($result1['response']);
                    
                    //dd([$url, $header, $query, $response1]);
                    return response()->json(['statuscode'=> 'TXNOTP', 'status'=> 'Transaction Successfull','message'=> $response1]);
                    //return response()->json(['statuscode'=> 'RNF', 'status'=> 'Customer Not Found' , 'message'=> $response->message]);
                }elseif($response->status == 463){
                    return response()->json(['statuscode'=> 'RNF', 'status'=> 'Customer Not Found' , 'message'=> $response->message]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;
            
            case 'otp':
                if(is_array($response) && isset($response[0]->StatusCode) && $response[0]->StatusCode == 001){
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response[0]->Message]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response[0]->Message]);
                }
                break;

            case 'registration':
                if($response->status == 0){
                    return response()->json(['statuscode'=> 'TXNOTP', 'status'=> 'Transaction Successfull','message'=> $response]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;

            case 'registrationValidate':
                if($response->status == 0){
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;

            case 'addbeneficiary':
                if($response->status == 0){
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;
            
            case 'beneverify':
                if(!is_array($response) && isset($response->StatusCode) && $response->StatusCode == 001){
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response]);
                }elseif(is_array($response) && isset($response[0]->StatusCode) && $response[0]->StatusCode == 001){
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response]);
                }elseif(is_array($response) && isset($response[0]->StatusCode) && $response[0]->StatusCode == 000){
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response[0]->Message]);
                }elseif(is_array($response) && isset($response[0]->StatusCode) && $response[0]->StatusCode == 003){
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response[0]->Message]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;

            case 'accountverification':
                if(isset($response->statuscode) && $response->statuscode == 001 && isset($response->Data[0]->benename) && $response->Data[0]->benename != ""){
                    
                    $balance = User::where('id', $userdata->id)->first(['mainwallet']);
                    $insert = [
                        'api_id' => $this->api->id,
                        'provider_id' => $post->provider_id,
                        'option1' => $post->name,
                        'mobile' => $post->mobile,
                        'number' => $post->beneaccount,
                        'option2' => isset($response->Data[0]->benename) ? $response->Data[0]->benename : $post->benename,
                        'option3' => $post->benebank,
                        'option4' => $post->beneifsc,
                        'txnid' => $post->txnid,
                        'refno' => isset($response->Data[0]->rrn) ? $response->Data[0]->rrn : "none",
                        'amount' => $post->amount,
                        'charge' => $post->charge,
                        'remark' => "Money Transfer",
                        'status' => 'success',
                        'user_id' => $userdata->id,
                        'credit_by' => $userdata->id,
                        'product' => 'dmt',
                        'balance' => $balance->mainwallet,
                        'description' => $post->benemobile
                    ];

                    User::where('id', $post->user_id)->decrement('mainwallet', $post->charge + $post->amount);
                    $report = Report::create($insert);
                    return response()->json(['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull','message'=> $response->Data[0]->benename]);
                }elseif(is_array($response) && isset($response[0]->statuscode) && $response[0]->statuscode == 000){
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response[0]->Message]);
                }else{
                    return response()->json(['statuscode'=> 'TXR', 'status'=> 'Transaction Error' , 'message'=> $response->message]);
                }
                break;
            
            case 'transfer':
                $report = Report::where('id', $post->reportid)->first();
                if(isset($response->status) && $response->status == 0 && isset($response->data->tx_status) && in_array($response->data->tx_status, ["0", "2", "5"])){
                    $charge = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $post->provider_id, $userdata->role->slug);
                    $post['gst'] = 0;
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge - $post->gst - $charge);
                    Report::where('id', $post->reportid)->update([
                        'status'=> "success",
                        'payid' => (isset($response->data->tid))?$response->data->tid : "Pending" ,
                        'refno' => (isset($response->data->bank_ref_num))?$response->data->bank_ref_num : "Pending",
                        'gst'   => $post->gst,
                        'profit'=> $report->charge - $post->gst - $charge
                    ]);
                    \Myhelper::commission($report);
                    return ['statuscode'=> 'TXN', 'status'=> 'Transaction Successfull', 'message'=> "Transaction Successfull", 'rrn' => (isset($response->Data[0]->rrn))?$response->Data[0]->rrn : $report->txnid, 'payid' => $post->reportid];
                }elseif(isset($response->status) && $response->status == 0 && isset($response->data->tx_status) && in_array($response->data->tx_status, ["1", "4"])){
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge + $report->amount);
                    if(isset($response->Data[0]) && isset($response->Data[0]->messagetext)){
                        $refno = $response->Data[0]->messagetext;
                    }elseif (isset($response->message)) {
                        $refno = $response->message;
                    }else{
                        $refno = 'Failed';
                    }

                    Report::where('id', $post->reportid)->update([
                        'status'=> 'failed',
                        'refno' => $refno,
                    ]);
                    try {
                        if(isset($response->message) && $response->message == "You have Insufficent balance"){
                            $refno = "Service Down for some time";
                        }
                    } catch (\Exception $th) {}
                    return ['statuscode'=> 'TXF', 'status'=> 'Transaction Failed' , 'message'=> 'Transaction Failed', "rrn" => $refno, 'payid' => $post->reportid];
                }else{
                    $charge = \Myhelper::getCommission($post->amount, $userdata->scheme_id, $post->provider_id, $userdata->role->slug);
                    $post['gst'] = 0;
                    User::where('id', $post->user_id)->increment('mainwallet', $report->charge - $post->gst - $charge);
                    Report::where('id', $post->reportid)->update([
                        'status'=> "pending",
                        'payid' => (isset($response->Data[0]->externalrefno))?$response->Data[0]->externalrefno : "Pending" ,
                        'refno' => (isset($response->Data[0]->rrn))?$response->Data[0]->rrn : "Pending",
                        'remark'=> (isset($response->Data[0]->fesessionid))?$response->Data[0]->fesessionid : "Pending",
                        'gst'   => $post->gst,
                        'profit'=> $report->charge - $post->gst - $charge
                    ]);
                    \Myhelper::commission($report);
                    return ['statuscode'=> 'TUP', 'status'=> 'Transaction Under Process','message'=> "Transaction Under Process", 'rrn' => (isset($response->Data[0]->rrn))?$response->Data[0]->rrn : $report->txnid, 'payid' => $post->reportid];
                }
                break;

            default:
                return response()->json(['statuscode'=> 'BPR', 'status'=> 'Bad Parameter Request','message'=> "Bad Parameter Request"]);
                break;
        }
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
}
