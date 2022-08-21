<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Model\EkoMahaagent;
use App\Model\Mahastate;
use App\Model\Report;
use App\Model\Commission;
use App\Model\Aepsreport;
use App\Model\Provider;
use App\Model\Api;
use App\Http\Controllers\CURLFile;
use App\Http\Controllers\Storage;

class EkoAepsController extends Controller
{
    protected $api, $billapi, $kapi, $aepsekoapi;
    public function __construct()
    {
        
        $this->aepsekoapi = Api::where('code', 'aepsekoapi')->first();
    }
    
     public function index(Request $post)
      {
       
       $data['agent'] = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
        
       
        $data['mahastate'] = Mahastate::get();
        
        if(!$data['agent']){
            $data['mahastate'] = Mahastate::get();
            
        }
        
        return view('service.newaeps')->with($data);
    }
    
     public function index1(Request $post)
    {
       $data['agent'] = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->first();
        if(!$data['agent']){
           
        
            
        }
        else{
        $data['serviceactive'] = \DB::table('eko_mahaagents')->where('user_id', \Auth::id())->where('bbps_id','activated')->first();
        $data['mahastate'] = Mahastate::get();
        
        if(!$data['serviceactive']){
        $data['user_code']=$data['agent']->bc_id;
        $data['city']=$data['agent']->bc_city;
        $data['state']=$data['agent']->bc_state;
        $data['address']=$data['agent']->bc_address;
        $data['pincode']=$data['agent']->bc_pincode;
        }
        else{
        $data['user_code']=$data['agent']->bc_id;    
        }
        }
        return view('service.service')->with($data);
    }
    
public function serviceactivate(Request $post)
{
       
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

$key = "0d619438-954f-463d-950a-02a91ee95d54";

// Encode it using base64
$encodedKey = base64_encode($key);
$secret_key_timestamp = "".round(microtime(true) * 1000);
$signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);

// Encode it using base64
$secret_key = base64_encode($signature); 
$addre=[ "line"=> $post->bc_city,"city"=>$post->bc_city,"state"=>$post->bc_state,"pincode"=>$post->bc_pincode];

$address=json_encode($addre);
$json1=  "service_code=43&initiator_id=7471112503&user_code=21461003&devicenumber=123234234234234&modelname=Morpho&office_address=$address&address_as_per_proof=$address";

$target_url = $this->aepsekoapi->url."user/service/activate";   


$cfile1 =new \CURLFile(realpath($uploadedpancardimg));
$cfile2 =new \CURLFile(realpath($uploadedaadhafront));
$cfile3 = new \CURLFile(realpath($uploadedaadharback));

    $post = array (
              'pan_card' => $cfile1,
			  'aadhar_front' => $cfile2,
			  'aadhar_back' => $cfile3,
			  'form-data' => "service_code=43&initiator_id=7471112503&user_code=$post->user_code&devicenumber=123234234234234&modelname=Morpho&office_address=$address&address_as_per_proof=$address",
			  ); 
	$header=array('Content-Type: multipart/form-data','developer_key: 23edcb2a5132ba03d342fa815487ac4a', 'secret-key:'.$secret_key,'secret-key-timestamp:'.$secret_key_timestamp);		  
    $result = \Myhelper::curl($target_url, "PUT", $post, $header, "no");
    $response = json_decode($result['response']);
    
    if($result['response'] != ''){
            $response = json_decode($result['response']);
           
            if($response->data->service_status_desc == 'Pending'){
                $update['bbps_id'] = 'activated';
                 $update['status'] = 'success';
                
                $user = \DB::table('eko_mahaagents')->where('bc_id',$response->data->user_code)->update($update);
                
                return response()->json(['statuscode'=>'TXN', 'status'=>'Service Activated', 'message'=> $response->message]);
                
                } 
                elseif($response->data->service_status_desc == 'Activated') {
                $update['bbps_id'] = 'activated';
                $update['status'] = 'success';
                
                $user = \DB::table('eko_mahaagents')->where('bc_id',$response->data->user_code)->update($update);
                
                return response()->json(['statuscode'=>'TXN', 'status'=>'Service Activated', 'message'=> $response->message]);
            }
                else{
                    
                    return response()->json(['statuscode'=>'TXF', 'status'=>'Failed', 'message'=> $response->message ]);
                }
                
            }else{
                return response()->json(['statuscode'=>'TXF', 'status'=>'Failed', 'message'=> $response->message]);
            }
    
   
    }
    
     public function registration1(Request $post)
    {
        
       
            $key = $this->aepsekoapi->optional1;
            
            // Encode it using base64
            $encodedKey = base64_encode($key);
            
            // Get current timestamp in milliseconds since UNIX epoch as STRING
            // Check out https://currentmillis.com to understand the timestamp format
            $secret_key_timestamp = "".round(microtime(true) * 1000);
            
            // Computes the signature by hashing the salt with the encoded key 
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            
            // Encode it using base64
            $secret_key = base64_encode($signature); 
            $addre=[ "line"=> $post->bc_city,"city"=>$post->bc_city,"state"=>$post->bc_state,"pincode"=>$post->bc_pincode];
            $address=json_encode($addre);
            $json1=  "initiator_id=".$this->aepsekoapi->username."&pan_number=$post->bc_pan&mobile=$post->phone1&first_name=$post->bc_f_name&last_name=$post->bc_l_name&email=$post->emailid&residence_address=$address&dob=$post->bc_dob&shop_name=$post->shopname";
            $url= $this->aepsekoapi->url."user/onboard";
            $url="https://staging.eko.in:25004/ekoapi/v1/user/onboard";
           
            $header=array(
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
                "developer_key: ".$this->aepsekoapi->password,
                "secret-key:".$secret_key,
                "secret-key-timestamp:".$secret_key_timestamp
              );
            
        $result = \Myhelper::curl($url, "PUT", $json1, $header, "yes", 'EkoKyc', $post->phone1);
        //dd([$url, $header,$json1,$url,$result]);
        
        
                
        if($result['response'] != ''){
            $response = json_decode($result['response']);
            
            if($response->message == "User onboarding successfull"){
                
                
                $data['bc_id'] = $response->data->user_code;
                $data['bbps_id']='notactivated';
                $data['bbps_agent_id'] =$response->data->initiator_id;
                $data['user_id'] = \Auth::id();
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
               
          
                
                $user = \DB::table('eko_mahaagents')->insert($data);
                
                return response()->json(['statuscode'=>'TXN', 'status'=>'Transaction Successfull', 'message'=> "Kyc Submitted"]);
                
                } 
                else{
                
                    
                    return response()->json(['statuscode'=>'TXF', 'status'=>'Transaction Failed', 'message'=> $response->message ]);
                }
                
            }else{
                return response()->json(['statuscode'=>'TXF', 'status'=>'Transaction Failed', 'message'=> $response->message]);
            }
        
    }
    
    public function serviceenquiry(){
        $key = "0d619438-954f-463d-950a-02a91ee95d54";
            
            // Encode it using base64
            $encodedKey = base64_encode($key);
            
            // Get current timestamp in milliseconds since UNIX epoch as STRING
            // Check out https://currentmillis.com to understand the timestamp format
            $secret_key_timestamp = "".round(microtime(true) * 1000);
            
            // Computes the signature by hashing the salt with the encoded key 
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            
            // Encode it using base64
            $secret_key = base64_encode($signature);
        $url= $this->aepsekoapi->url."user/services/user_code:21461005?initiator_id=7471112503";
        $header=array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Host: staging.eko.in:25004",
    "cache-control: no-cache",
    "developer_key: 23edcb2a5132ba03d342fa815487ac4a",
    "secret-key:".$secret_key,
    "secret-key-timestamp:".$secret_key_timestamp
  );
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "25002",
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Host: api.eko.in:25002",
    "cache-control: no-cache",
    "developer_key: 23edcb2a5132ba03d342fa815487ac4a",
    "secret-key:".$secret_key,
    "secret-key-timestamp:".$secret_key_timestamp
  ),
));

$response = curl_exec($curl);
dd($url,$header,$response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
    }
    
     public function ekoaepslog(Request $post)
     {
        //dd('test');
       
       $data= \DB::table('microlog')->insert(['product' => 'ekoaeps', 'response' => json_encode($post->all())]);
      
    if(!$this->aepsekoapi || $this->aepsekoapi->status == 0){
           
            $output['action'] = 'go';
            $output['allow'] = false;
            $output['message'] = "Service Down";
            return response()->json($output);
        }
    if($data=='true'){
            $encode= json_encode($post->all());
            $decode= json_decode($encode);
    if($post->action=='debit-hook'){
            $agent = \DB::table('eko_mahaagents')->where('bc_id', $decode->detail->data->user_code)->first();
            $user = User::where('id', $agent->user_id)->first();
    if(!$agent){
            $output['TRANSACTION_ID'] = date('Ymdhis');
            $output['VENDOR_ID'] = $agent->user_id.date('Ymdhis');
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Service Down";
            return response()->json($output);
            }
            
    if($decode->detail->data->type=='2'){
            $key = "0d619438-954f-463d-950a-02a91ee95d54";
            $encodedKey = base64_encode($key);
            $secret_key_timestamp = "".round(microtime(true) * 1000);
//secret_key_timestamp + customer_id + user_code
            $string= $secret_key_timestamp.$decode->detail->data->customer_id.$decode->detail->data->amount.$decode->detail->data->user_code;
            $requesthash = hash_hmac('SHA256', $string, $encodedKey, true);
            $request_hash=base64_encode($requesthash);
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            $secret_key = base64_encode($signature); 
//dd($secret_key_timestamp,$secret_key,$request_hash);
            $post['provider_id'] = '0';
            $insert = [
                        'number' => $decode->detail->data->user_code,
                        'mobile' => $user->mobile,
                        'provider_id' => $post->provider_id,
                        'api_id'=>'12',
                        'amount' =>   $decode->detail->data->amount,
                        'txnid'  =>   $decode->detail->client_ref_id,
                        'option1'  => 'CW',
                        'option2'  => $decode->detail->data->customer_id,
                        'option3'  => $decode->detail->data->bank_code,
                        'option4'  => $decode->action,
                        'status' => 'pending',
                        'user_id'=> $user->id,
                        'credit_by' => $user->id,
                        'rtype' => 'main',
                        'via'   => 'portal',
                        'balance' => $user->mainwallet,
                        'trans_type'  => 'credit',
                        'product'     => 'aeps'
                    ];
            }
    elseif($decode->detail->data->type=='3')  {
             //encryption process  
            $key = "0d619438-954f-463d-950a-02a91ee95d54";
            $encodedKey = base64_encode($key);
            $secret_key_timestamp = "".round(microtime(true) * 1000);
//secret_key_timestamp + customer_id + user_code
            $string= $secret_key_timestamp.$decode->detail->data->customer_id.$decode->detail->data->user_code;
            $requesthash = hash_hmac('SHA256', $string, $encodedKey, true);
            $request_hash=base64_encode($requesthash);
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            $secret_key = base64_encode($signature); 
//dd($secret_key_timestamp,$secret_key,$request_hash);

            $post['provider_id'] = '0';
            $insert = [
                        'number' => $decode->detail->data->user_code,
                        'mobile' => $user->mobile,
                        'provider_id' => $post->provider_id,
                        'api_id'=>'12',
                        'amount' =>   '0',
                        'txnid'  =>   $decode->detail->client_ref_id,
                        'option1'  => 'BE',
                        'option2'  => $decode->detail->data->customer_id,
                        'option3'  => $decode->detail->data->bank_code,
                        'option4'  => $decode->action,
                        'status' => 'pending',
                        'user_id'=> $user->id,
                        'credit_by' => $user->id,
                        'rtype' => 'main',
                        'via'   => 'portal',
                        'balance' => $user->mainwallet,
                        'trans_type'  => 'credit',
                        'product'     => 'aeps'
                    ];
    }      
    else{
              //encryption process  
            $key = "0d619438-954f-463d-950a-02a91ee95d54";
            $encodedKey = base64_encode($key);
            $secret_key_timestamp = "".round(microtime(true) * 1000);
//secret_key_timestamp + customer_id + user_code
            $string= $secret_key_timestamp.$decode->detail->data->customer_id.$decode->detail->data->user_code;
            $requesthash = hash_hmac('SHA256', $string, $encodedKey, true);
            $request_hash=base64_encode($requesthash);
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            $secret_key = base64_encode($signature); 
//dd($secret_key_timestamp,$secret_key,$request_hash);

            $post['provider_id'] = '0';
            $insert = [
                        'number' => $decode->detail->data->user_code,
                        'mobile' => $user->mobile,
                        'provider_id' => $post->provider_id,
                        'amount' =>   '0',
                        'txnid'  =>   $decode->detail->client_ref_id,
                        'option1'  => 'MS',
                        'option2'  => $decode->detail->data->customer_id,
                        'option3'  => $decode->detail->data->bank_code,
                        'option4'  => $decode->action,
                        'status' => 'pending',
                        'user_id'=> $user->id,
                        'credit_by' => $user->id,
                        'rtype' => 'main',
                        'api_id'=>'12',
                        'via'   => 'portal',
                        'balance' => $user->mainwallet,
                        'trans_type'  => 'credit',
                        'product'     => 'aeps'
                    ];
    }

    do {
            $post['payid'] = $this->transcode().rand(111111111, 999999999);
        } while (Report::where("payid", "=", $post->payid)->first() instanceof Report);
        $insert['payid'] = $post->payid;

        do {
            $post['description'] = rand(11111111, 99999999);
        } while (Report::where("description", "=", $post->description)->first() instanceof Report);
        $insert['description'] = $post->description;
        Report::create($insert);
           
        $output['action'] = 'go';
        $output['allow'] = true;
        $output['secret_key_timestamp'] = $secret_key_timestamp;
        $output['request_hash'] = $request_hash;
        $output['secret_key'] = $secret_key;
        //dd($output);
        return response()->json($output); 
    }     
        if($post->action=='eko-response'){
           $encode= json_encode($post->all());
           $decode= json_decode($encode);
           $report = Report::where('txnid', $decode->detail->client_ref_id)->first();
         
        if(!$report){
            $output['STATUS'] = "FAILED";
            $output['MESSAGE'] = "Report Not Found";
            return response()->json($output);
        }
            $user = User::where('id', $report->user_id)->first();
            $update['profit']  = 0;
            $update['balance'] = $user->mainwallet;
            $update['provider_id'] = '0';
            $update['refno'] = $decode->detail->response->data->bank_ref_num;
            //dd($decode);
        if(isset($decode->detail->response->response_status_id) && strtolower($decode->detail->response->response_status_id) == "0" && $report->status == "pending"){
            $update['status']  = "success";
        }elseif(isset($decode->detail->response->response_status_id) && strtolower($decode->detail->response->response_status_id) == "1" && $report->status == "pending"){
            $update['status']  = "failed";
        }
        
        if($report->option1=='CW'){
            if($report->amount > 99 && $report->amount <= 499){
                $provider = Provider::where('recharge1', 'aeps1')->first();
            }elseif($report->amount>499 && $report->amount<=1000){
                $provider = Provider::where('recharge1', 'aeps2')->first();
            }elseif($report->amount>1000 && $report->amount<=1500){
                $provider = Provider::where('recharge1', 'aeps3')->first();
            }elseif($report->amount>1500 && $report->amount<=2000){
                $provider = Provider::where('recharge1', 'aeps4')->first();
            }elseif($report->amount>2000 && $report->amount<=2500){
                $provider = Provider::where('recharge1', 'aeps5')->first();
            }elseif($report->amount>2500 && $report->amount<=3000){
                $provider = Provider::where('recharge1', 'aeps6')->first();
            }elseif($report->amount>3000 && $report->amount<=10000){
                $provider = Provider::where('recharge1', 'aeps7')->first();
            }
            $update['provider_id'] = '0';
        if($report->amount > 500){
                $update['profit'] = \Myhelper::getCommission($report->amount, $user->scheme_id, $provider->id, $user->role->slug);
            }
        }
           Report::where('id', $report->id)->update($update);
           
         if(isset($decode->detail->response->response_status_id) && strtolower($decode->detail->response->response_status_id) == "0" && $report->status == "pending"){
            User::where('id', $report->user_id)->increment('mainwallet', $report->amount+$update['profit']);
            try {
                if($report->amount > 499){
                    $report = Report::where('id', $report->id)->first();
                    \Myhelper::commission($report);
                }
            } catch (\Exception $th) {}
        }  
            $output['STATUS'] = "SUCCESS";
            $output['MESSAGE'] = "Success";
            return response()->json($output);   
     }
}
        
 }
    
    
   
}