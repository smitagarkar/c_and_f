<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use DataTables;
use PHPMailer\PHPMailer\PHPMailer;

class TransactionController extends Controller
{

     public function __cunstruct(){

	}


	

/*sap bill start*/

    public function SapBill(Request $request){

    	$title = 'Add Sap Bill';

    	$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		$userData['user_list']       = DB::table('master_depot')->get();
		
		$userData['item_list']       = DB::table('master_item')->get();
		
		$userData['acc_list']        = DB::table('master_acc')->get();
		
		$userData['area_list']       = DB::table('master_area')->get();
		
		$userData['transpoter_list'] = DB::table('master_acctype')->get();

		
		//DB::enableQueryLog();
		$item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$MaccYear)->get();
		//dd(DB::getQueryLog());
					foreach ($item_um_aum_list as $key) {
					$userData['fromDate'] =  $key->fy_from_date;
					$userData['toDate']   =  $key->fy_to_date;
					}

    	return view('admin.sap_bill',$userData+compact('title'));

    }

    

    

    public function SaveSapBill(Request $request){

    	//print_r($request->post());exit();
    	$validate = $this->validate($request, [

				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_date'     => 'required',
				'invoice_no'       => 'required',
				'depot_code'       => 'required',
				'account_code'     => 'required',
				'area_code'        => 'required',
				'transport_code'   => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'inv_qty_um'       => 'required',
				'inv_qty_aum'      => 'required',
				'so_code'          => 'required',

		]);


		$data = array(
					"comp_code"    =>  $request->input('comp_code'),
					"fy_year"      =>  $request->input('fy_year'),
					"vr_date"      =>  $request->input('transaction_date'),
					"vr_no"        =>  $request->input('transaction_no'),
					"invoice_date" =>  $request->input('invoice_date'),
					"invoice_no"   =>  $request->input('invoice_no'),
					"depot_code"   =>  $request->input('depot_code'),
					"acct_code"    =>  $request->input('account_code'),
					"area_code"    =>  $request->input('area_code'),
					"trpt_code"    =>  $request->input('transport_code'),
					"truck_no"     =>  $request->input('vehicle_no'),
					"item_code"    =>  $request->input('item_code'),
					"qty_issued"   =>  $request->input('inv_qty_um'),
					"aqty_issued"  =>  $request->input('inv_qty_aum'),
					"so_code"      =>  $request->input('so_code'),
					"created_by"   =>  $request->session()->get('userid')
	 
	    	);



		$saveData = DB::table('sap_bill')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Sap Bill Was Successfully Added...!');
				return redirect('/view-sap-bill');

			} else {

				$request->session()->flash('alert-error', 'Sap Bill Can Not Added...!');
				return redirect('/view-sap-bill');

			}

    }

    public function viewSapBill(Request $request){

    	if ($request->ajax()) {

    	

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    	$data = DB::table('sap_bill')
            ->join('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
            ->select('sap_bill.*', 'master_acc.acc_name')
            ->get();
    	

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	//DB::enableQueryLog();
		$data = DB::table('sap_bill')
				->select('sap_bill.*', 'master_acc.acc_name')
           		->leftjoin('master_acc', 'sap_bill.acct_code', '=', 'master_acc.acc_code')
            	->where([['sap_bill.created_by','=',$userid],['sap_bill.comp_code','=',$CompanyCode],['sap_bill.fy_year','=',$macc_year]])
            	->get();
    	 //dd(DB::getQueryLog());

    	}else{
    		
    		$data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sapbillview" onclick="return ViewSapBil('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-sap-bil/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#sapbillDelete" class="btn btn-danger btn-xs" onclick="return deletesapbil('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Sap Bill';
       return view('admin.view_sap_bill',compact('title'));

    }

    public function DeleteSapBill(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('sap_bill')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Sap Bill Data Was Deleted Successfully...!');
			return redirect('/view-sap-bill');

			} else {

			$request->session()->flash('alert-error', 'Sap Bill Data Can Not Deleted...!');
			return redirect('/view-sap-bill');

			}

		}else{

		$request->session()->flash('alert-error', 'Sap Bill Data Not Found...!');
		return redirect('/view-sap-bill');

		}
	}

	public function EditSapBill($id, Request $request){
		$title = 'Edit Sap Bill';

		$id = base64_decode($id);

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		if($id!=''){
    	    $query = DB::table('sap_bill');
			$query->where('id', $id);
			$compData['sapbil_list']     = $query->get()->first();
			
			$compData['user_list']       = DB::table('master_depot')->get();
			
			$compData['acc_list']        = DB::table('master_acc')->get();
			
			$compData['area_list']       = DB::table('master_area')->get();
			
			$compData['transpoter_list'] = DB::table('master_acctype')->get();
			
			$compData['item_list']       = DB::table('master_item')->get();

			//DB::enableQueryLog();
			$item_um_aum_list = DB::table('master_fy')->where('comp_code',$CCFromSession)->where('fy_code',$MaccYear)->get();
			//dd(DB::getQueryLog());


					foreach ($item_um_aum_list as $key) {
					$compData['fromDate'] =  $key->fy_from_date;
					$compData['toDate']   =  $key->fy_to_date;
					}

			return view('admin.edit_sap_bill', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-sap-bill');
		}

	}

	public function UpdateSapBill(Request $request){

		
		$validate = $this->validate($request, [

				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_date'     => 'required',
				'invoice_no'       => 'required',
				'depot_code'       => 'required',
				'account_code'     => 'required',
				'area_code'        => 'required',
				'transport_code'   => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'inv_qty_um'       => 'required',
				'inv_qty_aum'      => 'required',
				'so_code'          => 'required',
		]);

       $id = $request->input('sapbil_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"comp_code"    =>  $request->input('comp_code'),
					"fy_year"      =>  $request->input('fy_year'),
					"vr_date"      =>  $request->input('transaction_date'),
					"vr_no"        =>  $request->input('transaction_no'),
					"invoice_date" =>  $request->input('invoice_date'),
					"invoice_no"   =>  $request->input('invoice_no'),
					"depot_code"   =>  $request->input('depot_code'),
					"acct_code"    =>  $request->input('account_code'),
					"area_code"    =>  $request->input('area_code'),
					"trpt_code"    =>  $request->input('transport_code'),
					"truck_no"     =>  $request->input('vehicle_no'),
					"item_code"    =>  $request->input('item_code'),
					"qty_issued"   =>  $request->input('inv_qty_um'),
					"aqty_issued"  =>  $request->input('inv_qty_aum'),
					"so_code"      =>  $request->input('so_code'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('sap_bill')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Sap Bill Was Successfully Updated...!');
				return redirect('/view-sap-bill');

			} else {

				$request->session()->flash('alert-error', 'Sap Bill Can Not Updated...!');
				return redirect('/view-sap-bill');

			}


	}

/*sap bill end*/

    public function Item_UM_AUM(Request $request){

		$response_array = array();

		if ($request->ajax()) {


	    	$itemCode = $request->input('itemcode');

	    
	    	$item_um_aum_list = DB::table('master_itemum')->where('item_code', $itemCode)->get();

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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

/*inward Transaction start*/
    public function InwardTrans(Request $request){

			$CompanyCode   = $request->session()->get('company_name');
			$MaccYear      = $request->session()->get('macc_year');
			$getcomcode    = explode('-', $CompanyCode);
			$CCFromSession = $getcomcode[0];

    	$title = 'Add Inward Transaction';

		$userData['user_list']       = DB::table('master_depot')->get();
		
		$userData['acc_list']        = DB::table('master_acc')->get();
		
		$userData['area_list']       = DB::table('master_area')->get();
		
		$userData['transpoter_list'] = DB::table('master_acctype')->get();
		
		$userData['item_list']       = DB::table('master_item')->get();

		//DB::enableQueryLog();

		$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();

		//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$userData['fromDate'] =  $key->fy_from_date;
				$userData['toDate']   =  $key->fy_to_date;
				}
    	
    	return view('admin.inward_trans',$userData+compact('title'));

    }

    public function SaveInwardTrans(Request $request){

    	
	    	$validate = $this->validate($request, [

				
				'depot_code'       => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_no'       => 'required|unique:inward_trans,invoice_no',
				'invoice_date'     => 'required',
				'account_code'     => 'required',
				'transporter_code' => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'sto_qty'          => 'required',
				'sto_aqty'         => 'required',
				'qty_recd'         => 'required',
				'aqty_recd'        => 'required',
				'flag'             => 'required',

			]);

			$sortQty = $request->input('sort_qty');

			if($sortQty!=''){ 
	    		$sortQty;
	    	}else{ 
	    		$sortQty ='';
    		}

    		$sortAQty = $request->input('sort_aqty');

    		if($sortAQty!=''){ 
	    		$sortAQty;
	    	}else{ 
	    		$sortAQty ='';
    		}

    		$damageQty = $request->input('damage_qty');

    		if($damageQty!=''){ 
	    		$damageQty;
	    	}else{ 
	    		$damageQty ='';
    		}

    		$damageAQty = $request->input('damage_aqty');

    		if($damageAQty!=''){ 
	    		$damageAQty;
	    	}else{ 
	    		$damageAQty ='';
    		}

    		$returnQty = $request->input('return_qty');

    		if($returnQty!=''){ 
	    		$returnQty;
	    	}else{ 
	    		$returnQty ='';
    		}


	    	$data = array(
				"comp_code"    =>  $request->input('comp_code'),
				"fy_year"      =>  $request->input('fy_year'),
				"depot_code"   =>  $request->input('depot_code'),
				"vr_date"      =>  $request->input('transaction_date'),
				"vr_no"        =>  $request->input('transaction_no'),
				"invoice_no"   =>  $request->input('invoice_no'),
				"invoice_date" =>  $request->input('invoice_date'),
				"acc_code"     =>  $request->input('account_code'),
				"trpt_code"    =>  $request->input('transporter_code'),
				"truck_no"     =>  $request->input('vehicle_no'),
				"item_code"    =>  $request->input('item_code'),
				"sto_qty"      =>  $request->input('sto_qty'),
				"sto_aqty"     =>  $request->input('sto_aqty'),
				"qty_recd"     =>  $request->input('qty_recd'),
				"aqty_recd"    =>  $request->input('aqty_recd'),
				"short_qty"    =>  $sortQty,
				"short_aqty"   =>  $sortAQty,
				"damage_qty"   =>  $damageQty,
				"damage_aqty"  =>  $damageAQty,
				"return_qty"   =>  $returnQty,
				"flag"         =>  $request->input('flag'),
				"created_by"   =>  $request->session()->get('userid')
	 
	    	);

	    	$saveData = DB::table('inward_trans')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Inward Transaction Was Successfully Added...!');
				return redirect('/view-inward-trans');

			} else {

				$request->session()->flash('alert-error', 'Inward Transaction Can Not Added...!');
				return redirect('/view-inward-trans');

			}

    }

    public function viewInwardTrnas(Request $request){

    	
    	if ($request->ajax()) {

		$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		 $CompanyCode   = $request->session()->get('company_name');

		 $macc_year   = $request->session()->get('macc_year');
		 

		if($user_type == 'admin'){

    	$data = DB::table('inward_trans')
				->select('inward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'inward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'inward_trans.depot_code', '=', 'master_depot.depot_code')
            	->get();


    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('inward_trans')
				->select('inward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'inward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'inward_trans.depot_code', '=', 'master_depot.depot_code')
            	->where([['inward_trans.created_by','=',$userid],['inward_trans.comp_code','=',$CompanyCode],['inward_trans.fy_year','=',$macc_year]])
            	->get();

    	}else{

    		$data ='';
    	}

			return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#inwardTransview" onclick="return inwardView('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-inward-trans/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#inwardTransDelete" class="btn btn-danger btn-xs" onclick="return deleteinwrd('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

    	}

         	$title = 'View Inward Transaction';

    		return view('admin.view_inward_trans',compact('title'));
    }


    public function viewAllDataInwardTrans(Request $request,$id){

    	//$id = $request->input('id');
		$userData['inward_list'] = DB::table('inward_trans')->where('id', $id)->get()->first();
		//print_r($userData);
    	return view('admin.view_all_data_inward_trans',$userData);

    }

    public function DeleteInwardTrans(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('inward_trans')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', ' Inward Transaction Was Deleted Successfully...!');
			return redirect('/view-inward-trans');

			} else {

			$request->session()->flash('alert-error', 'Inward Transaction Can Not Deleted...!');
			return redirect('/view-inward-trans');

			}

		}else{

		$request->session()->flash('alert-error', 'Inward Transaction Not Found...!');
		return redirect('/view-inward-trans');

		}
	}

	 public function EditInwardTrans($id, Request $request){

	 	$title = 'Edit Inward Transaction';

	 	   $id = base64_decode($id);

    	if($id!=''){

    		 $CompanyCode   = $request->session()->get('company_name');
			$MaccYear      = $request->session()->get('macc_year');
			$getcomcode    = explode('-', $CompanyCode);
			$CCFromSession = $getcomcode[0];

    	    $query = DB::table('inward_trans');
			$query->where('id', $id);
			$compData['inward_list'] = $query->get()->first();

			$compData['user_list']       = DB::table('master_depot')->get();
		
			$compData['acc_list']        = DB::table('master_acc')->get();
		
			$compData['area_list']       = DB::table('master_area')->get();
		
			$compData['transpoter_list'] = DB::table('master_acctype')->get();
		
			$compData['item_list']       = DB::table('master_item')->get();

			//DB::enableQueryLog();

			$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();

			//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$compData['fromDate'] =  $key->fy_from_date;
				$compData['toDate']   =  $key->fy_to_date;
				}


			return view('admin.edit_inward_trans', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-inward-trans');
		}
    }

    public function UpdateInwardTrans(Request $request){


	    	$validate = $this->validate($request, [

				
				'depot_code'       => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'invoice_no'       => 'required|unique:inward_trans,invoice_no',
				'invoice_date'     => 'required',
				'account_code'     => 'required',
				'transporter_code' => 'required',
				'vehicle_no'       => 'required',
				'item_code'        => 'required',
				'sto_qty'          => 'required',
				'sto_aqty'         => 'required',
				'qty_recd'         => 'required',
				'aqty_recd'        => 'required',
				'flag'             => 'required',

			]);
			
	    	$id =  $request->input('inward_id');

	    	$sortQty = $request->input('sort_qty');

			if($sortQty!=''){ 
	    		$sortQty;
	    	}else{ 
	    		$sortQty ='';
    		}

    		$sortAQty = $request->input('sort_aqty');

    		if($sortAQty!=''){ 
	    		$sortAQty;
	    	}else{ 
	    		$sortAQty ='';
    		}

    		$damageQty = $request->input('damage_qty');

    		if($damageQty!=''){ 
	    		$damageQty;
	    	}else{ 
	    		$damageQty ='';
    		}

    		$damageAQty = $request->input('damage_aqty');

    		if($damageAQty!=''){ 
	    		$damageAQty;
	    	}else{ 
	    		$damageAQty ='';
    		}

    		$returnQty = $request->input('return_qty');

    		if($returnQty!=''){ 
	    		$returnQty;
	    	}else{ 
	    		$returnQty ='';
    		}


	    	$data = array(
				"comp_code"    =>  $request->input('comp_code'),
				"fy_year"      =>  $request->input('fy_year'),
				"depot_code"   =>  $request->input('depot_code'),
				"vr_date"      =>  $request->input('transaction_date'),
				"vr_no"        =>  $request->input('transaction_no'),
				"invoice_no"   =>  $request->input('invoice_no'),
				"invoice_date" =>  $request->input('invoice_date'),
				"acc_code"     =>  $request->input('account_code'),
				"trpt_code"    =>  $request->input('transporter_code'),
				"truck_no"     =>  $request->input('vehicle_no'),
				"item_code"    =>  $request->input('item_code'),
				"sto_qty"      =>  $request->input('sto_qty'),
				"sto_aqty"     =>  $request->input('sto_aqty'),
				"qty_recd"     =>  $request->input('qty_recd'),
				"aqty_recd"    =>  $request->input('aqty_recd'),
				"short_qty"    =>  $sortQty,
				"short_aqty"   =>  $sortAQty,
				"damage_qty"   =>  $damageQty,
				"damage_aqty"  =>  $damageAQty,
				"return_qty"   =>  $returnQty,
				"flag"         =>  $request->input('flag'),
				"last_updat_by" =>  $request->session()->get('userid'),

	 
	    	);

	    	//print_r($data);exit();
	    	$saveData = DB::table('inward_trans')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Inward Transaction Was Successfully Updated...!');
				return redirect('/view-inward-trans');

			} else {

				$request->session()->flash('alert-error', 'Inward Transaction Can Not Updated...!');
				return redirect('/view-inward-trans');

			}

    }
/*inward Transaction end*/

/*outward Transaction start*/

	public function OutwardTrans(Request $request){

		$title = 'Add Outward Transaction';

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		$userData['acc_list']  = DB::table('master_acc')->get();
		
		$userData['user_list'] = DB::table('master_depot')->get();
		
		$userData['area_list'] = DB::table('master_area')->get();
		
		//DB::enableQueryLog();

		$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();

		//dd(DB::getQueryLog());

				foreach ($item_um_aum_list as $key) {
				$userData['fromDate'] =  $key->fy_from_date;
				$userData['toDate']   =  $key->fy_to_date;
				}

    	return view('admin.outward_trans',$userData+compact('title'));
    }

    public function SaveOutwardTrans(Request $request){

    	    	$validate = $this->validate($request, [

				'depot_code'       => 'required',
				'account_code'     => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'despatch_type'    => 'required',
				'invoice_no'       => 'required',
				'chalan_no'        => 'required',
				'area_code'        => 'required',
				'driver_name'      => 'required',
				'driver_number'    => 'required',
		]);


    	    	$developmentMode = true;
        		$mailer = new PHPMailer($developmentMode);

    	    	$AccCode =  $request->input('account_code');

				$getemail = DB::table('master_acc')->where(['acc_code'=>$AccCode,'acctype_code'=>'T'])->get();

    	    	foreach ($getemail as $row) {
    	    		$accEmailId = $row->email_id;
    	    		$transName = $row->acc_name;
    	    	}

    	    	$allaccount = DB::select("SELECT * FROM `master_acc` WHERE acc_code='$AccCode' AND acctype_code!='T' ");

    	    	if(!empty($allaccount)){
    	    		foreach ($allaccount as $rowacc) {
	    	    		$accNAme = $rowacc->acc_name;
	    	    	}
    	    	}else{
    	    		$accNAme = '-';
    	    	}
    	    	

        		$areaCode = $request->input('area_code');

        		$getareaname = DB::select("SELECT * FROM `master_area` WHERE code='$areaCode'");
        		if(!empty($getareaname)){

	        		foreach ($getareaname as $rowar) {
	        			$areaName = $rowar->name;
        			}
        		}else{
        			$areaName = '';
        		}

        		$itemname = $request->input('item');
        		$itmname = DB::select("SELECT * FROM `master_itemum` WHERE item_code='$itemname'");

        		if(!empty($itmname)){
        			foreach ($itmname as $itmrow) {
	        			$umcode = $itmrow->um_code;
	        			$aumcode = $itmrow->aum;
        			}
    	    		
    	    	}else{
	    	    	$umcode = '-';
    	    		$aumcode = '-';
    	   		}
        		
                
				$vehicle_num   = $request->input('vehicle_no');
				$despatch_qty  = $request->input('despatch_qty');
				$invoic_num    = $request->input('invoice_no');
				$trip_trans_no = $request->input('transaction_no');
				$driver_Name   = $request->input('driver_name');
				$driver_number = $request->input('driver_number');
				$despatchAqty = $request->input('despatch_aqty');

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
                $mailer->addReplyTo('kamini.khapre@aceworth.in', 'Aceworth Private Limitate');

                $mailer->isHTML(true);
                $mailer->Subject = 'Outward Transaction';

                $message = '<div style="padding-left: 14%;font-size: 16px;font-weight: 600;color: gray;">Outward Transaction</div><table id="OutwardTrans" style="border: 1px solid #a99999;border-radius: 5px;padding: 11px;border-top: 3px solid #3c8dbc;">
  <tbody><tr><td><b>Invoice Number</b></td><td><b>'.$invoic_num.'</b></td></tr><tr><td><b>Invoice Date</b></td><td><b>2020-12-05 06:11:08</b></td></tr><tr><td><b>Route</b></td><td><b>'.$areaName.'</b></td></tr><tr><td><b>Trip Id</b></td><td>'.$trip_trans_no.'</td></tr><tr><td><b>Truck Number</b></td><td><b>'.$vehicle_num.'</b></td></tr><tr><td><b>Transporter Name</b></td><td>'.$transName.'</td></tr><tr><td><b>Driver Name</b></td><td>'.$driver_Name.'</td></tr><tr><td><b>Driver Contact Number(s)</b></td><td>'.$driver_number.'</td></tr><tr><td><b>Ship To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Sold To Party</b></td><td>'.$accNAme.'</td></tr><tr><td><b>Invoice Quantity</b></td><td>'.$despatch_qty.'-'.$umcode.'-'.$despatchAqty.'-'.$aumcode.'</td></tr></tbody></table>';

                $mailer->Body = $message;

        $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}


    	 $data = array(
					"comp_code"     =>  $request->input('comp_code'),
					"fy_year"       =>  $request->input('fy_year'),
					"depot_code"    =>  $request->input('depot_code'),
					"tr_date"       =>  $request->input('transaction_date'),
					"tr_no"         =>  $request->input('transaction_no'),
					"chalan_no"     =>  $request->input('chalan_no'),
					"acc_code"      =>  $request->input('account_code'),
					"area_code"     =>  $request->input('area_code'),
					"trans_code"    =>  $transCode,
					"truck_no"      =>  $vehiclNo,
					"item_code"     =>  $itemcd,
					"desp_qty"      =>  $desQty,
					"desp_aqty"     =>  $destAQty,
					"inv_no"        =>  $request->input('invoice_no'),
					"desp_type"     =>  $request->input('despatch_type'),
					"driver_name"   =>  $request->input('driver_name'),
					"driver_number" =>  $request->input('driver_number'),
					"created_by"    =>  $request->session()->get('userid')
				
	    	);

		$saveData = DB::table('outward_trans')->insert($data);

		      $mailSend = $mailer->send();
                $mailer->ClearAllRecipients();

			if ($saveData && $mailSend) {

				$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Added...!');
				return redirect('/view-outward-trans');

			} else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Added...!');
				return redirect('/view-outward-trans');

			}
    }

       public function viewOutwardTrans(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){

    	
    	$data = DB::table('outward_trans')
				->select('outward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'outward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'outward_trans.depot_code', '=', 'master_depot.depot_code')
            	->get();
    	
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	$data = DB::table('outward_trans')
				->select('outward_trans.*', 'master_depot.depot_name as depotName','master_acc.acc_name as accountName')
           		->leftjoin('master_acc', 'outward_trans.acc_code', '=', 'master_acc.acc_code')
           		->leftjoin('master_depot', 'outward_trans.depot_code', '=', 'master_depot.depot_code')
           		->where([['outward_trans.created_by','=',$userid],['outward_trans.comp_code','=',$CompanyCode],['outward_trans.fy_year','=',$macc_year]])
            	->get();

    	}else{

    		$data ='';
    	}

    	//return DataTables()->of($data)->make(true);

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<button type="button"  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#outwardtransView" onclick="return outwardView('.$data->id.')"><i class="fa fa-eye" title="view"></i></button> | <a href="'.url('/edit-form-outward-trans/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#OutwardTranssDelete" class="btn btn-danger btn-xs" onclick="return deleteoutwrd('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);


    }

    	 $title = 'View Outward Transaction';

    	 return view('admin.view_outward_trans',compact('title'));

    }

    public function DeleteOutwardTrans(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('outward_trans')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Outward Tranaction Data Was Deleted Successfully...!');
			return redirect('/view-outward-trans');

			} else {

			$request->session()->flash('alert-error', 'Outward Tranaction Data Can Not Deleted...!');
			return redirect('/view-outward-trans');

			}

		}else{

		$request->session()->flash('alert-error', 'Outward Tranaction Data Not Found...!');
		return redirect('/view-outward-trans');

		}
	}

	public function EditOutwardTrans($id,Request $request){

		$title = 'Edit Outward Tranaction';

		$id = base64_decode($id);

		$CompanyCode   = $request->session()->get('company_name');
		$MaccYear      = $request->session()->get('macc_year');
		$getcomcode    = explode('-', $CompanyCode);
		$CCFromSession = $getcomcode[0];

		if($id!=''){
    	    $query = DB::table('outward_trans');
			$query->where('id', $id);
			$compData['outward_trans_list'] = $query->get()->first();
			
			$compData['user_list']          = DB::table('master_depot')->get();
			
			$compData['acc_list']           = DB::table('master_acc')->get();
			
			$compData['area_list']          = DB::table('master_area')->get();
			
			/*$compData['transpoter_list']    = DB::table('transporter')->get();
			
			$compData['item_list']          = DB::table('master_item')->get();*/


			$item_um_aum_list = DB::table('master_fy')->where(['comp_code'=>$CCFromSession,'fy_code'=>$MaccYear])->get();


				foreach ($item_um_aum_list as $key) {
					$compData['fromDate'] =  $key->fy_from_date;
					$compData['toDate']   =  $key->fy_to_date;
				}

			return view('admin.edit_outward_list', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-outward-trans');
		}

	}

	public function UpdateOutwardTrans(Request $request){
		
    	 $validate = $this->validate($request, [

				'depot_code'       => 'required',
				'account_code'     => 'required',
				'transaction_date' => 'required',
				'transaction_no'   => 'required',
				'despatch_type'    => 'required',
				'invoice_no'       => 'required',
				'chalan_no'        => 'required',
				'area_code'        => 'required',
				'driver_name'      => 'required',
				'driver_number'    => 'required',
		]);

    	 $id= $request->input('outward_id');
    	 $updatedDate = date("Y-m-d");

    	 $itemcd = $request->input('item');

			if($itemcd!=''){ 
	    		$itemcd;
	    	}else{ 
	    		$itemcd ='';
    		}


        $desQty = $request->input('despatch_qty');

			if($desQty!=''){ 
	    		$desQty;
	    	}else{ 
	    		$desQty ='';
    		}

    	$destAQty = $request->input('despatch_aqty');

			if($destAQty!=''){ 
	    		$destAQty;
	    	}else{ 
	    		$destAQty ='';
    		}

    	$vehiclNo = $request->input('vehicle_no');

			if($vehiclNo!=''){ 
	    		$vehiclNo;
	    	}else{ 
	    		$vehiclNo ='';
    		}

    	$transCode = $request->input('transport_code');

			if($transCode!=''){ 
	    		$transCode;
	    	}else{ 
	    		$transCode ='';
    		}
    	 $data = array(
					"comp_code"       =>  $request->input('comp_code'),
					"fy_year"         =>  $request->input('fy_year'),
					"depot_code"      =>  $request->input('depot_code'),
					"tr_date"         =>  $request->input('transaction_date'),
					"tr_no"           =>  $request->input('transaction_no'),
					"chalan_no"       =>  $request->input('chalan_no'),
					"acc_code"        =>  $request->input('account_code'),
					"area_code"       =>  $request->input('area_code'),
					"trans_code"      =>  $transCode,
					"truck_no"        =>  $vehiclNo,
					"item_code"       =>  $itemcd,
					"desp_qty"        =>  $desQty,
					"desp_aqty"       =>  $destAQty,
					"inv_no"          =>  $request->input('invoice_no'),
					"desp_type"       =>  $request->input('despatch_type'),
					"driver_name"     =>  $request->input('driver_name'),
					"driver_number"   =>  $request->input('driver_number'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
				
	    	);

    	 $saveData = DB::table('outward_trans')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Outward Transaction Was Successfully Updated...!');
				return redirect('/view-outward-trans');

			} else {

				$request->session()->flash('alert-error', 'Outward Transaction Can Not Updated...!');
				return redirect('/view-outward-trans');

			}


	}


/*outward Transaction end*/

/*fetch invoice no when select desptach type*/
  public function Dpt_Type_Ajax(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$inv_no = $request->input('inv_no');
	    	$comp_code = $request->input('comp_code');
	    	$fy_year = $request->input('fy_year');
	    
	    	$item_um_aum_list = DB::select("SELECT inward_trans.item_code,inward_trans.truck_no,inward_trans.invoice_no,inward_trans.trpt_code,inward_trans.sto_qty,inward_trans.sto_aqty FROM `inward_trans` WHERE inward_trans.invoice_no='$inv_no' AND inward_trans.comp_code ='$comp_code' AND  inward_trans.fy_year='$fy_year' ");

	    	/*$item_um_aum_list = DB::table('inward_trans')
				->select('inward_trans.item_code','inward_trans.truck_no','inward_trans.invoice_no','inward_trans.trpt_code','inward_trans.sto_qty','inward_trans.sto_aqty')
           		->where([['inward_trans.invoice_no','=',$inv_no],['inward_trans.comp_code','=',$comp_code],['inward_trans.fy_year','=',$fy_year]])
            	->get();*/

    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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
/*fetch invoice no when select desptach type*/



/*get UM and AUM from master_itemum table for edit pages*/

public function Get_UmAum_Show_In_Edit(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$item_code = $request->input('item_code');
	    
	    	 $item_um_aum_list = DB::table('master_itemum')->where('item_code',$item_code)->get();
    		if ($item_um_aum_list) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $item_um_aum_list ;

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

/*get UM and AUM from master_itemum table for edit pages*/


/*fetch all data on model load outward form*/

public function outward_data_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	$fetch_reocrd = DB::table('outward_trans')->where('id',$formid)->get();

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

/*fetch all data on model load outward form*/



/*fetch all data on model load inward form*/
public function inward_data_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	$fetch_reocrd = DB::table('inward_trans')->where('id',$formid)->get();

    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

 /*fetch all data on model load inward form*/


 /*fetch all data on model load sapbill form*/
public function sap_bill_fetch(Request $request){

		$response_array = array();

		if ($request->ajax()) {

	    	$formid = $request->input('id');
	    
	    	//DB::enableQueryLog();
	    	$fetch_reocrd = DB::table('sap_bill')->where('id',$formid)->get();
	    	//dd(DB::getQueryLog());


    		if ($fetch_reocrd) {

    			$response_array['response'] = 'success';
	            $response_array['data'] = $fetch_reocrd ;

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

 /*fetch all data on model load sapbill form*/






}
