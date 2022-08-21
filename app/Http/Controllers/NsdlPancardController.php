<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Circle;
use App\Model\Scheme;
use App\Model\Company;
use App\Model\Provider;
use App\Model\NsdlPancard;
use App\Model\Utiid;
use App\Model\Permission;
use App\User;
use App\Model\Commission;
use App\Http\Requests\NsdlPancardRequest;
use Yajra\Datatables\Datatables;
use Crypt;


class NsdlPancardController extends Controller
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

    public function index()
    {
        if (\Myhelper::hasNotRole('retailer')) {
            return view('nsdl_pancard.index');
        }else{
            abort(403);
        }
    }

    public function user_index()
    {

        if (\Myhelper::hasRole('retailer')) {
            return redirect()->route('nsdl_pancard.create');
        }else{
            abort(403);
        }
        
        // return view('nsdl_pancard.user_index');
    }

    public function view(Request $request,$id)
    {
        $nsdl_pancard=NsdlPancard::find($id);
        return view('nsdl_pancard.view',compact('nsdl_pancard'));
    }

    public function create()
    {
        $state = Circle::all();

       return view('nsdl_pancard.addedit',compact('state'));
    }

    public function nsdl_data(Request $request)
    {
        $nsdl_id=$request->application_id;
        return view('nsdl_pancard.partial.loan_data',compact('nsdl_id'));
    }

    public function any_data(Request $request)
    {
         $sql=NsdlPancard::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('nsdl_pancard.partial.action',compact('data'));
              })
              ->editColumn('f_name',function($data){

                return  view('nsdl_pancard.partial.name',compact('data'));
              })
              ->editColumn('application_detail',function($data){

                return  view('nsdl_pancard.partial.loan_detail',compact('data'));
              })
             
             
              ->editColumn('status',function($data){
                  // return getStatusIcon($data);
                 if ($data->reason_for_change_status != null) {
                   $string='<p>'.$data->reason_for_change_status.' ( At - '.date('d-M-Y',strtotime($data->deleted_at)).' )</p>'; 
                }else{
                    $string ="";
                }
                if ($data->status == 1) {
                    return '<a class="badge badge-danger ">Rejected</a> <br><br>'. $string;
                }else if($data->status==2){
                    return '<a class="badge badge-warning">Pending</a><br><br>'. $string;

                }else if($data->status==3){
                    return '<a class="badge badge-danger">Delete</a><br><br>'. $string;

                }else if($data->status==4){
                    return '<a class="badge badge-success">Approve</a><br><br>'. $string;

                }

               
                return 'UnKnown';
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                   
                  if (isset($request['searchtext']) && $request['searchtext'] != "") {
                      $query->where('f_name', 'like', '%' . $request->searchtext . '%')
                            ->orWhere('l_name', 'like', '%' . $request->searchtext . '%')
                            ->orWhere('m_name', 'like', '%' . $request->searchtext . '%')
                            ->orWhere('address', 'like', '%' . $request->searchtext . '%');
                  }

                  if (isset($request['start_date']) && !empty($request['start_date']) && isset($request['end_date']) && !empty($request['end_date'])) {

                    $query->where('created_at','>=',$request['start_date'])
                            ->orwhere('created_at','<=',$request['end_date']);

                }elseif(isset($request['start_date']) && !empty($request['start_date'])){

                        $query->where('created_at','>=',$request['start_date']);

                }elseif(isset($request['end_date']) && !empty($request['end_date'])){

                        $query->where('created_at','<=',$request['end_date']);
                }
              })
              ->rawColumns(['name','address','loan_detail','action','status'])
              ->make(true);


    }

     public function user_any_data(Request $request)
    {
         $sql=NsdlPancard::select("*")->where('user_id',\Auth::user()->id);
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('nsdl_pancard.partial.user_action',compact('data'));
              })
              ->editColumn('f_name',function($data){

                return  view('nsdl_pancard.partial.name',compact('data'));
              })
              ->editColumn('application_detail',function($data){

                return  view('nsdl_pancard.partial.loan_detail',compact('data'));
              })
             
             
              ->editColumn('status',function($data){
                  // return getStatusIcon($data);
                if ($data->reason_for_change_status != null) {
                   $string='<p class="text-danger">'.$data->reason_for_change_status.' ( At - '.date('d-M-Y',strtotime($data->deleted_at)).' )</p>'; 
                }else{
                    $string ="";
                }

                if ($data->status == 1) {
                    return '<a class="badge badge-danger ">Rejected</a><br><br>'. $string;
                }else if($data->status==2){
                    return '<a class="badge badge-warning">Pending</a><br><br>'. $string;

                }else if($data->status==3){
                    return '<a class="badge badge-danger">Delete</a><br><br>'. $string;

                }else if($data->status==4){
                    return '<a class="badge badge-success">Approve</a><br><br>'. $string;

                }
                return 'UnKnown';
              })
              ->filter(function ($query) use ($request) {
                
                  if (isset($request['status']) && $request['status'] != "") {
                      $query->where('status', $request['status']);
                  }
                   
                  if (isset($request['name']) && $request['name'] != "") {
                      $query->where('name', 'like', '%' . $request->name . '%');
                  }
              })
              ->rawColumns(['name','address','loan_detail','action','status'])
              ->make(true);


    }

    public function single_status_change(Request $request)
    {
        $status=$request->status;
        $res=NsdlPancard::find($request->id);
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
        return view('nsdl_pancard.partial.reason_modal',compact('res'));
    }

    public function reason(Request $request)
    {
        $id=$request->id;
        $res=NsdlPancard::find($id);
        $res->reason_for_change_status=$request->reason;
        $res->deleted_at=\Carbon\Carbon::now('Asia/Kolkata');

        $res->save();
        return redirect()->back();
    }

    public function store(NsdlPancardRequest $request)
    {
          $charge=\App\Model\Commission::whereHas('provider',function($q)
        {
            $q->where('id',1224);
        })
                                    ->where('scheme_id',\Auth::user()->scheme_id)->first();
                                    $slug=\Auth::user()->role->slug;
        if ($charge != null) {
            if (\Auth::user()->mainwallet==null || \Auth::user()->mainwallet < $charge->$slug) {
                $msg="Your Wallet Balance is not enough";
                return response()->json(['msg'=>$msg,'status'=>$msg]);
            }
        }
        $res=new NsdlPancard;

        if (isset($request->photo) && $request->photo != null) {

            $imageName = UPLOAD_FILE($request,'photo',ADMIN_NSDL_PANCARD_PHOTO_UPLOAD_PATH());
            if ($imageName !="") {
              $res->photo = $imageName;
            }
        } 
        if (isset($request->addhar_card_photo) && $request->addhar_card_photo != null) {

            $imageName = UPLOAD_FILE($request,'addhar_card_photo',ADMIN_NSDL_PANCARD_ADHAR_UPLOAD_PATH());
            if ($imageName !="") {
              $res->addhar_card_photo = $imageName;
            }
        } 
        if (isset($request->nsdl_form) && $request->nsdl_form != null && $request->application_type == 1) {

            $imageName = UPLOAD_FILE($request,'nsdl_form',ADMIN_NSDL_PANCARD_NSDL_FORM_UPLOAD_PATH());
            if ($imageName !="") {
              $res->nsdl_form = $imageName;
            }
        } 
        if (isset($request->signature) && $request->signature != null ) {

            $imageName = UPLOAD_FILE($request,'signature',ADMIN_NSDL_PANCARD_SIGN_UPLOAD_PATH());
            if ($imageName !="") {
              $res->signature = $imageName;
            }
        }

        if ($request->application_type==2) {
            $res->old_pan_no=$request->old_pan_no;
        }
        $res->application_type=$request->application_type;
        $res->f_name=$request->f_name;
        $res->l_name=$request->l_name;
        $res->m_name=$request->m_name;
        $res->email=$request->email;
        $res->mobile_no=$request->mobile_no;
        $res->dob=$request->dob;
        $res->category=$request->category;
        $res->user_id=\Auth::user()->id;
        $res->save();


         $charge=\App\Model\Commission::whereHas('provider',function($q)
        {
            $q->where('id',1224);
        })
                                    ->where('scheme_id',\Auth::user()->scheme_id)->first();

        if ($charge != null ) {

            $slug=\Auth::user()->role->slug;
            $re=\Auth::user();
            if ($charge->type=='flat') {
                $re->mainwallet=$re->mainwallet-$charge->$slug;
            }else{
                // $re->mainwallet=$re->mainwallet-($charge->);
            }
            $re->save();
        }
        
        $msg="Your Nsdl Pancard Registration Form Submited Successfully";
        $url=route('nsdl_pancard.index');
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
