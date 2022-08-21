<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Fundreport;
use App\Model\Aepsfundrequest;
use App\Model\Report;
use App\Model\Fundbank;
use App\Model\Paymode;
use App\Model\Api;
use App\Model\Provider;
use App\Model\Aepsreport;
use App\Model\PortalSetting;
use Carbon\Carbon;

class FundController extends Controller
{
    public $fundapi, $admin;

    public function __construct()
    {
        $this->fundapi = Api::where('code', 'fund')->first();
        $this->admin = User::whereHas('role', function ($q){
            $q->where('slug', 'admin');
        })->first();
    }

    public function index($type, $action="none")
    {
        $data = [];
        switch ($type) {
            case 'tr':
                $permission = ['fund_transfer', 'fund_return'];
                break;
            
            case 'request':
                $permission = 'fund_request';
                break;
            
            case 'requestview':
                $permission = 'setup_bank';
                break;
            
            case 'statement':
            case 'requestviewall':
                $permission = 'fund_report';
                break;

            case 'aeps':
                $permission = 'aeps_fund_request';
                $data['settlementcharge'] = $this->settlementcharge();
                $data['settlementcharge1k'] = $this->settlementcharge1k();
                $data['settlementcharge25k'] = $this->settlementcharge25k();
                $data['settlementcharge2l'] = $this->settlementcharge2l();
                $data['batch'] = $this->batch();
                break;
            
            case 'aepsrequest':
            case 'payout':
                $permission = 'aeps_fund_view';
                break;

            case 'aepsfund':
            case 'aepsrequestall':
                $permission = 'aeps_fund_report';
                break;

            default:
                abort(404);
                break;
        }

        if (!\Myhelper::can($permission)) {
            abort(403);
        }

        if ($this->fundapi->status == "0") {
            abort(503);
        }

        switch ($type) {
            case 'request':
                $data['banks'] = Fundbank::where('user_id', \Auth::user()->parent_id)->where('status', '1')->get();
                if(!\Myhelper::can('setup_bank', \Auth::user()->parent_id)){
                    $admin = User::whereHas('role', function ($q){
                        $q->where('slug', 'whitelable');
                    })->where('company_id', \Auth::user()->company_id)->first(['id']);

                    if($admin && \Myhelper::can('setup_bank', $admin->id)){
                        $data['banks'] = Fundbank::where('user_id', $admin->id)->where('status', '1')->get();
                    }else{
                        $admin = User::whereHas('role', function ($q){
                            $q->where('slug', 'admin');
                        })->first(['id']);
                        $data['banks'] = Fundbank::where('user_id', $admin->id)->where('status', '1')->get();
                    }
                }
                $data['paymodes'] = Paymode::where('status', '1')->get();
                break;
        }

        return view('fund.'.$type)->with($data);
    }

    public function transaction(Request $post)
    {
        if ($this->fundapi->status == "0") {
            return response()->json(['status' => "This function is down."],400);
        }
        $provide = Provider::where('recharge1', 'fund')->first();
        $post['provider_id'] = $provide->id;

        switch ($post->type) {
            case 'transfer':
            case 'return':
                if($post->type == "transfer" && !\Myhelper::can('fund_transfer')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }

                if($post->type == "return" && !\Myhelper::can('fund_return')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }

                $rules = array(
                    'amount'    => 'required|numeric|min:1',
                );
        
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }

                if($post->type == "transfer"){
                    if(\Auth::user()->mainwallet < $post->amount){
                        return response()->json(['status' => "Insufficient wallet balance."],400);
                    }
                }else{
                    $user = User::where('id', $post->user_id)->first();
                    if($user->mainwallet < $post->amount){
                        return response()->json(['status' => "Insufficient balance in user wallet."],400);
                    }
                }
                $post['txnid'] = 0;
                $post['option1'] = 0;
                $post['option2'] = 0;
                $post['option3'] = 0;
                $post['refno'] = date('ymdhis');
                return $this->paymentAction($post);

                break;

            case 'requestview':
                if(!\Myhelper::can('setup_bank')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }

                $fundreport = Fundreport::where('id', $post->id)->first();
                $post['amount'] = $fundreport->amount;
                $post['type'] = "request";
                $post['user_id'] = $fundreport->user_id;
                if ($post->status == "approved") {
                    if(\Auth::user()->mainwallet < $post->amount){
                        return response()->json(['status' => "Insufficient wallet balance."],200);
                    }
                    $action = Fundreport::where('id', $post->id)->update([
                        "status" => $post->status,
                        "remark" => $post->remark
                    ]);

                    $post['txnid'] = $fundreport->id;
                    $post['option1'] = $fundreport->fundbank_id;
                    $post['option2'] = $fundreport->paymode;
                    $post['option3'] = $fundreport->paydate;
                    $post['refno'] = $fundreport->ref_no;
                    return $this->paymentAction($post);
                }else{
                    $action = Fundreport::where('id', $post->id)->update([
                        "status" => $post->status,
                        "remark" => $post->remark
                    ]);

                    if($action){
                        return response()->json(['status' => "success"],200);
                    }else{
                        return response()->json(['status' => "Something went wrong, please try again."],200);
                    }
                }
                
                return $this->paymentAction($post);
                break;

            case 'request':
                if(!\Myhelper::can('fund_request')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }

                $rules = array(
                    'fundbank_id'    => 'required|numeric',
                    'paymode'    => 'required',
                    'amount'    => 'required|numeric|min:100',
                    'ref_no'    => 'required|unique:fundreports,ref_no',
                    'paydate'    => 'required'
                );
        
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }

                $post['user_id'] = \Auth::id();
                $post['credited_by'] = \Auth::user()->parent_id;
                if(!\Myhelper::can('setup_bank', \Auth::user()->parent_id)){
                    $admin = User::whereHas('role', function ($q){
                        $q->where('slug', 'whitelable');
                    })->where('company_id', \Auth::user()->company_id)->first(['id']);

                    if($admin && \Myhelper::can('setup_bank', $admin->id)){
                        $post['credited_by'] = $admin->id;
                    }else{
                        $admin = User::whereHas('role', function ($q){
                            $q->where('slug', 'admin');
                        })->first(['id']);
                        $post['credited_by'] = $admin->id;
                    }
                }
                $post['status'] = "pending";
                if($post->hasFile('payslips')){
                    $filename ='payslip'.\Auth::id().date('ymdhis').".".$post->file('payslips')->guessExtension();
                    $post->file('payslips')->move(public_path('deposit_slip/'), $filename);
                    $post['payslip'] = $filename;
                }
                $action = Fundreport::create($post->all());
                if($action){
                    return response()->json(['status' => "success"],200);
                }else{
                    return response()->json(['status' => "Something went wrong, please try again."],200);
                }
                break;

            case 'bank':
                if ($this->pinCheck($post) == "fail") {
                    return response()->json(['status' => "Transaction Pin is incorrect"]);
                }
                
                $banksettlementtype = $this->banksettlementtype();
                if($banksettlementtype == "down"){
                    return response()->json(['status' => "Aeps Settlement Down For Sometime"],400);
                }

                $user = User::where('id',\Auth::user()->id)->first();

                $post['user_id'] = \Auth::id();

                if($user->account == '' && $user->bank == '' && $user->ifsc == ''){
                    $rules = array(
                        'amount'    => 'required|numeric|min:10',
                        'account'   => 'sometimes|required',
                        'bank'   => 'sometimes|required',
                        'ifsc'   => 'sometimes|required'
                    );
                }else{
                    $rules = array(
                        'amount'    => 'required|numeric|min:10'
                    );

                    $post['account'] = $user->account;
                    $post['bank']    = $user->bank;
                    $post['ifsc']    = $user->ifsc;
                }

                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                if($user->account == '' && $user->bank == '' && $user->ifsc == ''){
                    User::where('id',\Auth::user()->id)->update(['account' => $post->account, 'bank' => $post->bank, 'ifsc'=>$post->ifsc]);
                }

                $settlerequest = Aepsfundrequest::where('user_id', \Auth::user()->id)->where('status', 'pending')->count();
                if($settlerequest > 0){
                    return response()->json(['status'=> "One request is already submitted"], 400);
                }

                if($post->amount <= 1000){
                    $post['charge'] = $this->settlementcharge1k();
                }elseif($post->amount > 1000 && $post->amount <= 25000){
                    $post['charge'] = $this->settlementcharge25k();
                }else{
                    $post['charge'] = $this->settlementcharge2l();
                }

                if($user->mainwallet < $post->amount + $post->charge){
                    return response()->json(['status'=>  "Low aeps balance to make this request."], 400);
                }

                if($banksettlementtype == "auto"){

                    $previousrecharge = Aepsfundrequest::where('account', $post->account)->where('amount', $post->amount)->where('user_id', $post->user_id)->whereBetween('created_at', [Carbon::now()->subSeconds(30)->format('Y-m-d H:i:s'), Carbon::now()->addSeconds(30)->format('Y-m-d H:i:s')])->count();
                    if($previousrecharge){
                        return response()->json(['status'=> "Transaction Allowed After 1 Min."]);
                    } 

                    $api = Api::where('code', 'psettlement')->first();

                    do {
                        $post['payoutid'] = $this->transcode().rand(111111111111, 999999999999);
                    } while (Aepsfundrequest::where("payoutid", "=", $post->payoutid)->first() instanceof Aepsfundrequest);

                    $post['status']   = "pending";
                    $post['pay_type'] = "payout";
                    $post['payoutid'] = $post->payoutid;
                    $post['payoutref']= $post->payoutid;
                    $post['create_time']= Carbon::now()->toDateTimeString();

                    try {
                        $aepsrequest = Aepsfundrequest::create($post->all());
                    } catch (\Exception $e) {
                        return response()->json(['status'=> "Duplicate Transaction Not Allowed, Please Check Transaction History"]);
                    }

                    $insert = [
                        'number' => $post->account,
                        'mobile' => $user->mobile,
                        'provider_id' => $provide->id,
                        'api_id' => $api->id,
                        'amount' => $post->amount,
                        'charge' => $post->charge,
                        'txnid'  => $post->payoutid,
                        'payid'  => $aepsrequest->id,
                        'option1'  => $post->bank,
                        'option2'  => $post->ifsc,
                        'refno'    => $aepsrequest->payoutref,
                        'remark'   => "Bank Settlement",
                        'status'   => 'success',
                        'user_id'  => $user->id,
                        'credit_by'=> $this->admin->id,
                        'rtype'    => 'main',
                        'via'      => 'portal',
                        'balance'  => $user->mainwallet,
                        'trans_type'  => 'debit',
                        'product'     => 'payout',
                        'create_time' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    User::where('id', $insert['user_id'])->decrement('mainwallet',$insert['amount']+$insert['charge']);
                    $myaepsreport = Report::create($insert);
                    
                    $url = $api->url;

                    $parameter = [
                        "apitxnid" => $post->payoutid,
                        "amount"   => $post->amount, 
                        "account"  => $post->account,
                        "name"     => $user->name,
                        "bank"     => $post->bank,
                        "ifsc"     => $post->ifsc,
                        "ip"       => $post->ip(),
                        "token"    => $api->username,
                        'callback' => url('api/callback/update/recharge/payout')
                    ];
                    $header = array("Content-Type: application/json");

                    if(env('APP_ENV') != "local"){
                        $result = \Myhelper::curl($url, 'POST', json_encode($parameter), $header, 'yes', '\App\Model\Aepsfundrequest', $post->payoutid);
                    }else{
                        $result = [
                            'error'    => true,
                            'response' => ''
                        ];
                    }

                    if($result['response'] == ''){
                        return response()->json(['status'=> "success"]);
                    }

                    $response = json_decode($result['response']);
                    if(isset($response->status) && in_array($response->status, ['TXN', 'TUP'])){
                        Aepsfundrequest::where('id', $aepsrequest->id)->update(['status' => "approved", "payoutref" => $response->rrn]);
                        return response()->json(['status'=>"success"], 200);
                    }elseif(isset($response->status) && in_array($response->status, ['ERR', 'TXF'])){
                        User::where('id', $insert['user_id'])->increment('mainwallet', $insert['amount'] + $insert['charge']);
                        
                        if($response->message == "Low balance, kindly recharge your wallet"){
                            Report::where('id', $myaepsreport->id)->update(['status' => "failed", "refno" => "Service Down For Sometime"]);
                        }else{
                            Report::where('id', $myaepsreport->id)->update(['status' => "failed", "refno" => $response->message]);
                        }

                        Aepsfundrequest::where('id', $aepsrequest->id)->update(['status' => "rejected", "payoutref" => $response->message]);
                        return response()->json(['status'=> $response->message], 400);
                    }else{
                        Aepsfundrequest::where('id', $aepsrequest->id)->update(['status' => "pending"]);
                        return response()->json(['status'=> "success"]);
                    }
                }else{
                    $post['pay_type'] = "manual";
                    $request = Aepsfundrequest::create($post->all());
                }

                if($request){
                    return response()->json(['status'=>"success", 'message' => "Fund request successfully submitted"], 200);
                }else{
                    return response()->json(['status'=>"ERR", 'message' => "Something went wrong."], 400);
                }
                break;

            case 'wallet':
                return response()->json(['status' => "This feature is not allowed"],400);
                // if(!\Myhelper::can('aeps_fund_request')){
                //     return response()->json(['status' => "Permission not allowed"],400);
                // }
                // $rules = array(
                //     'amount'    => 'required|numeric|min:1',
                // );
        
                // $validator = \Validator::make($post->all(), $rules);
                // if ($validator->fails()) {
                //     return response()->json(['errors'=>$validator->errors()], 422);
                // }

                // $user = User::where('id',\Auth::user()->id)->first();

                // $request = Aepsfundrequest::where('user_id', \Auth::user()->id)->where('status', 'pending')->count();
                // if($request > 0){
                //     return response()->json(['status'=> "One request is already submitted"], 400);
                // }

                // if(\Auth::user()->aepsbalance >= $post->amount){
                //     $post['user_id'] = \Auth::id();

                //     $settlementType = $this->settlementtype();

                //     if($settlementType != "auto"){
                //         $load = Aepsfundrequest::create($post->all());
                //     }else{
                //         $post['status'] = "approved";
                //         $load = Aepsfundrequest::create($post->all());
                //         $payee = User::where('id', \Auth::id())->first();
                //         User::where('id', $payee->id)->decrement('aepsbalance', $post->amount);
                //         $inserts = [
                //             "mobile"  => $payee->mobile,
                //             "amount"  => $post->amount,
                //             "bank"    => $payee->bank,
                //             'txnid'   => date('ymdhis'),
                //             'refno'   => $post->refno,
                //             "user_id" => $payee->id,
                //             "credited_by" => $user->id,
                //             "balance"     => $payee->aepsbalance,
                //             'type'        => "debit",
                //             'transtype'   => 'fund',
                //             'status'      => 'success',
                //             'remark'      => "Move To Wallet Request",
                //             'payid'       => "Wallet Transfer Request",
                //             'aadhar'      => $payee->account
                //         ];

                //         Aepsreport::create($inserts);

                //         if($post->type == "wallet"){
                //             $provide = Provider::where('recharge1', 'aepsfund')->first();
                //             User::where('id', $payee->id)->increment('mainwallet', $post->amount);
                //             $insert = [
                //                 'number' => $payee->mobile,
                //                 'mobile' => $payee->mobile,
                //                 'provider_id' => $provide->id,
                //                 'api_id' => $this->fundapi->id,
                //                 'amount' => $post->amount,
                //                 'charge' => '0.00',
                //                 'profit' => '0.00',
                //                 'gst' => '0.00',
                //                 'tds' => '0.00',
                //                 'txnid' => $load->id,
                //                 'payid' => $load->id,
                //                 'refno' => $post->refno,
                //                 'description' =>  "Aeps Fund Recieved",
                //                 'remark' => $post->remark,
                //                 'option1' => $payee->name,
                //                 'status' => 'success',
                //                 'user_id' => $payee->id,
                //                 'credit_by' => $payee->id,
                //                 'rtype' => 'main',
                //                 'via' => 'portal',
                //                 'balance' => $payee->mainwallet,
                //                 'trans_type' => 'credit',
                //                 'product' => "fund request"
                //             ];

                //             Report::create($insert);
                //         }
                //     }
                //     if($load){
                //         return response()->json(['status' => "success"],200);
                //     }else{
                //         return response()->json(['status' => "fail"],200);
                //     }
                // }else{
                //     return response()->json(["errors"=>['amount'=>["Low aeps balance to make this request."]]], 422);
                // }
                break;
                
            case 'aepstransfer':
                if(\Myhelper::hasNotRole('admin')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }

                $user = User::where('id',\Auth::user()->id)->first();
                if($user->mainwallet < $post->amount){
                    return response()->json(['status' => "Insufficient Aeps Wallet Balance"],400);
                }

                $request = Aepsfundrequest::find($post->id);
                $action  = Aepsfundrequest::where('id', $post->id)->update(['status'=>$post->status, 'remark'=> $post->remark]);
                $payee   = User::where('id', $request->user_id)->first();

                if($action){
                    if($post->status == "approved" && $request->status == "pending"){
                        $post['charge'] = 0;
                        if($request->type == "bank"){
                            if($request->amount <= 1000){
                                $post['charge'] = $this->settlementcharge1k();
                            }elseif($request->amount > 1000 && $request->amount <= 25000){
                                $post['charge'] = $this->settlementcharge25k();
                            }else{
                                $post['charge'] = $this->settlementcharge2l();
                            }
                        }

                        User::where('id', $payee->id)->decrement('mainwallet', $request->amount + $post->charge);

                        $inserts = [
                            'mobile'  => $payee->mobile,
                            'provider_id' => $provide->id,
                            'api_id'  => $this->fundapi->id,
                            'amount'  => $request->amount,
                            'charge'  => $post->charge,
                            'txnid'   => $request->id,
                            'refno'   => $post->refno,
                            'description' =>  "Move To Wallet Request",
                            'remark'  => "Move To ".ucfirst($request->type)." Request",
                            'status'  => 'success',
                            'user_id' => $payee->id,
                            'credit_by' => $user->id,
                            'rtype'   => 'main',
                            'via'     => 'portal',
                            'balance' => $user->mainwallet,
                            'trans_type' => 'debit',
                            'product' => "aeps"
                        ];

                        if($request->type == "wallet"){
                            $inserts["number"]= $payee->aadhar;
                        }else{
                            $inserts['option1'] = $payee->bank;
                            $inserts['option2'] = $payee->ifsc;
                            $inserts['number']  = $payee->account;
                        }

                        Report::create($inserts);

                        if($request->type == "wallet"){
                            $provide = Provider::where('recharge1', 'aepsfund')->first();
                            User::where('id', $payee->id)->increment('mainwallet', $request->amount);
                            $insert = [
                                'number' => $payee->mobile,
                                'mobile' => $payee->mobile,
                                'provider_id' => $provide->id,
                                'api_id' => $this->fundapi->id,
                                'amount' => $request->amount,
                                'charge' => '0.00',
                                'profit' => '0.00',
                                'gst' => '0.00',
                                'tds' => '0.00',
                                'txnid' => $request->id,
                                'payid' => $request->id,
                                'refno' => $post->refno,
                                'description' =>  "Aeps Fund Recieved",
                                'remark' => $post->remark,
                                'option1' => $payee->name,
                                'status' => 'success',
                                'user_id' => $payee->id,
                                'credit_by' => $user->id,
                                'rtype' => 'main',
                                'via' => 'portal',
                                'balance' => $payee->mainwallet,
                                'trans_type' => 'credit',
                                'product' => "fund request"
                            ];

                            Report::create($insert);
                        }
                    }
                    return response()->json(['status'=> "success"], 200);
                }else{
                    return response()->json(['status'=> "fail"], 400);
                }

                break;
            
            case 'loadwallet':
                if(\Myhelper::hasNotRole('admin')){
                    return response()->json(['status' => "Permission not allowed"],400);
                }
                $action = User::where('id', \Auth::id())->increment('mainwallet', $post->amount);
                if($action){
                    $insert = [
                        'number' => \Auth::user()->mobile,
                        'mobile' => \Auth::user()->mobile,
                        'provider_id' => $post->provider_id,
                        'api_id' => $this->fundapi->id,
                        'amount' => $post->amount,
                        'charge' => '0.00',
                        'profit' => '0.00',
                        'gst' => '0.00',
                        'tds' => '0.00',
                        'apitxnid' => NULL,
                        'txnid' => date('ymdhis'),
                        'payid' => NULL,
                        'refno' => NULL,
                        'description' => NULL,
                        'remark' => $post->remark,
                        'option1' => NULL,
                        'option2' => NULL,
                        'option3' => NULL,
                        'option4' => NULL,
                        'status' => 'success',
                        'user_id' => \Auth::id(),
                        'credit_by' => \Auth::id(),
                        'rtype' => 'main',
                        'via' => 'portal',
                        'adminprofit' => '0.00',
                        'balance' => \Auth::user()->mainwallet,
                        'trans_type' => 'credit',
                        'product' => "fund ".$post->type
                    ];
                    $action = Report::create($insert);
                    if($action){
                        return response()->json(['status' => "success"], 200);
                    }else{
                        return response()->json(['status' => "Technical error, please contact your service provider before doing transaction."],400);
                    }
                }else{
                    return response()->json(['status' => "Fund transfer failed, please try again."],400);
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    public function paymentAction($post)
    {
        $user = User::where('id', $post->user_id)->first();

        if($post->type == "transfer" || $post->type == "request"){
            $action = User::where('id', $post->user_id)->increment('mainwallet', $post->amount);
        }else{
            $action = User::where('id', $post->user_id)->decrement('mainwallet', $post->amount);
        }

        if($action){
            if($post->type == "transfer" || $post->type == "request"){
                $post['trans_type'] = "credit";
            }else{
                $post['trans_type'] = "debit";
            }

            $insert = [
                'number' => $user->mobile,
                'mobile' => $user->mobile,
                'provider_id' => $post->provider_id,
                'api_id' => $this->fundapi->id,
                'amount' => $post->amount,
                'charge' => '0.00',
                'profit' => '0.00',
                'gst' => '0.00',
                'tds' => '0.00',
                'apitxnid' => NULL,
                'txnid' => $post->txnid,
                'payid' => NULL,
                'refno' => $post->refno,
                'description' => NULL,
                'remark' => $post->remark,
                'option1' => $post->option1,
                'option2' => $post->option2,
                'option3' => $post->option3,
                'option4' => NULL,
                'status' => 'success',
                'user_id' => $user->id,
                'credit_by' => \Auth::id(),
                'rtype' => 'main',
                'via' => 'portal',
                'adminprofit' => '0.00',
                'balance' => $user->mainwallet,
                'trans_type' => $post->trans_type,
                'product' => "fund ".$post->type
            ];
            $action = Report::create($insert);
            if($action){
                return $this->paymentActionCreditor($post);
            }else{
                return response()->json(['status' => "Technical error, please contact your service provider before doing transaction."],400);
            }
        }else{
            return response()->json(['status' => "Fund transfer failed, please try again."],400);
        }
    }

    public function paymentActionCreditor($post)
    {
        $payee = $post->user_id;
        $user = User::where('id', \Auth::id())->first();
        if($post->type == "transfer" || $post->type == "request"){
            $action = User::where('id', $user->id)->decrement('mainwallet', $post->amount);
        }else{
            $action = User::where('id', $user->id)->increment('mainwallet', $post->amount);
        }

        if($action){
            if($post->type == "transfer" || $post->type == "request"){
                $post['trans_type'] = "debit";
            }else{
                $post['trans_type'] = "credit";
            }

            $insert = [
                'number' => $user->mobile,
                'mobile' => $user->mobile,
                'provider_id' => $post->provider_id,
                'api_id' => $this->fundapi->id,
                'amount' => $post->amount,
                'charge' => '0.00',
                'profit' => '0.00',
                'gst' => '0.00',
                'tds' => '0.00',
                'apitxnid' => NULL,
                'txnid' => $post->txnid,
                'payid' => NULL,
                'refno' => $post->refno,
                'description' => NULL,
                'remark' => $post->remark,
                'option1' => $post->option1,
                'option2' => $post->option2,
                'option3' => $post->option3,
                'option4' => NULL,
                'status' => 'success',
                'user_id' => $user->id,
                'credit_by' => $payee,
                'rtype' => 'main',
                'via' => 'portal',
                'adminprofit' => '0.00',
                'balance' => $user->mainwallet,
                'trans_type' => $post->trans_type,
                'product' => "fund ".$post->type
            ];

            $action = Report::create($insert);
            if($action){
                return response()->json(['status' => "success"], 200);
            }else{
                return response()->json(['status' => "Technical error, please contact your service provider before doing transaction."],400);
            }
        }else{
            return response()->json(['status' => "Technical error, please contact your service provider before doing transaction."],400);
        }
    }

    public function paytm(Request $post)
    {
        $api = Api::where('code', 'pdmt')->first();
        $url = $api->url."/bpay/api/v1/disburse/order/bank";
        do {
            $post['txn_id'] = "PI".rand(111111111111, 999999999999);
        } while (Report::where("txn_id", "=", $post->txn_id)->first() instanceof Report);

        $parameter = [
            "orderId" => $post->txn_id,
            "subwalletGuid" => $api->option1,
            "amount" => "100", 
            "beneficiaryAccount" => "918008484891",
            "beneficiaryIFSC" => "PYTM0123456",
            "purpose" => "OTHERS",
            "callbackUrl" => "https://e-bankar.in" ,
            "comments" => "comment",
            "date" => "2019-11-20"
        ];

        $body= json_encode($parameter, true);
        $checksum = \Paytm::getChecksumFromString($body, $api->password);
        $header = array("Content-Type: application/json", "x-mid: ".$api->username, "x-checksum: ".$checksum);

        $result = \Mycheck::curl($url, 'POST', $body, $header, 'no', $post);

        dd([
            "Url" => $url, 
            "Header" => $header, 
            "bodyRequest" => $body,
            "Response" => $result
        ]);
    }

    public function paytmstatus(Request $post)
    {
        $api = Api::where('code', 'pdmt')->first();
        $url = $api->url."/bpay/api/v1/disburse/order/query";

        $parameter = [
            "orderId" => $post->txnid,
        ];

        $method = "POST";
        $body= json_encode($parameter, true);
        $checksum = \Paytm::getChecksumFromString($body, $api->password);
        $header = array("Content-Type: application/json", "x-mid: ".$api->username, "x-checksum: ".$checksum);
        $result = \Mycheck::curl($url, $method, json_encode($parameter), $header, 'no');

        dd([
            "Url" => $url, 
            "Header" => $header, 
            "bodyRequest" => $body,
            "Response" => $result
        ]);
    }
}
