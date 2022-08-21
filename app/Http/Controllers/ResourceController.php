<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Scheme;
use App\Model\Company;
use App\Model\Provider;
use App\Model\Commission;
use App\Model\Companydata;
use App\User;

class ResourceController extends Controller
{
    public function index($type)
    {
        switch ($type) {
            case 'scheme':
                $data['commission']['mobile']   = Provider::where('type', 'mobile')->where('status', "1")->get();
                $data['commission']['dth']      = Provider::where('type', 'dth')->where('status', "1")->get();
                $data['commission']['electricity']    = Provider::where('type', 'electricity')->where('status', "1")->get();
                $data['commission']['postpaid'] = Provider::where('type', 'postpaid')->where('status', "1")->get();
                $data['commission']['water']    = Provider::where('type', 'water')->where('status', "1")->get();
                $data['commission']['broadband']= Provider::where('type', 'broadband')->where('status', "1")->get();
                $data['commission']['lpggas']   = Provider::where('type', 'lpggas')->where('status', "1")->get();
                $data['commission']['gasutility'] = Provider::where('type', 'gasutility')->where('status', "1")->get();
                $data['commission']['landline'] = Provider::where('type', 'landline')->where('status', "1")->get();
                $data['commission']['landline'] = Provider::where('type', 'landline')->where('status', "1")->get();
                $data['commission']['pancard']  = Provider::where('type', 'pancard')->where('status', "1")->get();
                $data['commission']['aeps'] = Provider::where('type', 'aeps')->where('status', "1")->get();
                $data['commission']['ministatement'] = Provider::where('type', 'ministatement')->where('status', "1")->get();


                $data['charge']['ration-card'] = Provider::where('type', 'ration-card')->where('status', "1")->get();
                $data['charge']['e-sharm'] = Provider::where('type', 'e-sharm')->where('status', "1")->get();
                $data['charge']['nsdl-pancard'] = Provider::where('type', 'nsdl-pancard')->where('status', "1")->get();
                $data['charge']['prepaidcard-kyc'] = Provider::where('type', 'prepaidcard-kyc')->where('status', "1")->get();
                // $data['charge']['prepaid-card-load'] = Provider::where('type', 'prepaid-card-load')->where('status', "1")->get();
                $data['charge']['loan'] = Provider::where('type', 'loan')->where('status', "1")->get();
                $data['charge']['gst-registration'] = Provider::where('type', 'gst-registration')->where('status', "1")->get();
                $data['charge']['itr-registration'] = Provider::where('type', 'itr-registration')->where('status', "1")->get();
                $data['charge']['digital-signature'] = Provider::where('type', 'digital-signature')->where('status', "1")->get();


                $data['charge']['dmt'] = Provider::where('type', 'dmt')->where('status', "1")->get();
                break;

            case 'company':
                $permission = "company_manager";
                break;

            case 'companyprofile':
                $permission = "change_company_profile";
                $data['company'] = Company::where('id', \Auth::user()->company_id)->first();
                $data['companydata'] = Companydata::where('company_id', \Auth::user()->company_id)->first();
                break;
            
            case 'commission':
                $permission = "view_commission";
                $product = ['mobile','dth','electricity','dmt','pancard','aeps','ministatement','ration-card','e-sharm','digital-signature','itr-registration','gst-registration','loan','prepaidcard-kyc','nsdl-pancard'];
                foreach ($product as $key) {
                    $data['commission'][$key] = Commission::where('scheme_id', \Auth::user()->scheme_id)->whereHas('provider', function ($q) use($key){
                        $q->where('type' , $key);
                    })->get();
                }
                break;
            
            default:
                # code...
                break;
        }

        if ($type != "scheme" && !\Myhelper::can($permission)) {
            abort(403);
        }elseif($type == "scheme"){
            if(\Myhelper::hasRole('retailer')){
                abort(403);
            }
        }
        $data['type'] = $type;
         
        return view("resource.".$type)->with($data);
    }

    public function update(Request $post)
    {
        switch ($post->actiontype) {
            case 'scheme':
            case 'commission':
                break;
            
            case 'company':
                $permission = ["company_manager", "change_company_profile"];
                break;

            case 'companydata':
                $permission = "change_company_profile";
                break;
        }

        if (isset($permission) && !\Myhelper::can($permission)) {
            return response()->json(['status' => "Permission Not Allowed"], 400);
        }

        if(in_array($post->actiontype, ['scheme', 'commission']) && \Myhelper::hasRole('retailer')){
            return response()->json(['status' => "Permission Not Allowed"], 400);
        }

        switch ($post->actiontype) {
            case 'scheme':
                $rules = array(
                    'name'    => 'sometimes|required' 
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }
                $post['user_id'] = \Auth::id();
                $action = Scheme::updateOrCreate(['id'=> $post->id], $post->all());
                if ($action) {
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
                break;

            case 'company':
                $rules = array(
                    'companyname'    => 'sometimes|required'
                );

                if($post->file('logos')){
                    $rules['logos'] = 'sometimes|required|mimes:jpg,JPG,jpeg,png|max:500';
                }
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }
                if($post->id != 'new'){
                    $company = Company::find($post->id);
                }
                
                if($post->hasFile('logos')){
                    try {
                        unlink(public_path('logos/').$company->logo);
                    } catch (\Exception $e) {
                    }
                    $filename ='logo'.$post->id.".".$post->file('logos')->guessExtension();
                    $post->file('logos')->move(public_path('logos/'), $filename);
                    $post['logo'] = $filename;
                }

                $action = Company::updateOrCreate(['id'=> $post->id], $post->all());
                if ($action) {
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
                break;

            case 'companydata':
                $rules = array(
                    'company_id'    => 'required'
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }

                $action = Companydata::updateOrCreate(['company_id'=> $post->company_id], $post->all());
                if ($action) {
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
                break;
            
            case 'commission':
                $rules = array(
                    'scheme_id'    => 'sometimes|required|numeric' 
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }

                $scheme = Scheme::where('id', $post->scheme_id)->where('user_id', \Auth::id())->first();

                if(!$scheme){
                    return response()->json(['status'=>"Commission Changes Not Allowed"], 400);
                }

                $rules = array(
                    'scheme_id'    => 'sometimes|required|numeric' 
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }

                foreach ($post->slab as $key => $value) {
                    $update[$value] = Commission::updateOrCreate([
                        'scheme_id' => $post->scheme_id,
                        'slab'      => $post->slab[$key]
                    ],[
                        'scheme_id' => $post->scheme_id,
                        'slab'      => $post->slab[$key],
                        'type'      => $post->type[$key],
                        'whitelable'=> $post->whitelable[$key],
                        'statehead'=> $post->statehead[$key],
                        'md'        => $post->md[$key],
                        'distributor'  => $post->distributor[$key],
                        'retailer'     => $post->retailer[$key],
                    ]);
                }
                return response()->json(['status'=>$update], 200);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function getCommission(Request $post , $type)
    {
        return Commission::where('scheme_id', $post->scheme_id)->get()->toJson();
    }

    public function mycommission(Type $var = null)
    {
        # code...
    }
}
