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

class FinanceMasterController extends Controller{

	private $data;

	public function __cunstruct($data){

		//$this->data = "smit@121";

	}


/*	Tax master start */

	public function Tax(Request $request){

		$title = 'Add Master Tax';

		return view('admin.tax',compact('title'));

	}

	public function SaveTax(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'tax_code' => 'required',
				'tax_name'   => 'required',

		]);

		$data = array(
					"tax_code"    =>  $request->input('tax_code'),
					"tax_name"    =>  $request->input('tax_name'),
					"created_by"  =>  $request->session()->get('userid'),
					"comp_name"   =>  $compName,
					"fiscal_year" => $fisYear
	 
	    	);

		$saveData = DB::table('master_tax')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
				return redirect('/finance/view-tax');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Added...!');
				return redirect('/finance/view-tax');

			}

	}

	public function ViewTax(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_tax')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_tax')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-tax/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#taxDelete" class="btn btn-danger btn-xs" onclick="return deleteTax('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Tax';
       return view('admin.view_tax',compact('title'));

    }


    public function DeleteTax(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('master_tax')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Tax Data Was Deleted Successfully...!');
			return redirect('/finance/view-tax');

			} else {

			$request->session()->flash('alert-error', 'Tax Data Can Not Deleted...!');
			return redirect('/finance/view-tax');

			}

		}else{

		$request->session()->flash('alert-error', 'Tax Data Not Found...!');
		return redirect('/finance/view-tax');

		}
	}

	public function EditTax($id){

    	$title = 'Edit Tax';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_tax');
			$query->where('id', $id);
			$userData['tax_list'] = $query->get()->first();


			return view('admin.edit_tax', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Tax Id Not Found...!');
			return redirect('/finance/view-tax');
		}

    }


    public function UpdateTax(Request $request){

		
		$validate = $this->validate($request, [
				
				'tax_code' => 'required',
				'tax_name' => 'required',
		]);

       $id = $request->input('tax_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"tax_code"        =>  $request->input('tax_code'),
					"tax_name"        =>  $request->input('tax_name'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_tax')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Updated...!');
				return redirect('/finance/view-tax');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Updated...!');
				return redirect('/finance/view-tax');

			}


	}


/*	Tax master end */


/*	GLSCH master start */

	public function Glsch(Request $request){

		$title = 'Add Master GLSCH';

		return view('admin.glsch_form',compact('title'));

	}

	public function SaveGlsch(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'glsch_type'  => 'required',
				'glsch_code'  => 'required',
				'glsch_name'  => 'required',
				'glsch_seqno' => 'required',

		]);

		$data = array(
					"glsch_type"  =>  $request->input('glsch_type'),
					"glsch_code"  =>  $request->input('glsch_code'),
					"glsch_name"  =>  $request->input('glsch_name'),
					"glsch_seqno" =>  $request->input('glsch_seqno'),
					"created_by"  =>  $request->session()->get('userid'),
					"comp_name"   =>  $compName,
					"fiscal_year" => $fisYear
	 
	    	);

		$saveData = DB::table('master_glsch')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'GLSCH Was Successfully Added...!');
				return redirect('/finance/view-glsch');

			} else {

				$request->session()->flash('alert-error', 'GLSCH Can Not Added...!');
				return redirect('/finance/view-glsch');

			}

	}


	public function ViewGlsch(Request $request){

    	if ($request->ajax()) {

    	

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_glsch')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_glsch')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-glsch/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#glschDelete" class="btn btn-danger btn-xs" onclick="return deleteGLSCH('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View GLSCH';
       return view('admin.view_glsch',compact('title'));

    }


    public function DeleteGlsch(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('master_glsch')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'GLSCH Data Was Deleted Successfully...!');
			return redirect('/finance/view-glsch');

			} else {

			$request->session()->flash('alert-error', 'GLSCH Data Can Not Deleted...!');
			return redirect('/finance/view-glsch');

			}

		}else{

		$request->session()->flash('alert-error', 'GLSCH Data Not Found...!');
		return redirect('/finance/view-glsch');

		}
	}


	public function EditGlsch($id){

    	$title = 'Edit GLSCH';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_glsch');
			$query->where('id', $id);
			$userData['glsch_list'] = $query->get()->first();


			return view('admin.edit_glsch', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'GLSCH Id Not Found...!');
			return redirect('/finance/view-glsch');
		}

    }

      public function UpdateGlsch(Request $request){

		
		$validate = $this->validate($request, [

				'glsch_type'  => 'required',
				'glsch_code'  => 'required',
				'glsch_name'  => 'required',
				'glsch_seqno' => 'required',

		]);

       $id = $request->input('tax_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"glsch_type"      =>  $request->input('glsch_type'),
					"glsch_code"      =>  $request->input('glsch_code'),
					"glsch_name"      =>  $request->input('glsch_name'),
					"glsch_seqno"     =>  $request->input('glsch_seqno'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_glsch')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'GLSCH Was Successfully Updated...!');
				return redirect('/finance/view-glsch');

			} else {

				$request->session()->flash('alert-error', 'GLSCH Can Not Updated...!');
				return redirect('/finance/view-glsch');

			}


	}





	/*	GLSCH master end*/

	/*GL master start*/

	public function GlMast(Request $request){

		$title = 'Add Master GL';

		$userData['glsch_lists']  = DB::table('master_glsch')->get();

		return view('admin.gl_form',$userData+compact('title'));

	}

	public function SaveGlMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'gl_code'    => 'required',
				'gl_name'    => 'required',
				'glsch_type' => 'required',
				'glsch_code' => 'required'

		]);

		$data = array(
					"gl_code"     =>  $request->input('gl_code'),
					"gl_name"     =>  $request->input('gl_name'),
					"glsch_type"  =>  $request->input('glsch_type'),
					"glsch_code"  =>  $request->input('glsch_code'),
					"autoposting" =>  $request->input('autoposting'),
					"created_by"  =>  $request->session()->get('userid'),
					"comp_name"   =>  $compName,
					"fiscal_year" => $fisYear
					
	    	);

		$saveData = DB::table('master_gl')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Gl Was Successfully Added...!');
				return redirect('/finance/view-gl-mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Can Not Added...!');
				return redirect('/finance/view-gl-mast');

			}

	}


	public function ViewGlMast(Request $request){

    	if ($request->ajax()) {

    	

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_gl')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_gl')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-gl-mast/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#GlDelete" class="btn btn-danger btn-xs" onclick="return dleteGlentry('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Gl';
       return view('admin.view_glmast',compact('title'));

    }


    public function DeleteGl(Request $request){

        $id = $request->input('id');
        if ($id!='') {

			$Delete = DB::table('master_gl')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Gl Data Was Deleted Successfully...!');
			return redirect('/finance/view-gl-mast');

			} else {

			$request->session()->flash('alert-error', 'Gl Data Can Not Deleted...!');
			return redirect('/finance/view-gl-mast');

			}

		}else{

		$request->session()->flash('alert-error', 'Tax Data Not Found...!');
		return redirect('/finance/view-gl-mast');

		}
	}

	public function EditGlMast($id){

    	$title = 'Edit Gl';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_gl');
			$query->where('id', $id);
			$userData['gl_list'] = $query->get()->first();

			$userData['glsch_lists']  = DB::table('master_glsch')->get();

			return view('admin.edit_gl_mast', $userData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Gl Id Not Found...!');
			return redirect('/finance/view-gl-mast');
		}

    }


    public function UpdateGlMast(Request $request){

		
		$validate = $this->validate($request, [

				'gl_code'    => 'required',
				'gl_name'    => 'required',
				'glsch_type' => 'required',
				'glsch_code' => 'required'

		]);

       $id = $request->input('glmast_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"gl_code"         =>  $request->input('gl_code'),
					"gl_name"         =>  $request->input('gl_name'),
					"glsch_type"      =>  $request->input('glsch_type'),
					"glsch_code"      =>  $request->input('glsch_code'),
					"autoposting"     =>  $request->input('autoposting'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_gl')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Gl Was Successfully Updated...!');
				return redirect('/finance/view-gl-mast');

			} else {

				$request->session()->flash('alert-error', 'Gl Can Not Updated...!');
				return redirect('/finance/view-gl-mast');

			}


	}


	/*GL master start*/

	public function TransactionMaster(Request $request){

		$title ='Add Transaction Master';
			//print_r($userData['acctype_list']);exit;
			
			return view('admin.transaction_form',compact('title'));
		
	}

	public function TransactionFormSave(Request $request){

		$validate = $this->validate($request, [

			'transaction_code'    => 'required',
			'transaction_head'    => 'required',
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"tran_code"   => $request->input('transaction_code'),
			"tran_head"   => $request->input('transaction_head'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_transaction')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Transaction Was Successfully Added...!');
			return redirect('/finance/view-mast-transaction');

		} else {

			$request->session()->flash('alert-error', 'Transaction Can Not Added...!');
			return redirect('/finance/view-mast-transaction');

		}

	}


	public function ViewTransactionMast(Request $request){

    	$title = 'View Master Transaction';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	$TransData['transaction_list'] = DB::table('master_transaction')->orderBy('id','DESC')->get();
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$TransData['transaction_list'] = DB::table('master_transaction')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$TransData['transaction_list']='';
    	}

    	return view('admin.view_transaction',$TransData+compact('title'));
    }


    public function EditTransactionMast($id){

    	$title = 'Edit Master Transaction';
    	//print_r($id);
    	$id = base64_decode($id);
    	if($id!=''){
    	    $query = DB::table('master_transaction');
			$query->where('id', $id);
			$userData['transaction_list'] = $query->get()->first();
			//print_r($userData['transaction_list']);exit;
		return view('admin.edit_transaction_form', $userData+compact('title'));

		}else{
			$request->session()->flash('alert-error', 'Transaction Not Found...!');
		return redirect('/finance/view-mast-transaction');

		}
    }

    public function TransactionFormUpdate(Request $request){

    	$validate = $this->validate($request, [

			'transaction_code'  => 'required',
			'transaction_head'  => 'required',
			'transaction_block' => 'required',
			

		]);


		$transId=$request->input('transId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"tran_code"       => $request->input('transaction_code'),
			"tran_head"       => $request->input('transaction_head'),
			"tran_block"      => $request->input('transaction_block'),
			"last_updat_by"   => $createdBy,
			"last_updat_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_transaction')->where('id', $transId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Transaction Was Successfully Added...!');
			return redirect('/finance/view-mast-transaction');

		} else {

			$request->session()->flash('alert-error', 'Transaction Can Not Added...!');
			return redirect('/finance/view-mast-transaction');

		}

    }

    public function DeleteTransaction(Request $request){

		$transactionId = $request->post('transactionId');
    	

    	if ($transactionId!='') {
    		
    		$Delete = DB::table('master_transaction')->where('id', $transactionId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Transaction Was Deleted Successfully...!');
				return redirect('/finance/view-mast-transaction');

			} else {

				$request->session()->flash('alert-error', 'Transaction Can Not Deleted...!');
				return redirect('/finance/view-mast-transaction');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/finance/view-mast-profit-center');

    	}

	}

    public function ProfitCenterMaster(){

    	$title ='Add Transaction Master';
		$compData['comp_list'] = DB::table('master_comp')->get();

		//print_r($compData['comp_list']);exit;



		return view('admin.profit_center_form',$compData+compact('title'));
    }


    public function ProfitCenterFormSave(Request $request){

		$validate = $this->validate($request, [

			'profit_code' => 'required',
			'profit_name' => 'required',
			'comp_code'   => 'required',
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"pfct_code"    => $request->input('profit_code'),
			"pfct_name"    => $request->input('profit_name'),
			"company_code" => $request->input('comp_code'),
			"created_by"   => $createdBy,
			
		);

		$saveData = DB::table('master_pfct')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Profit Center Was Successfully Added...!');
			return redirect('/finance/view-mast-profit-center');

		} else {

			$request->session()->flash('alert-error', 'Profit Center Can Not Added...!');
			return redirect('/finance/view-mast-profit-center');

		}

	}


	public function ViewProfitCenterMast(Request $request){

    	$title = 'View Profit Center';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){


    	$pfctData['pfct_list'] = DB::table('master_pfct')
            ->join('master_comp', 'master_pfct.company_code', '=', 'master_comp.comp_code')
            ->select('master_pfct.*', 'master_comp.comp_name')
            ->get();
    	}
    	elseif($userType=='superAdmin' || $userType=='user') {

    		$pfctData['pfct_list'] = DB::table('master_pfct')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();


    		$pfctData['pfct_list'] = DB::table('master_pfct')
            ->join('master_comp', 'master_pfct.company_code', '=', 'master_comp.comp_code')
            ->select('master_pfct.*', 'master_comp.comp_name')
            ->where([['master_pfct.created_by','=',$userid],['master_pfct.comp_name','=',$compName],['master_pfct.fiscal_year','=',$fisYear]])
            ->get();
    	}
    	else{
    		$pfctData['pfct_list']='';
    	}

    	return view('admin.view_profit_center',$pfctData+compact('title'));
    }


    public function EditProfitCenterMast($id){

    	$title = 'Edit Master Transaction';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_pfct');
			$query->where('id', $id);
			$pfctData['pfct_list'] = $query->get()->first();

			$pfctData['comp_list'] = DB::table('master_comp')->get();

			//print_r($userData['transaction_list']);exit;
			return view('admin.edit_profit_center', $pfctData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/finance/view-mast-profit-center');
		}

    }


    public function ProfitCenterFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'profit_code' => 'required',
			'profit_name' => 'required',
			'comp_code'   => 'required',
			

		]);

		$pfctId=$request->input('pfctId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");



    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"pfct_code"    => $request->input('profit_code'),
			"pfct_name"    => $request->input('profit_name'),
			"company_code" => $request->input('comp_code'),
			"pfct_block" => $request->input('pfct_block'),
			"last_updat_by"   => $createdBy,
			"last_updat_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_pfct')->where('id', $pfctId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Profit Center Was Successfully Added...!');
			return redirect('/finance/view-mast-profit-center');

		} else {

			$request->session()->flash('alert-error', 'Profit Center Can Not Added...!');
			return redirect('/finance/view-mast-profit-center');

		}

	}

	public function DeleteProfitCt(Request $request){

		$pfctId = $request->post('pfctId');
    	

    	if ($pfctId!='') {
    		
    		$Delete = DB::table('master_pfct')->where('id', $pfctId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Profit Center Was Deleted Successfully...!');
				return redirect('/finance/view-mast-profit-center');

			} else {

				$request->session()->flash('alert-error', 'Profit Center Can Not Deleted...!');
				return redirect('/finance/view-mast-profit-center');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Profit Center Not Found...!');
			return redirect('/finance/view-mast-profit-center');

    	}

	}


	public function DepartmentMaster(){

    	$title ='Add Transaction Master';
		$compData['comp_list'] = DB::table('master_comp')->get();

		//print_r($compData['comp_list']);exit;

		return view('admin.department_form',$compData+compact('title'));
    }


    public function DepartFormSave(Request $request){
    	//print_r($request->post());exit;

		$validate = $this->validate($request, [

			'department_code' => 'required',
			'department_name' => 'required'
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			
			"dept_code"    => $request->input('department_code'),
			"dept_name"    => $request->input('department_name'),
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"created_by"   => $createdBy,
			
		);

		$saveData = DB::table('dept_master')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Department Was Successfully Added...!');
			return redirect('/finance/view-department-mast');

		} else {

			$request->session()->flash('alert-error', 'Department Can Not Added...!');
			return redirect('/finance/view-department-mast');

		}

	}


	public function ViewDepartmentMast(Request $request){

    	$title = 'View Profit Center';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	$deptData['dept_list'] = DB::table('dept_master')->orderBy('id','DESC')->get();
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		$deptData['dept_list'] = DB::table('dept_master')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$deptData['dept_list']='';
    	}

    	return view('admin.view_department',$deptData+compact('title'));
    }


    public function EditDepartmentMast($id){

    	$title = 'Edit Master Department';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('dept_master');
			$query->where('id', $id);
			$deptData['dept_list'] = $query->get()->first();

			//print_r($userData['transaction_list']);exit;
			return view('admin.edit_department', $deptData+compact('title'));
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-department-mast');
		}

    }


    public function DepartmentFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'department_code'  => 'required',
			'department_name'  => 'required',
			'department_block' => 'required',
			

		]);

		$deptId = $request->input('deptId');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"dept_code"    => $request->input('department_code'),
			"dept_name"    => $request->input('department_name'),
			"dept_block"   => $request->input('department_block'),
			"updated_by"   => $createdBy,
			"updated_date" => $updatedDate,
			
		);

		$saveData = DB::table('dept_master')->where('id', $deptId)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Department  Was Successfully Updated...!');
			return redirect('/finance/view-department-mast');

		} else {

			$request->session()->flash('alert-error', 'Department  Can Not Updated...!');
			return redirect('/finance/view-department-mast');

		}

	}

	public function DeleteDepartment(Request $request){

		$deptId = $request->post('deptId');
    	

    	if ($deptId!='') {
    		
    		$Delete = DB::table('dept_master')->where('id', $deptId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Department Was Deleted Successfully...!');
				return redirect('/finance/view-department-mast');

			} else {

				$request->session()->flash('alert-error', 'Department Can Not Deleted...!');
				return redirect('/finance/view-department-mast');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-department-mast');

    	}

	}


	public function ConfigMaster(Request $request){

		$title        ='Add Config Master';
		
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$rfhead1      = $request->old('rfhead1');
		$rfhead2      = $request->old('rfhead2');
		$rfhead3      = $request->old('rfhead3');
		$rfhead4      = $request->old('rfhead4');
		$rfhead5      = $request->old('rfhead5');
		$config_id    = $request->old('config_id');


    	$button='Save';
    	$action='/finance/form-mast-config-save';
		//print_r($compData['comp_list']);exit;
		$transData['trans_list'] = DB::table('master_transaction')->get();
		$transData['gl_list'] = DB::table('master_gl')->get();

		return view('admin.config_form',$transData+compact('title','tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));
    }


    

    public function ConfigFormSave(Request $request){

		$validate = $this->validate($request, [

			'trans_code'  => 'required',
			'series_code' => 'required',
			'series_name' => 'required',
			'gi_code'     => 'required',
			

		]);

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"tran_code"   => $request->input('trans_code'),
			"series_code" => $request->input('series_code'),
			"series_name" => $request->input('series_name'),
			"gl_code"     => $request->input('gi_code'),
			"rfhead1"     => $request->input('Rfhead1'),
			"rfhead2"     => $request->input('Rfhead2'),
			"rfhead3"     => $request->input('Rfhead3'),
			"rfhead4"     => $request->input('Rfhead4'),
			"rfhead5"     => $request->input('Rfhead5'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_config')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Config Was Successfully Added...!');
			return redirect('/finance/view-config-mast');

		} else {

			$request->session()->flash('alert-error', 'Config Can Not Added...!');
			return redirect('/finance/view-config-mast');

		}

	}

	public function ViewConfigMast(Request $request){

    	$title = 'View Config Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin' || $userType=='Admin'){

    	/*$configData['config_list'] = DB::table('master_config')->orderBy('id','DESC')->get();*/


    	$configData['config_list'] = DB::table('master_config')
            ->join('master_transaction', 'master_config.tran_code', '=', 'master_transaction.tran_code')
            ->join('master_gl', 'master_config.gl_code', '=', 'master_gl.gl_code')
            ->select('master_config.*', 'master_transaction.tran_head','master_gl.gl_name')
            ->get();

           // print_r($configData['config_list']);exit;
    	}
    	elseif ($userType=='superAdmin' || $userType=='user') {

    		/*$configData['config_list'] = DB::table('master_config')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();*/

    		$configData['config_list'] = DB::table('master_config')
            ->join('master_transaction', 'master_config.tran_code', '=', 'master_transaction.tran_code')
            ->join('master_gl', 'master_config.gl_code', '=', 'master_gl.gl_code')
            ->select('master_config.*', 'master_transaction.tran_head','master_gl.gl_name')
            ->where([['master_config.created_by','=',$userid],['master_config.comp_name','=',$compName],['master_config.fiscal_year','=',$fisYear]])
            ->get();
    	}
    	else{
    		$configData['config_list']='';
    	}

    	return view('admin.view_config',$configData+compact('title'));
    }


    public function EditConfigMast($id){

    	$title = 'Edit Config Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_config');
			$query->where('id', $id);
			$dData= $query->get()->first();
			$configData['tran_code']=$dData->tran_code;
			$configData['series_code']=$dData->series_code;
			$configData['series_name']=$dData->series_name;
			$configData['gl_code']=$dData->gl_code;
			$configData['rfhead1']=$dData->rfhead1;
			$configData['rfhead2']=$dData->rfhead2;
			$configData['rfhead3']=$dData->rfhead3;
			$configData['rfhead4']=$dData->rfhead4;
			$configData['rfhead5']=$dData->rfhead5;
			
			$configData['config_block']=$dData->config_block;
			$configData['config_id']=$dData->id;
			$button='Update';
			$action='/finance/form-mast-config-update';

			$configData['trans_list'] = DB::table('master_transaction')->get();

		    $configData['gl_list'] = DB::table('master_gl')->get();
			
			return view('admin.config_form', $configData+compact('title','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-config-mast');
		}

    }


    public function ConfigFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'trans_code'  => 'required',
			'series_code' => 'required',
			'series_name' => 'required',
			'gi_code'     => 'required',
			

		]);


		$config_id = $request->input('config_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"         => $compName,
			"fiscal_year"       => $fisYear,
			"tran_code"         => $request->input('trans_code'),
			"series_code"       => $request->input('series_code'),
			"series_name"       => $request->input('series_name'),
			"gl_code"           => $request->input('gi_code'),
			"rfhead1"           => $request->input('Rfhead1'),
			"rfhead2"           => $request->input('Rfhead2'),
			"rfhead3"           => $request->input('Rfhead3'),
			"rfhead4"           => $request->input('Rfhead4'),
			"rfhead5"           => $request->input('Rfhead5'),
			"rfhead5"           => $request->input('Rfhead5'),
			"config_block"      => $request->input('config_block'),
			"last_updated_by"   => $createdBy,
			"last_updated_date" => $updatedDate,
			
		);


	$saveData = DB::table('master_config')->where('id', $config_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Config Was Successfully Updated...!');
			return redirect('/finance/view-config-mast');

		} else {

			$request->session()->flash('alert-error', 'Config Can Not Added...!');
			return redirect('/finance/view-config-mast');

		}

	}


	public function TranTaxMaster(Request $request){
		
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$config_id    = $request->old('config_id');


    	$button='Save';
    	$action='/finance/form-mast-trantax-save';
		//print_r($compData['comp_list']);exit;
		$transData['trans_list'] = DB::table('master_transaction')->get();
		$transData['tax_list'] = DB::table('master_tax')->get();

		$transData['config_list'] = DB::table('master_config')->get();

		$transData['gl_list'] = DB::table('master_gl')->get();

		$transData['rate_list'] = DB::table('rate_value')->get();

		return view('admin.tran_tax_form',$transData+compact('tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));
    }


    public function TranTaxFormSave(Request $request){
        
      $createdBy  = $request->session()->get('userid');
      $compName   = $request->session()->get('company_name');
      $fisYear  =  $request->session()->get('macc_year');
          
		$data = array(
					"tax_code"    =>  $request->input('tax_code'),
					"tran_code"   =>  $request->input('trans_code'),
					"series_code" =>  $request->input('series_code'),
					"gl_code"     =>  $request->input('gi_code'),
					
					"amthead"     =>  $request->input('amthead'),
					
					"afhead2"     =>  $request->input('afhead2'),
					"afrate2"     =>  $request->input('afrate2'),
					"afratei2"    =>  $request->input('afratei2'),
					"aflogic2"    =>  $request->input('aflogic2'),
					"afgl_code2"  =>  $request->input('afgl_code2'),
					"statici2"    =>  $request->input('statici2'),
					
					"afhead3"     =>  $request->input('afhead3'),
					"afrate3"     =>  $request->input('afrate3'),
					"afratei3"    =>  $request->input('afratei3'),
					"aflogic3"    =>  $request->input('aflogic3'),
					"afgl_code3"  =>  $request->input('afgl_code3'),
					"statici3"    =>  $request->input('statici3'),
					
					"afhead4"     =>  $request->input('afhead4'),
					"afrate4"     =>  $request->input('afrate4'),
					"afratei4"    =>  $request->input('afratei4'),
					"aflogic4"    =>  $request->input('aflogic4'),
					"afgl_code4"  =>  $request->input('afgl_code4'),
					"statici4"    =>  $request->input('statici4'),
					
					"afhead5"     =>  $request->input('afhead5'),
					"afrate5"     =>  $request->input('afrate5'),
					"afratei5"    =>  $request->input('afratei5'),
					"aflogic5"    =>  $request->input('aflogic5'),
					"afgl_code5"  =>  $request->input('afgl_code5'),
					"statici5"    =>  $request->input('statici5'),
					
					"afhead6"     =>  $request->input('afhead6'),
					"afrate6"     =>  $request->input('afrate6'),
					"afratei6"    =>  $request->input('afratei6'),
					"aflogic6"    =>  $request->input('aflogic6'),
					"afgl_code6"  =>  $request->input('afgl_code6'),
					"statici6"    =>  $request->input('statici6'),
					
					"afhead7"     =>  $request->input('afhead7'),
					"afrate7"     =>  $request->input('afrate7'),
					"afratei7"    =>  $request->input('afratei7'),
					"aflogic7"    =>  $request->input('aflogic7'),
					"afgl_code7"  =>  $request->input('afgl_code7'),
					"statici7"    =>  $request->input('statici7'),
					
					"afhead8"     =>  $request->input('afhead8'),
					"afrate8"     =>  $request->input('afrate8'),
					"afratei8"    =>  $request->input('afratei8'),
					"aflogic8"    =>  $request->input('aflogic8'),
					"afgl_code8"  =>  $request->input('afgl_code8'),
					"statici8"    =>  $request->input('statici8'),
					
					"afhead9"     =>  $request->input('afhead9'),
					"afrate9"     =>  $request->input('afrate9'),
					"afratei9"    =>  $request->input('afratei9'),
					"aflogic9"    =>  $request->input('aflogic9'),
					"afgl_code9"  =>  $request->input('afgl_code9'),
					"statici9"    =>  $request->input('statici9'),
					
					"afhead10"    =>  $request->input('afhead10'),
					"afrate10"    =>  $request->input('afrate10'),
					"afratei10"   =>  $request->input('afratei10'),
					"aflogic10"   =>  $request->input('aflogic10'),
					"afgl_code10" =>  $request->input('afgl_code10'),
					"statici10"   =>  $request->input('statici10'),
					
					"afhead11"    =>  $request->input('afhead11'),
					"afrate11"    =>  $request->input('afrate11'),
					"afratei11"   =>  $request->input('afratei11'),
					"aflogic11"   =>  $request->input('aflogic11'),
					"afgl_code11" =>  $request->input('afgl_code11'),
					"statici11"   =>  $request->input('statici11'),
					
					
					"afhead12"    =>  $request->input('afhead12'),
					"afrate12"    =>  $request->input('afrate12'),
					"afratei12"   =>  $request->input('afratei12'),
					"aflogic12"   =>  $request->input('aflogic12'),
					"afgl_code12" =>  $request->input('afgl_code12'),
					"statici12"   =>  $request->input('statici12'),

					"nafhead1"          =>  $request->input('nafhead1'),
					"nafhead2"          =>  $request->input('nafhead2'),
					"nafhead3"          =>  $request->input('nafhead3'),
					"nafhead4"          =>  $request->input('nafhead4'),
					"nafhead5"          =>  $request->input('nafhead5'),
					"comp_name"   =>  $compName,
					"fiscal_year" => $fisYear
	 
	    	);

		$saveData = DB::table('trantax_master')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
				return redirect('/finance/view-tran-tax-mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Added...!');
				return redirect('/finance/view-tran-tax-mast');

			}
    }



    public function ViewTranTaxMast(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('trantax_master')->get();

       	 $data = DB::table('trantax_master')
            ->join('master_tax', 'trantax_master.tax_code', '=', 'master_tax.tax_code')
            ->join('master_transaction', 'trantax_master.tran_code', '=', 'master_transaction.tran_code')
            ->join('master_config', 'trantax_master.series_code', '=', 'master_config.series_code')
            ->select('trantax_master.*', 'master_tax.tax_name','master_transaction.tran_head','master_config.series_name')
            ->get();

          /*  print_r($data);exit;*/

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('trantax_master')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-trans-tax/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#transtaxDelete" class="btn btn-danger btn-xs" onclick="return deletetranTax('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Tax';
       return view('admin.view_trans_tax',compact('title'));

    }

    public function EditTransTaxMast($id){


    	$id = base64_decode($id);
    	

    	if($id!=''){
    	    $query = DB::table('trantax_master');
			$query->where('id', $id);
			$dData['tran_tax_data']= $query->get()->first();

			

			$button='Update';
	    	$action='/finance/form-mast-trantax-update';
			//print_r($compData['comp_list']);exit;
			$transData['tax_list'] = DB::table('master_tax')->get();

			$transData['trans_list'] = DB::table('master_transaction')->get();
			$transData['config_list'] = DB::table('master_config')->get();

			$transData['gl_list'] = DB::table('master_gl')->get();

			$transData['rate_list'] = DB::table('rate_value')->get();

		return view('admin.edit_trans_tax',$transData+$dData);
			
			//print_r($deptData['dept_list']);exit;
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-department-mast');
		}

	}


	public function UpdateFirstTransTaxMast(Request $request){

		
		$validate = $this->validate($request, [
				
				'tax_code'    => 'required',
				'trans_code'  => 'required',
				'series_code' => 'required',
				'gi_code'     => 'required',
		]);

       $id = $request->input('trntaxid');
       $updatedDate = date('Y-m-d');

		$data = array(
					"tax_code"          =>  $request->input('tax_code'),
					"tran_code"         =>  $request->input('trans_code'),
					"series_code"       =>  $request->input('series_code'),
					"gl_code"           =>  $request->input('gi_code'),
					"last_updated_by"   =>  $request->session()->get('userid'),
					"last_updated_date" =>  $updatedDate
	 
	    	);

		//print_r($data);exit;
		$saveData = DB::table('trantax_master')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tran Tax Was Successfully Updated...!');
				return redirect('/finance/edit-trans-tax/'.base64_encode($id));

			} else {

				$request->session()->flash('alert-error', 'Tran Tax Can Not Updated...!');
				return redirect('/finance/edit-trans-tax/'.base64_encode($id));

			}


	}


	public function UpdateSecondTransTaxMast(Request $request){

		

       $id = $request->input('secondid');
       $updatedDate = date('Y-m-d');

		$data = array(
					"nafhead1"          =>  $request->input('nafhead1'),
					"nafhead2"          =>  $request->input('nafhead2'),
					"nafhead3"          =>  $request->input('nafhead3'),
					"nafhead4"          =>  $request->input('nafhead4'),
					"nafhead5"          =>  $request->input('nafhead5'),
					"last_updated_by"   =>  $request->session()->get('userid'),
					"last_updated_date" =>  $updatedDate
	 
	    	);

		//print_r($data);exit;
		$saveData = DB::table('trantax_master')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tran Tax Was Successfully Updated...!');
				return redirect('/finance/view-tran-tax-mast');

			} else {

				$request->session()->flash('alert-error', 'Tran Tax Can Not Updated...!');
				return redirect('/finance/view-tran-tax-mast');

			}


	}



	public function UpdateThirdTransTaxMast(Request $request){

       $id = $request->input('thirdtrid');
       $updatedDate = date('Y-m-d');

		$data = array(
					"amthead"           =>  $request->input('amthead'),

					"afhead2"           =>  $request->input('afhead2'),
					"afrate2"           =>  $request->input('afrate2'),
					"afratei2"          =>  $request->input('afratei2'),
					"aflogic2"          =>  $request->input('aflogic2'),
					"afgl_code2"        =>  $request->input('afgl_code2'),
					"statici2"          =>  $request->input('statici2'),

					"afhead3"           =>  $request->input('afhead3'),
					"afrate3"           =>  $request->input('afrate3'),
					"afratei3"          =>  $request->input('afratei3'),
					"aflogic3"          =>  $request->input('aflogic3'),
					"afgl_code3"        =>  $request->input('afgl_code3'),
					"statici3"          =>  $request->input('statici3'),

					"afhead4"           =>  $request->input('afhead4'),
					"afrate4"           =>  $request->input('afrate4'),
					"afratei4"          =>  $request->input('afratei4'),
					"aflogic4"          =>  $request->input('aflogic4'),
					"afgl_code4"        =>  $request->input('afgl_code4'),
					"statici4"          =>  $request->input('statici4'),

					"afhead5"           =>  $request->input('afhead5'),
					"afrate5"           =>  $request->input('afrate5'),
					"afratei5"          =>  $request->input('afratei5'),
					"aflogic5"          =>  $request->input('aflogic5'),
					"afgl_code5"        =>  $request->input('afgl_code5'),
					"statici5"          =>  $request->input('statici5'),

					"afhead6"           =>  $request->input('afhead6'),
					"afrate6"           =>  $request->input('afrate6'),
					"afratei6"          =>  $request->input('afratei6'),
					"aflogic6"          =>  $request->input('aflogic6'),
					"afgl_code6"        =>  $request->input('afgl_code6'),
					"statici6"          =>  $request->input('statici6'),

					"afhead7"           =>  $request->input('afhead7'),
					"afrate7"           =>  $request->input('afrate7'),
					"afratei7"          =>  $request->input('afratei7'),
					"aflogic7"          =>  $request->input('aflogic7'),
					"afgl_code7"        =>  $request->input('afgl_code7'),
					"statici7"          =>  $request->input('statici7'),

					"afhead8"           =>  $request->input('afhead8'),
					"afrate8"           =>  $request->input('afrate8'),
					"afratei8"          =>  $request->input('afratei8'),
					"aflogic8"          =>  $request->input('aflogic8'),
					"afgl_code8"        =>  $request->input('afgl_code8'),
					"statici8"          =>  $request->input('statici8'),

					"afhead9"           =>  $request->input('afhead9'),
					"afrate9"           =>  $request->input('afrate9'),
					"afratei9"          =>  $request->input('afratei9'),
					"aflogic9"          =>  $request->input('aflogic9'),
					"afgl_code9"        =>  $request->input('afgl_code9'),
					"statici9"          =>  $request->input('statici9'),

					"afhead10"           =>  $request->input('afhead10'),
					"afrate10"           =>  $request->input('afrate10'),
					"afratei10"          =>  $request->input('afratei10'),
					"aflogic10"          =>  $request->input('aflogic10'),
					"afgl_code10"        =>  $request->input('afgl_code10'),
					"statici10"          =>  $request->input('statici10'),

					"afhead11"           =>  $request->input('afhead11'),
					"afrate11"           =>  $request->input('afrate11'),
					"afratei11"          =>  $request->input('afratei11'),
					"aflogic11"          =>  $request->input('aflogic11'),
					"afgl_code11"        =>  $request->input('afgl_code11'),
					"statici11"          =>  $request->input('statici11'),


					"afhead12"           =>  $request->input('afhead12'),
					"afrate12"           =>  $request->input('afrate12'),
					"afratei12"          =>  $request->input('afratei12'),
					"aflogic12"          =>  $request->input('aflogic12'),
					"afgl_code12"        =>  $request->input('afgl_code12'),
					"statici12"          =>  $request->input('statici12'),

					"last_updated_by"   =>  $request->session()->get('userid'),
					"last_updated_date" =>  $updatedDate
	 
	    	);

		//print_r($data);exit;
		$saveData = DB::table('trantax_master')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tran Tax Was Successfully Updated...!');
				return redirect('/finance/edit-trans-tax/'.base64_encode($id));

			} else {

				$request->session()->flash('alert-error', 'Tran Tax Can Not Updated...!');
				return redirect('/finance/edit-trans-tax/'.base64_encode($id));

			}


	}



	public function DeleteTranTax(Request $request){

	        $id = $request->input('trantaxid');
	        if ($id!='') {

				$Delete = DB::table('trantax_master')->where('id', $id)->delete();

				if ($Delete) {

				$request->session()->flash('alert-success', 'Tran Tax Data Was Deleted Successfully...!');
				return redirect('/finance/view-tran-tax-mast');

				} else {

				$request->session()->flash('alert-error', 'Tran Tax Data Can Not Deleted...!');
				return redirect('/finance/view-tran-tax-mast');

				}

			}else{

			$request->session()->flash('alert-error', 'Tran Tax Data Not Found...!');
			return redirect('/finance/view-tran-tax-mast');

			}
	}


	/*gl key master*/
		public function GlKey(Request $request){

		$title = 'Add GL Key Master';

		$glkeycode = $request->old('glkeycode');
		$glcode = $request->old('glcode');
		$acctypecode = $request->old('acctypecode');
		$amt_type = $request->old('amt_type');
		$getid = $request->old('key_id');

		$userData['gl_code_list'] = DB::table('master_gl')->get();

		$userData['acctype_code_list'] = DB::table('master_acctype')->get();

		$button='Save';

    	$action='/finance/form-mast-glkey-save';

		return view('admin.gl_key_mast',$userData+compact('button','action','glkeycode','glcode','acctypecode','amt_type','getid'));

	}

	public function SaveGlKey(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'glkey_code'   => 'required',
				'gl_code'      => 'required',
				'acctype_code' => 'required',
				'amt_type'     => 'required',

		]);

		$data = array(
					"glkey_code"   =>  $request->input('glkey_code'),
					"gl_code"      =>  $request->input('gl_code'),
					"acctype_code" =>  $request->input('acctype_code'),
					"amt_type"     =>  $request->input('amt_type'),
					"created_by"   =>  $request->session()->get('userid'),
					"comp_name"    =>  $compName,
					"fiscal_year"  =>  $fisYear
					
	    	);

		$saveData = DB::table('glkey_master')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Added...!');
				return redirect('/finance/view-gl-key-mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Added...!');
				return redirect('/finance/view-gl-key-mast');

			}

	}
	/*gl key master*/

	public function ViewGlKey(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('glkey_master')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('glkey_master')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edt-gl-key-mast/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#glkeyDelete" class="btn btn-danger btn-xs" onclick="return GlKeyDlt('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Tax';
       return view('admin.view_gl_key',compact('title'));

    }


    public function DeleteGlKey(Request $request){

         $id = $request->input('glkeyId');
        if ($id!='') {

			$Delete = DB::table('glkey_master')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Gl Key Was Deleted Successfully...!');
			return redirect('/finance/view-gl-key-mast');

			} else {

			$request->session()->flash('alert-error', 'Gl Key Can Not Deleted...!');
			return redirect('/finance/view-gl-key-mast');

			}

		}else{

		$request->session()->flash('alert-error', 'Gl Key Not Found...!');
		return redirect('/finance/view-gl-key-mast');

		}
	}

	public function EditGlKey($id){

    	$title = 'Edit Gl Key Master Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('glkey_master');
			$query->where('id', $id);
			$userData= $query->get()->first();
			$glkeycode = $userData->glkey_code;
			$glcode = $userData->gl_code;
			$acctypecode = $userData->acctype_code;
			$amt_type = $userData->amt_type;
			$getid = $userData->id;

			$button='Update';
			
			$action='/finance/update-gl-keymast';

			$userData['gl_code_list'] = DB::table('master_gl')->get();

			$userData['acctype_code_list'] = DB::table('master_acctype')->get();
			
			return view('admin.gl_key_mast',$userData+compact('title','glkeycode','glcode','acctypecode','amt_type','getid','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-gl-key-mast');
		}

    }


    public function UpdateGlKey(Request $request){

		
		$validate = $this->validate($request, [

				'glkey_code'   => 'required',
				'gl_code'      => 'required',
				'acctype_code' => 'required',
				'amt_type'     => 'required',
		]);

       $id = $request->input('tax_id');
       $updatedDate = date('Y-m-d');

		$data = array(
					"glkey_code"   =>  $request->input('glkey_code'),
					"gl_code"      =>  $request->input('gl_code'),
					"acctype_code" =>  $request->input('acctype_code'),
					"amt_type"     =>  $request->input('amt_type'),
					"last_updat_by"   =>  $request->session()->get('userid'),
					"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('glkey_master')->where('id', $id)->update($data);


			if ($saveData) {

				$request->session()->flash('alert-success', 'Tax Was Successfully Updated...!');
				return redirect('/finance/view-gl-key-mast');

			} else {

				$request->session()->flash('alert-error', 'Tax Can Not Updated...!');
				return redirect('/finance/view-gl-key-mast');

			}


	}


	public function PlantMast(Request $request){

        $title        ='Add Config Master';
		
		$tran_code    = $request->old('trans_code');
		$series_code  = $request->old('series_code');
		$series_name  = $request->old('series_name');
		$gl_code      = $request->old('gl_code');
		$config_block = $request->old('config_block');
		$rfhead1      = $request->old('rfhead1');
		$rfhead2      = $request->old('rfhead2');
		$rfhead3      = $request->old('rfhead3');
		$rfhead4      = $request->old('rfhead4');
		$rfhead5      = $request->old('rfhead5');
		$config_id    = $request->old('config_id');


    	$button='Save';
    	$action='/finance/form-mast-config-save';
		//print_r($compData['comp_list']);exit;
		$transData['comp_list'] = DB::table('master_comp')->get();

		return view('admin.plant_form',$transData+compact('title','tran_code','series_code','series_name','gl_code','config_block','config_id','button','action'));


    }


 public function PlantFormSave(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');
    	//print_r($request->post());exit;


		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"plant_code"   => $request->input('plant_code'),
			"plant_name"   => $request->input('plant_name'),
			"company_code" => $request->input('comp_code'),
			"pfct_code"    => $request->input('profit_code'),
			"address1"     => $request->input('address1'),
			"address2"     => $request->input('address2'),
			"address3"     => $request->input('address3'),
			"phone1"       => $request->input('phone1'),
			"phone2"       => $request->input('phone2'),
			"fax"          => $request->input('fax'),
			"email"        => $request->input('email_id'),
			"country"      => $request->input('country'),
			"state"        => $request->input('state'),
			"district"     => $request->input('district'),
			"city"         => $request->input('city'),
			"pin"          => $request->input('pincode'),
			"created_by"   => $createdBy,
			
		);

		$saveData = DB::table('master_plant')->insert($data);
		$lastid= DB::getPdo()->lastInsertId();

		 if ($saveData){

		  				$data1['message'] = 'Success';
		  				$data1['id'] = $lastid;
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					}else{

						$data1['message'] = 'Error';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

			}

	}

	public function PlantFormUpdate(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	$PlantUpID = $request->input('updateid1');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

		$data = array(
			"comp_name"    => $compName,
			"fiscal_year"  => $fisYear,
			"plant_code"   => $request->input('plant_code'),
			"plant_name"   => $request->input('plant_name'),
			"company_code" => $request->input('comp_code'),
			"pfct_code"    => $request->input('profit_code'),
			"address1"     => $request->input('address1'),
			"address2"     => $request->input('address2'),
			"address3"     => $request->input('address3'),
			"phone1"       => $request->input('phone1'),
			"phone2"       => $request->input('phone2'),
			"fax"          => $request->input('fax'),
			"email"        => $request->input('email_id'),
			"country"      => $request->input('country'),
			"state"        => $request->input('state'),
			"district"     => $request->input('district'),
			"city"         => $request->input('city'),
			"pin"          => $request->input('pincode'),
			"updated_by"   => $createdBy,
			"updated_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_plant')->where('id', $PlantUpID)->update($data);
		

		 if ($saveData){

		  				$data1['message'] = 'Success';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

					}else{

						$data1['message'] = 'Error';
		  				$getalldata = json_encode($data1);  
		  				print_r($getalldata);

			}

	}


	public function PlantFormSave2(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	
    	$lastid = $request->input('lastid');
    		
		$data1 = array(
	
			"tan_no"        => $request->input('tan_no'),
			"tin_no"        => $request->input('tin_no'),
			"sales_taxno"   => $request->input('sale_tax_no'),
			"csales_taxno"  => $request->input('csale_tax_no'),
			"service_taxno" => $request->input('service_tax_no'),
			"updated_by"    => $createdBy,
			"updated_date"  => $updatedDate,
			
		);

		$saveData = DB::table('master_plant')->where('id', $lastid)->update($data1);

		 if($saveData){

		  				$data2['message'] = 'Success';
		  				$data2['id'] = $lastid;
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

					}else{

						$data2['message'] = 'Error';
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

			}

	}


	public function PlantFormSave3(Request $request){

    	$createdBy 	= $request->session()->get('userid');

    	date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$lastid1 = $request->input('lastid1');

    	//print_r($lastid1);exit;
    		
		$data1 = array(
	
			"ecc_no"       => $request->input('ecc_no'),
			"range_no"     => $request->input('range_no'),
			"range_name"   => $request->input('range_name'),
			"range_add1"   => $request->input('range_addres1'),
			"range_add2"   => $request->input('range_addres2'),
			"division"     => $request->input('division'),
			"collector"    => $request->input('collector'),
			"updated_by"   => $createdBy,
			"updated_date" => $updatedDate,
			
		);

		$saveData = DB::table('master_plant')->where('id', $lastid1)->update($data1);

		 if($saveData){

		  				$data2['message'] = 'Success';
		  				
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

					}else{

						$data2['message'] = 'Error';
		  				$getalldata = json_encode($data2);  
		  				print_r($getalldata);

			}

	}


	public function GetPfctCode(Request $request){

    	 $comp_code = $request->post('comp_code');
    	 //print_r($cmp_name);exit();

    	$getcompcode = DB::table('master_pfct')->where('company_code',$comp_code)->get();
    	//print_r($getcompcode);exit;

      
      if(!empty($getcompcode))
      {
        $response = '<option value="">--SELECT--</option>';
        foreach ($getcompcode as $row) 
        {
          $response .= '<option value="'.$row->pfct_code.'">'.$row->pfct_code.'='.$row->pfct_name.'</option>';
        }
      }
      else
      {
        $response = '<option value="">--SELECT--</option>';
      }
      echo $response;exit; 

    }



 public function ViewPlantMast(Request $request){

    	if ($request->ajax()) {

    	$user_type = $request->session()->get('user_type');

		$userid = $request->session()->get('userid');

		$CompanyCode   = $request->session()->get('company_name');

		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	/* $data = DB::table('trantax_master')->get();*/

       	 $data = DB::table('master_plant')
            ->join('master_comp', 'master_plant.company_code', '=', 'master_comp.comp_code')
            ->select('master_plant.*', 'master_comp.comp_name')
            ->get();

          
    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_plant')
            ->join('master_comp', 'master_plant.company_code', '=', 'master_comp.comp_code')
            ->select('master_plant.*', 'master_comp.comp_name')
            ->where([['master_plant.created_by','=',$userid],['master_plant.comp_name','=',$CompanyCode],['master_plant.fiscal_year','=',$macc_year]])
            ->get();

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-plant/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button"  class="btn btn-danger btn-xs" onclick="return deletePlant('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Tax';
       return view('admin.view_plant',compact('title'));
    }


   public function EditPlantMast($id){


    	$id = base64_decode($id);
    	

    	if($id!=''){
    	    $query = DB::table('master_plant');
			$query->where('id', $id);
			$plantData['plant_data'] = $query->get()->first();

			/*print_r($plantData['plant_data']);exit;*/

			$plantData['comp_list'] = DB::table('master_comp')->get();


		    return view('admin.edit_plant_form',$plantData);
			
			//print_r($deptData['dept_list']);exit;
		}else{
			$request->session()->flash('alert-error', 'Department Not Found...!');
			return redirect('/finance/view-department-mast');
		}


       
    }

    public function DeletePlant(Request $request){

		$plantID = $request->post('PlantID');
    	

    	if ($plantID!='') {
    		
    		$Delete = DB::table('master_plant')->where('id', $plantID)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Plant Was Deleted Successfully...!');
				return redirect('/finance/view-mast-plant');

			} else {

				$request->session()->flash('alert-error', 'Plant Can Not Deleted...!');
				return redirect('/finance/view-mast-plant');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Plant Not Found...!');
			return redirect('/finance/view-mast-plant');

    	}

	}

	public function ValuationMast(Request $request){

		$title        ='Add Valuation Master';
		
		$valuation_code = $request->old('valuation_code');
		$valuation_name = $request->old('valuation_name');
		$valuation_id   = $request->old('valuation_id');
		$valuation_block   = $request->old('valuation_block');

    	$button='Save';
    	$action='/finance/form-mast-valuation-save';
		//print_r($compData['comp_list']);exit;

		return view('admin.valuation_form',compact('title','valuation_code','valuation_name','valuation_id','valuation_block','button','action'));
    } 

    public function ValuationFormSave(Request $request){


		$validate = $this->validate($request, [

			'valuation_code'  => 'required',
			'valuation_name' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"valuation_code" => $request->input('valuation_code'),
			"valuation_name" => $request->input('valuation_name'),
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_valuation')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Valuation Was Successfully Added...!');
			return redirect('/finance/view-mast-valuation');

		} else {

			$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
			return redirect('/finance/view-mast-valuation');

		}

	}
	 public function EditValuationMast($id){

    	$title = 'Edit Valuation Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_valuation');
			$query->where('id', $id);
			$valData= $query->get()->first();

			$valuation_code  = $valData->valuation_code;
			$valuation_name  = $valData->valuation_name;
			$valuation_block = $valData->val_block;
			$valuation_id    = $valData->id;

			$button='Update';
			$action='/finance/form-mast-valuation-update';

			return view('admin.valuation_form',compact('title','valuation_code','valuation_name','valuation_id','valuation_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-mast-valuation');
		}

    }


    public function ValuationFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'valuation_code'  => 'required',
			'valuation_name' => 'required',

		]);

		$valuation_id = $request->input('valuation_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"valuation_code" => $request->input('valuation_code'),
			"valuation_name" => $request->input('valuation_name'),
			"val_block"      => $request->input('valuation_block'),
			"created_by"     => $createdBy,
			
		);

	$saveData = DB::table('master_valuation')->where('id', $valuation_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Valuation Was Successfully Updated...!');
			return redirect('/finance/view-mast-valuation');

		} else {

			$request->session()->flash('alert-error', 'Valuation Can Not Added...!');
			return redirect('/finance/view-mast-valuation');

		}

	}

	public function ViewValuationMast(Request $request){

    	$title = 'View  Valuation Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$valData['val_list'] = DB::table('master_valuation')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$valData['val_list'] = DB::table('master_valuation')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$valData['val_list']='';
    	}

    	return view('admin.view_valuation',$valData+compact('title'));
    }


    public function DeleteValuation(Request $request){

		$valId = $request->post('valId');
    	

    	if ($valId!='') {
    		
    		$Delete = DB::table('master_valuation')->where('id', $valId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', ' Valuation Was Deleted Successfully...!');
				return redirect('/finance/view-mast-valuation');

			} else {

				$request->session()->flash('alert-error', 'Valuation Can Not Deleted...!');
				return redirect('/finance/view-mast-valuation');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/finance/view-mast-valuation');

    	}

	}

   public function ItemClassMast(Request $request){

		$title        ='Add Item Class Master';
		
		$item_class_code  = $request->old('item_class_code');
		$item_class_name  = $request->old('item_class_name');
		$item_class_id    = $request->old('item_class_id');
		$item_class_block = $request->old('item_class_block');

    	$button='Save';
    	$action='/finance/form-mast-item-class-save';
		//print_r($compData['comp_list']);exit;

		return view('admin.item_class_form',compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));
    } 

    public function ItemClassFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_class_code' => 'required',
			'item_class_name' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_class_code" => $request->input('item_class_code'),
			"item_class_name" => $request->input('item_class_name'),
			"created_by"      => $createdBy,
			
		);

		$saveData = DB::table('master_item_class')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Added...!');
			return redirect('/finance/view-mast-item-class');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/finance/view-mast-item-class');

		}

	}
	 public function EditItemClassMast($id){

    	$title = 'Edit Valuation Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_item_class');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$item_class_code  = $classData->item_class_code;
			$item_class_name  = $classData->item_class_name;
			$item_class_id    = $classData->id;
			$item_class_block = $classData->class_block;

			$button='Update';
			$action='/finance/form-mast-item-class-update';

			return view('admin.item_class_form',compact('title','item_class_code','item_class_name','item_class_id','item_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-mast-item-class');
		}

    }


    public function ItemClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_class_code' => 'required',
			'item_class_name' => 'required',

		]);

		$item_class_id = $request->input('item_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_class_code" => $request->input('item_class_code'),
			"item_class_name" => $request->input('item_class_name'),
			"class_block"     => $request->input('item_class_block'),
			"updated_by"      => $createdBy,
			"updated_by"      => $updatedDate,
			
		);

	$saveData = DB::table('master_item_class')->where('id', $item_class_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Updated...!');
			return redirect('/finance/view-mast-item-class');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/finance/view-mast-item-class');

		}

	}

	public function ViewItemClassMast(Request $request){

    	$title = 'View  Valuation Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$classData['itemclass'] = DB::table('master_item_class')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$classData['itemclass'] = DB::table('master_item_class')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$classData['itemclass']='';
    	}

    	return view('admin.view_item_class',$classData+compact('title'));
    }


    public function DeleteItemClass(Request $request){

		$classId = $request->post('classId');
    	

    	if ($classId!='') {
    		
    		$Delete = DB::table('master_item_class')->where('id', $classId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Class Was Deleted Successfully...!');
				return redirect('/finance/view-mast-item-class');

			} else {

				$request->session()->flash('alert-error', 'Item Class Can Not Deleted...!');
				return redirect('/finance/view-mast-item-class');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Valuation Not Found...!');
			return redirect('/finance/view-mast-valuation');

    	}

	}


	public function ItemTypeMast(Request $request){

		$title        ='Add Item Class Master';
		
		$item_type_code  = $request->old('item_type_code');
		$item_type_name  = $request->old('item_type_name');
		$item_type_id    = $request->old('item_type_id');
		$item_type_block = $request->old('item_type_block');

    	$button='Save';
    	$action='/finance/form-mast-item-type-save';
		//print_r($compData['comp_list']);exit;

		return view('admin.item_type_form',compact('title','item_type_code','item_type_name','item_type_id','item_type_block','button','action'));
    } 

    public function ItemTypeFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_type_code' => 'required',
			'item_type_name' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"item_type_code" => $request->input('item_type_code'),
			"item_type_name" => $request->input('item_type_name'),
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_item_type')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Class Was Successfully Added...!');
			return redirect('/finance/view-mast-item-type');

		} else {

			$request->session()->flash('alert-error', 'Item Class Can Not Added...!');
			return redirect('/finance/view-mast-item-type');

		}

	}
	 public function EditItemTypeMast($id){

    	$title = 'Edit Type Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_item_type');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$item_type_code  = $classData->item_type_code;
			$item_type_name  = $classData->item_type_name;
			$item_type_id    = $classData->id;
			$item_type_block = $classData->type_block;

			$button='Update';
			$action='/finance/form-mast-item-type-update';

			return view('admin.item_type_form',compact('title','item_type_code','item_type_name','item_type_id','item_type_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Config Not Found...!');
			return redirect('/finance/view-mast-item-type');
		}

    }


    public function ItemTypeFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_type_code' => 'required',
			'item_type_name' => 'required',

		]);

		$item_type_id = $request->input('item_type_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"       => $compName,
			"fiscal_year"     => $fisYear,
			"item_type_code" => $request->input('item_type_code'),
			"item_type_name" => $request->input('item_type_name'),
			"type_block"     => $request->input('item_type_block'),
			"updated_by"      => $createdBy,
			"updated_by"      => $updatedDate,
			
		);

	$saveData = DB::table('master_item_type')->where('id', $item_type_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item type Was Successfully Updated...!');
			return redirect('/finance/view-mast-item-type');

		} else {

			$request->session()->flash('alert-error', 'Item type Can Not Added...!');
			return redirect('/finance/view-mast-item-type');

		}

	}

	public function ViewItemTypeMast(Request $request){

    	$title = 'View Item Type Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$typeData['itemtype'] = DB::table('master_item_type')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$typeData['itemtype'] = DB::table('master_item_type')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$typeData['itemtype']='';
    	}

    	return view('admin.view_item_type',$typeData+compact('title'));
    }


    public function DeleteItemType(Request $request){

		$typeId = $request->post('typeId');
    	

    	if ($typeId!='') {
    		
    		$Delete = DB::table('master_item_type')->where('id', $typeId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Type Was Deleted Successfully...!');
				return redirect('/finance/view-mast-item-type');

			} else {

				$request->session()->flash('alert-error', 'Item Type Can Not Deleted...!');
				return redirect('/finance/view-mast-item-type');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/finance/view-mast-item-type');

    	}

	}


	public function RackMast(Request $request){

		$title        ='Add Rack Master';
		
		$rack_code  = $request->old('rack_code');
		$rack_name  = $request->old('rack_name');
		$rack_id    = $request->old('rack_id');
		$rack_block = $request->old('rack_block');

    	$button='Save';
    	$action='/finance/form-mast-rack-save';
		


		return view('admin.rack_form',compact('title','rack_code','rack_name','rack_id','rack_block','button','action'));
    } 

    public function RackFormSave(Request $request){


		$validate = $this->validate($request, [

			'rack_code' => 'required',
			'rack_name' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"rack_code"   => $request->input('rack_code'),
			"rack_name"   => $request->input('rack_name'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_rack')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Rack Was Successfully Added...!');
			return redirect('/finance/view-mast-rack');

		} else {

			$request->session()->flash('alert-error', 'Rack Can Not Added...!');
			return redirect('/finance/view-mast-rack');

		}

	}
	 public function EditRackMast($id){

    	$title = 'Edit Rack Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_rack');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$rack_code  = $classData->rack_code;
			$rack_name  = $classData->rack_name;
			$rack_id    = $classData->id;
			$rack_block = $classData->rack_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-rack-update';

			return view('admin.rack_form',compact('title','rack_code','rack_name','rack_id','rack_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Rack Not Found...!');
			return redirect('/finance/view-mast-rack');
		}

    }


    public function RackFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'rack_code' => 'required',
			'rack_name' => 'required',

		]);

		$rack_id = $request->input('rack_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"rack_code"   => $request->input('rack_code'),
			"rack_name"   => $request->input('rack_name'),
			"rack_block"  => $request->input('rack_block'),
			"updated_by"  => $createdBy,
			"updated_by"  => $updatedDate,
			
		);

	$saveData = DB::table('master_rack')->where('id', $rack_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Rack Was Successfully Updated...!');
			return redirect('/finance/view-mast-rack');

		} else {

			$request->session()->flash('alert-error', 'Rack Can Not Added...!');
			return redirect('/finance/view-mast-rack');

		}

	}

	public function ViewRackMast(Request $request){

    	$title = 'View Rack Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$rackData['rack'] = DB::table('master_rack')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$rackData['rack'] = DB::table('master_rack')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$rackData['rack']='';
    	}

    	return view('admin.view_rack',$rackData+compact('title'));
    }


    public function DeleteRack(Request $request){

		$rackId = $request->post('rackId');
    	

    	if ($rackId!='') {
    		
    		$Delete = DB::table('master_rack')->where('id', $rackId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Rack Was Deleted Successfully...!');
				return redirect('/finance/view-mast-rack');

			} else {

				$request->session()->flash('alert-error', 'Rack Can Not Deleted...!');
				return redirect('/finance/view-mast-rack');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Type Not Found...!');
			return redirect('/finance/view-mast-item-type');

    	}

	}


public function ItemRackMast(Request $request){

		$title        ='Add Item Rack Master';
		
		$item_code  = $request->old('item_code');
		$rack_code  = $request->old('rack_code');
		$item_rack_id    = $request->old('item_rack_id');
		$item_rack_block = $request->old('item_rack_block');

    	$button='Save';
    	$action='/finance/form-mast-item-rack-save';
		//print_r($compData['comp_list']);exit;
		$data['item_list'] = DB::table('master_item')->get();
		$data['rack_list'] = DB::table('master_rack')->get();
	//print_r($data['comp_list']);exit;

		return view('admin.item_rack_form',$data+compact('title','item_code','rack_code','item_rack_id','item_rack_block','button','action'));
    } 

    public function ItemRackFormSave(Request $request){


		$validate = $this->validate($request, [

			'item_code' => 'required',
			'rack_code' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

    	//print_r($request->input('item_code'));exit;

		$data = array(
			"comp_name"   => $compName,
			"fiscal_year" => $fisYear,
			"item_code"   => $request->input('item_code'),
			"rack_code"   => $request->input('rack_code'),
			"created_by"  => $createdBy,
			
		);

		$saveData = DB::table('master_item_rack')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Rack Was Successfully Added...!');
			return redirect('/finance/view-mast-item-rack');

		} else {

			$request->session()->flash('alert-error', 'Item Rack Can Not Added...!');
			return redirect('/finance/view-mast-item-rack');

		}

	}
	 public function EditItemRackMast($id){

    	$title = 'Edit Rack Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_item_rack');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$item_code       = $classData->item_code;
			$rack_code       = $classData->rack_code;
			$item_rack_id    = $classData->id;
			$item_rack_block = $classData->itemrack_block;
			//print_r($rack_block);exit;
			$data['item_list'] = DB::table('master_item')->get();
		    $data['rack_list'] = DB::table('master_rack')->get();

			$button='Update';
			$action='/finance/form-mast-item-rack-update';

			return view('admin.item_rack_form',$data+compact('title','item_code','rack_code','item_rack_id','item_rack_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Rack Not Found...!');
			return redirect('/finance/view-mast-item-rack');
		}

    }


    public function ItemRackFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'item_code' => 'required',
			'rack_code' => 'required',

		]);

		$item_rack_id = $request->input('item_rack_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"item_code"      => $request->input('item_code'),
			"rack_code"      => $request->input('rack_code'),
			"itemrack_block" => $request->input('item_rack_block'),
			"updated_by"     => $createdBy,
			"updated_by"     => $updatedDate,
			
		);

	$saveData = DB::table('master_item_rack')->where('id', $item_rack_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Item Rack Was Successfully Updated...!');
			return redirect('/finance/view-mast-item-rack');

		} else {

			$request->session()->flash('alert-error', 'Item Rack Can Not Added...!');
			return redirect('/finance/view-mast-item-rack');

		}

	}

	public function ViewItemRackMast(Request $request){

    	$title = 'View Rack Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	/*$itemrackData['item_rack'] = DB::table('master_item_rack')->orderBy('id','DESC')->get();*/

    	$itemrackData['item_rack'] = DB::table('master_item_rack')
            ->join('master_item', 'master_item_rack.item_code', '=', 'master_item.item_code')
            ->join('master_rack', 'master_item_rack.rack_code', '=', 'master_rack.rack_code')
            ->select('master_item_rack.*', 'master_item.item_name','master_rack.rack_name')
            ->orderBy('id','DESC')
            ->get();

    	//print_r($itemrackData['item_rack']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$itemrackData['item_rack'] = DB::table('master_item_rack')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$itemrackData['item_rack']='';
    	}

    	return view('admin.view_item_rack',$itemrackData+compact('title'));
    }


    public function DeleteItemRack(Request $request){

		$itemrackId = $request->post('itemrackId');
    	

    	if ($itemrackId!='') {
    		
    		$Delete = DB::table('master_item_rack')->where('id', $itemrackId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Item Rack Was Deleted Successfully...!');
				return redirect('/finance/view-mast-item-rack');

			} else {

				$request->session()->flash('alert-error', 'Item Rack Can Not Deleted...!');
				return redirect('/finance/view-mast-item-rack');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Item Rack Not Found...!');
			return redirect('/finance/view-mast-item-rack');

    	}

	}



/*item category*/

	public function ItemCategory(Request $request){

		$title = 'Add Item Category';

		$itemcategory_code    = $request->old('itemcategory_code');
		$itemcategory_name  = $request->old('itemcategory_name');
		$itemcategory_id  = $request->old('id');
		$category_block      = $request->old('category_block');

		$button='Save';

    	$action='/form-itemcategory-save';

		return view('admin.item_category',compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','action','button'));

	}


	public function SaveItemCategory(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'itemcategory_code' => 'required',
				'itemcategory_name' => 'required',

		]);

		$data = array(
					"itemcategory_code" =>  $request->input('itemcategory_code'),
					"itemcategory_name" =>  $request->input('itemcategory_name'),
					"created_by"        =>  $request->session()->get('userid'),
					"comp_name"         =>  $compName,
					"fiscal_year"       => $fisYear
					
	    	);

		$saveData = DB::table('master_item_category')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Added...!');
				return redirect('/finance/view-item-category');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Added...!');
				return redirect('/finance/view-item-category');

			}

	}


	public function ViewItemCategory(Request $request){

    	if ($request->ajax()) {

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_item_category')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_item_category')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-item-category/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#itemcatDelete" class="btn btn-danger btn-xs" onclick="return deleteitemcategory('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Item Category';
       return view('admin.view_item_category',compact('title'));

    }


    public function DeleteItemCategory(Request $request){

        $id = $request->input('itemcatid');
        if ($id!='') {

			$Delete = DB::table('master_item_category')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Category Data Was Deleted Successfully...!');
			return redirect('/finance/view-item-category');

			} else {

			$request->session()->flash('alert-error', 'Item Category Data Can Not Deleted...!');
			return redirect('/finance/view-item-category');

			}

		}else{

		$request->session()->flash('alert-error', 'Item Category Data Not Found...!');
		return redirect('/finance/view-item-category');

		}
	}


	public function EditItemCategory($id){

    	$title = 'Edit Item Category';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_item_category');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$itemcategory_code  = $classData->itemcategory_code;
			$itemcategory_name  = $classData->itemcategory_name;
			$itemcategory_id    = $classData->id;
			$category_block = $classData->category_block;

			$button='Update';
			$action='/form-item-category-update';

			return view('admin.item_category',compact('title','itemcategory_code','itemcategory_name','itemcategory_id','category_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-item-category');
		}

    }


    public function UpdateItemCategory(Request $request){

		
		$validate = $this->validate($request, [

				'itemcategory_code' => 'required',
				'itemcategory_name' => 'required',
				'category_block'    => 'required',

		]);

       $id = $request->input('idcat');
       $updatedDate = date('Y-m-d');

		$data = array(
				"itemcategory_code" =>  $request->input('itemcategory_code'),
				"itemcategory_name" =>  $request->input('itemcategory_name'),
				"category_block"    =>  $request->input('category_block'),
				"last_updat_by"     =>  $request->session()->get('userid'),
				"last_updat_date"   =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_item_category')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Category Was Successfully Updated...!');
				return redirect('/finance/view-item-category');

			} else {

				$request->session()->flash('alert-error', 'Item Category Can Not Updated...!');
				return redirect('/finance/view-item-category');

			}


	}

/*item category*/


/*item group*/

	public function ItemGroup(Request $request){

		$title = 'Add Item Group';

		$itemgroup_code = $request->old('itemgroup_code');
		$itemgroup_name = $request->old('itemgroup_name');
		$itemgroup_id   = $request->old('id');
		$group_block    = $request->old('group_block');

		$button='Save';

    	$action='/form-itemgroup-save';

		return view('admin.item_group',compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','action','button'));

	}

	public function SaveItemGroup(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'itemgroup_code' => 'required',
				'itemgroup_name' => 'required',

		]);

		$data = array(
					"itemgroup_code" =>  $request->input('itemgroup_code'),
					"itemgroup_name" =>  $request->input('itemgroup_name'),
					"created_by"     =>  $request->session()->get('userid'),
					"comp_name"      =>  $compName,
					"fiscal_year"    =>  $fisYear
					
	    	);

		$saveData = DB::table('master_itemgroup')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Added...!');
				return redirect('/finance/view-item-group');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Added...!');
				return redirect('/finance/view-item-group');

			}

	}

	public function ViewItemGroup(Request $request){

    	if ($request->ajax()) {

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_itemgroup')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_itemgroup')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-item-group/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#itemgroupDelete" class="btn btn-danger btn-xs" onclick="return deleteitemgroup('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View Item Group';
       return view('admin.view_item_group',compact('title'));

    }


    public function DeleteItemgroup(Request $request){

        $id = $request->input('itemgroupid');
        if ($id!='') {

			$Delete = DB::table('master_itemgroup')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'Item Group Data Was Deleted Successfully...!');
			return redirect('/finance/view-item-group');

			} else {

			$request->session()->flash('alert-error', 'Item Group Data Can Not Deleted...!');
			return redirect('/finance/view-item-group');

			}

		}else{

		$request->session()->flash('alert-error', 'Item Group Data Not Found...!');
		return redirect('/finance/view-item-group');

		}
	}


	public function EditItemGroup($id){

    	$title = 'Edit Item Group';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_itemgroup');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$itemgroup_code = $classData->itemgroup_code;
			$itemgroup_name = $classData->itemgroup_name;
			$itemgroup_id   = $classData->id;
			$group_block    = $classData->group_block;

			$button='Update';
			$action='/form-item-group-update';

			return view('admin.item_group',compact('title','itemgroup_code','itemgroup_name','itemgroup_id','group_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-item-group');
		}

    }

    public function UpdateItemGroup(Request $request){

		
		$validate = $this->validate($request, [

				'itemgroup_code' => 'required',
				'itemgroup_name' => 'required',
				'group_block'    => 'required',

		]);

       $id = $request->input('idgroup');
       $updatedDate = date('Y-m-d');

		$data = array(
				"itemgroup_code"  =>  $request->input('itemgroup_code'),
				"itemgroup_name"  =>  $request->input('itemgroup_name'),
				"group_block"     =>  $request->input('group_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_itemgroup')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Updated...!');
				return redirect('/finance/view-item-group');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Updated...!');
				return redirect('/finance/view-item-group');

			}


	}

/*item group*/

/*TDS Master*/

	public function TDSMast(Request $request){

		$title = 'Add TDS';

		$tds_code         = $request->old('tds_code');
		$tds_name         = $request->old('tds_name');
		$tds_rate         = $request->old('tds_rate');
		$surcharge_rate   = $request->old('surcharge_rate');
		$surchargegl_code = $request->old('surchargegl_code');
		$cess_rate        = $request->old('cess_rate');
		$cessgl_code      = $request->old('cessgl_code');
		$form_no          = $request->old('form_no');
		$gl_code          = $request->old('gl_code');
		$tds_section      = $request->old('tds_section');
		$from_date        = $request->old('from_date');
		$to_date          = $request->old('to_date');
		$tds_id           = $request->old('id');
		$tds_block        = $request->old('tds_block');

		$button='Save';

    	$action='/form-tdsmast-save';

    	$glData['gl_list'] = DB::table('master_gl')->get();

		return view('admin.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','gl_code','tds_section','from_date','to_date','tds_id','tds_block','action','button'));

	}

	public function SaveTDSMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');


		$validate = $this->validate($request, [

				'tds_code'         => 'required',
				'tds_name'         => 'required',
				'tds_rate'         => 'required',
				'surcharge_rate'   => 'required',
				'surchargegl_code' => 'required',
				'cess_rate'        => 'required',
				'cessgl_code'      => 'required',
				'form_no'          => 'required',
				'gl_code'          => 'required',
				'tds_section'      => 'required',
				'from_date'        => 'required',
				'to_date'          => 'required',
				

		]);

		$data = array(
					"tds_code"         =>  $request->input('tds_code'),
					"tds_name"         =>  $request->input('tds_name'),
					"tds_rate"         =>  $request->input('tds_rate'),
					"surcharge_rate"   =>  $request->input('surcharge_rate'),
					"surchargegl_code" =>  $request->input('surchargegl_code'),
					"cess_rate"        =>  $request->input('cess_rate'),
					"cessgl_code"      =>  $request->input('cessgl_code'),
					"form_no"          =>  $request->input('form_no'),
					"gl_code"          =>  $request->input('gl_code'),
					"tds_section"      =>  $request->input('tds_section'),
					"from_date"        =>  $request->input('from_date'),
					"to_date"          =>  $request->input('to_date'),
					"created_by"       =>  $request->session()->get('userid'),
					"comp_name"        =>  $compName,
					"fiscal_year"      =>  $fisYear
					
	    	);

		$saveData = DB::table('master_tds')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Was Successfully Added...!');
				return redirect('/finance/view-tds-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Can Not Added...!');
				return redirect('/finance/view-tds-mast');

			}

	}


	public function ViewTDSMast(Request $request){

    	if ($request->ajax()) {

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_tds')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_tds')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	 

    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-tds-mast/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#tdsDelete" class="btn btn-danger btn-xs" onclick="return deletetds('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View TDS';
       return view('admin.view_tds_mast',compact('title'));

    }

    public function DeleteTDSMast(Request $request){

        $id = $request->input('tdsid');
        if ($id!='') {

			$Delete = DB::table('master_tds')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'TDS Data Was Deleted Successfully...!');
			return redirect('/finance/view-tds-mast');

			} else {

			$request->session()->flash('alert-error', 'TDS Data Can Not Deleted...!');
			return redirect('/finance/view-tds-mast');

			}

		}else{

		$request->session()->flash('alert-error', 'TDS Data Not Found...!');
		return redirect('/finance/view-tds-mast');

		}
	}


	public function EditTDSMast($id){

    	$title = 'Edit TDS Master';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_tds');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$tds_code         = $classData->tds_code;
			$tds_name         = $classData->tds_name;
			$tds_rate         = $classData->tds_rate;
			$surcharge_rate   = $classData->surcharge_rate;
			$surchargegl_code = $classData->surchargegl_code;
			$cess_rate        = $classData->cess_rate;
			$cessgl_code      = $classData->cessgl_code;
			$form_no          = $classData->form_no;
			$from_date        = $classData->from_date;
			$to_date          = $classData->to_date;
			$gl_code          = $classData->gl_code;
			$tds_section      = $classData->tds_section;
			$tds_id           = $classData->id;
			$tds_block        = $classData->tds_block;

			$button='Update';
			$action='/form-tds-mast-update';

			$glData['gl_list'] = DB::table('master_gl')->get();

			return view('admin.tds_mast',$glData+compact('title','tds_code','tds_name','tds_rate','surcharge_rate','surchargegl_code','cess_rate','cessgl_code','form_no','from_date','to_date','gl_code','tds_section','tds_id','tds_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Item Category Not Found...!');
			return redirect('/finance/view-tds-mast');
		}

    }


    public function UpdateTDSMast(Request $request){

		$validate = $this->validate($request, [

				'tds_code'         => 'required',
				'tds_name'         => 'required',
				'tds_rate'         => 'required',
				'surcharge_rate'   => 'required',
				'surchargegl_code' => 'required',
				'cess_rate'        => 'required',
				'cessgl_code'      => 'required',
				'form_no'          => 'required',
				'gl_code'          => 'required',
				'tds_section'      => 'required',
				'from_date'        => 'required',
				'to_date'          => 'required',
				

		]);

       $id = $request->input('idtds');
       $updatedDate = date('Y-m-d');

		$data = array(
				"tds_code"         =>  $request->input('tds_code'),
				"tds_name"         =>  $request->input('tds_name'),
				"tds_rate"         =>  $request->input('tds_rate'),
				"surcharge_rate"   =>  $request->input('surcharge_rate'),
				"surchargegl_code" =>  $request->input('surchargegl_code'),
				"cess_rate"        =>  $request->input('cess_rate'),
				"cessgl_code"      =>  $request->input('cessgl_code'),
				"form_no"          =>  $request->input('form_no'),
				"gl_code"          =>  $request->input('gl_code'),
				"tds_section"      =>  $request->input('tds_section'),
				"from_date"        =>  $request->input('from_date'),
				"to_date"          =>  $request->input('to_date'),
				"tds_block"        =>  $request->input('tds_block'),
				"last_updat_by"    =>  $request->session()->get('userid'),
				"last_updat_date"  =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_tds')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'Item Group Was Successfully Updated...!');
				return redirect('/finance/view-tds-mast');

			} else {

				$request->session()->flash('alert-error', 'Item Group Can Not Updated...!');
				return redirect('/finance/view-tds-mast');

			}


	}


	public function AccClassMast(Request $request){

		$title        ='Add Rack Master';
		
		$acc_class_code  = $request->old('acc_class_code');
		$acc_class_name  = $request->old('acc_class_name');
		$acc_class_id    = $request->old('acc_class_id');
		$acc_class_block = $request->old('acc_class_block');

    	$button='Save';
    	$action='/finance/form-mast-acc-class-save';
		


		return view('admin.acc_class_form',compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));
    } 

    public function AccClassFormSave(Request $request){


		$validate = $this->validate($request, [

			'acc_class_code' => 'required',
			'acc_class_name' => 'required',

		]);


    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_class_code" => $request->input('acc_class_code'),
			"acc_class_name" => $request->input('acc_class_name'),
			"created_by"     => $createdBy,
			
		);

		$saveData = DB::table('master_acc_class')->insert($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Class Was Successfully Added...!');
			return redirect('/finance/view-mast-acc-class');

		} else {

			$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
			return redirect('/finance/view-mast-acc-class');

		}

	}
	 public function EditAccClassMast($id){

    	$title = 'Edit Acc Class Master';

    	//print_r($id);
    	$id = base64_decode($id);


    	if($id!=''){
    	    $query = DB::table('master_acc_class');
			$query->where('id', $id);
			$classData= $query->get()->first();

			$acc_class_code  = $classData->acc_class_code;
			$acc_class_name  = $classData->acc_class_name;
			$acc_class_id    = $classData->id;
			$acc_class_block = $classData->class_block;
			//print_r($rack_block);exit;

			$button='Update';
			$action='/finance/form-mast-acc-class-update';

			return view('admin.acc_class_form',compact('title','acc_class_code','acc_class_name','acc_class_id','acc_class_block','button','action'));
		}else{
			$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/finance/view-mast-acc-class');
		}

    }


    public function AccClassFormUpdate(Request $request){

		$validate = $this->validate($request, [

			'acc_class_code' => 'required',
			'acc_class_name' => 'required',

		]);

		$acc_class_id = $request->input('acc_class_id');

		date_default_timezone_set('Asia/Kolkata');

		$updatedDate = date("Y-m-d");

    	$createdBy 	= $request->session()->get('userid');

    	$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$data = array(
			"comp_name"      => $compName,
			"fiscal_year"    => $fisYear,
			"acc_class_code" => $request->input('acc_class_code'),
			"acc_class_name" => $request->input('acc_class_name'),
			"class_block"    => $request->input('acc_class_block'),
			"updated_by"     => $createdBy,
			"updated_by"     => $updatedDate,
			
		);

	$saveData = DB::table('master_acc_class')->where('id', $acc_class_id)->update($data);

		if ($saveData) {

			$request->session()->flash('alert-success', 'Acc Class Was Successfully Updated...!');
			return redirect('/finance/view-mast-acc-class');

		} else {

			$request->session()->flash('alert-error', 'Acc Class Can Not Added...!');
			return redirect('/finance/view-mast-acc-class');

		}

	}

	public function ViewAccClassMast(Request $request){

    	$title = 'View Acc Class Master';

    	$userid	= $request->session()->get('userid');

    	$userType = $request->session()->get('usertype');

    	$compName = $request->session()->get('company_name');

    	$fisYear =  $request->session()->get('macc_year');

    	if($userType=='admin'){

    	$classData['acc_class'] = DB::table('master_acc_class')->orderBy('id','DESC')->get();

    	//print_r($valData['val_list']);exit;
    	}
		elseif ($userType=='superAdmin' || $userType=='user') {

    		$classData['acc_class'] = DB::table('master_acc_class')->where(['created_by' => $userid, 'comp_name' => $compName, 'fiscal_year' => $fisYear])->orderBy('id','DESC')->get();
    	}
    	else{
    		$classData['acc_class']='';
    	}

    	return view('admin.view_acc_class',$classData+compact('title'));
    }


    public function DeleteAccClass(Request $request){

		$classId = $request->post('classId');
    	

    	if ($classId!='') {
    		
    		$Delete = DB::table('master_acc_class')->where('id', $classId)->delete();

			if ($Delete) {

				$request->session()->flash('alert-success', 'Acc Class Was Deleted Successfully...!');
				return redirect('/finance/view-mast-acc-class');

			} else {

				$request->session()->flash('alert-error', 'Acc Class Can Not Deleted...!');
				return redirect('/finance/view-mast-acc-class');

			}

    	}else{

    		$request->session()->flash('alert-error', 'Acc Class Not Found...!');
			return redirect('/finance/view-mast-acc-class');

    	}

	}

/*TDS Master*/


/*TDS Rate Master*/

	public function TDSRateMast(Request $request){

		$title = 'Add TDS Rate';

		$tds_code  = $request->old('tds_code');
		$acc_code  = $request->old('acc_code');
		$tds_rate  = $request->old('tds_rate');
		$from_date = $request->old('from_date');
		$to_date   = $request->old('to_date');
		$tdsrate_id   = $request->old('tdsrateid');
		$button='Save';

    	$action='/form-tds-rate-mast-save';

    	$userdata['tds_list'] = DB::table('master_tds')->get();
    	$userdata['acc_list'] = DB::table('master_acc')->get();

		return view('admin.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','from_date','to_date','tds_rate','tdsrate_id','action','button'));

	}


	public function SaveTDSRateMast(Request $request){

		$compName 	= $request->session()->get('company_name');

    	$fisYear 	=  $request->session()->get('macc_year');

		$validate = $this->validate($request, [

				'tds_code'      => 'required',
				'acc_code'      => 'required',
				'tds_rate'      => 'required',
				'from_date'     => 'required',
				'to_date'       => 'required',	
		]);

		$data = array(
					"tds_code"      =>  $request->input('tds_code'),
					"acc_code"      =>  $request->input('acc_code'),
					"tds_rate"      =>  $request->input('tds_rate'),
					"from_date"     =>  $request->input('from_date'),
					"to_date"       =>  $request->input('to_date'),
					"created_by"    =>  $request->session()->get('userid'),
					"comp_name"     =>  $compName,
					"fiscal_year"   =>  $fisYear	
	    	);

		$saveData = DB::table('master_tds_rate')->insert($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Rate Was Successfully Added...!');
				return redirect('/finance/view-tds-rate-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Rate Can Not Added...!');
				return redirect('/finance/view-tds-rate-mast');

			}

	}

	public function ViewTDSRateMast(Request $request){

    	if ($request->ajax()) {

		$user_type   = $request->session()->get('user_type');
		
		$userid      = $request->session()->get('userid');
		
		$CompanyCode = $request->session()->get('company_name');
		
		$macc_year   = $request->session()->get('macc_year');

		if($user_type == 'admin'){
    
       	 $data = DB::table('master_tds_rate')->get();

    	}else if($user_type == 'superAdmin' || $user_type == 'user'){

    	 $data = DB::table('master_tds_rate')->where([['created_by','=',$userid],['comp_name','=',$CompanyCode],['fiscal_year','=',$macc_year]])->get();
    	}else{
    		
    	 $data ='';
    	}

    	return DataTables()->of($data)->addIndexColumn()->addColumn('action', function($data){
				$btn = '<a href="'.url('/finance/edit-tds-rate-mast/'.base64_encode($data->id)).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil " title="edit"></i></a> | <button type="button" data-toggle="modal" data-target="#tdsrateDelete" class="btn btn-danger btn-xs" onclick="return deletetdsrate('.$data->id.')"><i class="fa fa-trash" title="delete"></i></button>';
     			
     			return $btn;
			})->make(true);

       }

       $title = 'View TDS Rate';
       return view('admin.view_tds_rate_mast',compact('title'));

    }


    public function DeleteTDSRateMast(Request $request){

        $id = $request->input('tdsrateid');
        if ($id!='') {

			$Delete = DB::table('master_tds_rate')->where('id', $id)->delete();

			if ($Delete) {

			$request->session()->flash('alert-success', 'TDS Rate Data Was Deleted Successfully...!');
			return redirect('/finance/view-tds-rate-mast');

			} else {

			$request->session()->flash('alert-error', 'TDS Rate Data Can Not Deleted...!');
			return redirect('/finance/view-tds-rate-mast');

			}

		}else{

		$request->session()->flash('alert-error', 'TDS Rate Data Not Found...!');
		return redirect('/finance/view-tds-rate-mast');

		}
	}



	public function EditTDSRateMast($id){

    	$title = 'Edit TDS Rate';

    	//print_r($id);
    	$id = base64_decode($id);

    	if($id!=''){
    	    $query = DB::table('master_tds_rate');
			$query->where('id', $id);
			$classData= $query->get()->first();
			
			$tds_code      = $classData->tds_code;
			$acc_code      = $classData->acc_code;
			$tds_rate      = $classData->tds_rate;
			$from_date     = $classData->from_date;
			$to_date       = $classData->to_date;
			$tdsrate_block = $classData->tdsrate_block;
			$tdsrate_id    = $classData->id;

			$button='Update';
			$action='/form-tds-rate-mast-update';

			$userdata['tds_list'] = DB::table('master_tds')->get();
    		$userdata['acc_list'] = DB::table('master_acc')->get();

			return view('admin.tds_rate_mast',$userdata+compact('title','tds_code','acc_code','tds_rate','from_date','to_date','tdsrate_block','tdsrate_id','button','action'));
		}else{
			$request->session()->flash('alert-error', 'TDS Rate Not Found...!');
			return redirect('/finance/view-tds-rate-mast');
		}

    }


    public function UpdateTDSRateMast(Request $request){

		$validate = $this->validate($request, [

				'tds_code'      => 'required',
				'acc_code'      => 'required',
				'tds_rate'      => 'required',
				'from_date'     => 'required',
				'to_date'       => 'required',	
		]);

       $id = $request->input('idtds');
       $updatedDate = date('Y-m-d');

		$data = array(
				"tds_code"        =>  $request->input('tds_code'),
				"acc_code"        =>  $request->input('acc_code'),
				"tds_rate"        =>  $request->input('tds_rate'),
				"from_date"       =>  $request->input('from_date'),
				"to_date"         =>  $request->input('to_date'),
				"tdsrate_block"   =>  $request->input('tdsrate_block'),
				"last_updat_by"   =>  $request->session()->get('userid'),
				"last_updat_date" =>  $updatedDate
	 
	    	);

		$saveData = DB::table('master_tds_rate')->where('id', $id)->update($data);

			if ($saveData) {

				$request->session()->flash('alert-success', 'TDS Rate Was Successfully Updated...!');
				return redirect('/finance/view-tds-rate-mast');

			} else {

				$request->session()->flash('alert-error', 'TDS Rate Can Not Updated...!');
				return redirect('/finance/view-tds-rate-mast');

			}


	}

/*TDS Rate Master*/







}


?>