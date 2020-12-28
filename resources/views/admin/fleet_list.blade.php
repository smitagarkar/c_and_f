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

  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Fleet

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-fleet/'.base64_encode($fleet_list->id)) }}">Master Fleet</a></li>

            <li class="active"><a href="{{ url('/edit-fleet/'.base64_encode($fleet_list->id)) }}">Edit Mast Fleet</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Fleet</h2>

              

              

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

            <form action="{{ url('form-mast-fleet-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Truck No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="text" class="form-control" name="truck_no" value="{{ $fleet_list->truck_no }}" placeholder="Truck No">

                          <input type="hidden" name="fleetIdId" value="{{ $fleet_list->id }}">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Regd Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control datepicker" name="regd_date" value="{{ $fleet_list->regd_date }}" placeholder="Regd Date">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Make: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>

                         <!--  <input type="text" class="form-control" name="make_model" value="{{ $fleet_list->make }}" placeholder="Enter Make Model"> -->

                         <input list="mfgList"  id="make" name="make" class="form-control  pull-left" value="{{ $fleet_list->make }}" placeholder="Enter Make" >



                          <datalist id="mfgList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($mfg_list as $key)

                            

                            <option value='<?php echo $key->vehicle_mfg_code?>'   data-xyz ="<?php echo $key->vehicle_mfg_name; ?>" ><?php echo $key->vehicle_mfg_name ; echo " [".$key->vehicle_mfg_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('make_model', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small>
                          <div class="pull-left showSeletedName" id="makeText"></div>
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Model: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="model"  value="{{ $fleet_list->model }}" placeholder="Enter Model">



                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('model', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Depot Code:

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building"></i></span>

                          <!-- <input type="text" class="form-control" name="base_location" value="{{ $fleet_list->location }}" placeholder="Enter Base Location"> -->

                          <input list="depotList"  id="Depot" name="depot_code" class="form-control  pull-left" value="{{ $fleet_list->location }}" placeholder="Select Depot Name" >



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            

                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('base_location', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                        <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Wheels Type : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-cog" aria-hidden="true"></i>

                          </span>

                       <!-- <input name="wheel_type" class="form-control" value="{{ $fleet_list->wheels_type }}" placeholder="Enter Wheels Type"> -->

                        <input list="wheelList"  id="wheel_type" name="wheel_type" class="form-control  pull-left" value="{{ $fleet_list->wheels_type }}" placeholder="Select Wheel Type" >



                          <datalist id="wheelList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($wheel_list as $key)

                            

                            <option value='<?php echo $key->wheel_code?>'   data-xyz ="<?php echo $key->wheel_name; ?>" ><?php echo $key->wheel_name ; echo " [".$key->wheel_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('wheel_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                      <small>
                          <div class="pull-left showSeletedName" id="wheelText"></div>
                      </small>
                      

                    </div>

                    <!-- /.form-group -->

                  </div>

                 

              </div>
              <div class="row">
                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Load Capacity : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="load_capacity" class="form-control"  value="{{ $fleet_list->load_capacity }}" placeholder="Enter Load Capacity">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('load_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

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

          <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')



<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'yyyy/mm/dd',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',

      autoclose: 'true'
     // startDate: 'today',

    });

});


$(document).ready(function(){



        $("#Depot").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

        });

        $("#make").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#mfgList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("makeText").innerHTML = msg; 

        });



        $("#wheel_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("wheelText").innerHTML = msg; 

        });

      });

</script>



@endsection