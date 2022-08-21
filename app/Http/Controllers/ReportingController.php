<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Circle;
use App\Model\Scheme;
use App\Model\Company;
use App\Model\Provider;
use App\Model\GstReg;
use App\Model\ReportingCharge;
use App\Model\Utiid;
use App\Model\Permission;
use App\User;
use App\Model\Commission;
use App\Http\Requests\GstRegRequest;
use Yajra\Datatables\Datatables;
use Crypt;


class ReportingController extends Controller
{
    // public function index($type , $action="view")
    // {
    //     if($action != 'view' && $action != 'create'){
    //         abort(404);
    //     }

    //     $data['role'] = Role::where('slug', $type)->first();
    //     $data['roles'] = [];
    //     if(!$data['role'] && !in_array($type, ['other', 'kycpending', 'kycsubmitted', 'kycrejected', 'web'])){
    //         abort(404);
    //     }
        
    //     if($action == "view" && !\Myhelper::can('view_'.$type)){
    //         abort(401);
    //     }elseif($action == "create" && !\Myhelper::can('create_'.$type) && !in_array($type, ['kycpending', 'kycsubmitted', 'kycrejected', 'web'])){
    //         abort(401);
    //     }

    //     if($action == "create" && !$data['role']){
    //         $roles = Role::whereIn('slug', ["whitelable", "md", 'distributor', 'retailer', "statehead", 'apiuser'])->get();

    //         foreach ($roles as $role) {
    //             if(\Myhelper::can('create_'.$type)){
    //                 $data['roles'][] = $role;
    //             }
    //         }

    //         $roless = Role::whereNotIn('slug', ['admin', "whitelable", "statehead", "md", 'distributor', 'retailer', 'apiuser'])->get();

    //         foreach ($roless as $role) {
    //             if(\Myhelper::can('create_other')){
    //                 $data['roles'][] = $role;
    //             }
    //         }
    //     }
        
    //     if ($action == "create" && (!$data['role'] && sizeOf($data['roles']) == 0)){
    //         abort(404);
    //     }
        
    //     $data['type'] = $type;
    //     $data['state'] = Circle::all();
    //     $data['scheme'] = Scheme::where('user_id', \Auth::id())->get();

    //     $types = array(
    //         'Resource' => 'resource',
    //         'Setup Tools' => 'setup',
    //         'Member'   => 'member',
    //         'Member Setting'   => 'memberaction',
    //         'Member Report'    => 'memberreport',

    //         'Wallet Fund'   => 'fund',
    //         'Wallet Fund Report'   => 'fundreport',

    //         'Aeps Fund'   => 'aepsfund',
    //         'Aeps Fund Report'   => 'aepsfundreport',

    //         'Agents List'   => 'idreport',

    //         'Portal Services'   => 'service',
    //         'Transactions'   => 'report',

    //         'Transactions Editing'   => 'reportedit',
    //         'Transactions Status'   => 'reportstatus',

    //         'User Setting' => 'setting'
    //     );
    //     foreach ($types as $key => $value) {
    //         $data['permissions'][$key] = Permission::where('type', $value)->orderBy('id', 'ASC')->get();
    //     }

    //     if($action == "view"){
    //         return view('member.index')->with($data);
    //     }else{
    //         return view('member.create')->with($data);
    //     }
    // }

  
   

    public function create()
    {
        $res=ReportingCharge::first();
       return view('reporting.addedit',compact('res'));
    }

 



   

    public function single_status_change(Request $request)
    {
        $status=$request->status;
        $res=GstReg::find($request->id);
        if ($status==1) {
            $res->status=1;
        }elseif ($status==2) {
            $res->status=2;
        }elseif($status==3){
            $res->status=3;
        }elseif ($status==4) {
            $res->status=4;
        }

        $res->save();
        return view('gst_reg.partial.reason_modal',compact('res'));
    }

    public function reason(Request $request)
    {
        $id=$request->id;
        $res=GstReg::find($id);
        $res->reason_for_change_status=$request->reason;
        $res->deleted_at=\Carbon\Carbon::now('Asia/Kolkata');

        $res->save();
        return redirect()->back();
    }

    public function store(Request $request)
    {
        ReportingCharge::truncate();
        $res=new ReportingCharge;

       
        $res->ration_card_charge=$request->ration_card_charge;
        $res->esharm_charge=$request->esharm_charge;
        $res->digital_signature_charge=$request->digital_signature_charge;
        $res->itr_registration_charge=$request->itr_registration_charge;
        $res->gst_registration_charge=$request->gst_registration_charge;
        $res->prepaid_kyc_charge=$request->prepaid_kyc_charge;
        $res->prepaidcard_load_charge=$request->prepaidcard_load_charge;
        $res->nsdlpancard_charge=$request->nsdlpancard_charge;
        $res->loan_charge=$request->loan_charge;
        $res->save();
        
        $msg="Your Charges change Successfully";
        $url=route('reporting_charge.index');
        return response()->json(['msg'=>$msg,'status'=>true,'url'=>$url]);

    }

    public function utiidcreation($user)
    {
        $provider = Provider::where('recharge1', 'utipancard')->first();

        if($provider && $provider->status != 0 && $provider->api && $provider->api->status != 0){
            $parameter['token'] = $provider->api->username;
            $parameter['vle_id'] = $user->mobile;
            $parameter['vle_name'] = $user->name;
            $parameter['location'] = $user->city;
            $parameter['contact_person'] = $user->name;
            $parameter['pincode'] = $user->pincode;
            $parameter['state'] = $user->state;
            $parameter['email'] = $user->email;
            $parameter['mobile'] = $user->mobile;
            $url = $provider->api->url."/create";
            $result = \Myhelper::curl($url, "POST", json_encode($parameter), ["Content-Type: application/json", "Accept: application/json"], "no");

            if(!$result['error'] || $result['response'] != ''){
                $doc = json_decode($result['response']);
                if($doc->statuscode == "TXN"){
                    $parameter['user_id'] = $user->email;
                    $parameter['type'] = "new";
                    Utiid::create($post->all());
                }
            }
        }
    }

    public function getCommission(Request $post)
    {
        $product = ['mobile', 'dth', 'electricity', 'pancard', 'dmt', 'aeps','ministatement'];
        foreach ($product as $key) {
            //dd($key);
            $data['commission'][$key] = Commission::where('scheme_id', $post->scheme_id)->whereHas('provider', function ($q) use($key){
                $q->where('type' , $key);
            })->get();
        }
        
        return response()->json(view('member.commission')->with($data)->render());
    }

    public function getScheme(Request $post)
    {
        $user = User::where('id', $post->id)->first(['id', 'role_id']);
        $scheme = Scheme::where('user_id', \Auth::id())->orWhere('type', $user->role->slug)->orWhere('id', $post->scheme_id)->get();
        return response()->json(['data' => $scheme]);
    }
}
