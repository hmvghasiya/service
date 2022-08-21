<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Model\Mahaagent;
use App\Model\Mahastate;
use App\Model\Aepsreport;
use App\Model\Report;
use App\Model\Commission;
use App\Model\Provider;
use App\Model\Api;

class AepsController extends Controller
{
    protected $api;
    public function __construct()
    {
        $this->api = Api::where('code', 'aeps')->first();
    }

    public function index(Request $post)
    {
        if (\Myhelper::hasRole('admin') || !\Myhelper::can('aeps_service')) {
            abort(403);
        }

        if(!$this->api || $this->api->status == 0){
            abort(405);
        }

        $data['agent'] = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
        $data['mahastate'] = Mahastate::get();
        return view('service.aeps')->with($data);
    }
    
    public function transaction(Request $post)
    {
        $post['user_id'] = \Auth::id();
        $user = User::where('id', $post->user_id)->first();
        
        switch ($post->transactionType) {
            case 'kyc':
                $rules = array(
                    'bc_pan'      => 'required',
                    'phone1'      => 'required',
                    'bc_f_name'   => 'required',
                    'bc_l_name'   => 'required',
                    'emailid'     => 'required',
                    'bc_city'     => 'required',
                    'bc_state'    => 'required',
                    'bc_pincode'  => 'required',
                    'bc_dob'      => 'required',
                    'shopname'    => 'required'
                );
                break;
                
            case 'service':
                $rules = array(
                    'pancardimg'      => 'required',
                    'aadhafront'   => 'required',
                    'aadharback'    => 'required'
                );
                break;
                
            case 'initiate':
               
                $rules = array(
                    'user_id'      => 'required'
                );
                break;
                
            default:
                return response()->json(array(
                    'statuscode' => 'BPR',
                    'status' => 'Bad Parameter Request.',  
                    'message' => "Bad Parameter Request"
                ));
                break;
        }

        $validator = \Validator::make($post->all(), array_reverse($rules));
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $error = $value[0];
            }
            return response()->json(array(
                'statuscode' => 'BPR',
                'status' => 'Bad Parameter Request.',  
                'message' => $error
            ));
        }
        
        switch ($post->transactionType) {
            case 'kyc':
                $address   = json_encode([
                    "bc_city"    => $post->bc_city,
                    "city"    => $post->bc_city,
                    "state"   => $post->bc_state,
                    "pincode" => $post->bc_pincode
                ]);

                $parameter["token"]     = $this->api->username;
                $parameter['transactionType'] = "registration";
                $parameter["bc_pan"]    = $post->bc_pan;
                $parameter["phone1"]    = $post->phone1;
                $parameter["bc_f_name"] = $post->bc_f_name;
                $parameter["bc_l_name"] = $post->bc_l_name;
                $parameter["emailid"]   = $post->emailid;
                $parameter["bc_city"]   = $post->bc_city;
                $parameter["bc_state"]  = $post->bc_state;
                $parameter["bc_pincode"]= $post->bc_pincode;
                $parameter["bc_dob"]    = $post->bc_dob;
                $parameter["shopname"]  = $post->shopname;

                $url= $this->api->url."/transaction";
                $header = array("Content-Type: application/json");
                
                $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", 'ekokyc', $post->phone1);
                //dd([$url, $parameter, $result]);
                if($result['response'] == ''){
                    return response()->json(['statuscode'=>'TXF', 'message'=> "Something went wrong, try again"]);
                }
                
                $response = json_decode($result['response']);
                //dd([$url, $parameter, $result]);
                
                if($response->statuscode == "TXN"){
                    $data['bc_id']         = $response->usercode;
                    $data['bbps_id']       = 'notactivated';
                    $data['user_id']       = $post->user_id;
                    $data["bc_f_name"]     = $post->bc_f_name;
                    $data["bc_m_name"]     = "";
                    $data["bc_l_name"]     = $post->bc_l_name;
                    $data["emailid"]       = $post->emailid;
                    $data["phone1"]        = $post->phone1;
                    $data["bc_dob"]        = $post->bc_dob;
                    $data["bc_state"]      = $post->bc_state;
                    $data["bc_address"]    = $post->bc_address;
                    $data["bc_city"]       = $post->bc_city;
                    $data["bc_pincode"]    = $post->bc_pincode;
                    $data["bc_pan"]        = $post->bc_pan;
                    $data["shopname"]      = $post->shopname;

                    $user = \DB::table('eko_mahaagents')->insert($data);
                    
                    $pancardimg = $post->file('pancardimg');
                    $pic= rand(1111111111, 9999999999).'.'.$pancardimg->getClientOriginalExtension();
                    $destinationpancardimg = public_path('/kyc/pancard');
                    $uploadedpancardimg=$post['pancardimg']->move($destinationpancardimg, $pic);
                    
                    $aadhafront = $post->file('aadhafront');
                    $aadhafrontpic= rand(1111111111, 9999999999).'.'.$aadhafront->getClientOriginalExtension();
                    $destinationaadhafront = public_path('/kyc/aadharfront');
                    $uploadedaadhafront=$post['aadhafront']->move($destinationaadhafront, $aadhafrontpic);
                    
                    $aadharback = $post->file('aadharback');
                    $aadharbacktpic= rand(1111111111, 9999999999).'.'.$aadharback->getClientOriginalExtension();
                    $destinationaadharback = public_path('/kyc/aadharback');
                    $uploadedaadharback=$post['aadharback']->move($destinationaadharback, $aadharbacktpic);
                    
                    $cfile1 = new \CURLFile(realpath($uploadedpancardimg));
                    $cfile2 = new \CURLFile(realpath($uploadedaadhafront));
                    $cfile3 = new \CURLFile(realpath($uploadedaadharback));
                
                    $parameter = [];
                    
                    $parameter["token"]           = $this->api->username;
                    $parameter['transactionType'] = "serviceActivation";
                    $parameter["pancardFile"]     = $cfile1;
                    $parameter["adharFrontFile"]  = $cfile2;
                    $parameter["adharBackFile"]   = $cfile3;
                    $parameter["bc_city"]      = $post->bc_city;
                    $parameter["bc_state"]     = $post->bc_state;
                    $parameter["bc_pincode"]   = $post->bc_pincode;
                    $parameter['user_code']    = $response->usercode;
    
                    $url= $this->api->url."/transaction";
                    $header = array("Content-Type: application/json");
                    
                    $header=array(
                        'Content-Type: multipart/form-data'
                    );
                
                    $result = \Myhelper::curl($url, "POST", $parameter, $header, "yes", 'ekokyc', $post->phone1);
                   //dd($result);
                    if($result['response'] == ''){
                        return response()->json(['statuscode'=>'TXF', 'message'=> "Something went wrong, try again"]);
                    }
    
                    $responses = json_decode($result['response']);
               
                    if(isset($responses->statuscode) && $responses->statuscode == 'TXN'){
                        $update['bbps_id'] = 'activated';
                        $user = \DB::table('eko_mahaagents')->where('bc_id',$response->usercode)->update($update);
                        return response()->json(['statuscode'=>'TXN', 'message'=> $responses->message]);
                    }else{
                        return response()->json(['statuscode'=>'TXF', 'message'=> $responses->message ]);
                    }
                
                    return response()->json(['statuscode'=>'TXN', 'message'=> "KycSubmitted", 'usercode' => $response->usercode]);
                }else{
                    return response()->json(['statuscode'=>'TXF', 'message'=> $response->message ]);
                }
                break;

            case 'service':
                $agent = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();

                if(!$agent){
                    return response()->json(['statuscode'=>'TXF', 'message'=> "User onboarding is pending"]);
                }

                $pancardimg = $post->file('pancardimg');
                $pic= rand(1111111111, 9999999999).'.'.$pancardimg->getClientOriginalExtension();
                $destinationpancardimg = public_path('/kyc/pancard');
                $uploadedpancardimg=$post['pancardimg']->move($destinationpancardimg, $pic);
                
                $aadhafront = $post->file('aadhafront');
                $aadhafrontpic= rand(1111111111, 9999999999).'.'.$aadhafront->getClientOriginalExtension();
                $destinationaadhafront = public_path('/kyc/aadharfront');
                $uploadedaadhafront=$post['aadhafront']->move($destinationaadhafront, $aadhafrontpic);
                
                $aadharback = $post->file('aadharback');
                $aadharbacktpic= rand(1111111111, 9999999999).'.'.$aadharback->getClientOriginalExtension();
                $destinationaadharback = public_path('/kyc/aadharback');
                $uploadedaadharback=$post['aadharback']->move($destinationaadharback, $aadharbacktpic);
                
                $cfile1 = new \CURLFile(realpath($uploadedpancardimg));
                $cfile2 = new \CURLFile(realpath($uploadedaadhafront));
                $cfile3 = new \CURLFile(realpath($uploadedaadharback));

                $parameter = [];
                
                $parameter["token"]           = $this->api->username;
                $parameter['transactionType'] = "serviceActivation";
                $parameter["pancardFile"]     = $cfile1;
                $parameter["adharFrontFile"]  = $cfile2;
                $parameter["adharBackFile"]   = $cfile3;
                $parameter["bc_city"]      = $post->bc_city;
                $parameter["bc_state"]     = $post->bc_state;
                $parameter["bc_pincode"]   = $post->bc_pincode;
                $parameter['user_code']    = $agent->bc_id;

                $url= $this->api->url."/transaction";
                $header = array("Content-Type: application/json");
                
                $header=array(
                    'Content-Type: multipart/form-data'
                );
            
                $result = \Myhelper::curl($url, "POST", $parameter, $header, "yes", 'ekokyc', $post->phone1);
                
                //dd($result);
                if($result['response'] == ''){
                    return response()->json(['statuscode'=>'TXF', 'message'=> "Something went wrong, try again"]);
                }

                $responses = json_decode($result['response']);
           
                if(isset($responses->statuscode) && $responses->statuscode == 'TXN'){
                    $update['bbps_id'] = 'activated';
                    $update['status'] = 'success';
                    $user = \DB::table('eko_mahaagents')->where('bc_id' , $agent->bc_id)->update($update);
                    return response()->json(['statuscode'=>'TXN', 'message'=> $responses->message]);
                }else{
                    return response()->json(['statuscode'=>'TXF', 'message'=> $responses->message ]);
                }
                break;

            case 'initiate':
                $agent = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
                
                if(!$agent){
                    return response()->json(['statuscode'=>'TXF', 'message'=> "User onboarding is pending"]);
                }

                if($agent->bbps_id != "activated"){
                    $parameter = [];
                    
                    $parameter["token"]           = $this->api->username;
                    $parameter['transactionType'] = "onboardCheck";
                    $parameter['user_code']    = $agent->bc_id;
    
                    $url= $this->api->url."/transaction";
                    $header = array("Content-Type: application/json");
                    
                    $header=array(
                        'Content-Type: multipart/form-data'
                    );
                
                    $result = \Myhelper::curl($url, "POST", $parameter, $header, "no");
                    if($result['response'] == ''){
                        return response()->json(['statuscode'=>'TXF', 'message'=> "User onboard activation is pending"]);
                    }
    
                    $responses = json_decode($result['response']);
                    if(isset($responses->statuscode) && $responses->statuscode == 'TXN' && isset($responses->status) && $responses->status == "activated"){
                        $update['bbps_id'] = 'activated';
                        $update['status']  = 'success';
                        \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->update($update);
                    }
                    
                    $agent = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
                    if($agent->bbps_id != "activated"){
                        return response()->json(['statuscode'=>'TXF', 'message'=> "User onboard activation is pending"]);
                    }
                }
                
                $url = $this->api->url."/transaction";
                $logo="https://".$user->company->website."/public/logos/".$user->company->logo;
                return \Redirect::away($url."?transactionType=initiate&user_code=".$agent->bc_id."&logo=".$logo."&company=".$user->company->companyname);
                break;
            
            default:
                break;
        }
    }

    public function registration(Request $post)
    {
        $data["bc_f_name"] = $post->bc_f_name;
        $data["bc_m_name"] = "";
        $data["bc_l_name"] = $post->bc_l_name;
        $data["emailid"] = $post->emailid;
        $data["phone1"] = $post->phone1;
        $data["phone2"] = $post->phone2;
        $data["bc_dob"] = $post->bc_dob;
        $data["bc_state"] = $post->bc_state;
        $data["bc_district"] = $post->bc_district;
        $data["bc_address"] = $post->bc_address;
        $data["bc_block"] = $post->bc_block;
        $data["bc_city"] = $post->bc_city;
        $data["bc_landmark"] = $post->bc_landmark;
        $data["bc_mohhalla"] = $post->bc_mohhalla;
        $data["bc_loc"] = $post->bc_loc;
        $data["bc_pincode"] = $post->bc_pincode;
        $data["bc_pan"] = $post->bc_pan;
        $data["shopname"] = $post->shopname;
        $data["shopType"] = $post->shopType;
        $data["qualification"] = $post->qualification;
        $data["population"] = $post->population;
        $data["locationType"] = $post->locationType;
        $data["token"] = $this->api->username;

        $url = $this->api->url."registration";
        $header = array("Content-Type: application/json");
        $result = \Myhelper::curl($url, "POST", json_encode($data), $header, "yes", "Kyc", \Auth::id());
        //dd([$url,$$result]);
        if($result['response'] != ''){
            $datas = json_decode($result['response']);
            if(isset($datas->statuscode) && $datas->statuscode == "TXN"){
                $data['bc_id'] = $datas->message;
                $data['user_id'] = \Auth::id();
                $user = Mahaagent::create($data);
                return response()->json(['statuscode'=>'TXN', 'status'=>'Transaction Successfull', 'message'=> "Kyc Submitted"]);
            }else{
                return response()->json(['statuscode'=>'TXF', 'status'=>'Transaction Failed', 'message'=> $datas->message]);
            }
        }else{
            return response()->json(['statuscode'=>'TXF', 'status'=>'Transaction Failed', 'message'=> "Something went wrong"]);
        }
    }

    public function iciciaepslog(Request $post)
    {
        $data= \DB::table('microlog')->insert(['response' => json_encode($post->all())]);
        if(!$this->api || $this->api->status == 0){
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Service Down";
            return response()->json($output);
        }
        
        $agent = \DB::table('eko_mahaagents')->where('bc_id', $post->detail['data']['user_code'])->first();
        $user = User::where('id', $agent->user_id)->first();

        if(!$agent){
            $output['TRANSACTION_ID'] = date('Ymdhis');
            $output['VENDOR_ID'] = $agent->user_id.date('Ymdhis');
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Service Down";
            return response()->json($output);
        }
        
        if($post->detail['data']['type'] == '2'){
            $post['Txntype'] = "CW";
        }elseif($post->detail['data']['type'] =='3'){
            $post['Txntype'] = "BE";
        }else{
            $post['Txntype'] = "MS";
        }
        $post['provider_id'] = '0';
        $post['api_id'] = $this->api->id;
        
        $insert = [
            'number' => $post->detail['data']['user_code'],
            'mobile' => $user->mobile,
            'provider_id' => $post->provider_id,
            'api_id' => $post->api_id,
            'amount' => isset($post->detail['data']['amount']) ? $post->detail['data']['amount'] : 0,
            'txnid'  => $post->detail['client_ref_id'],
            'option1'  => $post->Txntype,
            'option3'  => $post->detail['data']['user_code'],
            'option2'  => $post->detail['data']['customer_id'],
            'option4'  => $post->detail['data']['bank_code'],
            'status' => 'pending',
            'user_id'=> $user->id,
            'credit_by' => $user->id,
            'rtype' => 'main',
            'via'   => 'portal',
            'balance' => $user->mainwallet,
            'trans_type'  => 'credit',
            'product'     => 'aeps'
        ];

        $transaction = Report::create($insert);
        if($transaction){
            $output['STATUS'] = "SUCCESS";
            $output['MESSAGE'] = "Success";
            return response()->json($output);
        }else{
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Service Down";
            return response()->json($output);
        }
    }

    public function iciciaepslogupdate(Request $post)
    {
        $data= \DB::table('microlog')->insert(['response' => json_encode($post->all())]);
        $report = Report::where('txnid', $post->detail['client_ref_id'])->first();
        if(!$report){
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Report Not Found";
            return response()->json($output);
        }

        $user = User::where('id', $report->user_id)->first();
        $providerid = 0;
        if($post->action=='eko-response' && isset($post->detail['response']['response_status_id']) && strtolower($post->detail['response']['response_status_id']) == "0" && $report->status == "pending"){
            if($report->option1 == "CW"){
                if($report->amount > 99){
                    if($report->amount >= 100 && $report->amount <= 500){
                        $provider = Provider::where('recharge1', 'aeps1')->first();
                        $providerid = $provider->id;
                    }elseif($report->amount > 500 && $report->amount <= 3000){
                        $provider = Provider::where('recharge1', 'aeps2')->first();
                        $providerid = $provider->id;
                    }elseif($report->amount>3000 && $report->amount<=10000){
                        $provider = Provider::where('recharge1', 'aeps3')->first();
                        $providerid = $provider->id;
                    }
                    $usercommission = \Myhelper::getCommission($report->amount, $user->scheme_id, $provider->id, $user->role->slug);
                }else{
                    $usercommission = 0;
                }
                
                User::where('id', $report->user_id)->increment('mainwallet', $report->amount + $usercommission);
            }elseif($report->option1 == "MS"){
                $provider = Provider::where('recharge1', 'ministatement')->first();
                $providerid = $provider->id;
                $usercommission = \Myhelper::getCommission($report->amount, $user->scheme_id, $provider->id, $user->role->slug);
                User::where('id', $report->user_id)->increment('mainwallet', $usercommission);
            }else{
                $usercommission = 0;
            }

            Report::where('id', $report->id)->update([
                'status'  => "success",
                'number'  => (isset($post->detail['response']['data']['aadhar'])) ? $post->detail['response']['data']['aadhar'] : $report->number,
                "refno"   => $post->detail['response']['data']['tid'],
                "balance" => $user->mainwallet,
                'profit'  => $usercommission,
                'provider_id'  => $providerid
            ]);
            try {
                if($report->amount > 500){
                    $report = Report::where('id', $report->id)->first();
                    \Myhelper::commission($report);
                }
            } catch (\Exception $th) {}
                
        }else{
            Report::where('id', $report->id)->update([
                'status' => "failed",
                'number' => (isset($post->detail['response']['data']['aadhar'])) ? $post->detail['response']['data']['aadhar'] : "null",
                'refno'  => (isset($post->detail['response']['data']['tid'])) ?$post->detail['response']['data']['tid'] :"Failed",
                'remark' => (isset($post->detail['response']['data']['comment'])) ?$post->detail['response']['data']['tid'] :"Network error"
            ]);
        }
        
        $output['STATUS'] = "SUCCESS";
        $output['MESSAGE'] = "SUCCESS";
        return response()->json($output);
    }
}
