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

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/form-mast-dealer') }}">Master Account</a></li>

            <li class="active"><a href="{{ url('/form-mast-dealer') }}">Add Mast Acc</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-9">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Account</h2>


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

            <form action="{{ url('form-mast-dealer-save') }}" method="POST" >

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

                          <input type="text" class="form-control" name="account_code" value="{{ old('account_code')}}" placeholder="Enter Account Code">

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

                          <input type="text" class="form-control" name="account_name" value="{{ old('account_name')}}" placeholder="Enter Account Name">

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

                            <option value="{{$row->acctype_code}}">{{ $row->acctype_code }} [{{ $row->acctype_name }}]</option>

                           @endforeach

                          </select>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('acc_type_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                     

                      <input type="text" class="form-control" name="address_one" placeholder="Enter Address 1" value="{{ old('address_one') }}">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" placeholder="Enter Address 2" class="form-control" style="margin-top: 2%" value="{{ old('address_two') }}">



                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_two', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>



                      <input type="text" class="form-control" name="address_three" placeholder="Enter Address 3" style="margin-top: 2%" value="{{ old('address_three') }}">

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_three', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->
                    <div class="form-group">
                      
                      <label>

                        State Code : 

                        <span class="required-field"></span>

                      </label>

                      <select name="state_code" class="form-control">

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option value="{{$key->state_code}}">{{$key->state_name }}</option>

                        @endforeach

                      </select>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control Number" value="{{ old('pincode') }}" placeholder="Enter Pincode" maxlength="6">

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

                       <input name="contact_no" class="form-control Number" placeholder="Enter Contact Number" value="{{ old('contact_no') }}" maxlength="10">

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

                       <input name="contact_person" class="form-control" placeholder="Enter Cotact Person" value="{{ old('contact_person') }}">

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

                       <input type="email" name="email_id" class="form-control" placeholder="Enter Email id" value="{{ old('email_id') }}">

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

                       <input name="country" class="form-control" placeholder="Enter Country" value="{{ old('country') }}">

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

                       <input name="district" class="form-control" placeholder="Enter District" value="{{ old('district') }}">

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

                       <input name="city_code" class="form-control" placeholder="Enter City Code" value="{{ old('city_code') }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
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

                       <input name="service_charge" class="form-control" placeholder="Enter Service Charges" value="{{ old('service_charge') }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('service_charge', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    
                  </div>

                    <!-- /.form-group -->

                

                  

                  

              </div>



             

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-dealer') }}" class="btn btn-primary" style="margin-right: 2px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Account</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')

<script type="text/javascript">
$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});

  });
</script>



@endsection

