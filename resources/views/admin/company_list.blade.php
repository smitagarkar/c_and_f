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

            Master Company

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-company/'.base64_encode($comp_list->id)) }}">Master Company</a></li>

            <li class="active"><a href="{{ url('/edit-company/'.base64_encode($comp_list->id)) }}">Edit Mast Company</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Company</h2>

              

              

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

            <form action="{{ url('form-mast-company-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="company_code" value="{{ $comp_list->comp_code }}">

                          <input type="hidden" name="companyId" value="{{ $comp_list->id }}" placeholder="Enter Company Code">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="company_name" value="{{ $comp_list->comp_name }}" placeholder="Enter Company Name">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('company_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Number 1: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number" name="contact_no1" value="{{ $comp_list->phone1 }}" placeholder="Enter Contact Numbaer 1" maxlength="10">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_no1', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Number 2

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number" name="contact_no2" value="{{ $comp_list->phone2 }}" placeholder="Enter Contact Numbaer 2" maxlength="10">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('contact_no2', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



                <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Fax Number: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                          <input type="text" class="form-control" name="fax_no" value="{{ $comp_list->fax_no }}" placeholder="Enter Fax Number">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fax_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Email-Id:

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email" class="form-control" name="emailid" value="{{ $comp_list->email_id }}" placeholder="Enter Email Id">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('emailid', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>





              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Address: 

                        <span class="required-field"></span>

                      </label>

                      

                      <input type="text" name="address_one" class="form-control" placeholder="Address 1" value="{{ $comp_list->add1 }}">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" class="form-control" style="margin-top: 2%" placeholder="Address 2" value="{{ $comp_list->add2 }}">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_two', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_three" class="form-control" style="margin-top: 2%" placeholder="Address 3" value="{{ $comp_list->add3 }}">

                       <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_three', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->
                    <div class="form-group">

                      <label>

                        District : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-building"></i>

                          </span>

                        <input type="text" name="district" class="form-control" value="{{ $comp_list->district }}" placeholder="Enter District">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    

                  </div>



                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Country : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-globe"></i>

                          </span>

                    <input type="text" name="country_name" class="form-control" placeholder="Enter Country Name" value="{{ $comp_list->country }}">

                    </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                    <div class="form-group">

                      <label>

                        State Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-down"></i>

                          </span>

                      <select name="state_code" class="form-control">



                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option value="{{$key->state_code}}" <?php if($key->state_code==$comp_list->state){ echo 'selected';} ?>>{{$key->state_name }}</option>

                        @endforeach

                      </select>

                    </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>



                    

                  </div>



                

              </div>



              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        City Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="city_code" class="form-control" value="{{ $comp_list->city }}" placeholder="Enter City Code">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-6">
                    <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control Number" value="{{ $comp_list->pin_code }}" maxlength="6">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

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

          <a href="{{ url('/view-mast-company') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Company</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')


<script type="text/javascript">
   $(document).ready(function(){      
    $(".Number").keypress(function(event){
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
            event.preventDefault();
        }
    });
 });
</script>


@endsection