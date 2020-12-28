@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  .PageTitle{
    margin-right: 1px !important;
  }
 .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;
*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .content {
    min-height: 250px !important;
    padding: 0px !important;
    margin-right: auto !important;
    margin-left: auto !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
}
.showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}

.vehiclenumup{
  text-transform: uppercase;
}
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Fleet Transaction 
            <small>Add Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('dashboard') }}">Fleet</a></li>
            <li><a href="{{ url('logistic/fleet-transaction') }}">Fleet Transaction</a></li>
            <li><a href="{{ url('logistic/fleet-transaction') }}">Add Fleet Trans</a></li>
          </ol>
        </section>
 <form action="{{ url('form-fleet-trans-save') }}" method="POST" >
 	 @csrf
  <section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12" style="padding-top: 5%;">
        <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Fleet Transaction </h2>

               <div class="box-tools pull-right">
                <a href="{{ url('/logistic/view-fleet-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View fleet Transaction</a>
              </div>
          
          </div><!-- /.box-header -->

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                  <i class="icon fa fa-check"></i>
                  Success...!
                </h4>
                 {!! session('alert-success') !!}
              </div>


            @endif


            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                  <i class="icon fa fa-ban"></i>
                  Error...!
                </h4>
                {!! session('alert-error') !!}
              </div>

            @endif

          <div class="box-body">
          
              
               <div class="row">
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Transaction Date : 
                        <span class="required-field"></span>
                      </label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" value="{{ date('Y-m-d') }}">
                        </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Depot Name : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ old('dept_code')}}" placeholder="Select Depot Name" >

                          <datalist id="depotList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($depot_list as $key)
                            
                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>

                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="depotText"></div>
                     </small>
                     <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('dept_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                  </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->


                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Invoice Number 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <input type="text" class="form-control" name="invoice_no" value="{{ old('invoice_no')}}" placeholder="Enter Invoice Number">
                      </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('invoice_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->

                  
                
              </div>
              <!-- /.row -->

              <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </div>

                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" >

                          <datalist id="accountList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($acc_list as $key)
                            
                            <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>
                            
                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="accountText"></div>
                     </small>
                     <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('acct_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                  </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Area : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-street-view" aria-hidden="true"></i>
                          </div>
                          <input list="areaList"  id="area_code" name="area_code" class="form-control  pull-left" value="{{ old('area_code')}}" placeholder="Select Area" >

                          <datalist id="areaList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($area_list as $key)
                            
                            <option value='<?php echo $key->code?>'   data-xyz ="<?php echo $key->name; ?>" ><?php echo $key->name ; echo " [".$key->code."]" ; ?></option>

                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="areaText"></div>
                     </small>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('area_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Shipment No 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <input type="text" class="form-control" name="shipment_no" value="{{ old('shipment_no')}}" placeholder="Enter Shipment No">
                      </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('shipment_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                
              </div>
              <!-- /.row -->

          </div><!-- /.box-body -->


          
           
          </div>


      </div>
       
    </div>
     
	</section>

	<section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12">
        <div class="box box-warning Custom-Box">
         
          <div class="box-body">
            <div class="row">
                 <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        L R NO:  
                        <span class="required-field"></span>
                      </label>
                    <div class="input-group">
                         <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                         </div>
                      <input type="text" name="lr_no" class="form-control" placeholder="Enter L R NO" value="{{ old('lr_no')}}">
                     </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('lr_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                     
                    </div>
                  </div>
                    <!-- /.form-group -->
                  

                  <div class="col-md-4 setinmobileDiv">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-bus" aria-hidden="true"></i>
                          </div>
                          <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter">
                          <datalist id="transList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($acctype_list as $key)                  

                            <option value='<?php echo $key->acctype_code?>'   data-xyz ="<?php echo $key->acctype_name; ?>" ><?php echo $key->acctype_name ; echo " [".$key->acctype_code."]" ; ?></option>                        
                            @endforeach
                          </datalist>
                      </div>

                      <small>  
                        <div class="pull-left showSeletedName" id="transText"></div>
                     </small>

                      <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div><!-- /.col -->

                   <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Truck No: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                          </span>
                       <input name="truck_no" class="form-control vehiclenumup" placeholder="Enter Truck No" value="{{ old('truck_no') }}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
                </div>

                  
                <div class="row">
                  <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-ship" aria-hidden="true"></i>

                        </div>

                        <input list="itemList" id="item_code" name="material" class="form-control  pull-left" value="" placeholder="Select Item">



                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->item_code?>'   data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="itemText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('material', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="errorItem" class="form-text text-muted">

                           

                      </small>

                  </div>

                </div><!-- /.col -->
                 </div>



                <div class="row">

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                         Qty UM: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                        <input type="hidden" id="cfator">
                       <input name="sto_qty_um" id="stoqtyum" class="form-control Number" placeholder="Enter Qty UM" >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('sto_qty_um', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                        UM: 
                        <span class="required-field"></span>
                      </label>
                     
                       <input name="stoUM" id="stoUM" class="form-control" placeholder="Enter UM" readonly>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoUM', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
               
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                         Qty AUM: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                          </span>
                       <input name="sto_qty_aum" id="stoQtyAum" class="form-control Number" placeholder="Enter Qty AUM" >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('sto_qty_aum', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                        AUM: 
                        <span class="required-field"></span>
                      </label>
                     
                       <input name="stoAum" id="stoAum" class="form-control" placeholder="Enter AUM" readonly>
                      
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoAum', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
                 
                 </div>

                 <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Overload : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          
                       <input type="radio" name="overload" class="optionsRadios1" value="Y">&nbsp; &nbsp;&nbsp;&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                       <input type="radio" name="overload" class="optionsRadios1" value="N" >&nbsp; &nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('overload', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                     
                    <div class="form-group">
                      <label>
                        Rate : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="rate" class="form-control" placeholder="Enter Rate" value="{{ old('rate') }}" id="rate" readonly="">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                     </div>
                  </div>
                  
                  

                  <div class="col-md-4">
                     
                    <!-- /.form-group -->
                  </div>
                
              </div>
          </div><!-- /.box-body -->

          </div>

      </div>
       
    </div>
     
	</section>


	<section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-9">
        <div class="box box-success Custom-Box" style="width: 104% !important;">
            <!-- /.box-header -->
          
          <div class="box-body">
             <div class="row">
                 
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Driver Exp : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="drv_exp" class="form-control" id="a2" placeholder="Enter Driver Exp" value="{{ old('drv_exp') }}" onfocusout='calculate()'>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('drv_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Fooding Exp: 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="fooding" class="form-control" placeholder="Enter Fooding Exp" value="{{ old('fooding') }}" onfocusout='calculate()' id="a4">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('fooding', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Admin Exp : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="p_exp" class="form-control" placeholder="Enter Admin Exp" value="{{ old('p_exp') }}" id="a3" onfocusout='calculate()'>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('p_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        U-Loading Exp : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="lu_exp" class="form-control" placeholder="Enter LU Exp" value="{{ old('lu_exp') }}" onfocusout='calculate()' id="a5">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('lu_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Toll Exp: 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="toll" class="form-control" placeholder="Enter Toll Exp" value="{{ old('toll') }}" id="a6" onfocusout='calculate()'>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('toll', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Diesel Exp: 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="Disel" class="form-control" id="a1" placeholder="Enter Diesel Exp" value="{{ old('Disel') }}" onfocusout='calculate()'>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('Disel', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>  

                <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Other Exp : 
                       
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="other_exp" class="form-control" placeholder="Enter Other Exp" value="{{ old('other_exp') }}" id="a7" onfocusout='calculate()'>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('other_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Total Adv : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="total_adv" class="form-control" placeholder="Enter Total Adv" value="{{ old('total_adv') }}" id="TOTAL" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('total_adv', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Meter Reading : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="METER_READING" class="form-control" placeholder="Enter Meter Reading" value="{{ old('METER_READING') }}" id="meter_reading">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('METER_READING', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                
              </div>
          </div><!-- /.box-body -->
        </div>
      </div>

      <div class="col-sm-3">
        <div class="box box-success Custom-Box">
            <!-- /.box-header -->
          
          <div class="box-body">
            <div class="row">

              <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Diesel Cr : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-flask" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="DIESEL_CR" class="form-control" placeholder="Enter Diesel Cr" value="{{ old('DIESEL_CR') }}" id="diesedl_cr">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_CR', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Diesel Slip No : 
                       
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-file" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="deisel_slip_no" class="form-control" placeholder="Enter Diesel Slip No" value="{{ old('deisel_slip_no') }}" id="diesel_slip_no">
                      </div>
                      <small id="enterslipnomsg"></small>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('deisel_slip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Diesel Qty : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="diesel_qty" class="form-control" placeholder="Enter Diesel Qty" value="{{ old('diesel_qty') }}" id="diesel_qty">
                      </div>
                      <small id="filerrormsg"></small>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('diesel_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>
              
            </div>
          </div>
        </div>
      
    </div>
     
	</section>
	<div class="box-body">
		<div style="text-align: center;margin-top: -4%;
    margin-bottom: 5%;">
	                 <button type="Submit" class="btn btn-primary" id="hidesubmitbtn">
	                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 
	                 </button>
	     </div>
     </div>

 </form>
</div>

@include('admin.include.footer')

<script type="text/javascript">
  
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate:'today',
      autoclose: 'true'
    });
});
</script>
<script type="text/javascript">
  calculate = function()
  {
    var DEISEL=DRV_Exp=P_Exp=Fooding=Fooding=LU_Exp=Other_Exp=Toll=0;
    
    
     DEISEL = document.getElementById('a1').value;
     DRV_Exp = document.getElementById('a2').value; 
     P_Exp = document.getElementById('a3').value; 
     Fooding = document.getElementById('a4').value; 
     LU_Exp = document.getElementById('a5').value; 
     Toll = document.getElementById('a6').value; 
     Other_Exp = document.getElementById('a7').value; 
     
     if(DEISEL=="")DEISEL=0;
     if(DRV_Exp=="")DRV_Exp=0;
     if(P_Exp=="")P_Exp=0;
     if(Fooding=="")Fooding=0;
     if(LU_Exp=="")LU_Exp=0;
     if(Toll=="")Toll=0;
     if(Other_Exp=="")Other_Exp=0;
   
      
     
    document.getElementById('TOTAL').value = parseInt(DEISEL)+parseInt(DRV_Exp)+parseInt(P_Exp)+parseInt(Fooding)+parseInt(LU_Exp)+parseInt(Toll)+parseInt(Other_Exp);

     }
</script>
<script type="text/javascript">

 

  $(".optionsRadios1").on('change',function () { 
    var radio_btn = $(this).val();
    console.log(radio_btn);  
    var area_code = $("#area_code").val(); 
    var dept_code = $('#dept_code').val(); 
     getRate(area_code,dept_code,radio_btn);
    
});

   function getRate(area_code,dept_code,radio_btn)
   {
     
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });

      var loadType = radio_btn;
      var DEPOT_PLANT = dept_code;
      var DESTINATION = area_code;
     
      $.ajax({
        type: 'POST',
        url: "{{ url('/fleet_rate') }}",
        data: {
        'loadType': loadType, 
        'DEPOT_PLANT': DEPOT_PLANT, 
        'DESTINATION': DESTINATION, 
        'act': 'getRate'
        },
        success: function (data) {

           console.log("Data ==> ",data);

          if (data == '') {

             $("#rate").val('');

          }else{

            var obj = JSON.parse(data);
           
              $("#rate").val(obj.rate);
          }
          
          
        
        
        }
      }); 
        
       
     
   }
</script>


<script type="text/javascript">
    $(document).ready(function() {

      $('#a1').change(function(){
          var diselexp = $('#a1').val();
          if(diselexp){
          $('#diesel_slip_no').val('');
          $('#diesedl_cr').val('');
          $( "#diesel_slip_no" ).prop( "disabled", true );
          $( "#diesedl_cr" ).prop( "disabled", true );

          $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
          $('#hidesubmitbtn').prop( "disabled", true );

        }else{
            $( "#diesel_slip_no" ).prop( "disabled", false );
          $( "#diesedl_cr" ).prop( "disabled", false );
        }
      });

      $('#diesedl_cr').on('input',function(){
        $('#enterslipnomsg').html('');
          var diselcr = $('#diesedl_cr').val();
          
          if(diselcr){
            $('#a1').prop( "disabled", true );
            $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
            $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
            $( "#hidesubmitbtn" ).prop( "disabled", true );
            return true;
          }else{
             $('#a1').prop( "disabled", false );
            $('#enterslipnomsg').html('');
            $('#filerrormsg').html('');
            return false;
          }
      });

      $('#diesel_slip_no').on('input',function(){
       var diesel_slip_no =  $('#diesel_slip_no').val();
          if(diesel_slip_no){
            $('#enterslipnomsg').html('');
           // $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
           
          }else{
            $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
            $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
           // $( "#hidesubmitbtn" ).prop( "disabled", true );
          }
      });

      $('#diesel_slip_no').change(function(){
         var diselslipno = $('#diesel_slip_no').val();

         var driver_exp = $('#a2').val();
         var fooding_exp = $('#a4').val();
         var admin_exp = $('#a3').val();
         var uloading_exp = $('#a5').val();
         var toll_exp = $('#a6').val();
         var other_exp = $('#a7').val();
         var total_adv = parseInt(driver_exp)+parseInt(fooding_exp)+parseInt(admin_exp)+parseInt(uloading_exp)+parseInt(toll_exp)+parseInt(other_exp);

        // console.log(total_adv);

         if(diselslipno){
          $('#a1').val('');
          $('#TOTAL').val(total_adv);
         }

      });


      $('#diesel_qty').on('input',function(){
          var dieselQty = $(this).val();
          if(dieselQty){

          $('#hidesubmitbtn').prop( "disabled", false );
          $('#filerrormsg').html('');
        }else{
          $('#hidesubmitbtn').prop( "disabled", true );
        }
      });

      $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

      });

      $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

      });

      $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

        });

      $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });

       $("#trans_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

        });


      $("#item_code").change(function(){

         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var itemcode =  $(this).val();

        $.ajax({

          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    // console.log(data1.data[0]);

                    $('#stoUM').val(data1.data[0].um_code);
                    $('#stoAum').val(data1.data[0].aum);
                    $('#cfator').val(data1.data[0].aum_factor);
                        

                }
           }

        });

      });



      $("#stoqtyum").on('input',function(){

            var stoQty = $("#stoqtyum").val();

            var cFactor = $("#cfator").val();

            var result = stoQty*cFactor;

            if(stoQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#stoqtyum").val('0');

               $("#stoQtyAum").val('');

            }else{

               $("#stoQtyAum").val(result);

            }

        });


      $('#stoQtyAum').on('input',function(){

            var stoQtyAumvar = $('#stoQtyAum').val();
            var stoCfactor = $('#cfator').val();

            result = stoQtyAumvar / stoCfactor;

            $('#stoqtyum').val(result.toFixed(2));

        });

       $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
  });


    });

</script>
@endsection