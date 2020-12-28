<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use DataTables;
use Validator;

class ReportMisController extends Controller
{
    public function __cunstruct(){

	}


	public function index(Request $request){

		if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accountCode || $request->fromDate)) {

				$depot = $request->input('depotCode');
	    		$party = $request->input('accountCode');
	    		$from_date = $request->input('fromDate');
	    		$to_date = $request->input('toDate');
	    	$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

		    	
	    	if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="  AND  sap_bill.vr_date BETWEEN '$from_date' and  '$to_date'";
	      	}

			 if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
				$strWhere="  AND   inward_trans.depot_code= '$depot' AND inward_trans.fy_year = '$macc_year' AND sap_bill.fy_year = '$macc_year'";
			}
			else if (isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')) {

				$strWhere="  AND   inward_trans.depot_code='$depot' AND sap_bill.vr_date BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere=" AND  sap_bill.acct_code= '$party' AND inward_trans.fy_year = '$macc_year' AND sap_bill.fy_year = '$macc_year'";
			}
			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin'&& $usertype=='user')){
				$strWhere=" AND  sap_bill.acct_code= '$party' AND sap_bill.vr_date BETWEEN '$from_date' AND  '$to_date' AND sap_bill.comp_code='$company_name'";

			}


			

		    	$data = DB::select("SELECT inward_trans.acc_code, inward_trans.item_code, inward_trans.vr_date, inward_trans.sto_qty, inward_trans.depot_code, sap_bill.vr_date, sap_bill.truck_no, sap_bill.qty_issued, sap_bill.depot_code FROM inward_trans INNER JOIN sap_bill ON inward_trans.acc_code = sap_bill.acct_code WHERE inward_trans.item_code='JSWPSC-01' $strWhere");


				
			}else{

		   $company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="AND inward_trans.fy_year = '$macc_year' AND sap_bill.fy_year = '$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND sap_bill.vr_date BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name'";
			}

				$data = DB::select("SELECT inward_trans.acc_code, inward_trans.item_code, inward_trans.vr_date, inward_trans.sto_qty, inward_trans.depot_code, sap_bill.vr_date, sap_bill.truck_no, sap_bill.qty_issued, sap_bill.depot_code FROM inward_trans INNER JOIN sap_bill ON sap_bill.item_code=inward_trans.item_code WHERE inward_trans.item_code='JSWPSC-01' AND sap_bill.item_code='JSWPSC-01' $strWhere");

			}

			return DataTables()->of($data)->make(true);
			
		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		$title = 'SAP Vs Dispatch Report';

		$user_list       = DB::table('master_depot')->get();
		
		$acc_list        = DB::table('master_acc')->get();

		return view('admin.sap_despatch_report',compact('title','user_list','acc_list','from_date','to_date'));


	}

    

    public function SapDespatchAjax(Request $request){

    	 $validator = Validator::make($request->all(), [
            'dept_code' => 'required',
            'acct_code' => 'required',
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		 $response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	

	    	$serachSaplist = DB::select("SELECT inward_trans.acc_code, inward_trans.item_code, inward_trans.vr_date, inward_trans.sto_qty, inward_trans.depot_code, sap_bill.vr_date, sap_bill.truck_no, sap_bill.qty_issued, sap_bill.depot_code FROM inward_trans,sap_bill WHERE inward_trans.item_code='JSWPSC-01' AND inward_trans.depot_code='$dept_code' AND sap_bill.acct_code='$acct_code' ");

	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

	            $data = json_encode($response_array);

	            print_r($data);


				
      	

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }
	  }

    }

/*Report/MIS -> Bill Register*/

  public function ReportSapList(Request $request){

  		
  		if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {
		    	
				$depot      = $request->depotCode;
				$party      = $request->accCode;
				$from_date  = $request->formDate;
				$to_date    = $request->toDate;
				$trans_code = $request->transCode;

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

			$comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;

				
			if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
	      	}
	      	else if(isset($from_date)  && trim($from_date)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND sap_bill.comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
		    }

			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.depot_code= '$depot' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere="AND  sap_bill.depot_code= '$depot' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.acct_code= '$party' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="AND  sap_bill.acct_code= '$party' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
			}

			if(isset($trans_code)  && trim($trans_code)!="" && $usertype=='admin')
			{
				$strWhere="AND  sap_bill.acct_code= '$trans_code' AND sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($trans_code)  && trim($trans_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="AND  sap_bill.acct_code= '$trans_code' AND sap_bill.vr_date BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND sap_bill.fy_year= '$macc_year'";
			}

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` WHERE 1=1 $strWhere");

			/*$data = DB::table('sap_bill')
				->select('sap_bill.*', 'master_acc.acc_name as acc_code','master_depot.depot_name as depot_code','master_transporter.code as trans_name','master_area.name as area_name')
           		->leftjoin('master_depot', 'sap_bill.depot_code', '=', 'master_depot.depot_code')
           		->leftjoin('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_transporter', 'sap_bill.trpt_code', '=', 'master_transporter.code')
           		->leftjoin('master_area', 'sap_bill.area_code', '=', 'master_area.code')
            	->whereRaw('1 = 1')
            	->where($strWhere)
            	->get();*/

			return DataTables()->of($data)->make(true);
				
		}else{

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		     if($usertype=='admin'){

		    $strWhere="  AND   sap_bill.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND sap_bill.vr_date BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND   sap_bill.fy_year= '$macc_year'";
			}


			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;


  		$title = 'Bill Register';

		$user_list      = DB::table('master_depot')->get();
		
		$acc_list        = DB::table('master_acc')->get();

		$transpoter_list = DB::table('master_acc')->where('acctype_code','T')->get();

		
    return view('admin.sap_list_report',compact('title','user_list','acc_list','transpoter_list','from_date','to_date'));
    }


  public function SapListSearchAjax(Request $request){

  		$validator = Validator::make($request->all(), [
           /* 'dept_code' => 'required',
            'acct_code' => 'required',
            'trans_code' => 'required',*/
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		$response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	$trans_code = $request->input('trans_code');
	    	
	    	if(isset($dept_code)  && trim($dept_code)!=""){
	    		$AndString = " AND `depot_code`='$dept_code'";
	    	}
	    	if(isset($acct_code)  && trim($acct_code)!=""){
	    		$AndString = "AND `acct_code`='$acct_code' ";
	    	}
	    	if(isset($trans_code)  && trim($trans_code)!=""){
	    		$AndString = "AND `trpt_code`='$trans_code'";
	    	}
	    	
	    	$serachSaplist = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=sap_bill.depot_code) as depot_code,(SELECT acc_name FROM master_acc WHERE acc_code=sap_bill.acct_code) as acc_code,(SELECT name FROM master_transporter WHERE code=sap_bill.trpt_code) as trans_name,(SELECT name FROM master_area WHERE code=sap_bill.area_code) as area_name FROM `sap_bill` WHERE 1=1 $AndString");

	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }
	  }

    }

/*Report/MIS -> Bill Register*/

/*Report/MIS -> Inward STO Register*/

    public function ReportInwardSto(Request $request){


    	if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {
		    	
				$depot     = $request->depotCode;
				$party     = $request->accCode;
				$from_date = $request->formDate;
				$to_date   = $request->toDate;
				$tran_code   = $request->transCode;


			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			
			$comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;
				
			if(isset($from_date)  && trim($from_date)!="" && $usertype=='admin')
	      	 {
	      		$strWhere="  AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year'";
	      	}else if(isset($from_date)  && trim($from_date)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="  AND `vr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year'";
		    }


			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
			$strWhere="  AND  inward_trans.depot_code= '$depot' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
		     else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere="  AND  inward_trans.depot_code= '$depot' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year'";
		    }

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere=" AND   inward_trans.acc_code= '$party' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			 else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere=" AND   inward_trans.acc_code= '$party' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year'";
		    }

		    if(isset($tran_code)  && trim($tran_code)!="" && $usertype=='admin')
			{
				$strWhere=" AND   inward_trans.acc_code= '$tran_code' AND inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			 else if(isset($tran_code)  && trim($tran_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
		    	$strWhere=" AND   inward_trans.acc_code= '$tran_code' AND inward_trans.vr_date BETWEEN '$from_date1' AND  '$to_date1' AND inward_trans.comp_code='$company_name' AND inward_trans.fy_year= '$macc_year'";
		    }

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
				
		}else{

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
		

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="  AND   inward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND vr_date BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND fy_year= '$macc_year'";
			}

			$data = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

    	$title = 'Inward STO Register';

		$user_list       = DB::table('master_depot')->get();
		
		$acc_list       = DB::table('master_acc')->get();

		$transpoter_list = DB::table('master_acc')->where('acctype_code','T')->get();

		
    	return view('admin.inward_sto_reg_report',compact('title','user_list','acc_list','transpoter_list','from_date','to_date'));
    	
    }


    public function InwardStoSearchAjax(Request $request){

  		$validator = Validator::make($request->all(), [
           	'dept_code' => 'required',
           	'acct_code' => 'required',
           	'trans_code' => 'required',
        ]);

    	 if ($validator->fails()) {

          //  return response()->json(['error'=>$validator->errors()], 401);

            $response_array['response'] = 'validation_error';
            $response_array['validation'] = $validator->errors();

            $data = json_encode($response_array);

            print_r($data);


        }else{

		$response_array = array();

		if ($request->ajax()) {


	    	$dept_code = $request->input('dept_code');
	    	$acct_code = $request->input('acct_code');
	    	$trans_code = $request->input('trans_code');

	    	$from_date = $request->input('from_date');
	    	$to_date = $request->input('to_date');

	    	
	    	
	    	/*if(isset($dept_code)  && trim($dept_code)!=""){
	    		$AndString = " `Depot`='$dept_code'";
	    	}
	    	if(isset($acct_code)  && trim($acct_code)!=""){
	    		$AndString = " `acc_code`='$acct_code' ";
	    	}
	    	if(isset($trans_code)  && trim($trans_code)!=""){
	    		$AndString = "inward_trans.trans_code='$trans_code'";
	    	}*/
	    	
	    	$serachSaplist = DB::select("SELECT *,(SELECT depot_name FROM master_depot WHERE depot_code=inward_trans.depot_code) as depot_nam,(SELECT acc_name FROM master_acc WHERE acc_code=inward_trans.acc_code) as acc_name,(SELECT name FROM master_transporter WHERE code=inward_trans.trpt_code) as trans_name FROM `inward_trans` WHERE inward_trans.depot_code='$dept_code' AND inward_trans.acc_code='$acct_code' AND inward_trans.trpt_code='$trans_code'");

	    	
	    	

    		if ($serachSaplist) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $serachSaplist ;

	            $data = json_encode($response_array);

	            print_r($data);

			}else{

				$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
				
			}

	    }else{

	    		$response_array['response'] = 'error';
                $response_array['data'] = '' ;

                $data = json_encode($response_array);

                print_r($data);
	    }
	  }

    }

/*Report/MIS -> Inward STO Register*/


/*Report/MIS -> Outward Despatch Report*/

public function OutwardDespatchReport(Request $request){

	//print_r($request->depotCode);

		if ($request->ajax()) {

			if (!empty($request->depotCode || $request->accCode || $request->formDate || $request->transCode)) {
		    	
				$depot     = $request->depotCode;
				$party     = $request->accCode;
				$from_date = $request->formDate;
				$to_date   = $request->toDate;
				$trans_code   = $request->transCode;

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			
			$comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date1 =$fy_from_date;
		    $to_date1 =$fy_to_date;

				
			if(isset($from_date)  && trim($from_date)!="")
	      	 {
	      		$strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name'";
	      	}

			if(isset($depot)  && trim($depot)!="" && $usertype=='admin')
			{
			$strWhere="  AND   outward_trans.depot_code= '$depot' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}
			else if(isset($depot)  && trim($depot)!="" && ($usertype=='superAdmin' || $usertype=='user')){
				$strWhere="  AND   outward_trans.depot_code= '$depot' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year'";
			}

			if(isset($party)  && trim($party)!="" && $usertype=='admin')
			{
				$strWhere=" AND   outward_trans.acc_code= '$party' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}

			else if(isset($party)  && trim($party)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND   outward_trans.acc_code= '$party' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year'";
			}

			if(isset($trans_code)  && trim($trans_code)!="" && $usertype=='admin')
			{
				$strWhere=" AND   outward_trans.acc_code= '$trans_code' AND outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
			}

			else if(isset($trans_code)  && trim($trans_code)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND   outward_trans.acc_code= '$trans_code' AND `tr_date` BETWEEN '$from_date1' and  '$to_date1' AND comp_code='$company_name' AND outward_trans.fy_year= '$macc_year'";
			}

			$data = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");

			return DataTables()->of($data)->make(true);
				
		}else{

			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		    if($usertype=='admin'){

		    $strWhere="  AND   outward_trans.fy_year= '$macc_year' AND comp_code='$company_name'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date' AND comp_code='$company_name' AND   outward_trans.fy_year= '$macc_year'";
			}

			$data = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");



			return DataTables()->of($data)->make(true);
		}

		}

		$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');
			

	        $comp_code = substr($company_name,0,4);

			$getdate = DB::table('master_fy')->where([
			['comp_code', '=', $comp_code],
			['fy_code', '=', $macc_year],
			])->first();

	        $fy_from_date = $getdate->fy_from_date;
	        $fy_to_date = $getdate->fy_to_date;

	        $Data['formDate']= $fy_from_date;
	        $Data['toDate']= $fy_to_date;

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

		$title = 'Outward Dispatch Register';

    	$depot_list = DB::table('master_depot')->get();

        $dealer_list = DB::table('master_acc')->get();
       
        $transporter_list = DB::table('master_acc')->where('acctype_code','T')->get();


		return view('admin.view_outward_dispatch',compact('title','depot_list','dealer_list','transporter_list','from_date','to_date'));

	}




/*report / MIS*/

}
