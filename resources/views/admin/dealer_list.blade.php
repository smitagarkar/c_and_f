@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



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

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Account

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-dealer/'.base64_encode($dealer_list->id)) }}">Master Account</a></li>

            <li class="active"><a href="{{ url('/edit-dealer/'.base64_encode($dealer_list->id)) }}">Edit Mast Account</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-9">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Account</h2>

              

              

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

            <form action="{{ url('form-mast-dealer-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Account Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="account_code" value="{{ $dealer_list->acc_code }}" placeholder="Enter Account Code">

                          <input type="hidden" name="dealerId" value="{{ $dealer_list->id }}" >

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('account_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Account Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="account_name" value="{{ $dealer_list->acc_name }}" placeholder="Enter Account Name"> 

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('account_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Account Type Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                         

                           <select class="form-control" name="acc_type_code">

                            <option value="">--SELECT ACCOUNT TYPE--</option>

                            @foreach($acc_type_list as $row)

                            <option value="{{$row->acctype_code}}" <?php if($row->acctype_code==$dealer_list->acctype_code){echo 'selected';} ?>>{{ $row->acctype_code }} [{{ $row->acctype_name }}]</option>

                           @endforeach

                          </select>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('acc_type_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                      <label>

                        Address : 

                        <span class="required-field"></span>

                      </label>

                      <input rows="3" class="form-control" name="address_one" value="{{ $dealer_list->add1 }}" placeholder="Enter Address1">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                       <input rows="3" name="address_two" class="form-control" value="{{ $dealer_list->add2 }}" style="margin-top: 2%" placeholder="Enter Address2">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_two', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>



                       <input rows="3"  class="form-control" name="address_three" value="{{ $dealer_list->add3 }}" style="margin-top: 2%" placeholder="Enter Address3"> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_three', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                     <div class="form-group">

                      <label>

                        State Code : 

                        <span class="required-field"></span>

                      </label>

                      <select name="state_code" class="form-control">

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option value="{{$key->state_code}}" <?php if($key->state_code==$dealer_list->state_code){ echo 'selected'; } ?>>{{$key->state_name }}</option>

                        @endforeach

                      </select>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control" value="{{ $dealer_list->pincode }}" placeholder="Enter  Pincode" maxlength="6">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                   <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Contact Number: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-phone" aria-hidden="true"></i>

                          </span>

                       <input name="contact_no" class="form-control Number" placeholder="Enter Contact Number" value="{{ $dealer_list->contact_no }}" maxlength="10">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    <div class="form-group">

                      <label>

                        Contact Person : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-user" aria-hidden="true"></i>

                          </span>

                       <input name="contact_person" class="form-control" placeholder="Enter Cotact Person" value="{{ $dealer_list->contact_person }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_person', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-4">
                  <div class="form-group">

                      <label>

                        Contact Email : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-envelope" aria-hidden="true"></i>

                          </span>

                       <input type="email" name="email_id" class="form-control" placeholder="Enter Email id" value="{{ $dealer_list->email_id }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <div class="form-group">

                      <label>

                        Country : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="country" class="form-control" value="{{ $dealer_list->country }}" placeholder="Enter Country">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    <!-- /.form-group -->



                   

                  </div>



                   <div class="col-md-4">



                    <div class="form-group">

                      <label>

                        District : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="district" class="form-control" placeholder="Enter District" value="{{$dealer_list->district }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>

                  <div class="col-md-4">
                    <div class="form-group">

                      <label>

                        City Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="city_code" class="form-control" value="{{ $dealer_list->city }}" placeholder="Enter City">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>
                  </div>
                    <!-- /.form-group -->


                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Service Charges : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </span>

                       <input type="text" name="service_charge" class="form-control" placeholder="Enter Service Charges" value="{{ $dealer_list->service_charge }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('service_charge', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    
                  </div>

                  



              </div>



             

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-dealer') }}" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-eye"></i>&nbsp;View Account</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')





@endsection