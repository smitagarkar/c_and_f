<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;

class MyAdminController extends Controller{

	public function __cunstruct(){

	}


    public function index(Request $request){
 
    	return view('admin.login');
    }

    

    public function login(Request $request){

    	$validate = $this->validate($request, [

			'username' => 'required',
			'password' => 'required|min:4',

		]);

		$username 	= $request->input('username');
		$pass 		= md5($request->input('password'));

		$UserLogin 	= DB::table('master_user')->where('username', $username)->where('password', $pass)->get();

		if ($UserLogin->isEmpty()) {


			return back()->with('error', 'Wrong Login Details');

		}else{


			foreach ($UserLogin as $row) {
				
				$username = $row->username;
				$userid = $row->id;
				$userType = $row->user_type;
				$name = $row->name;

			}

			$session = array(
				'name'       => $name,
				'userid'     => $userid,
				'username'   => $username,
				'usertype'   => $userType,
				'last_login' => time(),
				'flag'       => 1,
				'login'      => TRUE
		    );

			$request->session()->put($session);

			$masterForm = DB::table('master_form')->where('user_id', $userid)->get();

			$FormName = [];
			foreach ($masterForm as $key) {

				$Fid = $key->form_name_id;

				$FormName[] = DB::table('form_name')->where('id', $Fid)->get();

			}

			$countF = count($FormName);


			for ($i=0; $i < $countF ; $i++) { 
				
				foreach ($FormName[$i] as $row1) {

					$form_name = $row1->form_name;

					$request->session()->push('form_name', $form_name);

				
				}
				

			}


			return redirect('/check-compny');
		}		


    }

    public function CheckCompny(Request $request){

    	$title = 'Check Company';

    	$data['comp_name'] = DB::table('master_comp')->get();

           return view('admin.check_compny',$data+compact('title'));

    }

    public function GetCompny(Request $request){

    	 $cmp_name = $request->post('comp_name');
    	 //print_r($cmp_name);exit();

    	$explode = explode('-', $cmp_name);

    	$getcom_code = $explode[0];

    	$getyear = DB::table('master_fy')->where('comp_code',$getcom_code)->get();
    	//print_r($getyear);exit;

      
      if(!empty($getyear))
      {
        $response = '<option value="">Select Year</option>';
        foreach ($getyear as $row) 
        {
          $response .= '<option value="'.$row->fy_code.'">'.$row->fy_code.'</option>';
        }
      }
      else
      {
        $response = '<option value="">Select Year</option>';
      }
      echo $response;exit; 

    }

    public function CompanySubmit(Request $request){

    	$validate = $this->validate($request, [

			'company_name' 	=> 'required',
			'macc_year' 	=> 'required',

		]);

    	$company_name = $request->input('company_name');
    	//print_r($company_name);exit;
    	$macc_year = $request->input('macc_year');

    	$session = array(
				'company_name' 	=> $company_name,
				'macc_year' 	=> $macc_year,
		    );

		$request->session()->put($session);

		

		
    	return redirect('/dashboard');
    }

    public function Dashboard(Request $request){

    	$title='C & F Management System';

    	$usrID 			= $request->session()->get('username');

    	$login 			= $request->session()->get('login');

    	$company_name 	= $request->session()->get('company_name');

    	$macc_year 		= $request->session()->get('macc_year');

    	if($login == TRUE && $company_name!='' && $macc_year!=''){

    		$usrID 		= $request->session()->get('userid');
    		$user_data 	= DB::table('master_user')->where('id', $usrID)->get()->first();

    		$session1 = array(
				'name' 	=> $user_data->name,
				'username' 	=> $user_data->username,
				'user_type' 	=> $user_data->user_type,
				'email_id' 	=> $user_data->email_id,
				'password' 	=> $user_data->password,
				'usercode' 	=> $user_data->usercode,
		    );

		$request->session()->put($session1);


    	//echo '<pre>';	print_r($data); echo '</pre>'; exit; 

    		return view('admin.dashboard',compact('title'));
    	
    	}else{

    		Auth::logout();
			$request->session()->flush();
			$request->session()->regenerate();
			return redirect('/');

    	}
    	
    	
    }

    

    public function Logout(Request $request) {

		Auth::logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/');
	}

/*dashboard link pages*/	

    public function actualStock(Request $request){

    	$sql_depopt= "SELECT receipt_view_1.Depot,receipt_view_1.item 
	FROM `receipt_view_1` 
	left join dispatch_view_2 on dispatch_view_2.month_recept=receipt_view_1.month_std_month 
	group by receipt_view_1.Depot,receipt_view_1.item
	order by month_std_month,receipt_view_1.Depot,receipt_view_1.item ";

	$sql_depopt = DB::select($sql_depopt);

	$data['depot_list']=$sql_depopt;

$actualStoc=[];
$depot_name='';
	foreach ($sql_depopt as $key) {

		$depot_code = $key->Depot;
		$item_code = $key->item;

		$depot	= DB::table('master_depot')->where('depot_code', $depot_code)->get()->first();

	if(isset($depot)){

	     $depot_name = $depot->depot_name;
		}
		else{
			$depot_name='';
		}
		
	
    	$sql = "(SELECT month_std_month,reciept_qty_mt,month_recept,dispatch_qty_mt,(reciept_qty_mt-dispatch_qty_mt) as closing1 , receipt_view_1.Depot,receipt_view_1.item FROM `receipt_view_1` LEFT JOIN dispatch_view_2 on ( dispatch_view_2.month_recept=receipt_view_1.month_std_month  and dispatch_view_2.depot=receipt_view_1.depot AND dispatch_view_2.item=receipt_view_1.item) where (
		receipt_view_1.depot='$depot_code'  AND receipt_view_1.item='$item_code' ) group by month_std_month ,receipt_view_1.item )
		UNION ALL
		(
		SELECT dispatch_view_2.month_recept, reciept_qty_mt, month_recept, dispatch_qty_mt, (reciept_qty_mt-dispatch_qty_mt) as closing1 , dispatch_view_2.Depot, dispatch_view_2.item FROM dispatch_view_2 LEFT join `receipt_view_1` on (dispatch_view_2.month_recept=receipt_view_1.month_std_month and dispatch_view_2.depot=receipt_view_1.depot AND dispatch_view_2.item=receipt_view_1.item) where dispatch_view_2.depot='$depot_code' AND dispatch_view_2.item='$item_code' AND month_std_month is NULL group by month_recept ,dispatch_view_2.item
		)";

		$actualStock[] = DB::select($sql);


	}
		if(!empty($actualStock)){
			 $data['actual_stock'] = $actualStock;
			}else{
			 $data['actual_stock'] ='';
		}
	
     
      

    	return view('admin.actual_stock',$data+compact('depot_name'));
    }


/*dashboard link pages*/


	public function sapStock(Request $request){

		$sql_depopt= "SELECT receipt_view_1.Depot,receipt_view_1.item 
	FROM `receipt_view_1` 
	left join dispatch_view_2 on dispatch_view_2.month_recept=receipt_view_1.month_std_month 
	group by receipt_view_1.Depot,receipt_view_1.item
	order by month_std_month,receipt_view_1.Depot,receipt_view_1.item ";

	$sql_depopt = DB::select($sql_depopt);

	$data['depot_list']=$sql_depopt;

	//print_r($data['depot_list']);exit;

	$actualStoc=[];
	$depot_name='';
	foreach ($sql_depopt as $key) {


		$depot_code = $key->Depot;
		$item_code = $key->item;

		$depot	= DB::table('master_depot')->where('depot_code', $depot_code)->get()->first();
		//print_r($depot);exit;
		if(isset($depot)){
	     $depot_name = $depot->depot_name;
		}else{
			$depot_name='';
		}
		
	
    	$sql = "(
		SELECT month_std_month ,reciept_qty_mt,sap_month,sap_qty_mt,(reciept_qty_mt-sap_qty_mt) as closing1  , receipt_view_1.Depot,receipt_view_1.item
		 FROM `receipt_view_1` 
		left join sap_view_1 on (sap_view_1.sap_month=receipt_view_1.month_std_month and sap_view_1.depot=receipt_view_1.depot AND sap_view_1.item=receipt_view_1.item ) 
		where receipt_view_1.depot='$depot_code'  AND receipt_view_1.item='$item_code'
		group by  month_std_month,receipt_view_1.item  )
		UNION ALL
		(		  
		SELECT sap_view_1.sap_month , reciept_qty_mt, sap_month, sap_qty_mt, (reciept_qty_mt-sap_qty_mt) as closing1 , sap_view_1.Depot, sap_view_1.item 
		FROM sap_view_1		
		LEFT join `receipt_view_1` on (sap_view_1.sap_month=receipt_view_1.month_std_month and sap_view_1.Depot=receipt_view_1.depot AND sap_view_1.item=receipt_view_1.item) 		
		where sap_view_1.Depot='$depot_code' AND sap_view_1.item='$item_code' AND month_std_month is NULL group by sap_month ,sap_view_1.item
		)";

		$actualStock[] = DB::select($sql);

	}
		if(!empty($actualStock)){
	
      		$data['actual_stock'] = $actualStock;

  		}else{
  			$$data['actual_stock'] ='';
  		}
 
    	return view('admin.sap_stock',$data+compact('depot_name'));
    }



}
