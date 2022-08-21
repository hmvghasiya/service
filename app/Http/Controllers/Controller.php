<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function transcode()
    {
    	$code = \DB::table('portal_settings')->where('code', 'transactioncode')->first(['value']);
    	return $code->value;
    }

    public function batch()
    {
        $code = \DB::table('portal_settings')->where('code', 'batch')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "";
        }
    }

    public function settlementcharge()
    {
        $code = \DB::table('portal_settings')->where('code', 'settlementcharge')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "0";
        }
    }

    public function settlementcharge1k()
    {
        $code = \DB::table('portal_settings')->where('code', 'settlementcharge1k')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "0";
        }
    }

    public function settlementcharge25k()
    {
        $code = \DB::table('portal_settings')->where('code', 'settlementcharge25k')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "0";
        }
    }

    public function settlementcharge2l()
    {
        $code = \DB::table('portal_settings')->where('code', 'settlementcharge2l')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "0";
        }
    }

    public function settlementtype()
    {
        $code = \DB::table('portal_settings')->where('code', 'settlementtype')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "manual";
        }
    }

    public function banksettlementtype()
    {
        $code = \DB::table('portal_settings')->where('code', 'banksettlementtype')->first(['value']);
        if($code){
           return $code->value;
        }else{
            return "manual";
        }
    }
     public function bbpsregistration($post, $agent)
    {
        if(!$agent->bbps_agent_id){
            $gpsdata = geoip($post->ip());
            $burl  = $this->billapi->url."RegBBPSAgent";

            $json_data = [
                "requestby"     => $this->billapi->username,
                "securityKey"   => $this->billapi->password,
                "name"          => $agent->bc_f_name." ".$agent->bc_l_name,
                "contactperson" => $agent->bc_f_name." ".$agent->bc_l_name,
                "mobileNumber"  => $agent->phone1,
                'agentshopname' => $agent->shopname,
                "businesstype"  => $agent->shopType,
                "address1"      => $agent->bc_address,
                "address2"      => $agent->bc_city,
                "state"         => $agent->bc_state,
                "city"          => $agent->bc_district,
                "pincode"       => $agent->bc_pincode,
                "latitude"      => sprintf('%0.4f', $gpsdata->lat),
                "longitude"     => sprintf('%0.4f', $gpsdata->lon),
                'email'         => $agent->emailid
            ];
            
            $header = array(
                "authorization: Basic ".base64_encode($this->billapi->username.":".$this->billapi->optional1),
                "cache-control: no-cache",
                "content-type: application/json"
            );
            $bbpsresult = \Myhelper::curl($burl, "POST", json_encode($json_data), $header, "yes", 'MahaBill', $agent->phone1);

            if($bbpsresult['response'] != ''){
                $response = json_decode($bbpsresult['response']);
                if(isset($response->Data)){
                    $datas = $response->Data;
                    if(!empty($datas)){
                        \App\Model\Mahaagent::where('user_id', $post->user_id)->update(['bbps_agent_id' => $datas[0]->agentid]);
                    }
                }
            }
        }

        if($agent->bbps_agent_id && !$agent->bbps_id){
            $url = $this->billapi->url."GetBBPSAgentStatus";
            $json_data = [
                "requestby"   => $this->billapi->username,
                "securityKey" => $this->billapi->password,
                "agentId"     => $agent->bbps_agent_id
            ];

            $header = array(
                "authorization: Basic ".base64_encode($this->billapi->username.":".$this->billapi->optional1),
                "cache-control: no-cache",
                "content-type: application/json"
            );

            $bbpsresult = \Myhelper::curl($url, "POST", json_encode($json_data), $header, "no");
            $response = json_decode($bbpsresult['response']);
            if(isset($response[0]) && !empty($response[0]->bbps_Id)){
                \App\Model\Mahaagent::where('user_id',$post->user_id)->update(['bbps_id'=> $response[0]->bbps_Id]);
            }
        }
        return \App\Model\Mahaagent::where('user_id', $post->user_id)->first();
    }
    
    public function pinCheck($data)
    {
        if(\Auth::check()){
            $code = \DB::table('pindatas')->where('user_id', \Auth::id())->where('pin', \Myhelper::encrypt($data->pin, "antliaFin@@##2025500"))->first();
        }else{
            $code = \DB::table('pindatas')->where('user_id', $data->user_id)->where('pin', \Myhelper::encrypt($data->pin, "antliaFin@@##2025500"))->first();
        }
        if(!$code){
            return 'fail';
        }
    }
}
