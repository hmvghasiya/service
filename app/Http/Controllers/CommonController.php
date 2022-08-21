<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Utiid;
use Carbon\Carbon;
use App\Model\Report;
use App\Model\Aepsreport;
use App\Model\Aepsfundrequest;
use App\User;
use App\Model\Provider;
use App\Model\Api;
use App\Model\EkoMahaagent;

class CommonController extends Controller
{
    public function fetchData(Request $request, $type, $id=0, $returntype="all")
	{
		$request['return'] = 'all';
		$request['returntype'] = $returntype;
		$parentData = \Myhelper::getParents(\Auth::id());
		switch ($type) {
			case 'permissions':
				$request['table']= '\App\Model\Permission';
				$request['searchdata'] = ['name', 'slug'];
				$request['select'] = 'all';
				$request['order'] = ['id','desc'];
				$request['parentData'] = 'all';
			break;

			case 'roles':
				$request['table']= '\App\Model\Role';
				$request['searchdata'] = ['name', 'slug'];
				$request['select'] = 'all';
				$request['order'] = ['id','desc'];
				$request['parentData'] = 'all';
			break;

			case 'whitelable':
			case 'md':
			case 'distributor':
			case 'retailer':
			case 'statehead':
			case 'apiuser':
			case 'other':
			case 'tr' :
			case 'web':
			case 'kycpending':
			case 'kycsubmitted':
			case 'kycrejected':
				$request['table']= '\App\User';
				$request['searchdata'] = ['id','name', 'mobile','email'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if (\Myhelper::hasRole(['retailer', 'apiuser'])){
					$request['parentData'] = [\Auth::id()];
				}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
					$request['parentData'] = $parentData;
				}else{
					$request['parentData'] = 'all';
				}
				$request['whereIn'] = 'parent_id';
			break;
		
			case 'payoutstatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['number', 'txnid', 'payid', 'remark', 'description', 'refno', 'id', 'apitxnid'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;	

			case 'fundrequest':
				$request['table']= '\App\Model\Fundreport';
				$request['searchdata'] = ['amount','ref_no', 'remark','paymode', 'user_id' , 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'user_id';
				break;
			
			case 'fundrequestview':
			case 'fundrequestviewall':
				$request['table']= '\App\Model\Fundreport';
				$request['searchdata'] = ['amount','ref_no', 'remark','paymode', 'user_id', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'credited_by';
				break;

			case 'fundstatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['amount','number', 'mobile','credit_by', 'user_id', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'user_id';
				break;
			
			case 'aepsfundrequest':
				$request['table']= '\App\Model\Aepsfundrequest';
				$request['searchdata'] = ['amount','type', 'user_id', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'user_id';
				break;

			case 'aepsfundrequestview':
			case 'aepspayoutrequestview':
			case 'aepsfundrequestviewall':
				$request['table']= '\App\Model\Aepsfundrequest';
				$request['searchdata'] = ['amount','type', 'user_id', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if(\Myhelper::hasNotRole(['admin'])){
					$request['parentData'] = [\Auth::id()];
				}else{
					$request['parentData'] = 'all';
				}
				$request['whereIn'] = 'user_id';
				break;
			
			case 'setupbank':
				$request['table']= '\App\Model\Fundbank';
				$request['searchdata'] = ['name','account', 'ifsc','branch'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'user_id';
				break;
			
			case 'setupapi':
				$request['table']= '\App\Model\Api';
				$request['searchdata'] = ['name','account', 'ifsc','branch'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = 'all';
				$request['whereIn'] = 'user_id';
				break;
				
			case 'setupoperator':
				$request['table']= '\App\Model\Provider';
				$request['searchdata'] = ['name','recharge1', 'recharge2','type'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = 'all';
				$request['whereIn'] = 'user_id';
				break;
			
			case 'setupcomplaintsub':
				$request['table']= '\App\Model\Complaintsubject';
				$request['searchdata'] = ['name'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = 'all';
				$request['whereIn'] = 'user_id';
				break;

			case 'resourcescheme':
				$request['table']= '\App\Model\Scheme';
				$request['searchdata'] = ['name', 'user_id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = [\Auth::id()];
				$request['whereIn'] = 'user_id';
				break;

			case 'resourcecompany':
				$request['table']= '\App\Model\Company';
				$request['searchdata'] = ['companyname'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				$request['parentData'] = 'all';
				$request['whereIn'] = 'user_id';
				break;
				
			case 'setuplinks':
				$request['table']= '\App\Model\Link';
				$request['searchdata'] = ['name'];
				$request['select'] = 'all';
				$request['order'] = ['id','desc'];
				$request['parentData'] = 'all';
				$request['whereIn'] = 'user_id';
				break;	
			
			case 'accountstatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['txnid','statement_type', 'user_id', 'credited_by', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if($id == 0){
					$request['parentData'] = [\Auth::id()];
				}else{
					if(in_array($id, $parentData)){
						$request['parentData'] = [$id];
					}else{
						$request['parentData'] = [\Auth::id()];
					}
				}
				$request['whereIn'] = 'user_id';
				
				break;

			case 'awalletstatement':
				$request['table']= '\App\Model\Aepsreport';
				$request['searchdata'] = ['mobile','aadhar', 'txnid', 'refno', 'payid', 'amount', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if($id == 0){
					$request['parentData'] = [\Auth::id()];
				}else{
					if(in_array($id, $parentData)){
						$request['parentData'] = [$id];
					}else{
						$request['parentData'] = [\Auth::id()];
					}
				}
				$request['whereIn'] = 'user_id';
				break;
			
			case 'utiidstatement':
				$request['table']= '\App\Model\Utiid';
				$request['searchdata'] = ['name','vleid', 'user_id', 'location', 'contact_person', 'pincode', 'email', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			case 'portaluti':
				$request['table']= '\App\Model\Utiid';
				$request['searchdata'] = ['name','vleid', 'user_id', 'location', 'contact_person', 'pincode', 'email', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					$request['parentData'] = [\Auth::id()];
					$request['whereIn'] = 'sender_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;
			
			case 'utipancardstatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['number', 'tokens', 'amount', 'remark', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			case 'rechargestatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['number', 'txnid', 'payid', 'remark', 'description', 'refno', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			case 'billpaystatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['number', 'txnid', 'payid', 'remark', 'description', 'refno','option1', 'option2', 'mobile', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			case 'moneystatement':
			case 'xpressmoneystatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['mobile', 'number', 'option1', 'option2', 'option3', 'option4', 'refno', 'payid', 'amount', 'id', 'txnid'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;
			
			case 'aepsstatement':
				$request['table']= '\App\Model\Report';
				$request['searchdata'] = ['number', 'mobile', 'txnid', 'payid', 'id', 'refno'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

            case 'ekoaepsagentstatement':
				$request['table']= '\App\Model\EkoMahaagent';
				$request['searchdata'] = ['bc_f_name','bc_l_name', 'bc_id', 'phone1', 'phone2', 'emailid','id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = [$id];
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;
			case 'complaints':
				$request['table']= '\App\Model\Complaint';
				$request['searchdata'] = ['type', 'solution', 'description', 'user_id', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			case 'apitoken':
				$request['table']= '\App\Model\Apitoken';
				$request['searchdata'] = ['ip'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if (\Myhelper::hasRole('admin')){
					$request['parentData'] = 'all';
				}else{
					$request['parentData'] = [\Auth::id()];
				}
				$request['whereIn'] = 'user_id';
				break;

			case 'aepsagentstatement':
				$request['table']= '\App\Model\Mahaagent';
				$request['searchdata'] = ['bc_f_name','bc_m_name', 'bc_id', 'phone1', 'phone2', 'emailid', 'id'];
				$request['select'] = 'all';
				$request['order'] = ['id','DESC'];
				if ($id == 0 || $returntype == "all") {
					if($id == 0){
						if (\Myhelper::hasRole(['retailer', 'apiuser'])){
							$request['parentData'] = [\Auth::id()];
						}elseif(\Myhelper::hasRole(['md', 'distributor','whitelable', 'statehead'])){
							$request['parentData'] = $parentData;
						}else{
							$request['parentData'] = 'all';
						}
					}else{
						if(in_array($id, $parentData)){
							$request['parentData'] = \Myhelper::getParents($id);
						}else{
							$request['parentData'] = [\Auth::id()];
						}
					}
					$request['whereIn'] = 'user_id';
				}else{
					$request['parentData'] = [$id];
					$request['whereIn'] = 'id';
					$request['return'] = 'single';
				}
				break;

			default:
				# code...
				break;
        }
        
		$request['where']=0;
		$request['type']= $type;
        
		try {
			$totalData = $this->getData($request, 'count');
		} catch (\Exception $e) {
			$totalData = 0;
		}

		if ((isset($request->searchtext) && !empty($request->searchtext)) ||
           	(isset($request->todate) && !empty($request->todate))       ||
           	(isset($request->product) && !empty($request->product))       ||
           	(isset($request->status) && $request->status != '')		  ||
           	(isset($request->agent) && !empty($request->agent))
         ) 
	    {
	        $request['where'] = 1;
	    }

		try {
			$totalFiltered = $this->getData($request, 'count');
		} catch (\Exception $e) {
			$totalFiltered = 0;
		}
		//return $data = $this->getData($request, 'data');
		try {
			$data = $this->getData($request, 'data');
		} catch (\Exception $e) {
			$data = [];
		}
		
		if ($request->return == "all" || $returntype =="all") {
			$json_data = array(
				"draw"            => intval( $request['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
			);
			echo json_encode($json_data);
		}else{
			return response()->json($data);
		}
	}

	public function getData($request, $returntype)
	{ 
		$table = $request->table;
		$data = $table::query();
		$data->orderBy($request->order[0], $request->order[1]);

		if($request->parentData != 'all'){
			if(!is_array($request->whereIn)){
				$data->whereIn($request->whereIn, $request->parentData);
			}else{
				$data->where(function ($query) use($request){
					$query->where($request->whereIn[0] , $request->parentData)
					->orWhere($request->whereIn[1] , $request->parentData);
				});
			}
		}

		if( $request->type != "roles" &&
			$request->type != "permissions" &&
			$request->type != "fundrequestview" &&
			$request->type != "fundrequest" &&
			$request->type != "setupbank" &&
			$request->type != "setupapi" &&
			$request->type != "setuplinks" &&
			$request->type != "setupoperator" &&
			$request->type != "resourcescheme" &&
			$request->type != "resourcecompany" &&
			$request->type != "aepsfundrequestview" &&
			$request->type != "fundrequestview" &&
			!in_array($request->type , ['whitelable', 'md', 'distributor', 'statehead', 'retailer', 'apiuser', 'other', 'tr', 'web'])&&
			$request->where != 1
        ){
            if(!empty($request->fromdate)){
                $data->whereDate('created_at', $request->fromdate);
            }
	    }

        switch ($request->type) {
			case 'whitelable':
			case 'statehead':
			case 'md':
			case 'distributor':
			case 'retailer':
			case 'apiuser':
				$data->whereHas('role', function ($q) use($request){
					$q->where('slug', $request->type);
				})->where('kyc', 'verified');
			break;

			case 'other':
				$data->whereHas('role', function ($q) use($request){
					$q->whereNotIn('slug', ['whitelable', 'md', 'distributor', 'retailer', 'apiuser', 'admin','statehead']);
				});
			break;
			
			case 'web':
				$data->where('kyc', 'pending')->where('status', 'block');
			break;

			case 'tr':
				$data->whereHas('role', function ($q) use($request){
					$q->whereIn('slug', ['whitelable', 'statehead', 'md', 'distributor', 'retailer', 'apiuser']);
				})->where('kyc', 'verified');
			break;

			case 'kycpending':
				$data->whereHas('role', function ($q) use($request){
					$q->whereIn('slug', ['whitelable', 'md', 'distributor', 'retailer', 'apiuser']);
				})->whereIn('kyc', ['pending']);
			break;

			case 'kycsubmitted':
				$data->whereHas('role', function ($q) use($request){
					$q->whereIn('slug', ['whitelable', 'md', 'distributor', 'retailer', 'apiuser']);
				})->whereIn('kyc', ['submitted']);
			break;
				
			case 'kycrejected':
				$data->whereHas('role', function ($q) use($request){
					$q->whereIn('slug', ['whitelable', 'md', 'distributor', 'retailer', 'apiuser']);
				})->whereIn('kyc', ['rejected']);
			break;

			case 'fundrequest':
				$data->where('type', 'request');
				break;

			case 'fundrequestview':
				$data->where('status', 'pending')->where('type', 'request');
				break;
			
			case 'fundrequestviewall':
				$data->where('type', 'request');
				break;

			case 'aepsfundrequestview':
				$data->where('status', 'pending')->where('pay_type', 'manual');
				break;

			case 'aepspayoutrequestview':
				$data->where('status', 'pending')->where('pay_type', 'payout');
				break;

			case 'rechargestatement':
				$data->where('product', 'recharge')->where('rtype', 'main');
				break;
			
			case 'billpaystatement':
				$data->where('product', 'billpay')->where('rtype', 'main');
				break;

			case 'aepsstatement':
				$data->where('rtype', 'main')->where('product', 'aeps')->whereIn('option1', ['CW', 'M']);;
				break;
			
			case 'utipancardstatement':
				$data->where('product', 'utipancard')->where('rtype', 'main');
				break;
			
			case 'fundstatement':
				$data->whereHas('provider', function ($q){
					$q->where('recharge1', 'fund');
				});
				break;

			case 'awalletstatement':
				$data->where('aepstype', '!=','BE');
				break;
				
			case 'payoutstatement':
				$data->where('product', 'payout')->where('rtype', 'main');
				break;	

			case 'moneystatement':
				$data->where('product', 'dmt')->where('rtype', 'main')->where('api_id',6);
				break;
			case 'xpressmoneystatement':
				$data->where('product', 'dmt')->where('rtype', 'main')->where('api_id',9);
				break;	
        }
		if ($request->where) {
	        if((isset($request->fromdate) && !empty($request->fromdate)) 
	        	&& (isset($request->todate) && !empty($request->todate))){
	            if($request->fromdate == $request->todate){
	                $data->whereDate('created_at','=', Carbon::createFromFormat('Y-m-d', $request->fromdate)->format('Y-m-d'));
	            }else{
	                $data->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $request->fromdate)->format('Y-m-d'), Carbon::createFromFormat('Y-m-d', $request->todate)->addDay(1)->format('Y-m-d')]);
	            }
	        }

	        if(isset($request->product) && !empty($request->product)){
	            switch ($request->type) {
					case 'billpaystatement':
					case 'rechargestatement':
	            		$data->where('provider_id', $request->product);
					break;

					case 'setupoperator':
	            		$data->where('type', $request->product);
					break;

					case 'complaints':
	            		$data->where('product', $request->product);
					break;

					case 'fundstatement':
					case 'aepsfundrequestview':
					case 'aepsfundrequestviewall':
					case 'payoutstatement':
	            		$data->where('type', $request->product);
					break;
				}
			}
			
	        if(isset($request->status) && $request->status != '' && $request->status != null){
	        	switch ($request->type) {	
					case 'kycpending':
					case 'kycsubmitted':
					case 'kycrejected':
						$data->where('kyc', $request->status);
					break;

					default:
	            		$data->where('status', $request->status);
					break;
				}
			}
			
			if(isset($request->agent) && !empty($request->agent)){
	        	switch ($request->type) {					
					case 'whitelable':
					case 'md':
					case 'distributor':
					case 'retailer':
					case 'apiuser':
					case 'other':
					case 'tr' :
					case 'kycpending':
					case 'kycsubmitted':
					case 'kycrejected':
						$data->whereIn('id', $this->agentFilter($request));
					break;

					default:
						$data->whereIn('user_id', $this->agentFilter($request));
					break;
				}
	        }

	        if(!empty($request->searchtext)){
	            $data->where( function($q) use($request){
	            	foreach ($request->searchdata as $value) {
	            		$q->orWhere($value, 'like',$request->searchtext.'%');
                  		$q->orWhere($value,'like','%'.$request->searchtext.'%');
                  		$q->orWhere($value, 'like','%'.$request->searchtext);
	            	}
				});
	        } 
      	}
		
		if ($request->return == "all" || $request->returntype == "all") {
			if($returntype == "count"){
				return $data->count();
			}else{
				if($request['length'] != -1){
					$data->skip($request['start'])->take($request['length']);
				}

				if($request->select == "all"){
					return $data->get();
				}else{
					return $data->select($request->select)->get();
				}
			}
		}else{
			if($request->select == "all"){
				return $data->first();
			}else{
				return $data->select($request->select)->first();
			}
		}
	}

	public function agentFilter($post)
	{
		if (\Myhelper::hasRole('admin') || in_array($post->agent, session('parentData'))) {
			return \Myhelper::getParents($post->agent);
		}else{
			return [];
		}
	}

	public function update(Request $post)
    {
        switch ($post->actiontype) {
            case 'utiid':
                $permission = "Utiid_statement_edit";
				break;
				
			case 'utipancard':
                $permission = "utipancard_statement_edit";
				break;
				
			case 'recharge':
                $permission = "recharge_statement_edit";
				break;
				
			case 'billpay':
                $permission = "billpay_statement_edit";
				break;
			
			case 'money':
                $permission = "money_statement_edit";
                break;

            case 'aeps':
                $permission = "money_statement_edit";
                break;

            case 'payout':
                $permission = "payout_statement_edit";
                break;

        }

        if (isset($permission) && !\Myhelper::can($permission)) {
            return response()->json(['status' => "Permission Not Allowed"], 400);
        }

        switch ($post->actiontype) {
            case 'utiid':
                $rules = array(
					'id'    => 'required',
                    'status'    => 'required',
                    'vleid'    => 'required|unique:utiids,vleid'.($post->id != "new" ? ",".$post->id : ''),
                    'vlepassword'    => 'required',
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
                }
                $action = Utiid::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype', 'actiontype']));
                if ($action) {
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;
				
			case 'utipancard':
                $rules = array(
					'id'    => 'required',
                    'status'    => 'required',
                    'number'    => 'required',
                    'remark'    => 'required',
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
				}
				
				$report = Report::where('id', $post->id)->first();
				if(!$report || !in_array($report->status , ['pending', 'success'])){
					return response()->json(['status' => "Utipancard Editing Not Allowed"], 400);
				}

                $action = Report::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype']));
                if ($action) {
					if($post->status == "reversed"){
						\Myhelper::transactionRefund($post->id);
					}

					if($report->user->role->slug == "apiuser" && $report->status == "pending" && $post->status != "pending"){
						\Myhelper::callback($report, 'utipancard');
					}
					
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;
				
			case 'recharge':
                $rules = array(
					'id'    => 'required',
                    'status'    => 'required',
                    'txnid'    => 'required',
					'refno'    => 'required',
                    'payid'    => 'required'
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
				}

				$report = Report::where('id', $post->id)->first();
				if(!$report || !in_array($report->status , ['pending', 'success'])){
					return response()->json(['status' => "Recharge Editing Not Allowed"], 400);
				}

                $action = Report::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype']));
                if ($action) {
					if($post->status == "reversed"){
						\Myhelper::transactionRefund($post->id);
					}

					if($report->user->role->slug == "apiuser" && $report->status != "reversed" && $post->status != "pending"){
						\Myhelper::callback($report, 'recharge');
					}

                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;
				
			case 'billpay':
                $rules = array(
					'id'    => 'required',
                    'status'    => 'required',
                    'txnid'    => 'required',
					'refno'    => 'required'
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
				}

				$report = Report::where('id', $post->id)->first();
				if(!$report || !in_array($report->status , ['pending', 'success'])){
					return response()->json(['status' => "Recharge Editing Not Allowed"], 400);
				}

                $action = Report::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype']));
                if ($action) {
					if($post->status == "reversed"){
						\Myhelper::transactionRefund($post->id);
					}
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;
				
			case 'money':
                $rules = array(
					'id'    => 'required',
                    'status'=> 'required',
                    'txnid' => 'required',
					'refno' => 'required',
                    'payid' => 'required'
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
				}

				$report = Report::where('id', $post->id)->first();
				if(!$report || !in_array($report->status , ['pending', 'success'])){
					return response()->json(['status' => "Money Transfer Editing Not Allowed"], 400);
				}

                $action = Report::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype']));
                if ($action) {
					if($post->status == "reversed"){
						\Myhelper::transactionRefund($post->id);
					}
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;

			case 'payout':
                $rules = array(
					'id'    => 'required',
                    'status'=> 'required',
					'payoutref' => 'required'
                );
                
                $validator = \Validator::make($post->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['errors'=>$validator->errors()], 422);
				}

				$fundreport = Aepsfundrequest::where('id', $post->id)->first();
				if(!$fundreport || !in_array($fundreport->status , ['pending', 'success'])){
					return response()->json(['status' => "Transaction Editing Not Allowed"], 400);
				}

                $action = Aepsfundrequest::where('id', $post->id)->update($post->except(['id', '_token', 'actiontype']));
                if ($action) {
					if($post->status == "rejected"){
						$report = Aepsreport::where('txnid', $fundreport->payoutid)->update(['status' => "reversed"]);
						$report = Aepsreport::where('txnid', $fundreport->payoutid)->first();
						$aepsreports['api_id'] = $report->api_id;
	                    $aepsreports['payid']  = $report->payid;
	                    $aepsreports['mobile'] = $report->mobile;
	                    $aepsreports['refno']  = $report->refno;
	                    $aepsreports['aadhar'] = $report->aadhar;
	                    $aepsreports['amount'] = $report->amount;
	                    $aepsreports['charge'] = $report->charge;
	                    $aepsreports['bank']   = $report->bank;
	                    $aepsreports['txnid']  = $report->id;
	                    $aepsreports['user_id']= $report->user_id;
	                    $aepsreports['credited_by'] = $report->credited_by;
	                    $aepsreports['balance']     = $report->user->aepsbalance;
	                    $aepsreports['type']        = "credit";
	                    $aepsreports['transtype']   = 'fund';
	                    $aepsreports['status'] = 'refunded';
	                    $aepsreports['remark'] = "Bank Settlement";
	                    Aepsreport::create($aepsreports);
                    	User::where('id', $aepsreports['user_id'])->increment('aepsbalance',$aepsreports['amount']+$aepsreports['charge']);
					}
                    return response()->json(['status' => "success"], 200);
                }else{
                    return response()->json(['status' => "Task Failed, please try again"], 200);
                }
				break;
        }
	}
	
	public function status(Request $post)
    {
		if (!\Myhelper::can($post->type."_status")) {
            return response()->json(['status' => "Permission Not Allowed"], 400);
		}
		
		switch ($post->type) {
			case 'recharge':
			case 'billpayment':
			case 'utipancard':
			case 'money':
				$report = Report::where('id', $post->id)->first();
				break;
				
			case 'payout':	
			    $r=Report::where('id', $post->id)->first();
			    $report = Aepsfundrequest::where('id', $r->payid)->first();
			    // dd($report);
				break;

			case 'aeps':
				$report = Report::where('id', $post->id)->first();
				break;

			case 'utiid':
				$report = Utiid::where('id', $post->id)->first();
				break;
				
			case 'ekostatus':
                
				$report = EkoMahaagent::where('id', $post->id)->first();
				
				break;	

			default:
				return response()->json(['status' => "Status Not Allowed"], 400);
				break;
		}

		if(!$report){
			return response()->json(['status' => "Recharge Status Not Allowed"], 400);
		}

		switch ($post->type) {
			case 'recharge':
				switch ($report->api->code) {
					case 'recharge1':
						$url = $report->api->url.'/status?token='.$report->api->username.'&apitxnid='.$report->txnid;
						break;
					
					default:
						return response()->json(['status' => "Recharge Status Not Allowed"], 400);
						break;
				}
				
				$method = "GET";
				$parameter = "";
				$header = [];
				break;

			case 'billpayment':
				$url = $report->api->url.'/status?token='.$report->api->username.'&apitxnid='.$report->txnid;
				$method = "GET";
				$parameter = "";
				$header = [];
				break;

			case 'utipancard':
				$url = $report->api->url.'/request/status?token='.$report->api->username.'&txnid='.$report->txnid;
				$method = "GET";
				$parameter = "";
				$header = [];
				break;
			case 'payout':
				$url = "https://nikatby.co.in/api/merchant/bank/payout/status";
				$method = "POST";
				$parameter = array(
					'token' => "RVSuK3mXIDvDfULa3PJW6tWdQIZJf9",
					'txnid'	=> $report->payoutid
				);
				$header = [];
				break;	
			
			case 'utiid':
				$url = $report->api->url.'/status?token='.$report->api->username.'&vleid='.$report->vleid;
				$method = "GET";
				$parameter = "";
				$header = [];
				break;

			case 'money':
				$url = $report->api->url."/transaction";
				$method = "POST";
				$parameter = json_encode(array(
					'token' => $report->api->username,
					'type'  => "status",
					'txnid'	=> $report->txnid
				));

				$header = array(
					"Accept: application/json",
					"Cache-Control: no-cache",
					"Content-Type: application/json"
				);
				break;

             case 'ekostatus':
               
			    $key = "67c57bc1-3655-4445-9e0d-5279e851e1b5";
            
            // Encode it using base64
            $encodedKey = base64_encode($key);
            
            // Get current timestamp in milliseconds since UNIX epoch as STRING
            // Check out https://currentmillis.com to understand the timestamp format
            $secret_key_timestamp = "".round(microtime(true) * 1000);
            
            // Computes the signature by hashing the salt with the encoded key 
            $signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
            
            // Encode it using base64
            $secret_key = base64_encode($signature);
            
			   
			    //$api  = Api::where('code', 'aepsekoapi')->first();
			   
			    $user=\DB::table('eko_mahaagents')->where('id',$post->id)->first();
			    $url=  "https://api.eko.in:25002/ekoicici/v1/user/services/user_code:$user->bc_id?initiator_id=7070856464";
				//$url= $api->url."user/services/user_code:$user->bc_id?initiator_id=7070856464";
				$method = "GET";
				$parameter = "";
 
				$header = array(
					"Accept: */*",
                        "Accept-Encoding: gzip, deflate",
                        "Cache-Control: no-cache",
                        "Connection: keep-alive",
                        "Host: api.eko.in:25002",
                        "cache-control: no-cache",
                        "developer_key: b440938f11a745450c01a2eb50b0debb",
                        "secret-key:".$secret_key,
                        "secret-key-timestamp:".$secret_key_timestamp
                    				);
				break;

			case 'aeps':
				$url = $report->api->url.'status?token='.$report->api->username.'&txnid='.$report->mytxnid;
				$method = "GET";
				$parameter = "";
				$header = [];
				break;
			
			default:
				# code...
				break;
		}

		$result = \Myhelper::curl($url, $method, $parameter, $header);
	//	dd([$url, $result,$parameter]);
		if($result['response'] != ''){
			switch ($post->type) {
				case 'recharge':
					switch ($report->api->code) {
						case 'recharge1':
						$doc = json_decode($result['response']);
						if($doc->statuscode == "TXN"){
							$update['refno'] = $doc->refno;
							$update['status'] = "success";
						}elseif($doc->statuscode == "TXF" || $doc->statuscode == "TXR"){
							$update['status'] = "reversed";
							$update['refno'] = $doc->refno;
						}else{
							$update['status'] = "Unknown";
							$update['refno'] = $doc->refno;
						}
						break;
					}
					$product = "recharge";
					break;
				case 'payout':
				    $doc = json_decode($result['response']);
				   //dd($doc);
					if(isset($doc->statuscode)){
						if(($doc->statuscode == "TXN" && $doc->trans_status =="success") || ($doc->statuscode == "TXN" && $doc->trans_status =="pending")){
							$update['refno'] = $doc->refno;
							$update['status'] = "success";
						}elseif($doc->statuscode == "TXN" && $doc->data->status =="reversed"){
							$update['status'] = "reversed";
						}else{
							$update['status'] = "Unknown";
						}
					}else{
						$update['status'] = "Unknown";
					}
					$product = "payout";
				    break;

				case 'billpayment':
					$doc = json_decode($result['response']);
					if(isset($doc->statuscode)){
						if(($doc->statuscode == "TXN" && $doc->data->status =="success") || ($doc->statuscode == "TXN" && $doc->data->status =="pending")){
							$update['refno'] = $doc->data->ref_no;
							$update['status'] = "success";
						}elseif($doc->statuscode == "TXN" && $doc->data->status =="reversed"){
							$update['status'] = "reversed";
						}else{
							$update['status'] = "Unknown";
						}
					}else{
						$update['status'] = "Unknown";
					}
					$product = "billpay";
					break;

				case 'utipancard':
					$doc = json_decode($result['response']);
					//dd($doc);
					if(isset($doc->statuscode) && $doc->statuscode == "TXN" && $doc->trans_status == "success"){
						$update['status'] = "success";
					}elseif(isset($doc->statuscode) && $doc->statuscode == "TXN" && $doc->trans_status == "reversed"){
						$update['status'] = "reversed";
						$update['refno']  = $doc->refno;
					}elseif(isset($doc->statuscode) && $doc->statuscode == "TUP" && $doc->trans_status == "pending"){
						$update['status'] = "pending";
					}else{
						$update['status'] = "Unknown";
					}
					$product = "utipancard";
					break;

				case 'money':
					$doc = json_decode($result['response']);
					//dd($doc);
					if(isset($doc->statuscode) && $doc->statuscode == "TXN" && $doc->trans_status == "success"){
						$update['refno'] = $doc->refno;
						$update['status'] = "success";
					}elseif(isset($doc->statuscode) && $doc->statuscode == "TXN" && $doc->trans_status == "reversed"){
						$update['refno'] = $doc->refno;
						$update['status'] = "reversed";
					}else{
						$update['status'] = isset($doc->trans_status) ? $doc->trans_status : 'unknown';
					}

					$product = "dmt";
					break;

				case 'utiid':
					$doc = json_decode($result['response']);
					//dd($doc);
					if(isset($doc->statuscode) && $doc->statuscode == "TXN"){
						$update['status'] = "success";
						$update['remark'] = $doc->message;
					}elseif(isset($doc->statuscode) && $doc->statuscode == "TXF"){
						$update['status'] = "reversed";
						$update['remark'] = $doc->message;
					}elseif(isset($doc->statuscode) && $doc->statuscode == "TUP"){
						$update['status'] = "pending";
						$update['remark'] = $doc->message;
					}else{
						$update['status'] = "Unknown";
					}
					$product = "utiid";
					break;

				case 'aeps':
					$doc = json_decode($result['response']);
					if(isset($doc->statuscode)){
						if($doc->statuscode == "TXN" && $doc->trans_status =="success"){
							$update['refno'] = $doc->refno;
							$update['status'] = "success";
						}elseif($doc->statuscode == "TXN" && $doc->trans_status =="complete"){
							$update['refno'] = $doc->refno;
							$update['status'] = "complete";
						}elseif($doc->statuscode == "TXN" && $doc->trans_status =="failed"){
							$update['status'] = "failed";
							$update['refno'] = $doc->refno;
						}elseif($doc->statuscode == "TXN" && $doc->trans_status =="pending"){
							$update['status'] = "pending";
							$update['refno'] = $doc->refno;
						}else{
							$update['status'] = "Unknown";
						}
					}else{
						$update['status'] = "Unknown";
					}
					$product = "aeps";
				
				break;
				
				 case 'ekostatus':
    			    $doc = json_decode($result['response']);
					
					if(isset($doc->data->service_status_list['0']->verification_status) && $doc->data->service_status_list['0']->verification_status == "1"){
					    $update['status'] = "success";
					    $update['bbps_id'] = "activated";
					    $update['qualification'] = "activated";
					    
					}elseif(isset($doc->data->service_status_list['0']->verification_status) && $doc->data->service_status_list['0']->verification_status == "3"){
					    $update['status'] = "pending";
					    $update['qualification'] = "pending";
					
					}elseif(isset($doc->data->service_status_list['0']->verification_status) && $doc->data->service_status_list['0']->verification_status == "2"){
					    $update['status'] = "rejected";
					    $update['bbps_id'] = "notactivated";
					    $update['qualification'] = $doc->data->service_status_list['0']->comments;
					}else{
						$update['status'] = "Unknown";
					}
    				break;
			}

			if ($update['status'] != "Unknown") {
				switch ($post->type) {
					case 'recharge':
					case 'billpayment':
					case 'utipancard':
					case 'money':
						$reportupdate = Report::where('id', $post->id)->update($update);
						if ($reportupdate && $update['status'] == "reversed") {
							\Myhelper::transactionRefund($post->id);
						}
						break;
                    case 'ekostatus':
						$reportupdate = EkoMahaagent::where('id', $post->id)->update($update);
						break;	

					case 'aeps':
						$reportupdate = Report::where('id', $post->id)->update($update);

						if($report->status == "pending" && $update['status'] == "complete"){
						    $user = User::where('id', $report->user_id)->first();
						    $insert = [
					            'number' => $report->number,
					            'mobile' => $report->mobile,
					            'provider_id' => $report->provider_id,
					            'api_id' => $report->api_id,
					            'amount' => $report->amount,
					            'profit' => $report->profit,
					            'txnid'  => $report->id,
					            'refno'  => $report->refno,
					            'payid'  => $report->payid,
					            'option1'  => $report->option1,
					            'option2'  => $report->option2,
					            'option3'  => $report->option3,
					            'option4'  => $report->option4,
					            'description'  => $report->description,
					            'status'   => 'success',
					            'user_id'  => $report->user_id,
					            'credit_by'=> $report->credit_by,
					            'rtype'    => 'main',
					            'via'      => 'portal',
					            'balance'  => $user->mainwallet,
					            'trans_type'  => 'credit',
					            'product'     => 'aeps',
					            'create_time' => Carbon::now()->format('Y-m-d H:i:s')
					        ];
					        
                            if($report->amount >= 100 && $report->amount <= 500){
                                $provider = Provider::where('recharge1', 'aeps1')->first();
                                $providerid = $provider->id;
                            }elseif($report->amount > 500 && $report->amount <= 3000){
                                $provider = Provider::where('recharge1', 'aeps2')->first();
                                $providerid = $provider->id;
                            }elseif($report->amount>3000 && $report->amount<=6000){
                                $provider = Provider::where('recharge1', 'aeps3')->first();
                                $providerid = $provider->id;
                            }elseif($report->amount>6000 && $report->amount<=10000){
                                $provider = Provider::where('recharge1', 'aeps4')->first();
                                $providerid = $provider->id;
                            }
                    
                            $post['provider_id']   = $provider->id;
                            $insert['provider_id'] = $provider->id;
                            $post['service']       = $provider->type;
                
                            if($report->option1 == "CW"){
                                if($report->amount > 500){
                                    $usercommission = \Myhelper::getCommission($report->amount, $user->scheme_id, $post->provider_id);
                                }else{
                                    $usercommission = 0;
                                }
                            }else{
                                $usercommission = 0;
                            }
                            
                            $insert['charge'] = $usercommission;
                            $action = User::where('id', $report->user_id)->increment('mainwallet', $report->amount+$usercommission);
                            if($action){
                                $aeps = Report::create($insert);
                                if($report->amount > 500){
                                    \Myhelper::commission(Report::find($aeps->id));
                                }
                            }
						}
						break;

					case 'utiid':
						$reportupdate = Utiid::where('id', $post->id)->update($update);
						break;
					case 'payout':
					    
					    //dd($post->all());
					     $r=Report::where('id', $post->id)->first();
			             $fundreport = Aepsfundrequest::where('id', $r->payid)->first();
			             $reportupdate = Report::where('id', $post->id)->update($update);
					    break;
				}
			}
			return response()->json($update, 200);
		}else{
			return response()->json(['status' => "Recharge Status Not Fetched , Try Again."], 400);
		}
	}
}
