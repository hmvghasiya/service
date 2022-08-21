<?php

namespace App\Http\Controllers\Android;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Mahaagent;
use App\Model\Api;
use App\Model\Utiid;
use App\Model\Role;
use App\Model\Microatmreport;
use App\Model\Pindata;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $api;
    public function __construct()
    {
        $this->api = Api::where('code', 'aeps')->first();
    }
    
    public function login(Request $post)
    {
        $rules = array(
            'password' => 'required',
            'mobile'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = User::where('mobile', $post->mobile)->with(['role'])->first();
        if(!$user){
            return response()->json(['status' => 'ERR', 'message' => "Your aren't registred with us." ]);
        }

        if (!\Auth::validate(['mobile' => $post->mobile, 'password' => $post->password])) {
            return response()->json(['status' => 'ERR', 'message' => 'Username and Password is incorrect']);
        }

        if (!\Auth::validate(['mobile' => $post->mobile, 'password' => $post->password, 'status' => "active"])) {
            return response()->json(['status' => 'ERR', 'message' => 'Your account currently de-activated, please contact administrator']);
        }

        if($user->apptoken == "none"){
            do {
                $string = str_random(40);
            } while (User::where("apptoken", "=", $string)->first() instanceof User);
            User::where('mobile', $post->mobile)->update(['apptoken' => $string]);
        }

        $user = User::where('mobile', $post->mobile)->with(['role'])->first();
        $utiid = Utiid::where('user_id', $user->id)->first();
        if($utiid){
            $user['utiid'] = $utiid->vleid;
            $user['utiidtxnid'] = $utiid->id;
            $user['utiidstatus'] = $utiid->status;
        }else{
            $user['utiid'] = 'no';
            $user['utiidstatus'] = 'no';
            $user['utiidtxnid'] = 'no';
        }
        $user['tokenamount'] = '107';
        return response()->json(['status' => 'TXN', 'message' => 'User details matched successfully', 'userdata' => $user]);
    }

    public function getbalance(Request $post)
    {
        $rules = array(
            'apptoken' => 'required',
            'user_id'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = User::where('id',$post->user_id)->where('apptoken',$post->apptoken)->first(['mainwallet','aepsbalance']);
        if($user){
            $output['status'] = "TXN";
            $output['message'] = "Balance Fetched Successfully";
            $output['data'] = [ "mainwallet" => $user->mainwallet , "aepsbalance" => $user->aepsbalance];
        }else{
            $output['status'] = "ERR";
            $output['message'] = "User details not matched";
        }
        return response()->json($output);
    }

    public function aepsInitiate(Request $post)
    {
        $rules = array(
            'apptoken' => 'required',
            'user_id'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        if (!\Myhelper::can('aeps_service', $post->user_id)) {
            return response()->json(['status' => "ERR", "message" => "Service Not Allowed"]);
        }

        $user = User::where('id', $post->user_id)->where('apptoken',$post->apptoken)->first();
        if($user){
            $agent = \DB::table('eko_mahaagents')->where('user_id', $post->user_id)->first();
            
            if(!$agent){
                return response()->json(['status'=>'TXF', 'message'=> "User onboarding is pending"]);
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
                    \DB::table('eko_mahaagents')->where('user_id', $post->user_id)->update($update);
                }
                
                $agent = \DB::table('eko_mahaagents')->where('user_id', $post->user_id)->first();
                if($agent->bbps_id != "activated"){
                    return response()->json(['statuscode'=>'TXF', 'message'=> "User onboard activation is pending"]);
                }
            }
            
            $url = $this->api->url."/apptransaction";
            $logo="https://".$user->company->website."/public/logos/".$user->company->logo;
            
            $parameter['token'] = $this->api->username;
            $parameter['user_code'] = $agent->bc_id;
            $parameter['logo'] = $logo;
            $parameter['company'] = $user->company->companyname;
            $header = array("Content-Type: application/json");
            $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "no");
            
            //dd([$url,$parameter, $result]);
            if($result['response'] != ''){
                
                $datas = json_decode($result['response']);
                if(isset($datas->status) && $datas->status == "TXN"){
                    return response()->json($datas);
                }else{
                    $output['status'] = "ERR";
                    $output['message'] = "Technical Error, Contact Service Provider";
                }
            }else{
                $output['status'] = "ERR";
                $output['message'] = "Technical Error, Contact Service Provider";
            }
                
        }else{
            $output['status'] = "ERR";
            $output['message'] = "User details not matched";
        }

        return response()->json($output);
    }
    
    public function aepskyc(Request $post){
        $this->api  = Api::where('code', 'aeps')->first(); 
        
        //dd($this->api);
        
        $data["bc_f_name"] = $post->bc_f_name;
        $data["bc_m_name"] = $post->bc_m_name;
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
        $data["saltkey"] = $this->api->username;
        $data["secretkey"] = $this->api->password;
        $data['kyc1'] = $post->kyc1;
        $data['kyc2'] = $post->kyc2;
        $data['kyc3'] = $post->kyc3;
        $data['kyc4'] = $post->kyc4;
        
        $url = $this->api->url."AEPS/APIBCRegistration";
        //dd($url);
        
        $header = array("Content-Type: application/json");
        $result = \Myhelper::curl($url, "POST", json_encode($data), $header, "no");
        // dd([$url,$result]);
        if($result['response'] != ''){
            $response = json_decode($result['response']);
            if($response[0]->Message == "Success"){
                $data['bc_id'] = $response[0]->bc_id;
                $data['user_id'] = $post->user_id;
                $user = Mahaagent::create($data);

                try {
                    $gpsdata = geoip($post->ip());
                    $name  = $post->bc_f_name." ".$post->bc_l_name;
                    $burl  = $this->billapi->url."RegBBPSAgent";

                    $json_data = [
                        "requestby"     => $this->billapi->username,
                        "securityKey"   => $this->billapi->password,
                        "name"          => $name,
                        "contactperson" => $name,
                        "mobileNumber"  => $post->phone1,
                        'agentshopname' => $post->shopname,
                        "businesstype"  => $post->shopType,
                        "address1"      => $post->bc_address,
                        "address2"      => $post->bc_city,
                        "state"         => $post->bc_state,
                        "city"          => $post->bc_district,
                        "pincode"       => $post->bc_pincode,
                        "latitude"      => sprintf('%0.4f', $gpsdata->lat),
                        "longitude"     => sprintf('%0.4f', $gpsdata->lon),
                        'email'         => $post->emailid
                    ];
                    
                    $header = array(
                        "authorization: Basic ".$this->billapi->optional1,
                        "cache-control: no-cache",
                        "content-type: application/json"
                    );
                    $bbpsresult = \Myhelper::curl($burl, "POST", json_encode($json_data), $header, "yes", 'MahaBill', $post->phone1);
                    //dd($bbpsresult);
                    if($bbpsresult['response'] != ''){
                        $response = json_decode($bbpsresult['response']);
                        if(isset($response->Data)){
                            $datas = $response->Data;
                            if(!empty($datas)){
                                $data['bbps_agent_id'] = $datas[0]->agentid;
                            }
                        }
                    }
                } catch (\Exception $e) {}
                
                return response()->json(['statuscode'=>'TXN',  'message'=> "Kyc Submitted"]);
            }else{
                return response()->json(['statuscode'=>'TXF',  'message'=> $response[0]->Message]);
            }
        }else{
            return response()->json(['statuscode'=>'TXF', 'message'=> "Something went wrong"]);
        }
        
    }
    public function GetState(Request $req){
        //dd("rttrrtrtrt");
        $url= 'http://uat.mahagram.in/Common/GetState';
       
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        
        $result= json_decode($response);
        
        //var_dump($result);
        return response()->json(['status' => 'success', 'message' => 'State Fached Successfully',"data"=>$result]);
  
}

    public function GetDistrictByState(Request $req){
        //dd("rttrrtrtrt");
        $url= 'http://uat.mahagram.in/Common/GetDistrictByState';
        $header = array("Content-Type: application/json");
        $parameter["stateid"] = $req->stateid;
        $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "no", 'App\Model\Report', '0');
        $res= $result['response'];
       // var_dump($res);
        $jsondata= json_decode($res);
        
        return response()->json(['status' => 'success', 'message' => 'District Fached Successfully',"data"=>$jsondata]);
  
} 
    public function bcstatus(Request $post){
        // dd("ttttt");
        $user = User::where('id', $post->user_id)->count();
        if($user){
            $agent = Mahaagent::where('user_id', $post->user_id)->first();
            if($agent){
               $data['bc_id'] = $agent->bc_id;
               $data['phone1'] = $agent->phone1;
               $data['status'] = $agent->status;
            }
            return response()->json(['statuscode'=>'TXN',  'message'=> "Bc id fatched successfully",'data'=>$data]);
        }
        
    }
     public function microatmInitiate(Request $post)
    {
        $rules = array(
            'apptoken' => 'required',
            'user_id'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        if (!\Myhelper::can('matm_service', $post->user_id)) {
            return response()->json(['status' => "ERR", "message" => "Service Not Allowed"]);
        }

        $user = User::where('id', $post->user_id)->count();
        if($user){

            $agent = Mahaagent::where('user_id', $post->user_id)->first();

            if($agent){
                $api = Api::where('code', 'microatm')->first();

                if(!$api || $api->status == 0){
                    return response()->json(['status' => "ERR", "message" => "Service Not Allowed"]);
                }

                do {
                    $post['txnid'] = $this->transcode().rand(1111111111, 9999999999);
                } while (Microatmreport::where("txnid", "=", $post->txnid)->first() instanceof Microatmreport);

                $insert = [
                    "mobile"   => $agent->phone1,
                    "aadhar"   => $agent->bc_id,
                    "txnid"    => $post->txnid,
                    "user_id"  => $user->id,
                    "balance"  => $user->aepsbalance,
                    'status'   => 'initiated',
                    'credited_by' => $user->id,
                    'type'        => 'credit',
                    'api_id'      => $api->id
                ];

                $matmreport = Microatmreport::create($insert);

                if($matmreport){
                    $output['status'] = "TXN";
                    $output['message'] = "Deatils Fetched Successfully";
                    $output['data'] = [ 
                        "saltKey"   => $api->username , 
                        "secretKey" => $api->password,
                        "BcId"      => $agent->bc_id,
                        "UserId"    => $post->user_id,
                        "bcEmailId" => $agent->emailid,
                        "Phone1"    => $agent->phone1,
                        "clientrefid" => $post->txnid
                    ];
                }else{
                    $output['status'] = "ERR";
                    $output['message'] = "Something went wrong, please try again";
                }
            }
            else{
                $output['status'] = "ERR";
                $output['message'] = "Aeps Registration Pending";
            }
        }else{
            $output['status'] = "ERR";
            $output['message'] = "User details not matched";
        }

        return response()->json($output);
    }

    public function microatmUpdate(Request $post)
    {
        \DB::table('microlog')->insert(['response' => json_encode($post->all())]);
        $rules = array(
            'apptoken' => 'required',
            'user_id'  =>'required|numeric'
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        if (!\Myhelper::can('matm_service', $post->user_id)) {
            return response()->json(['status' => "ERR", "message" => "Service Not Allowed"]);
        }

        $user = User::where('id', $post->user_id)->first();
        if(!$user){
            $output['status'] = "ERR";
            $output['message'] = "User details not matched";
            return response()->json($output);
        }

        $response = json_decode($post->response);

        $rules = array(
            'clientrefid' => 'required',
            'refstan'     => 'required',
            'statuscode'  => 'required',
            'tid'      => 'required',
            'txnamount'=> 'required',
            'mid'      => 'required',
        );

        $validator = \Validator::make((array)$response, array_reverse($rules));
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $key => $value) {
                $error = $value[0];
            }
            return response()->json(array(
                'status' => 'ERR',  
                'message' => $error
            ));
        }

        $report = Microatmreport::where('txnid', $response->clientrefid)->where('user_id', $post->user_id)->first();

        if(!$report){
            $output['status'] = "ERR";
            $output['message'] = "Report Not Found";
            return response()->json($output);
        }

        if($report->status != "initiated"){
            $output['status']  = "ERR";
            $output['message'] = "Permission Not Allowed";
            return response()->json($output);
        }

        $update['amount'] = $response->txnamount;
        $update['payid']  = $response->refstan;
        $update['refno']  = $response->rrn;
        $update['remark'] = $response->bankremarks;
        $update['aadhar'] = $response->cardno;
        $update['mytxnid']= $response->refstan;
        $update['balance']= $user->microatmbalance;

        if($response->statuscode == '00'){
            $update['status'] = "success";
            if($update['amount'] > 0){
                if($response->txnamount > 99 && $response->txnamount <= 3000){
                    $provider = Provider::where('recharge1', 'matm1')->first();
                }elseif($response->txnamount > 3000 && $response->txnamount <= 10000){
                    $provider = Provider::where('recharge1', 'matm2')->first();
                }
                
                $post['provider_id'] = $provider->id;
                if($response->txnamount > 500){
                    $update['charge'] = \Myhelper::getCommission($response->txnamount, $user->scheme_id, $post->provider_id, $user->role->slug);
                }else{
                    $update['charge'] = 0;
                }

                User::where('id', $user->id)->increment('microatmbalance', $update['amount'] + $update['charge']);
            }
        }elseif(in_array($response->statuscode, ['101', '104', '55', '103', '49', '51','91','102','92'])){
            $update['status']     = "failed";
            $update['terminalid'] = "update";
        }else{
            $update['status']     = "pending";
        }
        
        Microatmreport::where('id', $report->id)->update($update);
        
        $output['status']  = "TXN";
        $output['message'] = "Transaction Successfully";

        return response()->json($output);
    }
     public function passwordResetRequest(Request $post)
    {
        $rules = array(
            'mobile'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = \App\User::where('mobile', $post->mobile)->first();
        if($user){
            $otp = rand(11111111, 99999999);
            $content = "Dear Sahaj Money partner, your password reset token is ".$otp."-Sahaj Money";
            $sms = \Myhelper::sms($post->mobile, $content);
            \Myhelper::whatsapp($post->mobile, $content);
            $otpmailid   = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
            $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();
            try {
                $mail = \Myhelper::mail('mail.password', ["token" => $otp, "name" => $user->name], $user->email, $user->name, $otpmailid->value, $otpmailname->value, "Reset Password");
            } catch (\Exception $e) {
                $mail = "fail";
            }
            
            if($sms == "success" || $mail == "success"){
                \App\User::where('mobile', $post->mobile)->update(['remember_token'=> $otp]);
                return response()->json(['status' => 'TXN', 'message' => "Password reset token sent successfully"]);
            }else{
                return response()->json(['status' => 'ERR', 'message' => "Something went wrong"]);
            }
        }else{
            return response()->json(['status' => 'ERR', 'message' => "You aren't registered with us"]);
        } 
    }

    public function passwordReset(Request $post)
    {
        $rules = array(
            'mobile'  =>'required|numeric',
            'password'  =>'required',
            'token'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = \App\User::where('mobile', $post->mobile)->where('remember_token' , $post->token)->get();
        if($user->count() == 1){
            $update = \App\User::where('mobile', $post->mobile)->update(['password' => bcrypt($post->password),'passwordold' => $post->password]);
            if($update){
                return response()->json(['status' => "TXN", 'message' => "Password reset successfully"], 200);
            }else{
                return response()->json(['status' => 'ERR', 'message' => "Something went wrong"], 400);
            }
        }else{
            return response()->json(['status' => 'ERR', 'message' => "Please enter valid token"], 400);
        }
    }
    
    public function changepassword(Request $post)
    {
        $rules = array(
            'apptoken' => 'required',
            'user_id'  =>'required|numeric',
            'oldpassword'  =>'required|min:8',
            'password'  =>'required|min:8',
        );
            
        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = User::where('id', $post->user_id)->first();
        if(!\Myhelper::can('password_reset', $post->user_id)){
            return response()->json(['status' => 'ERR', 'message' => "Permission Not Allowed"]);
        }
        
        if(!\Myhelper::hasRole('admin')){
           
            $credentials = [
                'mobile' => $user->mobile,
                'password' => $post->oldpassword
            ];
            
    
            if(!\Auth::validate($credentials)){
                return response()->json(['status' => 'ERR', 'message' => "Please enter corret old password"]);
            }
        }

        	
        $response = User::where('id', $post->user_id)->update(['password' => bcrypt($post->password), 'passwordold' => $post->password]);
        if($response){
            return response()->json(['status' => 'TXN', 'message' => 'User password changed successfully']);
        }else{
            return response()->json(['status' => 'ERR', 'message' => "Something went wrong"]);
        }
    }
    
    public function registration(Request $post)
    {
        $rules = array(
            'name'       => 'required',
            'mobile'     => 'required|numeric|digits:10|unique:users,mobile',
            'email'      => 'required|email|unique:users,email',
            'shopname'   => 'required|unique:users,shopname',
            'pancard'    => 'required|unique:users,pancard',
            'aadharcard' => 'required|numeric|unique:users,aadharcard|digits:12',
            'state'      => 'required',
            'city'       => 'required',
            'address'    => 'required',
            'pincode'    => 'required|digits:6|numeric',
            'slug'       => ['required', Rule::In(['retailer', 'md', 'distributor', 'whitelable'])]
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $admin = User::whereHas('role', function ($q){
            $q->where('slug', 'admin');
        })->first(['id', 'company_id']);

        $role = Role::where('slug', $post->slug)->first();

        $post['role_id']    = $role->id;
        $post['id']         = "new";
        $post['parent_id']  = $admin->id;
        $post['password']   = bcrypt($post->mobile);
        $post['company_id'] = $admin->company_id;
        $post['status']     = "block";
        $post['kyc']        = "pending";

        $scheme = \DB::table('default_permissions')->where('type', 'scheme')->where('role_id', $role->id)->first();
        if($scheme){
            $post['scheme_id'] = $scheme->permission_id;
        }

        $response = User::updateOrCreate(['id'=> $post->id], $post->all());
        if($response){
            $permissions = \DB::table('default_permissions')->where('type', 'permission')->where('role_id', $post->role_id)->get();
            if(sizeof($permissions) > 0){
                foreach ($permissions as $permission) {
                    $insert = array('user_id'=> $response->id , 'permission_id'=> $permission->permission_id);
                    $inserts[] = $insert;
                }
                \DB::table('user_permissions')->insert($inserts);
            }

            try {
                $content = "Dear Partner, your login details are mobile - ".$post->mobile." & password - ".$post->mobile;
                \Myhelper::sms($post->mobile, $content);
                \Myhelper::whatsapp($post->mobile, $content);

                $otpmailid   = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
                $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();

                $mail = \Myhelper::mail('mail.member', ["username" => $post->mobile, "password" => "12345678", "name" => $post->name], $post->email, $post->name, $otpmailid, $otpmailname, "Member Registration");
            } catch (\Exception $e) {}

            return response()->json(['status' => "TXN", 'message' => "Registration Successful"], 200);
        }else{
            return response()->json(['status' => 'ERR', 'message' => "Something went wrong, please try again"], 400);
        }
    }
    
    public function getotp(Request $post)
    {
        $rules = array(
            'mobile'  =>'required|numeric'
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = \App\User::where('mobile', $post->mobile)->first();
        if($user){
            $company = \App\Model\Company::where('id', $user->company_id)->first();
            $companyname=$company->companyname;
            $otp = rand(111111, 999999);
            $msg="Dear Sir, Your OTP for login is ".$otp." and valid for 5 min. Nikatby.in";
            $tempid="";
            $sms = \Myhelper::sms($post->mobile, $msg, $tempid,$company);
            \Myhelper::whatsapp($post->mobile, $msg);
            if($sms == "success"){
                $user = \DB::table('password_resets')->insert([
                    'mobile' => $post->mobile,
                    'token' => \Myhelper::encrypt($otp, "antliaFin@@##2025500"),
                    'last_activity' => time()
                ]);
            
                return response()->json(['statuscode' => 'TXN', 'message' => "Otp has been send successfully"]);
            }else{
                return response()->json(['statuscode' => 'ERR', 'message' => "Something went wrong"]);
            }
        }else{
            return response()->json(['statuscode' => 'ERR', 'message' => "You aren't registered with us"]);
        }  
    }
    
    public function setpin(Request $post)
    {
        $rules = array(
            'otp'  =>'required|numeric',
            'tpin'  =>'required|numeric|confirmed',
            'mobile'=> 'required|numeric'
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        $user = \DB::table('password_resets')->where('mobile', $post->mobile)->where('token' , \Myhelper::encrypt($post->otp, "antliaFin@@##2025500"))->first();
        if($user){
            try {
                Pindata::where('user_id', $post->id)->delete();
                $apptoken = Pindata::create([
                    'pin' => \Myhelper::encrypt($post->tpin, "antliaFin@@##2025500"),
                    'user_id'  => $post->user_id
                ]);
            } catch (\Exception $e) {
                return response()->json(['statuscode' => 'ERR', 'message' => 'Try Again']);
            }
            
            if($apptoken){
                \DB::table('password_resets')->where('mobile', $post->mobile)->where('token' , \Myhelper::encrypt($post->otp, "antliaFin@@##2025500"))->delete();
                return response()->json(['statuscode' => "TXN", "message" => 'Transaction Pin Generate Successfully']);
            }else{
                return response()->json(['statuscode' => "ERR", "message" => "Something went wrong"]);
            }
        }else{
            return response()->json(['statuscode' => "ERR", "message" => "Please enter valid otp"]);
        }  
    }
}
