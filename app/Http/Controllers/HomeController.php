<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Circle;
use App\User;
use App\Model\Report;
use App\Model\Aepsreport;
use App\Model\Api;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function comingsoon(){
        return view('comingsoon');
       }
    public function index()
    {
        if(!session('parentData')){
            session(['parentData' => \Myhelper::getParents(\Auth::id())]);
        }

        $data['state'] = Circle::all();
        $roles = ['whitelable', 'statehead', 'md', 'distributor', 'retailer', 'apiuser', 'other'];

        foreach ($roles as $role) {
            if($role == "other"){
                $data[$role] = User::whereHas('role', function($q){
                    $q->whereNotIn('slug', ['whitelable', 'md', 'distributor', 'retailer', 'apiuser', 'admin']);
                })->whereIn('id', \Myhelper::getParents(\Auth::id()))->whereIn('kyc', ['verified'])->count();
            }else{
                $data[$role] = User::whereHas('role', function($q) use($role){
                    $q->where('slug', $role);
                })->whereIn('id', \Myhelper::getParents(\Auth::id()))->whereIn('kyc', ['verified'])->count();
            }
        }

        $product = [
            'recharge',
            'billpayment',
            'utipancard',
            'money',
            'aeps',
            'matm'
        ];

        $slot = ['today' , 'month', 'lastmonth'];

        $statuscount = [ 'success' => ['success'] , 'pending' => ['pending'], 'failed' => ['failed', 'reversed']];

        foreach ($product as $value) {
            foreach ($slot as $slots) {

                  if($value == "aeps"){
                    // dd($value);
                    $query = Report::whereIn('user_id', session('parentData'))->where('product','aeps');
                    
                   // dd($query);
                }
                elseif($value == "matm"){
                    $query = \DB::table('microatmreports');
                }
                else{
                    $query = Report::whereIn('user_id', session('parentData'));
                 //   dd("2");
                }

                if($slots == "today"){
                    $query->whereDate('created_at', date('Y-m-d'));
                }

                if($slots == "month"){
                    $query->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
                }

                if($slots == "lastmonth"){
                    $query->whereMonth('created_at', date('m', strtotime("-1 months")))->whereYear('created_at', date('Y'));
                }

                switch ($value) {
                    case 'recharge':
                        $query->where('product', 'recharge');
                        break;
                    
                    case 'billpayment':
                        $query->where('product', 'billpay');
                        break;

                    case 'utipancard':
                        $query->where('product', 'utipancard');
                        break;

                    case 'money':
                        $query->where('product', 'dmt');
                        break;

                    case 'aeps':
                        $query->where('product', 'aeps');
                        break;
                    case 'matm':
                        $query->where('transtype', 'transaction')->where('rtype', 'main');
                        break;     
                }
                $data[$value][$slots] = $query->where('rtype', 'main')->where('status', 'success')->sum('amount');
            }

            foreach ($statuscount as $keys => $values) {
                if($value == "aeps"){
                    $query = Report::where('product','aeps')->whereDate('created_at', date('Y-m-d'));;
                    
                }
                elseif($value == "matm"){
                    $query = \DB::table('microatmreports');
                }
                else{
                    $query = Report::where('product','aeps');
                   // dd("sec");
                }
                
                switch ($value) {
                    case 'recharge':
                        $query->where('product', 'recharge');
                        break;
                    
                    case 'billpayment':
                        $query->where('product', 'billpay');
                        break;

                    case 'utipancard':
                        $query->where('product', 'utipancard');
                        break;

                    case 'money':
                        $query->where('product', 'dmt');
                        break;
                    
                    case 'aeps':
                        $query->where('product', 'aeps');
                        break;
                     case 'matm':
                        $query->where('transtype', 'transaction')->where('rtype', 'main');
                        break;      
                }
                $data[$value][$keys] = $query->where('rtype', 'main')->whereIn('status', $values)->count();
            }
        }
        
        //dd($data);
        return view('home')->with($data);
    }

    public function getbalance()
    {
        $data['apibalance'] = 0;
        $api = Api::where('code', 'recharge1')->first();
        $url = "http://nikatby.co.in/api/getbal/".$api->username;
        $result = \Myhelper::curl($url, "GET", "", [], "no");
        if(!$result['error'] && $result['response'] != ''){
            $response = json_decode($result['response']);
            if(isset($response->balance)){
                $data['apibalance'] = $response->balance;
            }
        }
        $data['downlinebalance'] = round(User::whereIn('id', \Myhelper::getParents(\Auth::id()))->where('id', '!=', \Auth::id())->sum('mainwallet'), 2);
        $data['mainwallet'] = \Auth::user()->mainwallet;
        $data['lockedamount'] = \Auth::user()->lockedamount;
        if(\Myhelper::hasRole('admin')){
            $data['aepsbalance'] = round(User::where('id', '!=',  \Auth::id())->sum('aepsbalance'), 2);
        }else{
            $data['aepsbalance'] = \Auth::user()->aepsbalance;
        }

        return response()->json($data);
    }

    public function getmysendip()
    {
        $url = "http://nikatby.co.in/api/getip";
        $result = \Myhelper::curl($url, "GET", "", [], "no");
        dd($result);
    }

    public function setpermissions()
    {
        $users = User::whereHas('role', function($q){ $q->where('slug', '!=' ,'admin'); })->get();

        foreach ($users as $user) {
            $inserts = [];
            $insert = [];
            $permissions = \DB::table('default_permissions')->where('type', 'permission')->where('role_id', $user->role_id)->get();

            if(sizeof($permissions) > 0){
                \DB::table('user_permissions')->where('user_id', $user->id)->delete();
                foreach ($permissions as $permission) {
                    $insert = array('user_id'=> $user->id , 'permission_id'=> $permission->permission_id);
                    $inserts[] = $insert;
                }
                \DB::table('user_permissions')->insert($inserts);
            }
        }
    }

    public function setscheme()
    {
        $users = User::whereHas('role', function($q){ $q->where('slug', '!=' ,'admin'); })->get();

        foreach ($users as $user) {
            $inserts = [];
            $insert = [];
            $scheme = \DB::table('default_permissions')->where('type', 'scheme')->where('role_id', $user->role_id)->first();
            if ($scheme) {
                User::where('id', $user->id)->update(['scheme_id' => $scheme->permission_id]);
            }
        }
    }

    public function mydata()
    {
        $api = Api::where('code', 'recharge1')->first();
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        do {
            $apibalance = 0;
            $url = "http://securepayments.net.in/api/getbal/".$api->username;
            $result = \Myhelper::curl($url, "GET", "", [], "no");
            if(!$result['error'] && $result['response'] != ''){
                $response = json_decode($result['response']);
                if(isset($response->balance)){
                    $apibalance = round($response->balance, 2);
                }
            }
            $fundrequest = \App\Model\Fundreport::where('credited_by', \Auth::id())->where('status', 'pending')->count();
            $aepsfundrequest = \App\Model\Aepsfundrequest::where('status', 'pending')->where('pay_type', 'manual')->count();
            $aepspayoutrequest = \App\Model\Aepsfundrequest::where('status', 'pending')->where('pay_type', 'payout')->count();
            $downlinebalance =\App\User::whereIn('id', array_diff(session('parentData'), array(\Auth::id())))->sum('mainwallet');
            echo "data: {\"apibalance\" : {$apibalance}, \"downlinebalance\" : {$downlinebalance},\"fundrequest\" : {$fundrequest},\"aepsfundrequest\" : {$aepsfundrequest},\"aepspayoutrequest\" : {$aepspayoutrequest}}\n\n";
            sleep(10);
            @ob_flush();
            flush();
        } while (true);   
    }
}
