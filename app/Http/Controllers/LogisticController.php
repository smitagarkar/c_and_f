<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use Illuminate\Validation\Rule;

class LogisticController extends Controller{

	private $data;

	public function __cunstruct($data){

		//$this->data = "smit@121";

	}

	public function demoNew(Request $request){

		echo 'smit dilip agarkar';

	}

	public function index(Request $request){

	$title ='Add Fleet Transaction';

	$userData['acc_list']     = DB::table('master_acc')->get();
	$userData['depot_list']   = DB::table('master_depot')->get();
	$userData['area_list']    = DB::table('master_area')->get();
	$userData['acctype_list'] = DB::table('master_acctype')->get();
	$userData['item_list']    = DB::table('master_item')->get();
		//print_r($userData['acctype_list']);exit;
		
		return view('admin.fleet_trans_form',$userData+compact('title'));
		
	}

	public function FleetTransSave(Request $request){

		//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'dept_code'   => 'required',
			'invoice_no'  => 'required',
			'shipment_no' => 'required',
			'acct_code'   => 'required',
			'area_code'   => 'required',
			'lr_no'       => 'required|unique:fleet_trans,LR_NO',
			'trans_code'  => 'required',
			'truck_no'    => 'required',
			'material'    => 'required',
			'sto_qty_um'  => 'required',
			'sto_qty_aum' => 'required',
			'overload'    => 'required',
			
			
		]);

    	$createdBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$diselexp = $request->input('Disel');

    	if($diselexp!=''){ 
    		$diselexp;
    	}else{ 
    		$diselexp ='';
    	}

    	$diselslipno = $request->input('deisel_slip_no');
    	if($diselslipno!=''){
    		$diselslipno;
    	}else{
    		$diselslipno='';
    	}

    	$drvexp = $request->input('drv_exp');
    	if($drvexp!=''){
    		$drvexp;
    	}else{
    		$drvexp='';
    	}

    	$foodinfexp = $request->input('fooding');
    	if($foodinfexp!=''){
    		$foodinfexp;
    	}else{
    		$foodinfexp='';
    	}

    	$adminexp = $request->input('p_exp');
    	if($adminexp!=''){
    		$adminexp;
    	}else{
    		$adminexp='';
    	}

    	$uloding = $request->input('lu_exp');
    	if($uloding!=''){
    		$uloding;
    	}else{
    		$uloding='';
    	}

    	$tollexp = $request->input('toll');
    	if($tollexp!=''){
    		$tollexp;
    	}else{
    		$tollexp='';
    	}

    	$otherexp = $request->input('other_exp');
    	if($otherexp!=''){
    		$otherexp;
    	}else{
    		$otherexp='';
    	}

    	$totaladv = $request->input('total_adv');
    	if($totaladv!=''){
    		$totaladv;
    	}else{
    		$totaladv='';
    	}

    	$dieselcr = $request->input('DIESEL_CR');
    	if($dieselcr!=''){
    		$dieselcr;
    	}else{
    		$dieselcr='';
    	}

    	$meterreding = $request->input('METER_READING');
    	if($meterreding!=''){
    		$meterreding;
    	}else{
    		$meterreding='';
    	}

    	$deselQty = $request->input('diesel_qty');
    	if($deselQty!=''){
    		$deselQty;
    	}else{
    		$deselQty='';
    	}

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"TR_DATE"        => $request->input('date'),
			"DEPOT_CODE"     => $request->input('dept_code'),
			"INVOICE_NO"     => $request->input('invoice_no'),
			"SHIPMENT_NO"    => $request->input('shipment_no'),
			"ACC_CODE"       => $request->input('acct_code'),
			"AREA_CODE"      => $request->input('area_code'),
			"LR_NO"          => $request->input('lr_no'),
			"TRPT_CODE"      => $request->input('trans_code'),
			"TRUCK_NO"       => $request->input('truck_no'),
			"ITEM_CODE"      => $request->input('material'),
			"UM"             => $request->input('sto_qty_um'),
			"AUM"            => $request->input('sto_qty_aum'),
			"OVERLOAD"       => $request->input('overload'),
			"RATE"           => $request->input('rate'),
			"DRIVER_EXP"     => $drvexp,
			"FOODING_EXP"    => $foodinfexp,
			"ADMIN_EXP"      => $adminexp,
			"ULOADING_EXP"   => $uloding,
			"TOLL_EXP"       => $tollexp,
			"DIESEL_EXP"     => $diselexp,
			"OTHER_EXP"      => $otherexp,
			"TOTAL_ADV"      => $totaladv,
			"DIESEL_CR"      => $dieselcr,
			"DIESEL_SLIP_NO" => $diselslipno,
			"METER_READING"  => $meterreding,
			"DIESEL_QTY"     => $deselQty,
			"created_by"     => $createdBy,
			
		);



		$saveData = DB::table('fleet_trans')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Added...!');
			return redirect('/logistic/view-fleet-transaction');

		} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Can Not Added...!');
			return redirect('/logistic/view-fleet-transaction');

		}
    	
    	

    }

    public function FleetRate(Request $request){

    	
	    if ($request->ajax()) {

    	$depot_code = $request->DEPOT_PLANT;
    	$loadType = $request->loadType;
    	$area_code = $request->DESTINATION;


	    	if($loadType=='Y'){

			    $date = date("Y-m-d");
				$data =DB::select("SELECT rate FROM `master_rate` where depot_plant='$depot_code' AND area_code='$area_code' and to_date<='$date'  ");

				foreach ($data as $key) {
					# code...
					print_r(json_encode($key));
				}

			}else{

				
			}
	  
			
			

   		 }


}

public function ViewFleetTrans(Request $request){

	$title = 'View Fleet Transaction';

	$user_type = $request->session()->get('user_type');

	$userid = $request->session()->get('userid');

	$CompanyCode   = $request->session()->get('company_name');

	$macc_year   = $request->session()->get('macc_year');

	if($user_type == 'admin'){

	$fleetTransData['fleet_trans'] = DB::table('fleet_trans')->orderBy('id','DESC')->get();
	}else if($user_type == 'superAdmin' || $user_type == 'user'){

		$fleetTransData['fleet_trans'] = DB::table('fleet_trans')->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->where('created_by',$userid)->orderBy('id','DESC')->get();
	}
	return view('admin.view_fleet_trans_logistic',$fleetTransData+compact('title'));
}

public function EditFleetForm($id){

    	$title = 'Edit Fleet Transaction';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('fleet_trans');
			$query->where('id', $id);
			$userData['fleet_trans'] = $query->get()->first();

			$userData['acc_list']     = DB::table('master_acc')->get();
			$userData['depot_list']   = DB::table('master_depot')->get();
			$userData['area_list']    = DB::table('master_area')->get();
			$userData['acctype_list'] = DB::table('master_acctype')->get();
			$userData['item_list']    = DB::table('master_item')->get();


			/*echo "<pre>";*/
			//print_r($userData['acc_list']);exit;
			/*print_r($userData['fleet_trans']);exit;*/
			
			return view('admin.fleet_trans_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Depot-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function FleetTransUpdate(Request $request){

		//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'date'        => 'required',
			'dept_code'   => 'required',
			'invoice_no'  => 'required',
			'shipment_no' => 'required',
			'acct_code'   => 'required',
			'area_code'   => 'required',
			'lr_no'       => 'required',
			'trans_code'  => 'required',
			'truck_no'    => 'required',
			'material'    => 'required',
			'sto_qty_um'  => 'required',
			'sto_qty_aum' => 'required',
			'overload'    => 'required',
			
			
		]);


		$fleetId = $request->input('fleet_id');


		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");


		$lastUpdatedBy = $request->session()->get('userid');

    	$createdBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$diselexp = $request->input('Disel');

    	if($diselexp!=''){ 
    		$diselexp;
    	}else{ 
    		$diselexp ='';
    	}

    	$diselslipno = $request->input('deisel_slip_no');
    	if($diselslipno!=''){
    		$diselslipno;
    	}else{
    		$diselslipno='';
    	}

    	$drvexp = $request->input('drv_exp');
    	if($drvexp!=''){
    		$drvexp;
    	}else{
    		$drvexp='';
    	}

    	$foodinfexp = $request->input('fooding');
    	if($foodinfexp!=''){
    		$foodinfexp;
    	}else{
    		$foodinfexp='';
    	}

    	$adminexp = $request->input('p_exp');
    	if($adminexp!=''){
    		$adminexp;
    	}else{
    		$adminexp='';
    	}

    	$uloding = $request->input('lu_exp');
    	if($uloding!=''){
    		$uloding;
    	}else{
    		$uloding='';
    	}

    	$tollexp = $request->input('toll');
    	if($tollexp!=''){
    		$tollexp;
    	}else{
    		$tollexp='';
    	}

    	$otherexp = $request->input('other_exp');
    	if($otherexp!=''){
    		$otherexp;
    	}else{
    		$otherexp='';
    	}

    	$totaladv = $request->input('total_adv');
    	if($totaladv!=''){
    		$totaladv;
    	}else{
    		$totaladv='';
    	}

    	$dieselcr = $request->input('DIESEL_CR');
    	if($dieselcr!=''){
    		$dieselcr;
    	}else{
    		$dieselcr='';
    	}

    	$meterreding = $request->input('METER_READING');
    	if($meterreding!=''){
    		$meterreding;
    	}else{
    		$meterreding='';
    	}

    	$deselQty = $request->input('diesel_qty');
    	if($deselQty!=''){
    		$deselQty;
    	}else{
    		$deselQty='';
    	}

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"TR_DATE"         => $request->input('date'),
			"DEPOT_CODE"      => $request->input('dept_code'),
			"INVOICE_NO"      => $request->input('invoice_no'),
			"SHIPMENT_NO"     => $request->input('shipment_no'),
			"ACC_CODE"        => $request->input('acct_code'),
			"AREA_CODE"       => $request->input('area_code'),
			"LR_NO"           => $request->input('lr_no'),
			"TRPT_CODE"       => $request->input('trans_code'),
			"TRUCK_NO"        => $request->input('truck_no'),
			"ITEM_CODE"       => $request->input('material'),
			"UM"              => $request->input('sto_qty_um'),
			"AUM"             => $request->input('sto_qty_aum'),
			"OVERLOAD"        => $request->input('overload'),
			"RATE"            => $request->input('rate'),
			"DRIVER_EXP"      => $drvexp,
			"FOODING_EXP"     => $foodinfexp,
			"ADMIN_EXP"       => $adminexp,
			"ULOADING_EXP"    => $uloding,
			"TOLL_EXP"        => $tollexp,
			"DIESEL_EXP"      => $diselexp,
			"OTHER_EXP"       => $otherexp,
			"TOTAL_ADV"       => $totaladv,
			"DIESEL_CR"       => $dieselcr,
			"DIESEL_SLIP_NO"  => $diselslipno,
			"METER_READING"   => $meterreding,
			"DIESEL_QTY"      => $deselQty,
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,			
		);

		$saveData = DB::table('fleet_trans')->where('id',$fleetId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Updated...!');
			return redirect('/logistic/view-fleet-transaction');

		} else {

			$request->session()->flash('alert-error', 'Fleet Transaction Not Updated...!');
			return redirect('/logistic/view-fleet-transaction');

		}
    	
    	

    }

    public function DeleteFleetTrans(Request $request){

    	$fleetid = $request->post('FleetId');
    	//print_r($destinationId);exit;

    	if ($fleetid!='') {
    		
    		$Delete = DB::table('fleet_trans')->where('id', $fleetid)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Fleet Transaction Was Deleted Successfully...!');
				return redirect('/logistic/view-fleet-transaction');

			} else {

				$request->session()->flash('alert-error', 'Fleet Transaction Can Not Deleted...!');
				return redirect('/logistic/view-fleet-transaction');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Transaction Not Found...!');
			return redirect('/logistic/view-fleet-transaction');

    	}
    }


  /*submit part bill*/

      public function SubmitPartyBilReport(Request $request){


    	if ($request->ajax()) {

			if (!empty( $request->challan_no)) {
		    	
				$party     = $request->challan_no;
				$trDate     = $request->tr_date;
				
				$usertype 	= $request->session()->get('user_type');
				$compName 	= $request->session()->get('company_name');
				$fisYear 	=  $request->session()->get('macc_year');
				


				if(isset($party)  && trim($party)!=""  && $usertype=='admin')
				{
					$strWhere=" AND fleet_trans.LR_NO= '$party' AND fleet_trans.LR_REC_DATE='0000-00-00'";

				}
				 else if(isset($party)  && trim($party)!="" &&  ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere=" AND fleet_trans.LR_NO= '$party' AND fleet_trans.comp_name='$compName' AND fleet_trans.fiscal_year='$fisYear' AND fleet_trans.LR_REC_DATE='0000-00-00'";
			    }

				$data1 = DB::select("SELECT * FROM `fleet_trans` where 1=1  $strWhere");

				$array1 = json_decode( json_encode($data1), true);

				foreach ($array1 as $key => $row) {

					$array1[$key]['trdate']=$trDate;
				}

				$data=$array1;

				return DataTables()->of($data)->addIndexColumn()->make(true);


				
			}
		    

		}

			$usertype 	= $request->session()->get('user_type');
			
			$title = 'Manage Party Bill';
   		   
            return view('admin.submit_party_bill',compact('title'));

    	
    }


    public function EditChallanReceipt($id,$trdate){

    	$title = 'Edit Submit Challan';
    	//print_r($id);
    	$id = base64_decode($id);
    	$trdate = base64_decode($trdate);
    	if($id!=''){
    	    $query = DB::table('fleet_trans');
			$query->where('id', $id);
			$userData['fleet_trans'] = $query->get()->first();

			$acc_code = $userData['fleet_trans']->ACC_CODE;
			//print_r($acc_code);exit;
			$userData['servicechrg'] = DB::table('master_acc')->where('acc_code',$acc_code)->get()->first();
			

			//print_r($userData['fleet_trans']);exit;
			$userData['acc_list']     = DB::table('master_acc')->get();
			$userData['depot_list']   = DB::table('master_depot')->get();
			$userData['area_list']    = DB::table('master_area')->get();
			$userData['acctype_list'] = DB::table('master_acctype')->get();
			$userData['item_list']    = DB::table('master_item')->get();

			$tr_date = $trdate;
			/*
			$userData['state_list'] = DB::table('master_state')->get();

			 $userData['acc_type_list'] = DB::table('master_acctype')->get();*/

			return view('admin.edit_submit_party_bill', $userData+compact('title','tr_date'));
		}else{
			$request->session()->flash('alert-error', 'Account Code Not Found...!');
			return redirect('/form-mast-depot');
		}

    }


    public function UpdateChallanReceipt(Request $request){

		$fleetId = $request->input('fleet_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");


		$lastUpdatedBy = $request->session()->get('userid');

    	$createdBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	      $developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$AccCode =  $request->input('acct_code');

    	    	$getemail = DB::select("SELECT * FROM `master_acc` WHERE acc_code='$AccCode'");
    	    	foreach ($getemail as $row) {
    	    		$accEmailId = $row->email_id;
    	    		$transName = $row->acc_name;
    	    	}

        		$areaCode = $request->input('area_code');

        		$getemail = DB::select("SELECT * FROM `master_area` WHERE code='$areaCode'");
        		foreach ($getemail as $rowar) {
        			$areaName = $rowar->name;
        		}
                
                $vehicle_num = $request->input('vehicle_no');
                $despatch_qty = $request->input('despatch_qty');
                $invoic_num = $request->input('invoice_no');

                $mailer->SMTPDebug = 0;
                $mailer->isSMTP();

                if ($developmentMode) {
                    $mailer->SMTPOptions = [
                        'ssl'=> [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ]
                    ];
                }


                $mailer->Host = 'localhost';
                $mailer->SMTPAuth = false;
                $mailer->Username = 'kamini.khapre@aceworth.in';
                $mailer->Password = 'Kaminikhapre';
                $mailer->CharSet = 'iso-8859-1'; 
                $mailer->Port = 25;
                $mailer->WordWrap = TRUE;

                $mailer->setFrom('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');
                $mailer->addAddress($accEmailId, 'Aceworth Private Limitate');
                $mailer->addReplyTo('kamini.khapre@aceworth.in.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Fleet Challan Receipt';

                

		$data = array(
			"comp_name"         => $compName,
			"fiscal_year"       => $fisYear,
			"RECEIVED_QTY"      => $request->input('recvd_qty'),
			"RECEIVED_UM"       => $request->input('recivdUm'),
			"RECEIVED_AQTY_AUM" => $request->input('aqty_recd'),
			"RECEIVED_AUM"      => $request->input('recivdAum'),
			"DAMAGE_QTY"        => $request->input('dmg_qty'),
			"SHORTAGE_QTY"      => $request->input('shortage_qty'),
			"STAMP"             => $request->input('Stamp'),
			"STAMP_CHARGES"     => $request->input('stamp_charge'),
			"ADDL_EXP"          => $request->input('addl_exp'),
			"ADDL_EXP_REMARK"   => $request->input('addl_exp_remark'),
			"FRIGHT_AMT"        => $request->input('fright_amt'),
			"SUB_TOTAL"         => $request->input('sub_total'),
			"SERVICE_AMT"       => $request->input('service_amt'),
			"SERVICE_CHARGES"   => $request->input('service_chrge'),
			"TDS_RATE"          => $request->input('tds_rate'),
			"TDS_AMT"           => $request->input('tds_amt'),
			"NET_PAYMENT"       => $request->input('net_payment'),
			"LR_REC_DATE"       => $request->input('LR_REC_DATE'),
			"last_updat_by"     => $lastUpdatedBy,
			"last_updat_date"   => $updatedDate,
			
		);

		$saveData = DB::table('fleet_trans')->where('id',$fleetId)->update($data);

		if ($saveData) {

			$getData = DB::table('fleet_trans')->where('id',$fleetId)->get()->first();



			$getArea = DB::table('master_area')->where('code',$getData->AREA_CODE)->get()->first();

			$getTrpt = DB::table('master_acc')->where('acc_code',$getData->ACC_CODE)->where('acctype_code',$getData->TRPT_CODE)->get()->first();
//print_r($getTrpt->acc_name);exit;
			/*$getPatyName = DB::table('master_acc')->where('acc_code',$getData->ACC_CODE)->where('acctype_code', '!=', 'T')->get()->first();*/

			$getPatyName = DB::select("SELECT * FROM master_acc WHERE acc_code='$getData->ACC_CODE' AND acctype_code!='T'");
			if(empty($getPatyName)){

				$AccName='';
			}else{
				$AccName=$getPatyName->acc_name;
			}
			


			$message = '<div style="padding-left: 13%;font-size: 16px;font-weight: 600;color: gray;">Fleet Challan Receipt</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;padding: 11px;border-top: 3px solid #3c8dbc;">
  <tbody><tr><td><b>Invoice Number</b></td><td><b>'.$getData->INVOICE_NO.'</b></td></tr><tr><td><b>Invoice Date</b></td><td><b>2020-12-05 06:11:08</b></td></tr><tr><td><b>Route</b></td><td><b>'.$getArea->code.'&nbsp;&nbsp;&nbsp;'.$getArea->name.'</b></td></tr><tr><td><b>Trip Id</b></td><td></td></tr><tr><td><b>Truck Number</b></td><td><b>'.$getData->TRUCK_NO.'</b></td></tr><tr><td><b>Transporter Name</b></td><td>'.$getTrpt->acc_name.'</td></tr><tr><td><b>Driver Name</b></td><td></td></tr><tr><td><b>Driver Contact Number(s)</b></td><td></td></tr><tr><td><b>Ship To Party</b></td><td>'.$AccName.'</td></tr><tr><td><b>Sold To Party</b></td><td>'.$AccName.'</td></tr><tr><td><b>Invoice Quantity</b></td><td>'.$getData->RECEIVED_QTY.' - '.$getData->RECEIVED_UM.' - '.$getData->RECEIVED_AQTY_AUM.'</td></tr></tbody></table>';

                $mailer->Body = $message;

                $mailSend = $mailer->send();
                $mailer->ClearAllRecipients();
			/*print_r($getData);exit;*/
		    if ($mailSend) {

				$request->session()->flash('alert-success', 'Fleet Transaction Was Successfully Updated...!');
				
				return redirect('/logistic/fleet-challan-receipt');

			} else {

				$request->session()->flash('alert-error', 'Fleet Transaction Not Updated...!');
				return redirect('/logistic/fleet-challan-receipt');

			}
		}else {

			$request->session()->flash('alert-error', 'Fleet Transaction Not Updated...!');
			return redirect('/logistic/fleet-challan-receipt');

		}
		

    }

/*submit part bill*/

  /*  manage party bill*/

  	   public function PartyBillReport(Request $request){


    	if ($request->ajax()) {

			if (!empty( $request->acct_code)) {
		    	
				$acct_code     = $request->acct_code;
				
				$usertype 	= $request->session()->get('user_type');
				$CompanyCode   = $request->session()->get('company_name');
				$MaccYear      = $request->session()->get('macc_year');
				


				if(isset($acct_code)  && trim($acct_code)!="" && $usertype=='admin')
				{
					$strWhere=" AND fleet_trans.ACC_CODE= '$acct_code'";

				}
				 else if(isset($acct_code)  && trim($acct_code)!="" && ($usertype=='superAdmin' || $usertype=='user')){
			    	$strWhere=" AND fleet_trans.ACC_CODE= '$acct_code' AND fleet_trans.comp_name='$CompanyCode' AND fleet_trans.fiscal_year='$MaccYear'";
			    }

				$data = DB::select("SELECT * FROM `fleet_trans` where 1=1  $strWhere AND BILL_NO='' AND LR_REC_DATE!='0000-00-00'");

				return DataTables()->of($data)->addIndexColumn()->make(true);
				
			}

		}

			$usertype 	= $request->session()->get('user_type');
			
			$title = 'Manage Party Bill';
   		   $userdata['acc_list'] = DB::table('master_acc')->where('acctype_code','T')->get();

   		   $partybilget = DB::table('party_bill')->get();
   		   $gtebilid = '';
   		   foreach($partybilget as $row){
   		   		$gtebilid = $row->bill_no;
   		   		
   		   }

   		   $userdata['bilno'] = $gtebilid;

            return view('admin.manage_party_bill',$userdata+compact('title'));

    	
    }

  /*  manage party bill*/



    public function SaveInPartyBill(Request $request){
				
				
				$CompanyCode = $request->session()->get('company_name');
				$MaccYear    = $request->session()->get('macc_year');
				$userId      = $request->session()->get('userid');
		  		
			if ($request->ajax()) {

		  		$getid = $request->flitClass;
		  		$transDate = $request->transDate;
		  		$bill_no = $request->bill_no;

		  		$getcountid = count($getid);

		  		$saveData ='';

		  		for ($i=0; $i < $getcountid ; $i++) { 

		  			$checkid = $getid[$i];

		  			$data = DB::select("SELECT * FROM `fleet_trans` WHERE id='$checkid' ");



		  			$party ='';
		  		
		  			foreach ($data as $key) {

		  					
		  					
							$fletid     = $key->id;
							$trNo       = $key->LR_NO;
							$trDate     = $key->TR_DATE;
							$DepotCode  = $key->DEPOT_CODE;
							$invoiceNo  = $key->INVOICE_NO;
							$party      = $key->ACC_CODE;
							$AreaCode   = $key->AREA_CODE;
							$trptCode   = $key->TRPT_CODE;
							$truckNo    = $key->TRUCK_NO;
							$Qunatity   = $key->UM;
							$itemCode   = $key->ITEM_CODE;
							$diesel     = $key->DIESEL_EXP;
							$driverexp  = $key->DRIVER_EXP;
							$adminexp   = $key->ADMIN_EXP;
							$foodingexp = $key->FOODING_EXP;
							$uloding    = $key->ULOADING_EXP;
							$tolexp     = $key->TOLL_EXP;
							$otherexp   = $key->OTHER_EXP;
							$totaladv   = $key->TOTAL_ADV;
							$lrRecDate  = $key->LR_REC_DATE;
							$damage     = $key->DAMAGE_QTY;
							$shorteg    = $key->SHORTAGE_QTY;
							$stamp      = $key->STAMP;
							$billNo     = $key->BILL_NO;
							$bilDate    = $key->BILL_DATE;
							$rate       = $key->RATE;
							$emailFlag  = 'NO';


		  				$data = array(

								'comp_name'        => $CompanyCode,
								'fiscal_year'      => $MaccYear,
								'tr_id'            => $fletid,
								'L_R_NO'           => $trNo,
								'date'             => $trDate,
								'DEPOT_PLANT'      => $DepotCode,
								'INVOICE_NO'       => $invoiceNo,
								'party'            => $party,
								'DESTINATION'      => $AreaCode,
								'Transporter'      => $trptCode,
								'TRUCK_NO'         => $truckNo,
								'QTY'              => $Qunatity,
								'MATERIAL'         => $itemCode,
								'DEISEL'           => $diesel,
								'DRV_Exp'          => $driverexp,
								'P_Exp'            => $adminexp,
								'Fooding'          => $foodingexp,
								'LU_Exp'           => $uloding,
								'toll'             => $tolexp,
								'Other_Exp'        => $otherexp,
								'TOTAL_Adv'        => $totaladv,
								'lr_recieved_date' => $lrRecDate,
								'damage'           => $damage,
								'shortage'         => $shorteg,
								'stamp'            => $stamp,	
								'bill_no'          => $bill_no,
								'bill_date'        => $transDate,
								'rate'             => $rate,
								'email_flag'       => $emailFlag,
								'created_by'       => $userId
		  					);



		  				$saveData = DB::table('party_bill')->insert($data);

		  				$lastid = DB::getPdo()->lastInsertId();

		  				date_default_timezone_set('Asia/Kolkata');

						$updatedDate = date("Y-m-d");

		  				$data10=array(

								'bill_no'         => $bill_no,
								'last_updat_by'   => $userId,
								'last_updat_date' => $updatedDate,
		  				);

		  				$saveData = DB::table('fleet_trans')->where('id',$checkid)->update($data10);

		  		
		  			}
		  			
		  		}

		  		

		  			//print_r($justcheck);exit();

		  		

		  			$data1 = array();

		  			if ($saveData) {

		  				$data1['message'] = 'Success';
		  				$data1['party'] = $party;

		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					} else {

						$data1['message'] = 'Error';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					}
		  		

		 }


    }


    public function TrptPaymentAdvice(Request $request){

		if ($request->ajax()) {

			if (!empty($request->trans_code || $request->billNo)) {
		    	
			$transCode   = $request->input('trans_code');

			$billNo  = $request->input('billNo');

			$usertype 	= $request->session()->get('user_type');

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');


			if(isset($transCode)  && trim($transCode)!="" && $usertype=='admin'){

				$strWhere=" AND party_bill.party= '$transCode'";
			}else if(isset($transCode)  && trim($transCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND party_bill.party= '$transCode' AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year'";
			}


			if(isset($billNo)  && trim($billNo)!="" && $usertype=='admin')
			{
				$strWhere=" AND party_bill.bill_no= '$billNo'";
			}else if(isset($billNo)  && trim($billNo)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND party_bill.bill_no= '$billNo' AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT * FROM party_bill where 1=1  $strWhere");

			//print_r($data);

			return DataTables()->of($data)->make(true);
				
		}else{

			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');


			if($usertype=='admin'){

		    $strWhere="  AND party_bill.fiscal_year='$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND party_bill.comp_name='$company_name' AND party_bill.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT *  FROM party_bill where 1=1 $strWhere");

			return DataTables()->of($data)->make(true);
		}

		}

		$title = 'TRPT Payment Advice';

    	$userdata['transpoter_list'] = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as accName FROM fleet_trans WHERE TRPT_CODE='T' GROUP BY ACC_CODE");

		
    	return view('admin.trpt_payment_advice',$userdata+compact('title'));


	}


	public function  TrptPayment(Request $request){


		if ($request->ajax()) {


			if (!empty($request->dept_code || $request->acct_code || $request->trans_code || $request->from_date)) {

				if(isset($request->from_date)  && trim($request->from_date)!=""){

					$strWhere = "fleet_trans.TR_DATE = '$request->from_date' ";
				}
				 
				
				if(isset($request->dept_code)  && trim($request->dept_code)!=""){

					$strWhere = "master_depot.depot_name = '$request->dept_code' ";
				}
					
				if(isset($request->acct_code)  && trim($request->acct_code)!=""){

					$strWhere = "master_area.name = '$request->acct_code' ";
				}
				
				if(isset($request->trans_code)  && trim($request->trans_code)!=""){

					$strWhere = "master_transporter.name = '$request->trans_code' ";
					 
				}

				$data = DB::select("SELECT fleet_trans.*, master_depot.depot_name AS DEPOT_PLANT, master_dealer.name As PARTY, master_area.name As DESTINATION, master_transporter.name as Transporter, master_fleet.truck_no FROM fleet_trans left JOIN master_depot ON master_depot.depot_code = fleet_trans.DEPOT_CODE left JOIN master_dealer ON master_dealer.code = fleet_trans.ACC_CODE left JOIN master_area on master_area.code = fleet_trans.AREA_CODE left JOIN master_transporter on master_transporter.code = fleet_trans.TRPT_CODE left JOIN master_fleet on master_fleet.truck_no = fleet_trans.TRUCK_NO WHERE $strWhere order by fleet_trans.id desc");

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

		    	$title = 'TRPT Payment';

				$user_list       = DB::table('master_depot')->get();
				
				$area_list       = DB::table('master_area')->get();

				$transpoter_list = DB::table('master_transporter')->get();



				$data = DB::select("SELECT fleet_trans.*, master_depot.depot_name AS DEPOT_PLANT, master_dealer.name As PARTY, master_area.name As DESTINATION, master_transporter.name as Transporter, master_fleet.truck_no FROM fleet_trans left JOIN master_depot ON master_depot.depot_code = fleet_trans.DEPOT_CODE left JOIN master_dealer ON master_dealer.code = fleet_trans.ACC_CODE left JOIN master_area on master_area.code = fleet_trans.AREA_CODE left JOIN master_transporter on master_transporter.code = fleet_trans.TRPT_CODE left JOIN master_fleet on master_fleet.truck_no = fleet_trans.TRUCK_NO order by fleet_trans.id desc");

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

		    $from_date =$fy_from_date;
		    $to_date =$fy_to_date;

	    	$title = 'TRPT Payment';

			$user_list       = DB::table('master_depot')->get();
			
			$area_list       = DB::table('master_area')->get();

			$transpoter_list = DB::table('master_transporter')->get();

		
    	return view('admin.trpt_payment',compact('title','user_list','area_list','transpoter_list','from_date','to_date'));


		
	}


/*fleet transaction report*/
	public function FleetTransReport(Request $request){

		if ($request->ajax()) {

			if (!empty($request->TRUCK_NO || $request->dept_code || $request->trans_code || $request->from_date)) {
		    	
			$depotCode   = $request->input('dept_code');

			$Truck_no  = $request->input('TRUCK_NO');

			$transCode  = $request->input('trans_code');

			$fromDate  = $request->input('from_date');

			$toDate  = $request->input('to_date');

			$usertype 	= $request->session()->get('user_type');

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');


			if(isset($fromDate)  && trim($fromDate)!="")
	      	 {
	      		$strWhere=" AND `TR_DATE` BETWEEN '$fromDate' and  '$toDate'";
	      	}
			
			if(isset($depotCode)  && trim($depotCode)!="" && $usertype=='admin'){

				$strWhere=" AND fleet_trans.DEPOT_CODE= '$depotCode'";
			}else if(isset($depotCode)  && trim($depotCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND fleet_trans.DEPOT_CODE= '$depotCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}

			if(isset($transCode)  && trim($transCode)!="" && $usertype=='admin'){

				$strWhere=" AND fleet_trans.ACC_CODE= '$transCode'";
			}else if(isset($transCode)  && trim($transCode)!="" && ($usertype=='superAdmin' || $usertype=='user')){

				$strWhere=" AND fleet_trans.ACC_CODE= '$transCode' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}


			if(isset($Truck_no)  && trim($Truck_no)!="" && $usertype=='admin')
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no'";
			}else if(isset($Truck_no)  && trim($Truck_no)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as AccName, (SELECT name FROM master_area WHERE code=fleet_trans.AREA_CODE) as AreaName FROM fleet_trans where 1=1  $strWhere");

			//print_r($data);

			return DataTables()->of($data)->addIndexColumn()->make(true);
				
		}else{
			

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');

			$usertype 	= $request->session()->get('user_type');

		    if($usertype=='admin'){

		    $strWhere="  AND fleet_trans.fiscal_year= '$macc_year'";
		    }
		    else if($usertype=='superAdmin' || $usertype=='user'){
		    	
		    $strWhere="  AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT *,(SELECT acc_name FROM master_acc WHERE acc_code=fleet_trans.ACC_CODE) as AccName, (SELECT name FROM master_area WHERE code=fleet_trans.AREA_CODE) as AreaName FROM fleet_trans where 1=1  $strWhere");

			return DataTables()->of($data)->addIndexColumn()->make(true);
		}

		}

		$title = 'Fleet Transaction Report';

    	$depot_list = DB::table('master_depot')->get();

    	 $transporter_list= DB::table('master_acc')->where('acctype_code','T')->get();

		return view('admin.report_fleet_trans',compact('title','depot_list','transporter_list'));

	}

/*fleet transaction report*/



   public function PrinFletChalanRecept(Request $request,$id){

		$company_name = $request->session()->get('company_name');
		
		$macc_year    = $request->session()->get('macc_year');
		
		$usertype     = $request->session()->get('user_type');

		if($usertype == 'admin'){

			$userdata['fleetdata'] = DB::select("SELECT * FROM `fleet_trans` WHERE id='$id'");

		}else if($usertype=='superAdmin' || $usertype=='user'){

			$userdata['fleetdata'] = DB::select("SELECT * FROM `fleet_trans` WHERE id='$id' AND comp_name='$company_name' AND fiscal_year='$macc_year'");

		}else{
			$userdata['fleetdata'] ='';
		}

		$title = 'Print Fleet Challan Receipt';

		return view('admin.print_fleet_chalan_recept',$userdata+compact('title'));
      			
		

    }

    public function SendMailForPartyBil($party){
		
		$accountCode = base64_decode($party);

		$userdata = DB::table('master_acc')->where('acc_code',$accountCode)->get()->first();

		 $emialId = $userdata->email_id;

		$partydata = DB::table('party_bill')->where('party',$accountCode)->where('email_flag','NO')->get()->toArray();

		$getbyAccCode = json_decode( json_encode($partydata), true);

		$developmentMode = true;
        $mailer = new PHPMailer($developmentMode);

        $mailer->SMTPDebug = 0;
        $mailer->isSMTP();

        if ($developmentMode) {
            $mailer->SMTPOptions = [
                'ssl'=> [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ];
        }


        $mailer->Host = 'localhost';
        $mailer->SMTPAuth = false;
        $mailer->Username = 'kamini.khapre@aceworth.in';
        $mailer->Password = 'Kaminikhapre';
        $mailer->CharSet = 'iso-8859-1'; 
        $mailer->Port = 25;
        $mailer->WordWrap = TRUE;

        $mailer->setFrom('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');
        $mailer->addAddress($emialId, 'Aceworth Private Limitate');
        $mailer->addReplyTo('kamini.khapre@aceworth.in.in', 'Aceworth Private Limitate');

        $mailer->isHTML(true);
        $mailer->Subject = 'Party Bill Generate';

        $message = '<div style="padding-left: 13%;font-size: 16px;font-weight: 600;color: gray;">Party Bill Generate</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;border-top: 3px solid #3c8dbc;border-collapse: collapse;"><thead><th style="border:1px solid #e6d7d7;">L R No</th><th style="border:1px solid #e6d7d7;">Depot Plant</th><th style="border:1px solid #e6d7d7;">Invoice Number</th><th style="border:1px solid #e6d7d7;">Party</th></thead><tbody>';

        foreach ($getbyAccCode as $row) {
        	$message .= '<tr><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['L_R_NO'].'</td><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['DEPOT_PLANT'].'</td><td style="border:1px solid #e6d7d7;text-align:right;">'.$row['INVOICE_NO'].'</td><td style="border:1px solid #e6d7d7;">'.$row['party'].'</td></tr>';

        }

        $message .= '</tbody></table>';

        $mailer->Body = $message;

        $mailSend = $mailer->send();
        $mailer->ClearAllRecipients();

        if($mailSend){

        	$data1 = array(
        			'email_flag' => 'YES'
        		);

        	$UpdateParty = DB::table('party_bill')->where('party',$accountCode)->where('email_flag','NO')->update($data1);

        	if($UpdateParty){
        		return redirect('logistic/trpt-bill-generate');
        	}else{
        		return redirect('logistic/trpt-bill-generate');
        	}

	    }else{

	        return redirect('logistic/trpt-bill-generate');

	    }



    }

    public function FleetCertTrans(Request $request){

    	return view('admin.fleet_cert_transaction');

    }	

   public function FleetCertTransForm(Request $request){

   	    return view('admin.fleet_cert_transaction_form');

   }

    public function FleetCertTransFormSave(Request $request){

    		$cert_rnew_dt = $request->input('cert_rnew_dt');

			$rules = [
				'truck_no'  => 'required',
				'cert_date' => 'required',
				'cert_rnew' => 'required',
				'cert_code' => 'required',
				'truck_no'  =>'required' 
		    ];

		    if (empty($cert_rnew_dt)) {
				$rules['cert_no']   = 'required|unique:fleet_certificate_trans,certificate_no';
			}

		    $customMessages = [
		        'truck_no.unique'=>'The truck no has already been taken for this <b><u> Certificate Code</u></b>',
		    ];

		$this->validate($request, $rules, $customMessages);

			$createdBy 	= $request->session()->get('userid');

		    $compName 	= $request->session()->get('company_name');

			$fisYear 	=  $request->session()->get('macc_year');

			$truckno = $request->input('truck_no');
			$cert_code = $request->input('cert_code');


			$FleetData = DB::table('fleet_certificate_trans')->where('truck_no',$truckno)->where('certificate_code',$cert_code)->whereNull('cert_renew_date')->get()->first();
	

		    if(empty($FleetData)){


				$data = array(
					"comp_name"         => $compName,
					"fiscal_year"       => $fisYear,
					"truck_no"          => $request->input('truck_no'),
					"certificate_code"  => $request->input('cert_code'),
					"certificate_no"    => $request->input('cert_no'),
					"certificate_date"  => $request->input('cert_date'),
					"certificate_renew" => $request->input('cert_rnew'),
					"created_by"        => $createdBy,
					
				);

				$saveData = DB::table('fleet_certificate_trans')->insert($data);

			}else{

				date_default_timezone_set('Asia/Kolkata');
			    $updatedDate = date("Y-m-d");


			   	$data = array(
					
					"cert_renew_date"   => $request->input('cert_rnew_dt'),
					"last_updated_by"   => $createdBy,
				    "last_updated_date" => $updatedDate,
					
				);

				
				$saveData = DB::table('fleet_certificate_trans')->where('truck_no',$truckno)->update($data);
			}


			if ($saveData) {

				$request->session()->flash('alert-success', 'Fleet Certificate  Was Successfully Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			} else {

				$request->session()->flash('alert-error', 'Fleet Certificate Can Not Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			}

		  


   
   }

   public function FleetCertTransFormSave_old(Request $request){

   		$compName 	= $request->session()->get('company_name');

		$fisYear 	=  $request->session()->get('macc_year');

   		$code = $request->input('cert_code');
   		$truckno = $request->input('truck_no');

   	$results = DB::table('fleet_certificate_trans')->where('comp_name',$compName)->where('fiscal_year',$fisYear)->where('truck_no',$truckno)->where('certificate_code',$code)->get();

	    if(empty($results))
	    {

				$validate = $this->validate($request, [

				'truck_no'  => 'required',
				'cert_code' => 'required',
				//'employee' => 'required|in:'.$employee->implode('id', ', '),
				'cert_no'   => 'required|unique:fleet_certificate_trans,certificate_no',
				'cert_date' => 'required',
				'cert_rnew' => 'required',

			]);



		    $createdBy 	= $request->session()->get('userid');

		    	
			$data = array(
				"comp_name"         => $compName,
				"fiscal_year"       => $fisYear,
				"truck_no"          => $request->input('truck_no'),
				"certificate_code"  => $request->input('cert_code'),
				"certificate_no"    => $request->input('cert_no'),
				"certificate_date"  => $request->input('cert_date'),
				"certificate_renew" => $request->input('cert_rnew'),
				"created_by"        => $createdBy,
				
			);

			$saveData = DB::table('fleet_certificate_trans')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Fleet Certificate  Was Successfully Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			} else {

				$request->session()->flash('alert-error', 'Fleet Certificate Can Not Added...!');
				return redirect('/logistic/fleet-certificate-transaction-form');

			}

	    }
	    else
	    {
	        
	        $request->session()->flash('alert-error', 'Certificate already exist for this truck number...!');
			return redirect('/logistic/fleet-certificate-transaction-form');
	    }

   
   }

  public function FleetCertTransFormView(Request $request){
  		//print_r($request->vehicle_no);exit;

  		$vehicle_no = $request->vehicle_no;

  	   $getData = DB::table('fleet_certificate_trans')->where('truck_no',$vehicle_no)->get()->toArray();

  	   $vehicleData = json_decode( json_encode($getData), true);
  	   
  	 //  print_r($vehicleData);exit;

  	 return view('admin.fleet_cert_transaction_viewform',compact('vehicleData'));
  	   

  }

  public function FleetCertTransFormUpdate(Request $request){

  		 $id = $request->fleetId;
  		 $renewdate = $request->renewdt;

  		date_default_timezone_set('Asia/Kolkata');
  		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

  		 $data = array(
			"comp_name"         => $compName,
			"fiscal_year"       => $fisYear,
			"cert_renew_date"   => $renewdate,
			"last_updated_by"   => $lastUpdatedBy,
			"last_updated_date" => $updatedDate,			
		);

		$saveData = DB::table('fleet_certificate_trans')->where('id',$id)->update($data);

		$data1=array();
		if ($saveData) 
		{

			$data1['message'] = 'Success';
			$data1['id'] = $id;

			$getalldata = json_encode($data1);  
			print_r($getalldata);

	   } else{

		$data1['message'] = 'Error';
			$getalldata = json_encode($data1);  
			print_r($getalldata);

	    }


  }


  public function FleetCertTransReport(Request $request){


    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    		$data = DB::table('fleet_certificate_trans')->where('created_by',$userid)->whereNotNull('cert_renew_date')->get();
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 	$data = DB::table('fleet_certificate_trans')->where('created_by',$userid)->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->whereNotNull('cert_renew_date')->get();

    	}else{

    		$data ='';
    	}


    	$array1 = json_decode( json_encode($data), true);
    
    	$title = 'View Outward Transaction';


    	$due_date =[];
    	$i = 1;
    	foreach ($array1 as $key => $row) {

    		$i++;
    		$due_date[$key]['demo_key_'.$i] = $row['certificate_renew'];

    	}
    
    	DB::table('fleet_certificate_report')->truncate();

		$uniques = [];
    	foreach ($array1 as $key) {

	 		$tr_no= $key['truck_no'];

			if (!in_array($key['truck_no'],$uniques)) {

				$uniques[] = $key['truck_no'];

				if($user_type == 'admin'){
				
					$data00 = DB::table('fleet_certificate_trans')->where('truck_no',$key['truck_no'])->where('created_by',$userid)->whereNotNull('cert_renew_date')->get()->toArray();

				}else if($user_type == 'superAdmin' || $user_type == 'user'){

					$data00 = DB::table('fleet_certificate_trans')->where('truck_no',$key['truck_no'])->where('created_by',$userid)->where('comp_name',$CompanyCode)->where('fiscal_year',$macc_year)->whereNotNull('cert_renew_date')->get()->toArray();


				}else{

					$data00 = array();
				}

				$array12 = json_decode( json_encode($data00), true);

				foreach ($array12 as $value0) {

					if ($value0['certificate_code'] == 'CF') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_cf" 		=> $value0['certificate_code'],	
								"due_date_cf" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"cert_code_cf" 		=> $value0['certificate_code'],	
								"due_date_cf" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}


					if ($value0['certificate_code'] == 'S-Permit') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_spermit" 		=> $value0['certificate_code'],	
								"due_date_spermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_spermit" 		=> $value0['certificate_code'],	
								"due_date_spermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}

					if ($value0['certificate_code'] == 'N-Permit') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_npermit" 		=> $value0['certificate_code'],	
								"due_date_npermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_npermit" 		=> $value0['certificate_code'],	
								"due_date_npermit" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	


					if ($value0['certificate_code'] == 'RTO') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_rto" 		=> $value0['certificate_code'],	
								"due_date_rto" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_rto" 		=> $value0['certificate_code'],	
								"due_date_rto" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	


					if ($value0['certificate_code'] == 'Danta') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_danta" 		=> $value0['certificate_code'],	
								"due_date_danta" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_danta" 		=> $value0['certificate_code'],	
								"due_date_danta" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

					if ($value0['certificate_code'] == 'Insurance') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_insurance" 		=> $value0['certificate_code'],	
								"due_date_insurance" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_insurance" 		=> $value0['certificate_code'],	
								"due_date_insurance" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

					if ($value0['certificate_code'] == 'Pollution') {

						$checkData = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->get()->toArray();

						if (empty($checkData)) {

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_puc" 		=> $value0['certificate_code'],	
								"due_date_puc" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->insert($data0);
							
						}else{

							$data0 = array(
								"truck_no" 		=> $value0['truck_no'],	
								"cert_code_puc" 		=> $value0['certificate_code'],	
								"due_date_puc" 		=> $value0['certificate_renew'],	
								"created_by"        => $userid,
								
							);

							$saveData0 = DB::table('fleet_certificate_report')->where('truck_no',$key['truck_no'])->update($data0);

						}

					}	

				    
				}

				
				
			}
    	 	
    	}
    	
    	
    	$saveData01 = DB::table('fleet_certificate_report')->get()->toArray();

    	$array10['fetchdata'] = json_decode( json_encode($saveData01), true);

    	return view('admin.fleet_cert_transaction_report',$array10+compact('title'));

    }

    public function FleetCertTransData(Request $request){

    	

    	$response_array = array();

		if ($request->ajax()) {


	    	$truck_no = $request->truck_no;
    	    $cert_code = $request->cert_code;

	    	$getadata = DB::table('fleet_certificate_trans')->where('truck_no',$truck_no)->where('certificate_code',$cert_code)->whereNull('cert_renew_date')->get();
	    	$count=count($getadata);
    		if ($count > 0) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $getadata;

	           echo $data = json_encode($response_array);

	            //print_r($data);

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

    
    public function FleetCertReport(Request $request){

		if ($request->ajax()) {

			
			if (!empty($request->truck_no || $request->from_date)) {
		    

			$Truck_no  = $request->truck_no;
			//print_r($Truck_no);exit;

			$fromDate  = $request->from_date;

			$toDate  = $request->to_date;

			$usertype 	= $request->session()->get('user_type');

			$company_name 	= $request->session()->get('company_name');

	    	$macc_year 		= $request->session()->get('macc_year');


			if(isset($fromDate)  && trim($fromDate)!="")
	      	 {
	      		$strWhere=" AND `TR_DATE` BETWEEN '$fromDate' and  '$toDate'";
	      	}
			
			if(isset($Truck_no)  && trim($Truck_no)!="" && $usertype=='admin')
			{
				$strWhere=" AND fleet_certificate_report.truck_no= '$Truck_no'";
			}else if(isset($Truck_no)  && trim($Truck_no)!="" && ($usertype=='superAdmin' || $usertype=='user'))
			{
				$strWhere=" AND fleet_trans.TRUCK_NO= '$Truck_no' AND fleet_trans.comp_name='$company_name' AND fleet_trans.fiscal_year='$macc_year'";
			}

			$data = DB::select("SELECT * FROM fleet_certificate_report where 1=1  $strWhere");

			
			
			return DataTables()->of($data)->addIndexColumn()->make(true);
				
		}else{
			

			
		}

		}

		$title = 'Fleet Transaction Report';

    	$depot_list = DB::table('master_depot')->get();

    	 $transporter_list= DB::table('master_acc')->where('acctype_code','T')->get();

		return view('admin.report_fleet_trans',compact('title','depot_list','transporter_list'));

	}
  
}