<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Circle;
use App\Model\Scheme;
use App\Model\Company;
use App\Model\Provider;
use App\Model\ESharm;
use App\Model\Utiid;
use App\Model\Permission;
use App\User;
use App\Model\Commission;
use App\Http\Requests\ESharmRequest;
use Yajra\Datatables\Datatables;
use Crypt;


class ESharmController extends Controller
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
            return view('e_sharm.index');
        }else{
            abort(403);
        }
    }

    public function user_index()
    {
        if (\Myhelper::hasRole('retailer')) {
            return redirect()->route('e_sharm.create');
        }else{
            abort(403);
        }
        // return view('e_sharm.user_index');
    }

    public function view(Request $request,$id)
    {
        $e_sharm=ESharm::find($id);
        return view('e_sharm.view',compact('e_sharm'));
    }

    public function create()
    {
        $state = Circle::all();

       return view('e_sharm.addedit',compact('state'));
    }

    public function loan_data(Request $request)
    {
        $loan_id=$request->loan_id;
        return view('e_sharm.partial.loan_data',compact('loan_id'));
    }

    public function any_data(Request $request)
    {
         $sql=ESharm::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('e_sharm.partial.action',compact('data'));
              })
              ->editColumn('f_name',function($data){

                return  view('e_sharm.partial.name',compact('data'));
              })
              ->editColumn('loan_detail',function($data){

                return  view('e_sharm.partial.loan_detail',compact('data'));
              })
              ->editColumn('address',function($data){

                return  view('e_sharm.partial.address',compact('data'));
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
         $sql=ESharm::select("*")->where('user_id',\Auth::user()->id);
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('e_sharm.partial.user_action',compact('data'));
              })
              ->editColumn('f_name',function($data){

                return  view('e_sharm.partial.name',compact('data'));
              })
              ->editColumn('loan_detail',function($data){

                return  view('e_sharm.partial.loan_detail',compact('data'));
              })
              ->editColumn('address',function($data){

                return  view('e_sharm.partial.address',compact('data'));
              })
             
              ->editColumn('status',function($data){
                  // return getStatusIcon($data);
                if ($data->reason_for_change_status != null) {
                   $string='<p class="text-danger">'.$data->reason_for_change_status.' ( At - '.date('d-M-Y',strtotime($data->deleted_at)).') </p>'; 
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
        $res=ESharm::find($request->id);
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
        return view('e_sharm.partial.reason_modal',compact('res'));
    }

    public function reason(Request $request)
    {
        $id=$request->id;
        $res=ESharm::find($id);
        $res->reason_for_change_status=$request->reason;
        $res->deleted_at=\Carbon\Carbon::now('Asia/Kolkata');
        $res->save();
        return redirect()->back();
    }

    public function store(ESharmRequest $request)
    {

          $charge=\App\Model\Commission::whereHas('provider',function($q)
        {
            $q->where('id',1223);
        })
                                    ->where('scheme_id',\Auth::user()->scheme_id)->first();
                                    $slug=\Auth::user()->role->slug;
        if ($charge != null) {
            if (\Auth::user()->mainwallet==null || \Auth::user()->mainwallet < $charge->$slug) {
                $msg="Your Wallet Balance is not enough";
                return response()->json(['msg'=>$msg,'status'=>$msg]);
            }
        }

        $res=new ESharm;

        if (isset($request->photo) && $request->photo != null) {

            $imageName = UPLOAD_FILE($request,'photo',ADMIN_E_SHARM_PHOTO_UPLOAD_PATH());
            if ($imageName !="") {
              $res->photo = $imageName;
            }
        } if (isset($request->pancard_photo) && $request->pancard_photo != null) {

            $imageName = UPLOAD_FILE($request,'pancard_photo',ADMIN_E_SHARM_PAN_UPLOAD_PATH());
            if ($imageName !="") {
              $res->pancard_photo = $imageName;
            }
        } if (isset($request->bank_statement_photo) && $request->bank_statement_photo != null) {

            $imageName = UPLOAD_FILE($request,'bank_statement_photo',ADMIN_E_SHARM_BANK_STATE_UPLOAD_PATH());
            if ($imageName !="") {
              $res->bank_statement_photo = $imageName;
            }
        } 
        if (isset($request->addhar_card_photo) && $request->addhar_card_photo != null) {

            $imageName = UPLOAD_FILE($request,'addhar_card_photo',ADMIN_E_SHARM_ADHAR_UPLOAD_PATH());
            if ($imageName !="") {
              $res->addhar_card_photo = $imageName;
            }
        } 
        if (isset($request->address_proof) && $request->address_proof != null) {

            $imageName = UPLOAD_FILE($request,'address_proof',ADMIN_E_SHARM_ADDRESS_UPLOAD_PATH());
            if ($imageName !="") {
              $res->address_proof = $imageName;
            }
        } 
        if (isset($request->nationalilty) && $request->nationalilty != null ) {

            $imageName = UPLOAD_FILE($request,'nationalilty',ADMIN_E_SHARM_NATION_UPLOAD_PATH());
            if ($imageName !="") {
              $res->nationalilty = $imageName;
            }
        }
         if (isset($request->itr_3_year) && $request->itr_3_year != null) {

            $imageName = UPLOAD_FILE($request,'itr_3_year',ADMIN_E_SHARM_ITR_UPLOAD_PATH());
            if ($imageName !="") {
              $res->itr_3_year = $imageName;
            }
        }
        $res->f_name=$request->f_name;
        $res->l_name=$request->l_name;
        $res->m_name=$request->m_name;
        $res->pan_no=$request->pan_no;
        $res->email=$request->email;
        $res->landline_no=$request->landline_no;
        $res->mobile_no=$request->mobile_no;
        $res->dob=$request->dob;
        $res->address=$request->address;
        $res->state=$request->state;
        $res->city=$request->city;
        // $res->loan_type=$request->loan_type;
        $res->user_id=\Auth::user()->id;
        $res->save();

         $charge=\App\Model\Commission::whereHas('provider',function($q)
        {
            $q->where('id',1223);
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
        
        $msg="Your Esharm Form Submited Successfully";
        $url=route('e_sharm.index');
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
