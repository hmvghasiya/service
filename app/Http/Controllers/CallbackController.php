<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Report;
use App\Model\Utiid;

class CallbackController extends Controller
{
    public function update(Request $post)
    {
        if($post->has('status')){
            if(strtolower($post->status) == "success"){
                $update['status'] = "success";
                $update['refno'] = $post->refno;
            }elseif (strtolower($post->status) == "reversed") {
                $update['status'] = "reversed";
                $update['refno'] = $post->refno;
            }else{
                $update['status'] = "pending";
            }
        }

        if($update['status'] != "pending"){
            if($post->has('txnid')){
                $report = Report::where('txnid', $post->txnid)->first();

                if($report && (in_array($report->status, ['success', 'pending']))){
                    $updates = Report::where('id', $report->id)->update($update);
                    if($updates){
                        if($update['status'] == "reversed"){
                            \Myhelper::transactionRefund($report->id);
                        }

                        if($report->user->role->slug == "apiuser" && $report->user->callbackurl != null){
                            \Myhelper::callback($report, 'recharge');
                        }
                    }
                }
            }
        }
    }
     public function callback(Request $post, $api)
    {
     
         switch ($api) {
            case 'xpress':
                \DB::table('microlog')->insert(['response'=>json_encode($post->all())]);
               
                break;
            
            default:
                return response('');
                break;
        }
    }     
    
}
