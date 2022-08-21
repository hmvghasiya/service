<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Circle;
use App\Model\Role;
use App\Model\Pindata;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $data['state'] = Circle::all();
        $data['roles'] = Role::whereIn('slug', ['whitelable', 'md', 'distributor', 'retailer'])->get();
        // dd($data);
        return view('welcome')->with($data);
    }
    
    public function login(Request $post)
    {
        $user = User::where('mobile', $post->mobile)->first();
        if(!$user){
            return response()->json(['status' => "Your aren't registred with us." ], 400);
        }
        $company = \App\Model\Company::where('id', $user->company_id)->first();
        $otprequired = \App\Model\PortalSetting::where('code', 'otplogin')->first();

        if(!\Auth::validate(['mobile' => $post->mobile, 'password' => $post->password])){
            return response()->json(['status'=> 'Username or password is incorrect'], 400);
        }

        if (!\Auth::validate(['mobile' => $post->mobile, 'password' => $post->password,'status'=> "active"])) {
            return response()->json(['status' => 'Your account currently de-activated, please contact administrator'], 400);
        }

        if($otprequired->value == "yes" && $company->senderid){
            if($post->has('otp') && $post->otp == "resend"){
                if($user->otpresend < 10){
                    $otp = rand(111111, 999999);
                    if($company->senderid=='PAYAIR')
                     {
                      $tempid="1207162425650031589";
                      $msg = "Dear partner, your login otp is ".$otp." Don't share with anyone Regards ".$otp.". AIRMOBI";
                      $sms     = \Myhelper::sms($post->mobile, $msg,$tempid,$company);
                    }
                    else{
                       $tempid="";
                       $msg="Dear Sir, Your OTP for login is ".$otp." and valid for 5 min. Nikatby.in";
                       $send = \Myhelper::sms($post->mobile, $msg,$tempid,$company); 
                    }
                    \Myhelper::whatsapp($post->mobile, $msg);
                    $otpmailid   = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
                    $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();
                    $mail = \Myhelper::mail('mail.otp', ["otp" => $otp, "name" => $user->name], $user->email, $user->name, $otpmailid->value, $otpmailname->value, "Login Otp");
                  
                    if($send == 'success'){
                        User::where('mobile', $post->mobile)->update(['otpverify' => $otp, 'otpresend' => $user->otpresend+1]);
                        return response()->json(['status' => 'otpsent'], 200);
                    }else{
                        return response()->json(['status' => 'Please contact your service provider provider'], 400);
                    }
                }else{
                    return response()->json(['status' => 'Otp resend limit exceed, please contact your service provider'], 400);
                }
            }

            if($user->otpverify == "yes"){
                $otp  = rand(111111, 999999);
                if($company->senderid=='PAYAIR')
                     {
                      $tempid="1207162425650031589";
                      $msg = "Dear partner, your login otp is ".$otp." Don't share with anyone Regards ".$otp.". AIRMOBI";
                      $sms     = \Myhelper::sms($post->mobile, $msg,$tempid,$company);
                    }
                    else{
                       $tempid="";
                       $msg="Dear Sir, Your OTP for login is ".$otp." and valid for 5 min. Nikatby.in";
                       $send = \Myhelper::sms($post->mobile, $msg,$tempid,$company); 
                    }
                    \Myhelper::whatsapp($post->mobile, $msg);
                    
                if($company->senderid=='PAYAIR')
                {
                  $otpmailid="info@airmobipay.co.in";
                  $otpmailname="AIRMOBI PAYMENT TECHNOLOGIES";
                  $mail = \Myhelper::mail('mail.otp', ["otp" => $otp, "name" => $user->name], $user->email, $user->name, $otpmailid, $otpmailname, "Login Otp");
                }
                else{
                $otpmailid   = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
                $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();
                $mail = \Myhelper::mail('mail.otp', ["otp" => $otp, "name" => $user->name], $user->email, $user->name, $otpmailid->value, $otpmailname->value, "Login Otp");
                }
                
                
                if($send == 'success'){
                    User::where('mobile', $post->mobile)->update(['otpverify' => $otp]);
                    return response()->json(['status' => 'otpsent'], 200);
                }else{
                    return response()->json(['status' => 'Please contact your service provider provider'], 400);
                }
            }else{
                if(!$post->has('otp')){
                    return response()->json(['status' => 'preotp'], 200);
                }
            }

            if (\Auth::attempt(['mobile' =>$post->mobile, 'password' =>$post->password, 'otpverify' =>$post->otp, 'status'=>"active"])){
                return response()->json(['status' => 'Login'], 200);
            }else{
                return response()->json(['status' => 'Please provide correct otp'], 400);
            }

        }else{
            if (\Auth::attempt(['mobile' =>$post->mobile, 'password' =>$post->password, 'status'=> "active"])) {
                return response()->json(['status' => 'Login'], 200);
            }else{
                return response()->json(['status' => 'Something went wrong, please contact administrator'], 400);
            }
        }
    }

    public function logout(Request $request)
    {
        \Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function passwordReset(Request $post)
    {
        $rules = array(
            'type' => 'required',
            'mobile'  =>'required|numeric',
        );

        $validate = \Myhelper::FormValidator($rules, $post);
        if($validate != "no"){
            return $validate;
        }

        if($post->type == "request" ){
            $user = \App\User::where('mobile', $post->mobile)->first();
            if($user){
                $otp = rand(11111111, 99999999);
                $content = "Dear partner , your password reset token is ".$otp;
                $sms = \Myhelper::sms($post->mobile, $content);
                \Myhelper::whatsapp($post->mobile, $content);
                $otpmailid = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
                $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();
                $mail = \Myhelper::mail('mail.password', ["token" => $otp, "name" => $user->name], $user->email, $user->name, $otpmailid->value, $otpmailname->value, "Reset Password");
                
                //dd($mail);
                if($sms == "success" || $mail == "success"){
                    \App\User::where('mobile', $post->mobile)->update(['remember_token'=> $otp]);
                    return response()->json(['status' => 'TXN', 'message' => "Password reset token sent successfully"], 200);
                }else{
                    return response()->json(['status' => 'ERR', 'message' => "Something went wrong"], 400);
                }
            }else{
                return response()->json(['status' => 'ERR', 'message' => "You aren't registered with us"], 400);
            }
        }else{
            $user = \App\User::where('mobile', $post->mobile)->where('remember_token' , $post->token)->get();
            if($user->count() == 1){
                $update = \App\User::where('mobile', $post->mobile)->update(['password' => bcrypt($post->password), 'passwordold' => $post->password]);
                if($update){
                    return response()->json(['status' => "TXN", 'message' => "Password reset successfully"], 200);
                }else{
                    return response()->json(['status' => 'ERR', 'message' => "Something went wrong"], 400);
                }
            }else{
                return response()->json(['status' => 'ERR', 'message' => "Please enter valid token"], 400);
            }
        }  
    }
    
     public function registration(Request $post)
    {
        //dd($post->all());
        

       $this->validate($post, [
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
      ]);

        $admin = User::whereHas('role', function ($q){
            $q->where('slug', 'admin');
        })->first(['id', 'company_id']);

        $role = Role::where('slug', $post->slug)->first();

        $post['role_id']    = $role->id;
        $post['id']         = "new";
        $post['parent_id']  = $admin->id;
        $post['password']   = bcrypt('12345678');
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
               // $terminid='1707162047869921310';
             //$content="Dear ".$post->mobile.", Your profile is now created on our system. Username : ".$post->mobile.", password : ".$post->mobile.", Nikatby.in";
            //$content="Dear ".$post->mobile.", your login details are mobile - ".$post->mobile." & password - ".$post->mobile." Don't share with anyone Regards, RAJVEER TECHNOLOGY";
            //$content = "Dear Partner, your login details are mobile - ".$post->mobile." & password - ".$post->mobile;
            //\Myhelper::sms($post->mobile, $content);
            $msg = "Dear Partner, your login details are mobile - ".$post->mobile." & password - ".$post->mobile;
            \Myhelper::whatsapp($post->mobile, $msg);

                $otpmailid   = \App\Model\PortalSetting::where('code', 'otpsendmailid')->first();
                $otpmailname = \App\Model\PortalSetting::where('code', 'otpsendmailname')->first();

                $mail = \Myhelper::mail('mail.member', ["username" => $post->mobile, "password" => "12345678", "name" => $post->name], $post->email, $post->name, $otpmailid, $otpmailname, "Member Registration");
            } catch (\Exception $e) {}

            return response()->json(['status' => "TXN", 'message' => "Success"], 200);
        }else{
            return response()->json(['status' => 'ERR', 'message' => "Something went wrong, please try again"], 400);
        }
    }
    
    public function getotp(Request $post)
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
            $company = \App\Model\Company::where('id', $user->company_id)->first();
            $companyname=$company->companyname;
            $otp = rand(111111, 999999);
            $msg="Dear Sir, Your OTP for login is ".$otp." and valid for 5 min. Nikatby.in";
            $tempid="";
            //\Myhelper::whatsapp($post->mobile, $msg);
            $sms = \Myhelper::sms($post->mobile, $msg, $tempid,$company);
            if($sms == "success"){
                $user = \DB::table('password_resets')->insert([
                    'mobile' => $post->mobile,
                    'token' => \Myhelper::encrypt($otp, "antliaFin@@##2025500"),
                    'last_activity' => time()
                ]);
            
                return response()->json(['status' => 'TXN', 'message' => "Pin generate token sent successfully"], 200);
            }else{
                return response()->json(['status' => 'ERR', 'message' => "Something went wrong"], 400);
            }
        }else{
            return response()->json(['status' => 'ERR', 'message' => "You aren't registered with us"], 400);
        }  
    }
    
    public function setpin(Request $post)
    {
        $rules = array(
            'id'  =>'required|numeric',
            'otp'  =>'required|numeric',
            'pin'  =>'required|numeric|confirmed',
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
                    'pin' => \Myhelper::encrypt($post->pin, "antliaFin@@##2025500"),
                    'user_id'  => $post->id
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'ERR', 'message' => 'Try Again']);
            }
            
            if($apptoken){
                \DB::table('password_resets')->where('mobile', $post->mobile)->where('token' , \Myhelper::encrypt($post->otp, "antliaFin@@##2025500"))->delete();
                return response()->json(['status' => "success"], 200);
            }else{
                return response()->json(['status' => "Something went wrong"], 400);
            }
        }else{
            return response()->json(['status' => "Please enter valid otp"], 400);
        }  
    }
}
