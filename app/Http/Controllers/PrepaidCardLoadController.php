<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Circle;
use App\Model\Scheme;
use App\Model\Company;
use App\Model\Provider;
use App\Model\PrepaidCardLoad;
use App\Model\Utiid;
use App\Model\Permission;
use App\User;
use App\Model\Commission;
use App\Http\Requests\PrepaidCardLoadRequest;
use Yajra\Datatables\Datatables;
use Crypt;


class PrepaidCardLoadController extends Controller
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
            return view('prepaidcard_load.index');
        }else{
            abort(403);
        }
    }

    public function user_index()
    {
        if (\Myhelper::hasRole('retailer')) {
            return redirect()->route('prepaidcard_load.create');
        }else{
            abort(403);
        }
        
        // return view('prepaidcard_load.user_index');
    }

    public function view(Request $request,$id)
    {
        $prepaidcard_load=PrepaidCardLoad::find($id);
        return view('prepaidcard_load.view',compact('prepaidcard_load'));
    }

    public function create()
    {
        $state = Circle::all();

       return view('prepaidcard_load.addedit',compact('state'));
    }

    public function loan_data(Request $request)
    {
        $loan_id=$request->loan_id;
        return view('prepaidcard_load.partial.loan_data',compact('loan_id'));
    }

    public function any_data(Request $request)
    {
         $sql=PrepaidCardLoad::select("*");
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('prepaidcard_load.partial.action',compact('data'));
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

                        $query->where('end_datetime','<=',$request['end_date']);
                }
              })
              ->rawColumns(['name','address','loan_detail','action','status'])
              ->make(true);


    }

     public function user_any_data(Request $request)
    {
         $sql=PrepaidCardLoad::select("*")->where('user_id',\Auth::user()->id);
        return Datatables::of($sql)
              ->addColumn('action',function($data){

                 

                    
                  //   $string .=' <a href="javascript:void(0)" title="'.trans('message.delete_country_label').'" data-route="'.route('admin.country.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fadeIn animated bx bx-message-square-x"></i></a>';
                $string="";
                  
                  
                  return view('prepaidcard_load.partial.user_action',compact('data'));
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
        $res=PrepaidCardLoad::find($request->id);
        if ($status==1) {
            if($res->status !=1){
                $re=\Auth::user();
                $re->mainwallet=$res->atm+$re->mainwallet;
                $re->save();
            }
            $res->status=1;
        }elseif ($status==2) {
            $res->status=2;
        }elseif($status==3){
            $res->status=3;
        }elseif ($status==4) {
            $res->status=4;
        }

        $res->save();
        return view('prepaidcard_load.partial.reason_modal',compact('res'));
    }

    public function reason(Request $request)
    {
        $id=$request->id;
        $res=PrepaidCardLoad::find($id);
        $res->reason_for_change_status=$request->reason;
        $res->deleted_at=\Carbon\Carbon::now('Asia/Kolkata');

        $res->save();
        return redirect()->back();
    }

    public function store(PrepaidCardLoadRequest $request)
    {

        if (\Auth::user()->mainwallet < $request->atm) {
              $msg="Your Wallet Balance is not enough";
                return response()->json(['msg'=>$msg,'status'=>$msg]);
        }
        $res=new PrepaidCardLoad;

       
        $res->name=$request->name;
        $res->card_number=$request->card_number;
        $res->atm=$request->atm;
        $res->mobile_no=$request->mobile_no;
        $res->bank_name=$request->bank_name;
        $res->status=2;
        $res->user_id=\Auth::user()->id;
        $res->save();

        if ($res->atm != null) {
            $re=\Auth::user();
            $re->mainwallet=$re->mainwallet-$res->atm;
            $re->save();
        }
        

        
        $msg="Your Prepaid Card Load Form Submited Successfully";
        $url=route('prepaidcard_load.index');
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
