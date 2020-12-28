<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Dispatch;
use Auth;
use DB;
use Session;
use Illuminate\Support\Str;

class MasterController extends Controller{
    
    public function __cunstruct(Request $request){

    	

	}


/*master depot form*/


	public function DepotForm(Request $request){

	$title = 'Add Master Depot';

    $data['state_list'] = DB::table('master_state')->get();
    	
    	return view('admin.depot_form',$data+compact('title'));
    }

    public function DepotFormSave(Request $request){

    	$validate = $this->validate($request, [

			'depot_code'    => 'required|max:12',
			'depot_name'    => 'required',
			'contact_no'    => 'required',
			'contact_email' => 'required|email',
			'address_one'   => 'required',
			'address_two'   => 'required',
			'address_three' => 'required',
			'country'       => 'required',
			'state_code'    => 'required',
			'district'      => 'required',
			'city_code'     => 'required|max:6',
			'pincode'       => 'required|max:6',

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"    	=> $compName,
			"fiscal_year"   => $fisYear,
			"depot_code"    => $request->input('depot_code'),
			"depot_name"    => $request->input('depot_name'),
			"contac_person" => $request->input('contact_no'),
			"contac_email"  => $request->input('contact_email'),
			"add1"          => $request->input('address_one'),
			"add2"          => $request->input('address_two'),
			"add3"          => $request->input('address_three'),
			"country"       => $request->input('country'),
			"state_code"    => $request->input('state_code'),
			"district"      => $request->input('district'),
			"city"          => $request->input('city_code'),
			"pincode"       => $request->input('pincode'),
			"created_by"    => $createdBy,
			
		);

		$saveData = DB::table('master_depot')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Depot Was Successfully Added...!');
			return redirect('/view-mast-depot');

		} else {

			$request->session()->flash('alert-error', 'Depot Can Not Added...!');
			return redirect('/view-mast-depot');

		}
    	
    	

    }

    public function DepotView(Request $request){

    	$title = 'View Master Depot';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	$depotData['depot_list'] = DB::table('master_depot')->orderBy('id','DESC')->get();
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$depotData['depot_list'] = DB::table('master_depot')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$depotData['depot_list']='';
    	}

    	return view('admin.view_depot',$depotData+compact('title'));
    }

    public function EditDepotForm($id){

    	$title = 'Edit Master Depot';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_depot');
			$query->where('id', $id);
			$userData['depot_list'] = $query->get()->first();

			
			$userData['state_list'] = DB::table('master_state')->get();

			return view('admin.depot_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Depot-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DepotFormUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'depot_code'    => 'required|max:12',
			'depot_name'    => 'required',
			'contact_no'    => 'required',
			'contact_email' => 'required|email',
			'address_one'   => 'required',
			'address_two'   => 'required',
			'address_three' => 'required',
			'country'       => 'required',
			'state_code'    => 'required',
			'district'      => 'required',
			'city_code'     => 'required|max:6',
			'pincode'       => 'required|max:6',

		]);

		$depotId=$request->input('depotId');
		//print_r($request->post());exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"depot_code"      => $request->input('depot_code'),
			"depot_name"      => $request->input('depot_name'),
			"contac_person"   => $request->input('contact_no'),
			"contac_email"    => $request->input('contact_email'),
			"add1"            => $request->input('address_one'),
			"add2"            => $request->input('address_two'),
			"add3"            => $request->input('address_three'),
			"country"         => $request->input('country'),
			"state_code"      => $request->input('state_code'),
			"district"        => $request->input('district'),
			"city"            => $request->input('city_code'),
			"pincode"         => $request->input('pincode'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);
		

		$saveData = DB::table('master_depot')->where('id', $depotId)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'Depot Was Successfully Updated...!');
			return redirect('/view-mast-depot');

		} else {

			$request->session()->flash('alert-error', 'Depot Can Not Updated...!');
			return redirect('/view-mast-depot');

		}
    }


    public function DeleteDepot(Request $request){

    	$depotId = $request->post('DepotID');
    	

    	if ($depotId!='') {
    		
    		$Delete = DB::table('master_depot')->where('id', $depotId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Depot Was Deleted Successfully...!');
				return redirect('/view-mast-depot');

			} else {

				$request->session()->flash('alert-error', 'Depot Can Not Deleted...!');
				return redirect('/view-mast-depot');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Depot Not Found...!');
			return redirect('/view-mast-depot');

    	}
    }
/*master depot form*/

/*master dealer form*/
    public function DealerForm(Request $request){

    	 $title = 'Add Master Account';
    	
    	 $data['state_list'] = DB::table('master_state')->get();
    	 $data['acc_type_list'] = DB::table('master_acctype')->get();
    	
    	return view('admin.dealer_form',$data+compact('title'));
    }


    public function DealerFormSave(Request $request){
    	//print_r($request->post());exit;

    		$validate = $this->validate($request, [

			'account_code'   => 'required|max:12',
			'account_name'   => 'required',
			'acc_type_code'  => 'required',
			'contact_no'     => 'required',
			'contact_person' => 'required',
			'email_id'       => 'required',
			'address_one'    => 'required',
			'address_two'    => 'required',
			'address_three'  => 'required',
			'country'        => 'required',
			'state_code'     => 'required',
			'district'       => 'required',
			'city_code'      => 'required|max:6',
			'pincode'        => 'required|max:6',
			'service_charge' => 'required',

		]);

    	$createdBy = $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(

			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_code"       => $request->input('account_code'),
			"acc_name"       => $request->input('account_name'),
			"acctype_code"   => $request->input('acc_type_code'),
			"contact_no"     => $request->input('contact_no'),
			"contact_person" => $request->input('contact_person'),
			"email_id"       => $request->input('email_id'),
			"add1"           => $request->input('address_one'),
			"add2"           => $request->input('address_two'),
			"add3"           => $request->input('address_three'),
			"country"        => $request->input('country'),
			"state_code"     => $request->input('state_code'),
			"district"       => $request->input('district'),
			"city"           => $request->input('city_code'),
			"pincode"        => $request->input('pincode'),
			"service_charge" => $request->input('service_charge'),
			"flag"           => '0',
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_acc')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Was Successfully Added...!');
			return redirect('/view-mast-dealer');

		} else {

			$request->session()->flash('alert-error', 'Account Can Not Added...!');
			return redirect('/view-mast-dealer');

		}
    }

    public function DealerView(Request $request){

    	$title ='View Master Account';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin' || $userType=='Admin'){

    	$dealerData['dealer_list'] = DB::table('master_acc')->orderBy('id','DESC')->get();

		}else if($userType=='superAdmin' || $userType=='user'){

			$dealerData['dealer_list'] = DB::table('master_acc')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();

			
		}
		else{

			$dealerData['dealer_list']='';
			
		}

       return view('admin.view_dealer',$dealerData+compact('title'));
    	
    }

    public function EditDealerForm($id){

    	$title = 'Edit Master Account';
    	//print_r($id);
    	$id = base64_decode($id);
    	if($id!=''){
    	    $query = DB::table('master_acc');
			$query->where('id', $id);
			$userData['dealer_list'] = $query->get()->first();

			
			$userData['state_list'] = DB::table('master_state')->get();

			 $userData['acc_type_list'] = DB::table('master_acctype')->get();

			return view('admin.dealer_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Account Code Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DealerFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'account_code'   => 'required|max:12',
			'account_name'   => 'required',
			'acc_type_code'  => 'required',
			'contact_no'     => 'required',
			'contact_person' => 'required',
			'email_id'       => 'required',
			'address_one'    => 'required',
			'address_two'    => 'required',
			'address_three'  => 'required',
			'country'        => 'required',
			'state_code'     => 'required',
			'district'       => 'required',
			'city_code'      => 'required|max:6',
			'pincode'        => 'required|max:6',
			'service_charge' => 'required',

		]);

		$dealerId = $request->input('dealerId');


		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');


		$data = array(
			"acc_code"        => $request->input('account_code'),
			"acc_name"        => $request->input('account_name'),
			"acctype_code"    => $request->input('acc_type_code'),
			"contact_no"      => $request->input('contact_no'),
			"contact_person"  => $request->input('contact_person'),
			"email_id"        => $request->input('email_id'),
			"add1"            => $request->input('address_one'),
			"add2"            => $request->input('address_two'),
			"add3"            => $request->input('address_three'),
			"country"         => $request->input('country'),
			"state_code"      => $request->input('state_code'),
			"district"        => $request->input('district'),
			"city"            => $request->input('city_code'),
			"pincode"         => $request->input('pincode'),
			"service_charge"  => $request->input('service_charge'),
			"flag"            => '0',
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
			
		);



		$saveData = DB::table('master_acc')->where('id',$dealerId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Code Was Successfully Updated...!');
			return redirect('/view-mast-dealer');

		} else {

			$request->session()->flash('alert-error', 'Account Code Not Updated...!');
			return redirect('/view-mast-dealer');

		}

    }

     public function DeleteDealer(Request $request){

    	$DealerID = $request->post('DealerID');
    	//print_r($DealerID);exit;

    	if ($DealerID!='') {
    		
    	$Delete = DB::table('master_acc')->where('id',$DealerID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Account Code Was Deleted Successfully...!');
				return redirect('/view-mast-dealer');

			} else {

				$request->session()->flash('alert-error', 'Account Code Can Not Deleted...!');
				return redirect('/view-mast-dealer');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Not Found...!');
			return redirect('/view-mast-destination');

    	}
    }
    
/*master dealer form*/


    public function DestinationForm(Request $request){

    	$title ='Add Master Area';
    
    	return view('admin.destination_form',compact('title'));
    }

    public function DestinationFormSave(Request $request){

    	$validate = $this->validate($request, [

			'area_code'    => 'required',
			'area_name'    => 'required',
			
		]);

		$createdBy = $request->session()->get('userid');

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		

		$data = array(

			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"name"        => $request->input('area_name'),
			"code"        => $request->input('area_code'),
			"created_by"  => $createdBy,
		);

		$saveData = DB::table('master_area')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Area Was Successfully Added...!');
			return redirect('/view-mast-destination');

		} else {

			$request->session()->flash('alert-error', 'Area Can Not Added...!');
			return redirect('/view-mast-destination');

		}

    }

    public function DestinationView(Request $request){

    	$title = 'View Master Area';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$destinationData['destination_list'] = DB::table('master_area')->orderBy('id','DESC')->get();

    	 

		}else if($userType=='superAdmin' || $userType=='user'){
			$destinationData['destination_list'] = DB::table('master_area')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();

			//return view('admin.view_dealer',$dealerData);
		}
		else{

			$destinationData['destination_list']='';
			//return view('admin.view_dealer',$dealerData);
		}

    	return view('admin.view_destination',$destinationData+compact('title'));

    }

    public function EditDestinationForm($id){

    	$title ='Edit Master Area';
    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_area');
			$query->where('id', $id);
			$userData['destination_list'] = $query->get()->first();

			return view('admin.destination_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Area Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function DestinationFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'area_code'    => 'required',
			'area_name'    => 'required',
			
		]);

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$destinationId = $request->input('destinationId');

		$data = array(
			"name"         => $request->input('area_name'),
			"code"         => $request->input('area_code'),
			"updated_by"   => $lastUpdatedBy,
			"updated_date" => $updatedDate,
		);

		

		$saveData = DB::table('master_area')->where('id',$destinationId)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'Area Was Successfully Updated...!');
			return redirect('/view-mast-destination');

		} else {

			$request->session()->flash('alert-error', 'Area Can Not Updated...!');
			return redirect('/view-mast-destination');

		}
    }

    public function DeleteDestination(Request $request){

    	$destinationId = $request->post('DestinationID');
    	//print_r($destinationId);exit;

    	if ($destinationId!='') {
    		
    		$Delete = DB::table('master_area')->where('id', $destinationId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Area Was Deleted Successfully...!');
				return redirect('/view-mast-destination');

			} else {

				$request->session()->flash('alert-error', 'Area Can Not Deleted...!');
				return redirect('/view-mast-destination');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Area Not Found...!');
			return redirect('/view-mast-destination');

    	}
    }


    public function TransporterForm(Request $request){
    	
    	$title = 'Add Master Transpoter';
    
    	return view('admin.transporter_form',compact('title'));
    }

    public function TransportFormSave(Request $request)
    {
    	$validate = $this->validate($request, [

			'transport_code' => 'required|max:12',
			'transport_name' => 'required',
			'contact_no'     => 'required',
			'contact_person' => 'required',
			'address'        => 'required',
			

		]);

		$createdBy = $request->session()->get('userid');


		$data = array(
			"code"           => $request->input('transport_code'),
			"name"           => $request->input('transport_name'),
			"contact_no"     => $request->input('contact_no'),
			"contact_person" => $request->input('contact_person'),
			"address"        => $request->input('address'),
			"created_by" => $createdBy,
			
			
		);

		$saveData = DB::table('master_transporter')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Transpoter Was Successfully Added...!');
			return redirect('/view-mast-transport');

		} else {

			$request->session()->flash('alert-error', 'Transpoter Can Not Added...!');
			return redirect('/view-mast-transport');

		}
    }

    public function TransporterView(Request $request){

    	$title = 'View Master Transpoter';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	if($userType=='admin'){

    	$transportData['transport_list'] = DB::table('master_transporter')->orderBy('id','DESC')->get();

    	 

		}else if($userType=='superAdmin' || $userType=='user'){
			$transportData['transport_list'] = DB::table('master_transporter')->where('created_by', $userid)->get();

			//return view('admin.view_dealer',$dealerData);
		}
		else{

			$transportData['transport_list']='';
			//return view('admin.view_dealer',$dealerData);
		}

    	

    	return view('admin.view_transporter',$transportData+compact('title'));

    }

    public function EditTransporterForm($id){

    	$title = 'Edit Master Transporter';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_transporter');
			$query->where('id', $id);
			$userData['transporter_list'] = $query->get()->first();

			return view('admin.transporter_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Transporter Not Found...!');
			return redirect('/form-mast-depot');
		}
    }

    public function TransportFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'transport_code' => 'required|max:12',
			'transport_name' => 'required',
			'contact_no'     => 'required',
			'contact_person' => 'required',
			'address'        => 'required',
			

		]);

    		$transportId = $request->input('transportId');
    		//print_r($transportId);exit;
    		date_default_timezone_set('Asia/Kolkata');

			$updatedDate = date("Y-m-d");

			$lastUpdatedBy = $request->session()->get('userid');


		$data = array(
			"code"           => $request->input('transport_code'),
			"name"           => $request->input('transport_name'),
			"contact_no"     => $request->input('contact_no'),
			"contact_person" => $request->input('contact_person'),
			"address"        => $request->input('address'),
			"updated_by"     => $lastUpdatedBy,
			"updated_date"   => $updatedDate,
			
			
		);

		
		$saveData = DB::table('master_transporter')->where('id',$transportId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Transporter Was Successfully Updated...!');
			return redirect('/view-mast-transport');

		} else {

			$request->session()->flash('alert-error', 'Transporter Can Not Updated...!');
			return redirect('/view-mast-transport');

		}
    }

     public function DeleteTransport(Request $request){

    	$transportID = $request->post('transportID');
    	//print_r($DealerID);exit;

    	if ($transportID!='') {
    		
    	$Delete = DB::table('master_transporter')->where('id',$transportID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Transporter Was Deleted Successfully...!');
				return redirect('/view-mast-transport');

			} else {

				$request->session()->flash('alert-error', 'Transporter Can Not Deleted...!');
				return redirect('/view-mast-transport');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Transporter Not Found...!');
			return redirect('/view-mast-transport');

    	}
    }



    public function FleetForm(Request $request){

    	$title = 'Add Master Fleet';
    	
    	$userData['user_list']= DB::table('master_depot')->get();

    	$userData['mfg_list']= DB::table('Master_Vehicle_Mfg')->get();

   $userData['wheel_list']= DB::table('fleet_truck_wheel')->get();


    
    	return view('admin.fleet_form',$userData+compact('title'));
    }

    public function FleetFormSave(Request $request)
    {
    	$validate = $this->validate($request, [

			'truck_no'      => 'required|max:12',
			'regd_date'     => 'required',
			'make'    => 'required',
			'model'    => 'required',
			'depot_code' => 'required',
			'wheel_type'    => 'required',
			'load_capacity' => 'required',
			

		]);

		$createdBy = $request->session()->get('userid');

		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$data = array(

			"comp_name"     => $compName,
			"fiscal_year"   => $fisYear,
			"truck_no"      => $request->input('truck_no'),
			"regd_date"     => $request->input('regd_date'),
			"make"    => $request->input('make'),
			"model"    => $request->input('model'),
			"location"      => $request->input('depot_code'),
			"wheels_type"   => $request->input('wheel_type'),
			"load_capacity" => $request->input('load_capacity'),
			"created_by"    => $createdBy,
			
			
		);

		$saveData = DB::table('master_fleet')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Was Successfully Added...!');
			return redirect('/view-mast-fleet');

		} else {

			$request->session()->flash('alert-error', 'Fleet Can Not Added...!');
			return redirect('/view-mast-fleet');

		}
    }

    public function FleetView(Request $request){

		$title    = 'View Master Fleet';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    	$fleetData['fleet_list'] = DB::table('master_fleet')->orderBy('id','DESC')->get();

    	 

		}else if($userType=='superAdmin' || $userType=='user'){

			$fleetData['fleet_list'] = DB::table('master_fleet')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();

			//return view('admin.view_dealer',$dealerData);
		}
		else{

			$fleetData['fleet_list']='';
			//return view('admin.view_dealer',$dealerData);
		}

    	

    	return view('admin.view_fleet',$fleetData+compact('title'));

    }

    public function EditFleetForm($id){

    	$title = 'Edit Master Fleet';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_fleet');
			$query->where('id', $id);
			$userData['fleet_list'] = $query->get()->first();


			$userData['user_list']= DB::table('master_depot')->get();

    		$userData['mfg_list']= DB::table('Master_Vehicle_Mfg')->get();

   			$userData['wheel_list']= DB::table('fleet_truck_wheel')->get();

			return view('admin.fleet_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');
		}
    }

    public function FleetFormUpdate(Request $request){$validate = $this->validate($request, [

			'truck_no'      => 'required|max:12',
			'regd_date'     => 'required',
			'make'    => 'required',
			'model'    => 'required',
			'depot_code' => 'required',
			'wheel_type'    => 'required',
			'load_capacity' => 'required',
			

		]);

        date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');


       $fleetId = $request->input('fleetIdId');
		$data = array(
			"truck_no"        => $request->input('truck_no'),
			"regd_date"       => $request->input('regd_date'),
			"make"      => $request->input('make'),
			"model"      => $request->input('model'),
			"location"        => $request->input('depot_code'),
			"wheels_type"     => $request->input('wheel_type'),
			"load_capacity"   => $request->input('load_capacity'),
			"last_update_by"   => $lastUpdatedBy,
			"last_updated_date" => $updatedDate,
			
		);

		
		$saveData = DB::table('master_fleet')->where('id',$fleetId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Was Successfully Updated...!');
			return redirect('/view-mast-fleet');

		} else {

			$request->session()->flash('alert-error', 'Fleet Can Not Updated...!');
			return redirect('/view-mast-fleet');

		}
    }


     public function DeleteFleet(Request $request){

    	$fleetId = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($fleetId!='') {
    		
    		$Delete = DB::table('master_fleet')->where('id', $fleetId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Was Deleted Successfully...!');
				return redirect('/view-mast-fleet');

			} else {

				$request->session()->flash('alert-error', 'Fleet Can Not Deleted...!');
				return redirect('/view-mast-fleet');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Not Found...!');
			return redirect('/view-mast-fleet');

    	}
    }


     public function UserForm(Request $request){

     	$title = 'Add Master User';
    	
    
    	return view('admin.user_form',compact('title'));
    }

    public function UserFormSave(Request $request)
    {
    	//print_r($request->post());
    	$validate = $this->validate($request, [

			'name'             => 'required',
			'user_name'        => 'required',
			'user_code'        => 'required',
			'password'         => 'required|min:4|same:confirm_password',
			'confirm_password' => 'required|min:4',
			'email_id'         => 'required|email',
			'user_type'        => 'required',
		
		]);

		$createdBy = $request->session()->get('userid');

		$utype = $request->input('user_type');

		if($utype=='Admin'){

		
			$data = array(
				"name"         => $request->input('name'),
				"username"         => $request->input('user_name'),
				"usercode"         => $request->input('user_code'),
				"password"         => md5($request->input('password')),
				"confirm_password" => $request->input('confirm_password'),
				"email_id"         => $request->input('email_id'),
				"user_type"        => $utype,
				"created_by"       => $createdBy,
			
			);

			$saveData = DB::table('master_user')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'User Was Successfully Added...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Added...!');
				return redirect('/view-mast-user');

			}


		}else if($utype=='superAdmin' || $utype=='user'){

			//seesion = $request->session()->get('usertype');
			

			$data = array(
				"name"         => $request->input('name'),
				"username"         => $request->input('user_name'),
				"usercode"         => $request->input('user_code'),
				"password"         => md5($request->input('password')),
				"confirm_password" => $request->input('confirm_password'),
				"email_id"         => $request->input('email_id'),
				"user_type"        => $utype,
				"created_by"       => $createdBy,
			
			);

			$saveData = DB::table('master_user')->insert($data);
			$MicrodotMasId = DB::getPdo()->lastInsertId(); 

			$newStart='1';
			$newEnd='8';

			$newStart1='9';
			$newEnd1='17';

			$newStart2='18';
			$newEnd2='23';

			$newStart3='24';
			$newEnd3='28';



		$Data['userid'] = $MicrodotMasId;	
	 
	   	$Data['form_name_list'] = DB::table('form_name')->whereBetween('id', [$newStart, $newEnd])->get()->toArray();

	    $Data['form_name_list1'] = DB::table('form_name')->whereBetween('id', [$newStart1, $newEnd1])->get()->toArray();

	    $Data['form_name_list2'] = DB::table('form_name')->whereBetween('id', [$newStart2, $newEnd2])->get()->toArray();

	    $Data['form_name_list3'] = DB::table('form_name')->whereBetween('id', [$newStart3, $newEnd3])->get()->toArray();
	        //print_r($Data['form_name_list']);exit;

			return view('admin.user_access',$Data);

		}



    }

    public function UserView(Request $request){

    	$title = 'View Master User';

    	$fleetData['user_list'] = DB::table('master_user')->orderBy('id','DESC')->get();

    	return view('admin.view_user',$fleetData+compact('title'));

    }

    public function EditUserForm($id){

    	$title = 'Edit Master User';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_user');
			$query->where('id', $id);
			$userData['user_list'] = $query->get()->first();

			return view('admin.user_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'User-Id Not Found...!');
			return redirect('/form-mast-user');
		}
    }


    public function UserFormUpdate(Request $request){
    	//print_r($request->post());
    	$validate = $this->validate($request, [

			'name'             => 'required',
			'user_name'        => 'required',
			'user_code'        => 'required',
			'email_id'         => 'required|email',
			'user_type'        => 'required',
			
		
		]);
		$lastUpdatedBy = $request->session()->get('userid');

    	$updatedDate = date('Y-m-d');

    	$utype = $request->input('user_type');

    	if($utype=='Admin'){

		$data = array(
					"name"              => $request->input('name'),
					"username"          => $request->input('user_name'),
					"usercode"          => $request->input('user_code'),
					
					"email_id"          => $request->input('email_id'),
					"user_type"         => $utype,
					
					"last_update_by"    => $lastUpdatedBy,
					
					"last_updated_date" => $updatedDate
		
		);

		$userId = $request->input('UserID');

		$saveData = DB::table('master_user')->where('id',$userId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'User Was Successfully Updated...!');
			return redirect('/view-mast-user');

		} else {

			$request->session()->flash('alert-error', 'User Can Not Updated...!');
			return redirect('/view-mast-user');

		}

	}else if($utype=='superAdmin' || $utype=='user'){


			$data = array(
					"name"             => $request->input('name'),
					"username"         => $request->input('user_name'),
					"usercode"         => $request->input('user_code'),
					
					"email_id"         => $request->input('email_id'),
					"user_type"        => $utype,
					
					"last_update_by"   => $lastUpdatedBy,
					
					"last_updated_date" => $updatedDate
		
		);

		$userId = $request->input('UserID');

		$saveData = DB::table('master_user')->where('id',$userId)->update($data);

			$newStart='1';
			$newEnd='8';

			$newStart1='9';
			$newEnd1='17';

			$newStart2='18';
			$newEnd2='23';

			$newStart3='24';
			$newEnd3='28';

		$Data['userid'] = $userId;	
	 
	    $Data['form_name_list'] = DB::table('form_name')->whereBetween('id', [$newStart, $newEnd])->get()->toArray();

	    $Data['form_name_list1'] = DB::table('form_name')->whereBetween('id', [$newStart1, $newEnd1])->get()->toArray();

	    $Data['form_name_list2'] = DB::table('form_name')->whereBetween('id', [$newStart2, $newEnd2])->get()->toArray();

	    $Data['form_name_list3'] = DB::table('form_name')->whereBetween('id', [$newStart3, $newEnd3])->get()->toArray();
	        
	    $Data['user_type_id'] = DB::table('master_form')->where('user_id', $userId)->get()->toArray();

		return view('admin.update_user_access',$Data);


		}



    }

    public function DeleteUser(Request $request){

    	$userId = $request->post('UserID');

    	if ($userId!='') {
    		
    		$Delete = DB::table('master_user')->where('id', $userId)->delete();

    		$Delete = DB::table('master_form')->where('user_id', $userId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'User Was Deleted Successfully...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Deleted...!');
				return redirect('/view-mast-user');

			}

    	}else{

    		$request->session()->flash('alert-error', 'User Not Found...!');
			return redirect('/view-mast-user');

    	}
    }


     public function FyForm(Request $request){

     	$title = 'Add Master Fy';
    	$data['comp_code'] = DB::table('master_comp')->get();
    
    	return view('admin.fy_form',$data+compact('title'));
    }

    public function FyFormSave(Request $request)
    {
    	//print_r($request->post());
    	$validate = $this->validate($request, [

			'company_code' => 'required',
			'fy_from_date' => 'required',
			'fy_to_date'   => 'required',
			'fy_code'      => 'required',
		
		]);

    	$createdBy = $request->session()->get('userid');

		$data = array(
			"comp_code"    => $request->input('company_code'),
			"fy_code"      => $request->input('fy_code'),
			"fy_from_date" => $request->input('fy_from_date'),
			"fy_to_date"   => $request->input('fy_to_date'),
			"created_by"   => $createdBy
			
		);

		$saveData = DB::table('master_fy')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fy Was Successfully Added...!');
			return redirect('/view-mast-fy');

		} else {

			$request->session()->flash('alert-error', 'Fy Can Not Added...!');
			return redirect('/view-mast-fy');

		}
    }

    public function FyView(Request $request){

		$title    = 'View Master Fy';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$fisYear  =  $request->session()->get('macc_year');

		$CompanyCode   = $request->session()->get('company_name');
		$getcompname = explode('-', $CompanyCode);
		$comp_code= $getcompname[1];

    	if($userType=='admin'){

    		$fleetData['fy_list'] = DB::table('master_fy')->orderBy('id','DESC')->get();

		}else if($userType=='superAdmin' || $userType=='user'){

			$fleetData['fy_list'] = DB::table('master_fy')->where(['created_by' => $userid])->get();

		}else{

			$fleetData['fy_list']='';
			
		}

    	return view('admin.view_fy',$fleetData+compact('title'));


    }

    public function EditFyForm($id){

    	$title = 'Edit Master Fy';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_fy');
			$query->where('id', $id);
			$userData['fy_list'] = $query->get()->first();
			$userData['comp_code'] = DB::table('master_comp')->get();

			return view('admin.fy_list', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Fy Not Found...!');
			return redirect('/view-mast-fy');
		}
    }


    public function FyFormUpdate(Request $request){
    	//print_r($request->post());exit();
    	$validate = $this->validate($request, [

			'company_code' => 'required',
			'fy_from_date' => 'required',
			'fy_to_date'   => 'required',
			'fy_code'      => 'required',
		
		]);

    	$lastUpdatedBy = $request->session()->get('userid'); 

    	$updatedDate = date('Y-m-d');

		$data = array(
			"comp_code"       => $request->input('company_code'),
			"fy_code"         => $request->input('fy_code'),
			"fy_from_date"    => $request->input('fy_from_date'),
			"fy_to_date"      => $request->input('fy_to_date'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate
			
		);

		$userId = $request->input('UserID');

		$saveData = DB::table('master_fy')->where('id',$userId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fy Was Successfully Updated...!');
			return redirect('/view-mast-fy');

		} else {

			$request->session()->flash('alert-error', 'Fy Can Not Updated...!');
			return redirect('/view-mast-fy');

		}
    }

    public function DeleteFy(Request $request){

    	$FyID = $request->post('FyID');
    	//print_r($destinationId);exit;

    	if ($FyID!='') {
    		
    		$Delete = DB::table('master_fy')->where('id', $FyID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Fy Was Deleted Successfully...!');
				return redirect('/view-mast-fy');

			} else {

				$request->session()->flash('alert-error', 'Fy Can Not Deleted...!');
				return redirect('/view-mast-fy');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fy Not Found...!');
			return redirect('/view-mast-fy');

    	}
    }


    public function CompanyForm(Request $request){

    	$title = 'Add Master Company';
    	
    	$data['state_list'] = DB::table('master_state')->get();

    	return view('admin.company_form',$data+compact('title'));
    }

    public function CompanyFormSave(Request $request)
    { 
    	
    	$validate = $this->validate($request, [

			'company_code'  => 'required',
			'company_name'  => 'required',
			'contact_no1'   => 'required',
			'contact_no2'   => 'required',
			'fax_no'        => 'required',
			'emailid'       => 'required',
			'address_one'   => 'required',
			'address_two'   => 'required',
			'address_three' => 'required',
			'pincode'       => 'required',
			'country_name'  => 'required',
			'state_code'    => 'required',
			'district'      => 'required',
			'city_code'     => 'required',
		
		]);

		$createdBy = $request->session()->get('userid');
		$fisYear =  $request->session()->get('macc_year');

		$data = array(
			"comp_code"   => $request->input('company_code'),
			"comp_name"   => $request->input('company_name'),
			"fiscal_year" => $fisYear,
			"add1"        => $request->input('address_one'),
			"add2"        => $request->input('address_two'),
			"add3"        => $request->input('address_three'),
			"country"     => $request->input('country_name'),
			"state"       => $request->input('state_code'),
			"district"    => $request->input('district'),
			"city"        => $request->input('city_code'),
			"pin_code"    => $request->input('pincode'),
			"phone1"      => $request->input('contact_no1'),
			"phone2"      => $request->input('contact_no2'),
			"fax_no"      => $request->input('fax_no'),
			"email_id"    => $request->input('emailid'),
			"created_by"  => $createdBy
			
		);

		$saveData = DB::table('master_comp')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Company Was Successfully Added...!');
			return redirect('/view-mast-company');

		} else {

			$request->session()->flash('alert-error', 'Company Can Not Added...!');
			return redirect('/view-mast-company');

		}
    }

    public function CompanyView(Request $request){

    	$title = 'View Master Company';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	$exp = explode("-",$compName);

    	$compName1 =  $exp[1];


    	if($userType=='admin'){

    	$companyData['company_list'] = DB::table('master_comp')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$companyData['company_list'] = DB::table('master_comp')->where(['created_by' => $userid])->get();
			
		}
		else{

			$companyData['company_list']='';
			
		}
    	return view('admin.view_company',$companyData+compact('title'));

    }

    public function EditCompanyForm($id){

    	$title = 'Edit Master Company';

    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_comp');
			$query->where('id', $id);
			$compData['comp_list'] = $query->get()->first();
			$compData['state_list'] = DB::table('master_state')->get();

			return view('admin.company_list', $compData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/form-mast-user');
		}
    }


    public function CompanyFormUpdate(Request $request){
    	
    	$validate = $this->validate($request, [

			'company_code'  => 'required',
			'company_name'  => 'required',
			'contact_no1'   => 'required',
			'contact_no2'   => 'required',
			'fax_no'        => 'required',
			'emailid'       => 'required',
			'address_one'   => 'required',
			'address_two'   => 'required',
			'address_three' => 'required',
			'pincode'       => 'required',
			'country_name'  => 'required',
			'state_code'    => 'required',
			'district'      => 'required',
			'city_code'     => 'required',
		
		]);

    	$companyId = $request->input('companyId');

    	$lastUpdatedBy = $request->session()->get('userid');

    	$updatedDate = date('Y-m-d');

		$data = array(
			"comp_code"       => $request->input('company_code'),
			"comp_name"       => $request->input('company_name'),
			"phone1"          => $request->input('contact_no1'),
			"phone2"          => $request->input('contact_no2'),
			"email_id"        => $request->input('emailid'),
			"add1"            => $request->input('address_one'),
			"add2"            => $request->input('address_two'),
			"add3"            => $request->input('address_three'),
			"pin_code"        => $request->input('pincode'),
			"country"         => $request->input('country_name'),
			"state"           => $request->input('state_code'),
			"district"        => $request->input('district'),
			"city"            => $request->input('city_code'),
			"fax_no"          => $request->input('fax_no'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate
			
		);

      $saveData = DB::table('master_comp')->where('id',$companyId)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'Company Was Successfully Added...!');
			return redirect('/view-mast-company');

		} else {

			$request->session()->flash('alert-error', 'Company Can Not Added...!');
			return redirect('/view-mast-company');

		}
    }

    public function DeleteCompany(Request $request){

    	$CompanyID = $request->post('CompanyID');
    	
    	if ($CompanyID!='') {
    		
    		$Delete = DB::table('master_comp')->where('id', $CompanyID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Company Was Deleted Successfully...!');
				return redirect('/view-mast-company');

			} else {

				$request->session()->flash('alert-error', 'Company Can Not Deleted...!');
				return redirect('/view-mast-company');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Company Not Found...!');
			return redirect('/view-mast-company');

    	}
    }


    public function UmForm(Request $request){

    	$title = 'Add Master Um';
    
    	return view('admin.um_form',compact('title'));
    }

    public function UmFormSave(Request $request){

    	$validate = $this->validate($request, [

			'um_code'    => 'required',
			'um_name'    => 'required',
			
		]);

    	$createdBy = $request->session()->get('userid');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"um_code"     => $request->input('um_code'),
			"um_name"     => $request->input('um_name'),
			"created_by"  => $createdBy
			
		);

		$saveData = DB::table('master_um')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Um Was Successfully Added...!');
			return redirect('/view-mast-um');

		} else {

			$request->session()->flash('alert-error', 'Um Can Not Added...!');
			return redirect('/view-mast-um');

		}

    }

    public function UmView(Request $request){

    	$title = 'View Master Um';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		$umData['um_list'] = DB::table('master_um')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$umData['um_list'] = DB::table('master_um')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();

			
		}else{

			$umData['um_list']='';
			
		}

    	

    	return view('admin.view_um',$umData+compact('title'));

    }

    public function EditUmForm($id){

    	$title = 'Edit Master Um';

    	$id = base64_decode($id);
    	//print_r($id);
    	if($id!=''){
    	    $query = DB::table('master_um');
			$query->where('id', $id);
			$umData['um_list'] = $query->get()->first();

			return view('admin.um_list', $umData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Um Not Found...!');
			return redirect('/form-mast-um');
		}

    }

    public function UmFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'um_code'    => 'required',
			'um_name'    => 'required',
			
		]);

		$lastUpdatedBy = $request->session()->get('userid');
		$updatedDate = date('Y-m-d');

    	$umId = $request->input('umId');
		$data = array(
			"um_code"      => $request->input('um_code'),
			"um_name"      => $request->input('um_name'),
			"updated_by"   => $lastUpdatedBy,
			"updated_date" => $updatedDate
			
			
		);

		 $saveData = DB::table('master_um')->where('id',$umId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Um Was Successfully Added...!');
			return redirect('/view-mast-um');

		} else {

			$request->session()->flash('alert-error', 'Um Can Not Added...!');
			return redirect('/view-mast-um');

		}
    }

    public function DeleteUm(Request $request){

    	$UmID = $request->post('UmID');

    	if ($UmID!='') {
    		
    		$Delete = DB::table('master_um')->where('id', $UmID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Um Was Deleted Successfully...!');
				return redirect('/view-mast-um');

			} else {

				$request->session()->flash('alert-error', 'Um Can Not Deleted...!');
				return redirect('/view-mast-um');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Um Not Found...!');
			return redirect('/view-mast-um');

    	}
    }


    public function ItemForm(Request $request){

    	$title = 'Add Master Item';
    
    	return view('admin.item_form',compact('title'));
    }

    public function ItemFormSave(Request $request){

    	$validate = $this->validate($request, [

			'item_code' => 'required',
			'item_name' => 'required',
			'um'        => 'required',
			'aum'       => 'required',
			
		]);

		
		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"item_code"   => $request->input('item_code'),
			"item_name"   => $request->input('item_name'),
			"um"          => $request->input('um'),
			"aum"         => $request->input('aum'),
			"created_by"  => $createdBy
			
			
		);

		$saveData = DB::table('master_item')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Was Successfully Added...!');
			return redirect('/view-mast-item');

		} else {

			$request->session()->flash('alert-error', 'Item Can Not Added...!');
			return redirect('/view-mast-item');

		}

    }

    public function ItemView(Request $request){

		$title    = 'View Master Item';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    		$itemData['item_list'] = DB::table('master_item')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$itemData['item_list'] = DB::table('master_item')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();
			
		}else{

			$itemData['item_list'] ='';
			
		}

    	

    	return view('admin.view_item',$itemData+compact('title'));

    }

    public function EditItemForm($id){

    	$title = 'Edit Master Item';

    	$id = base64_decode($id);
    	//print_r($id);
    	if($id!=''){
    	    $query = DB::table('master_item');
			$query->where('id', $id);
			$itemData['item_list'] = $query->get()->first();

			return view('admin.item_list', $itemData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/view-mast-item');
		}

    }

    public function ItemFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'item_code' => 'required',
			'item_name' => 'required',
			'um'        => 'required',
			'aum'       => 'required',
			
		]);

    	$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');
    	$itemId = $request->input('itemId');

		$data = array(
			"item_code"       => $request->input('item_code'),
			"item_name"       => $request->input('item_name'),
			"um"              => $request->input('um'),
			"aum"             => $request->input('aum'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" =>$updatedDate
			
			
		);


      $saveData = DB::table('master_item')->where('id',$itemId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Was Successfully Updated...!');
			return redirect('/view-mast-item');

		} else {

			$request->session()->flash('alert-error', 'Item Can Not Updated...!');
			return redirect('/view-mast-item');

		}
    }

    public function DeleteItem(Request $request){

    	$ItemID = $request->post('ItemID');
    	//print_r($destinationId);exit;

    	if ($ItemID!='') {
    		
    		$Delete = DB::table('master_item')->where('id', $ItemID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Item Was Deleted Successfully...!');
				return redirect('/view-mast-item');

			} else {

				$request->session()->flash('alert-error', 'Item Can Not Deleted...!');
				return redirect('/view-mast-item');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/view-mast-item');

    	}
    }


    public function ItemUmForm(Request $request){

    	 $title = 'Add Master Item Um';
    	
    	 $data['item_code'] = DB::table('master_item')->get();
    	 $data['um_code'] = DB::table('master_um')->get();
    	return view('admin.itemum_form',$data+compact('title'));
    }

    public function ItemUmFormSave(Request $request){

    	$validate = $this->validate($request, [

			'item_code'  => 'required',
			'um_code'    => 'required',
			'aum'        => 'required',
			'aum_factor' => 'required',
			
		]);

		$createdby = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"item_code"   => $request->input('item_code'),
			"um_code"     => $request->input('um_code'),
			"aum"         => $request->input('aum'),
			"aum_factor"  => $request->input('aum_factor'),
			"created_by"  => $createdby
		);

		$saveData = DB::table('master_itemum')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item UM Was Successfully Added...!');
			return redirect('/view-mast-itemum');

		} else {

			$request->session()->flash('alert-error', 'Item UM Can Not Added...!');
			return redirect('/view-mast-itemum');

		}

    }

    public function ItemUmView(Request $request){

    	$title = 'View Item Um';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		$itemData['itemum_list'] = DB::table('master_itemum')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$itemData['itemum_list'] = DB::table('master_itemum')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();

		}else{

			$itemData['itemum_list'] ='';
			
		}

    	return view('admin.view_itemum',$itemData+compact('title'));


    }



    public function EditItemUmForm($id){

    	$title = 'Edit Item Um';

    	$id = base64_decode($id);
    	//print_r($id);
    	if($id!=''){
    	    $query = DB::table('master_itemum');
			$query->where('id', $id);
			$itemData['itemum_list'] = $query->get()->first();

			$itemData['item_code'] = DB::table('master_item')->get();
    	    $itemData['um_code'] = DB::table('master_um')->get();

			return view('admin.itemum_list', $itemData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/form-mast-itemum');
		}

    }

    public function ItemUmFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'item_code'  => 'required',
			'um_code'    => 'required',
			'aum'        => 'required',
			'aum_factor' => 'required',
			
		]);

		$itemumId = $request->input('itemumId');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"item_code"    => $request->input('item_code'),
			"um_code"      => $request->input('um_code'),
			"aum"          => $request->input('aum'),
			"aum_factor"   => $request->input('aum_factor'),
			"updated_by"   => $lastUpdatedBy,
			"updated_date" => $updatedDate			
			
			
		);

		
		$saveData = DB::table('master_itemum')->where('id',$itemumId)->update($data);


		if ($saveData) {

			$request->session()->flash('alert-success', 'Item UM Was Successfully Added...!');
			return redirect('/view-mast-itemum');

		} else {

			$request->session()->flash('alert-error', 'Item UM Can Not Added...!');
			return redirect('/view-mast-itemum');

		}
    }

    public function DeleteItemUm(Request $request){

    	$ItemumID = $request->post('ItemumID');
    	//print_r($ItemumID);exit;

    	if ($ItemumID!='') {
    		
    		$Delete = DB::table('master_itemum')->where('id', $ItemumID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Item UM Was Deleted Successfully...!');
				return redirect('/view-mast-itemum');

			} else {

				$request->session()->flash('alert-error', 'Item UM Can Not Deleted...!');
				return redirect('/view-mast-itemum');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/view-mast-itemum');

    	}
    }


    public function RateForm(Request $request){

    	 $title = 'Add Master Rate';
    	
    	 $data['depot_code']       = DB::table('master_depot')->get();

    	 $data['destination_code'] = DB::table('master_area')->get();

    	 $data['wheel_list']= DB::table('fleet_truck_wheel')->get();

    	return view('admin.rate_form',$data+compact('title'));
    }

    public function RateFormSave(Request $request){

    	$validate = $this->validate($request, [

			'depot_code'   => 'required',
			'area_code'    => 'required',
			'fy_from_date' => 'required',
			'fy_to_date'   => 'required',
			'rate'         => 'required',
			'wheel_type'   => 'required',
			'overload'     => 'required',
			
		]);

		
		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');

		$data = array(

			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"depot_plant" => $request->input('depot_code'),
			"area_code"   => $request->input('area_code'),
			"from_date"   => $request->input('fy_from_date'),
			"to_date"     => $request->input('fy_to_date'),
			"rate"        => $request->input('rate'),
			"wheel_type"  => $request->input('wheel_type'),
			"overload"    => $request->input('overload'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_rate')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Rate Was Successfully Added...!');
			return redirect('/view-mast-rate');

		} else {

			$request->session()->flash('alert-error', 'Rate Can Not Added...!');
			return redirect('/view-mast-rate');

		}

    }

    public function RateView(Request $request){

		$title    = 'View Master Rate';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    	$rateData['rate_list'] = DB::table('master_rate')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$rateData['rate_list'] = DB::table('master_rate')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();

			
		}
		else{

			$rateData['rate_list'] ='';
			
		}

    	return view('admin.view_rate',$rateData+compact('title'));

    }

    public function EditRateForm($id){

    	$title = 'Edit Master Rate';

    	$id = base64_decode($id);
    	//print_r($id);
    	if($id!=''){
				$query = DB::table('master_rate');
				$query->where('id', $id);
				$rateData['rate_list']  = $query->get()->first();
				
				$rateData['depot_code']       = DB::table('master_depot')->get();
				
				$rateData['destination_code'] = DB::table('master_area')->get();

				$rateData['wheel_list']= DB::table('fleet_truck_wheel')->get();

			return view('admin.rate_list', $rateData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Item Not Found...!');
			return redirect('/view-mast-rate');
		}

    }

    public function RateFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'depot_code'       => 'required',
			'destination_code' => 'required',
			'fy_from_date'     => 'required',
			'fy_to_date'       => 'required',
			'rate'             => 'required',
			'wheel_type'       => 'required',
			'overload'         => 'required',
			
		]);

		$rateId = $request->input('rateId');

		

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"depot_plant"     => $request->input('depot_code'),
			"area_code"       => $request->input('destination_code'),
			"from_date"       => $request->input('fy_from_date'),
			"to_date"         => $request->input('fy_to_date'),
			"rate"            => $request->input('rate'),
			"wheel_type"      => $request->input('wheel_type'),
			"overload"        => $request->input('overload'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);

		
		$saveData = DB::table('master_rate')->where('id',$rateId)->update($data);


		if ($saveData) {

			$request->session()->flash('alert-success', 'Rate Was Successfully Updated...!');
			return redirect('/view-mast-rate');

		} else {

			$request->session()->flash('alert-error', 'Rate Can Not Updated...!');
			return redirect('/view-mast-rate');

		}
    }

    public function DeleteRate(Request $request){

    	$RateID = $request->post('RateID');
    	//print_r($ItemumID);exit;

    	if ($RateID!='') {
    		
    		$Delete = DB::table('master_rate')->where('id', $RateID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Rate Was Deleted Successfully...!');
				return redirect('/view-mast-rate');

			} else {

				$request->session()->flash('alert-error', 'Rate Can Not Deleted...!');
				return redirect('/view-mast-rate');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Rate Not Found...!');
			return redirect('/view-mast-rate');

    	}
    }




     public function AccountTypeForm(Request $request){

     	$title = 'Add Master A Type';

    	return view('admin.account_type_form',compact('title'));
    }

    public function AccountTypeFormSave(Request $request){

 	//print_r($request->post());exit;
    	$validate = $this->validate($request, [

			'acc_type_code' => 'required',
			'acc_type_name' => 'required',	
			
		]);

		$createdBy = $request->session()->get('userid');
		
		$compName  = $request->session()->get('company_name');
		
		$fisYear   =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"acctype_code" => $request->input('acc_type_code'),
			"acctype_name" => $request->input('acc_type_name'),
			"created_by"   => $createdBy
			
		);

		$saveData = DB::table('master_acctype')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Type Was Successfully Added...!');
			return redirect('/view-mast-account-type');

		} else {

			$request->session()->flash('alert-error', 'Account Type Can Not Added...!');
			return redirect('/view-mast-account-type');

		}

    }

    public function AccountTypeView(Request $request){

    	$title = 'View Master Account Type';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		$acclistData['acc_type_list'] = DB::table('master_acctype')->orderBy('id','DESC')->get();

    	 
		}else if($userType=='superAdmin' || $userType=='user'){

			$acclistData['acc_type_list'] = DB::table('master_acctype')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->get();

		}else{

			$acclistData['acc_type_list'] ='';
			
		}

    	
    	return view('admin.view_account_type',$acclistData+compact('title'));


    }

    public function EditAccountTypeForm($id){

    	$title = 'Edit Master Account Type';

    	$id = base64_decode($id);
    	//print_r($id);
    	if($id!=''){
				$query = DB::table('master_acctype');
				$query->where('id', $id);
				$acctypeData['acctype_list']  = $query->get()->first();
				
			return view('admin.account_type_list', $acctypeData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Account Type Not Found...!');
			return redirect('/view-mast-account-type');
		}

    }

    public function AccountTypeFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'acc_type_code' => 'required',
			'acc_type_name' => 'required',	
			
		]);

		$acctypeId = $request->input('acctypeId');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"acctype_code"    => $request->input('acc_type_code'),
			"acctype_name"    => $request->input('acc_type_name'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate
			
		);

		$saveData = DB::table('master_acctype')->where('id',$acctypeId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Account Type Was Successfully Update...!');
			return redirect('/view-mast-account-type');

		} else {

			$request->session()->flash('alert-error', 'Account Type Can Not Update...!');
			return redirect('/view-mast-account-type');

		}
    }

    public function DeleteAccountType(Request $request){

    	$acctypeID = $request->post('acctypeID');
    	//print_r($ItemumID);exit;

    	if ($acctypeID!='') {
    		
    		$Delete = DB::table('master_acctype')->where('id', $acctypeID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Account Type Was Deleted Successfully...!');
				return redirect('/view-mast-account-type');

			} else {

				$request->session()->flash('alert-error', 'Account Type Can Not Deleted...!');
				return redirect('/view-mast-account-type');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Account Type Found...!');
			return redirect('/view-mast-account-type');

    	}
    }

    public function OutwardView(Request $request){

    $title = 'Outward Dispatch Register';

    $Data['depot_list'] = DB::table('master_depot')->get();

    $Data['dealer_list'] = DB::table('master_acc')->get();

    $Data['transporter_list'] = DB::table('master_transporter')->get();

  /*  $Data['Alldata'] = DB::select("SELECT despatch.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM despatch 
			left JOIN master_depot ON master_depot.depot_code =despatch.depot 
			left JOIN master_acc ON master_acc.acc_code =despatch.party 
			left JOIN master_transporter ON master_transporter.code =despatch.transporter");
		$company_name 	= $request->session()->get('company_name');

    	$macc_year 		= $request->session()->get('macc_year');*/

    	$Data['Alldata1'] = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code");



    	//print_r($Data['Alldata']);exit;
		$company_name 	= $request->session()->get('company_name');

    	$macc_year 		= $request->session()->get('macc_year');

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

   /* $strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date' and `comp_code`='$company_name'";*/
    $strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date'";

    $Data['Alldata']=DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");
  /*  echo '<pre>';
    print_r($Data['Alldata']);exit;*/
    

    	return view('admin.view_outward_dispatch',$Data+compact('title'));

    }

    public function OutwardSerach(Request $request){

    	//print_r($request->input('depot'));exit;
		$depot      = $request->input('depot');
		$party      = $request->input('party');
		$from_date  = $request->input('from_date');
		$to_date    = $request->input('to_date');
		$transporter = $request->input('trans_code');
		$btnsearch  = $request->input('btnsearch');

		//print_r($btnsearch);exit;

		if(isset($btnsearch)!='')
		{
			if(isset($from_date)  && trim($from_date)!="")
	      {
	      $strWhere="  AND `tr_date` BETWEEN '$from_date' and  '$to_date'";
	      }

    	if(isset($depot)  && trim($depot)!="")
			{
				$strWhere="  AND   outward_trans.depot_code= '$depot'";
			}

		if(isset($party)  && trim($party)!="")
			{
				$strWhere=" AND   outward_trans.acc_code= '$party'";
			}

		if(isset($transporter)  && trim($transporter)!="")
	      {
	      $strWhere=" AND   outward_trans.trans_code='$transporter'";

	      }

		}else
		{
		 $strWhere=" AND   outward_trans.id=''";
		}

            $getdate = DB::select("SELECT outward_trans.*, master_depot.depot_name as depot_name,master_acc.acc_name as party_name FROM outward_trans 
			left JOIN master_depot ON master_depot.depot_code =outward_trans.depot_code 
			left JOIN master_acc ON master_acc.acc_code =outward_trans.acc_code 
			left JOIN master_transporter ON master_transporter.code =outward_trans.trans_code where 1=1  $strWhere");
          
            //print_r($getdate);exit;
             $sr=1;
			foreach($getdate as $key){

			  $depot_name=$key->depot_name;
			  $party_name=$key->party_name;
			  $date=$key->tr_date;
			  $challan_no=$key->chalan_no;
			  $destination=$key->area_code;
			  $vehicle_no=$key->truck_no;
			  $qty_mt=$key->desp_qty;
			  $qty_bag=$key->desp_aqty;
			  $transporter=$key->trans_code;


			$nestedData   = array();
          
            $nestedData[] = $sr++;
            $nestedData[] = $depot_name;
            $nestedData[] = $party_name;
            $nestedData[] = $date;
            $nestedData[] = $challan_no;
            $nestedData[] = $destination;
            $nestedData[] = $vehicle_no;
            $nestedData[] = $qty_mt;
            $nestedData[] = $qty_bag;
            $nestedData[] = $transporter;
            $data[]       = $nestedData;
			 
			
			}
	$output = array(
            "data" => $data
        );
	
	echo json_encode($output);
			
			
    	
    }

     public function accessControl(Request $request){

    	$name1 = $request->input('name1');
    	$userid = $request->input('userid');
    	
        $count =count($name1);
        //print_r($userid);
        $saveData ='';
        for ($i=0; $i < $count ; $i++) { 

        	$data=array(

        		'user_id'=>$userid,
        		'form_name_id'=>$name1[$i],

    			);
        	
        $saveData = DB::table('master_form')->insert($data);

			
        }


            if ($saveData) {

				$request->session()->flash('alert-success', 'User Was Successfully Added...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Added...!');
				return redirect('/view-mast-user');

			}

    }

    public function accessUpdateControl(Request $request){
    	$name1 = $request->input('name1');
    	$userid = $request->input('userid');

    	if ($userid!='') {
    		
    	$Delete = DB::table('master_form')->where('user_id',$userid)->delete();
    	}
    	
        $count =count($name1);
        //print_r($userid);
        $saveData ='';
        for ($i=0; $i < $count ; $i++) { 

        	$data=array(

        		'user_id'=>$userid,
        		'form_name_id'=>$name1[$i],

    			);
      

	   $saveData = DB::table('master_form')->insert($data);
        }

        

            if ($saveData) {

				$request->session()->flash('alert-success', 'User Was Successfully Update...!');
				return redirect('/view-mast-user');

			} else {

				$request->session()->flash('alert-error', 'User Can Not Update...!');
				return redirect('/view-mast-user');

			}

    }


/*fleet truck wheel master*/

	public function FleetTruckWheelForm(Request $request){
    	
    	$title ='Add Master Fleet Truck Wheel';
    	return view('admin.fleet_truck_wheel_form',compact('title'));
    }


    public function FleetTruckWhelSave(Request $request){

    	$validate = $this->validate($request, [

			'wheel_code'    => 'required|max:12',
			'wheel_name'    => 'required',

		]);

    	$createdBy = $request->session()->get('userid');

    	$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"wheel_code"  => $request->input('wheel_code'),
			"wheel_name"  => $request->input('wheel_name'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('fleet_truck_wheel')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Fleet Truck Wheel Was Successfully Added...!');
			return redirect('/view-flet-truck-wheel');

		} else {

			$request->session()->flash('alert-error', 'Fleet Truck Wheel Can Not Added...!');
			return redirect('/view-flet-truck-wheel');

		}
    	
    	

    }


    public function FleetTruckWhelView(Request $request){

    	$title    = 'View Fleet Truck Wheel';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		$depotData['fleettruck_list'] = DB::table('fleet_truck_wheel')->orderBy('id','DESC')->get();


		}else if($userType=='superAdmin' || $userType=='user'){

			$depotData['fleettruck_list'] = DB::table('fleet_truck_wheel')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();

			//return view('admin.view_dealer',$dealerData);
		}
		else{

			$depotData['fleettruck_list']='';
			//return view('admin.view_dealer',$dealerData);
		}


    	

    	return view('admin.view_flet_truck_whel',$depotData+compact('title'));
    }

    public function EditFleetTruckWhel($id){

    	//print_r($id);
    	$id=base64_decode($id);
    	if($id!=''){
    	    $query = DB::table('fleet_truck_wheel');
			$query->where('id', $id);
			$userData['editfleet_truc'] = $query->get()->first();

			return view('admin.flet_truck_whel_list', $userData);
		}else{
			$request->session()->flash('alert-error', 'Fleet Truck Wheel-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }


    public function fletTrucWhelUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'wheel_code'    => 'required|max:12',
			'wheel_name'    => 'required',

		]);

		$whelId=$request->input('whelID');
		//print_r($request->post());exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"wheel_code"      => $request->input('wheel_code'),
			"wheel_name"      => $request->input('wheel_name'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);
		

		$saveData = DB::table('fleet_truck_wheel')->where('id', $whelId)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'fleet Truck Wheel Was Successfully Updated...!');
			return redirect('/view-flet-truck-wheel');

		} else {

			$request->session()->flash('alert-error', 'fleet Truck Wheel Can Not Updated...!');
			return redirect('/view-flet-truck-wheel');

		}
    }


    public function DeleteFletTruckWhel(Request $request){

    	$fleetId = $request->post('FleetID');
    	//print_r($destinationId);exit;

    	if ($fleetId!='') {
    		
    		$Delete = DB::table('fleet_truck_wheel')->where('id', $fleetId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Fleet Truck Wheel Was Deleted Successfully...!');
				return redirect('/view-flet-truck-wheel');

			} else {

				$request->session()->flash('alert-error', 'Fleet Truck Wheel Can Not Deleted...!');
				return redirect('/view-flet-truck-wheel');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }


/*fleet truck wheel master*/



/*manufacturing master*/


	public function MastManufacturingForm(Request $request){
    	
    	return view('admin.manufacturing_form');
    }

    public function ManufaturSave(Request $request){

    	$validate = $this->validate($request, [

			'vehicle_mfg_code'    => 'required|max:12',
			'vehicle_mfg_name'    => 'required',

		]);

    	$createdBy = $request->session()->get('userid');

    	$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');

		$data = array(

			"comp_name"        => $compName,
			"fiscal_year"      => $fisYear,
			"vehicle_mfg_code" => $request->input('vehicle_mfg_code'),
			"vehicle_mfg_name" => $request->input('vehicle_mfg_name'),
			"created_by"       => $createdBy,
			
		);

		$saveData = DB::table('Master_Vehicle_Mfg')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Manufature Was Successfully Added...!');
			return redirect('/view-manufature');

		} else {

			$request->session()->flash('alert-error', 'Manufature Can Not Added...!');
			return redirect('/view-manufature');

		}
    	
    }

    public function manufatureView(Request $request){

    	$title    = 'View Fleet Truck Wheel';
		
		$userid   = $request->session()->get('userid');
		
		$userType = $request->session()->get('usertype');
		
		$compName = $request->session()->get('company_name');
		
		$fisYear  =  $request->session()->get('macc_year');


    	if($userType=='admin'){

    		$depotData['manufacture_list'] = DB::table('Master_Vehicle_Mfg')->orderBy('id','DESC')->get();


		}else if($userType=='superAdmin' || $userType=='user'){

			$depotData['manufacture_list'] = DB::table('Master_Vehicle_Mfg')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
			
		}
		else{

			$depotData['manufacture_list']='';
			
		}

    	return view('admin.view_manufature',$depotData);

    }


     public function Deletemanufature(Request $request){

    	$MfgId = $request->post('mfgId');
    	//print_r($destinationId);exit;

    	if ($MfgId!='') {
    		
    		$Delete = DB::table('Master_Vehicle_Mfg')->where('id', $MfgId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Manufature Was Deleted Successfully...!');
				return redirect('/view-manufature');

			} else {

				$request->session()->flash('alert-error', 'Manufature Can Not Deleted...!');
				return redirect('/view-manufature');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Fleet Truck Wheel Not Found...!');
			return redirect('/view-flet-truck-wheel');

    	}
    }

    public function EditManufactur($id){

    	//print_r($id);
    	$id=base64_decode($id);
    	if($id!=''){
    	    $query = DB::table('Master_Vehicle_Mfg');
			$query->where('id', $id);
			$userData['edit_manufactur'] = $query->get()->first();

			return view('admin.manufactur_list', $userData);
		}else{
			$request->session()->flash('alert-error', 'Manufacturing-Id Not Found...!');
			return redirect('/form-mast-depot');
		}

    }

    public function ManufacturUpdate(Request $request){

    	//print_r($request->post());exit;

    	$validate = $this->validate($request, [

			'vehicle_mfg_code'    => 'required|max:12',
			'vehicle_mfg_name'    => 'required',

		]);

		$mfg_id=$request->input('MfgID');
		//print_r($request->post());exit;

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$lastUpdatedBy = $request->session()->get('userid');

		$data = array(
			"vehicle_mfg_code"      => $request->input('vehicle_mfg_code'),
			"vehicle_mfg_name"      => $request->input('vehicle_mfg_name'),
			"last_updat_by"   => $lastUpdatedBy,
			"last_updat_date" => $updatedDate,
			
		);
		

		$saveData = DB::table('Master_Vehicle_Mfg')->where('id', $mfg_id)->update($data);
		if ($saveData) {

			$request->session()->flash('alert-success', 'MAnufacturing Was Successfully Updated...!');
			return redirect('/view-manufature');

		} else {

			$request->session()->flash('alert-error', 'MAnufacturing Can Not Updated...!');
			return redirect('/view-manufature');

		}
    }

/*manufacturing master*/

}
