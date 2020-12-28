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

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Fleet Certificate Transaction

            <small>Add Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>


            <li><a href="{{ url('/logistic/fleet-certificate-transaction-form') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/logistic/fleet-certificate-transaction-form') }}"> Fleet Cert Transaction Form</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Fleet Certificate Trans</h2>

              

              

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

            <form action="{{ url('form-fleet-certificate-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Truck No:
                         

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="text" class="form-control" name="truck_no" id="truck_no" placeholder="Enter Truck No" value="{{ old('truck_no')}}">

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

                        Certificate Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-file"></i></span>

                          <input list="certList" class="form-control" name="cert_code" id="cert_code" placeholder="Enter Certificate Code" value="{{ old('cert_code')}}">

                          <datalist id="certList">

                           <option selected="selected" value="">--Select--</option>

                            <option value='CF' data-xyz ="Certificate Of Fitness" > [ Certificate Of Fitness ]</option>
                            <option value='S-Permit' data-xyz ="State Permit" > [ State Permit ]</option>
                            <option value='N-Permit' data-xyz ="National Permit" >[ National Permit ]</option>
                            <option value='RTO' data-xyz ="RTO Tax" >[ RTO Tax ] </option>
                            <option value='Danta' data-xyz ="Danta Tax" >[ Danta Tax ] </option>
                            <option value='Insurance' data-xyz ="Vehicle Insurance" > [ Vehicle Insurance ] </option>
                            <option value='Pollution' data-xyz ="PUC" > [ PUC ] </option>

                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Certificate Number : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control Number" name="cert_no" id="cert_no" value="{{ old('cert_no')}}" placeholder="Enter Certificate Number" maxlength="10">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Certificate Date

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control datepicker" name="cert_date" id="cert_date" value="{{ date('Y-m-d')}}" placeholder="Enter Certificate Date">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cert_date', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Cert Renew Due Date: 

                        <span class="required-field"></span>

                      </label>

                      
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                         <input type="text" name="cert_rnew" id="cert_rnew" class="form-control datepicker" placeholder="Enter Certificate Renew" value="{{ old('cert_rnew')}}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_rnew', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      
                      

                    </div>
                  </div>
                    <!-- /.form-group -->

                    <div class="col-md-6">
                     <div class="form-group">

                      <label>

                        Certificate Renew Date: 

                        

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-calendar" aria-hidden="true"></i>

                          </span>

                       <input name="cert_rnew_dt" id="cert_rnew_dt" class="form-control datepicker" placeholder="Enter Certificate Renew Date" value="{{ old('cert_rnew_dt') }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_rnew_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>


                  </div>

              </div>

              <div style="text-align: center;">
                  <input type="hidden" name="certID" id="certID" value="">
                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Submit 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>
      <div class="col-sm-1"></div>
      <!-- <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/logistic/fleet-certificate-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Fleet Certificate</a>

        </div>

      </div> -->



    </div>

     

	</section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

$(document).ready(function(){

    $("#cert_rnew_dt").prop("disabled", true);

  $('#cert_code').on('change',function(){

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

               }
        });



      var truck_no   =  $('#truck_no').val();
      
      var cert_code  =  $('#cert_code').val();
      
      var datastring = "truck_no="+truck_no+"&cert_code="+cert_code;

    

        $.ajax({

          url:"{{ url('/logistic/get-certificate-data') }}",

           method : "POST",

           type: "JSON",

           data: datastring,

           success:function(data){

           

                var data1 = JSON.parse(data);
                
                console.log(data1.response);
                if(data1.response == 'success'){



                  $("#cert_rnew_dt").prop("disabled",false);

                  $('#cert_no').val(data1.data[0].certificate_no);
                  $('#cert_date').val(data1.data[0].certificate_date);
                  $('#cert_rnew').val(data1.data[0].certificate_renew);
                  $('#certID').val(data1.data[0].id);
                 
               
                }else if(data1.response == 'error'){

                  var date1 ="<?php echo date('Y-m-d'); ?>";
                  

                     $("#cert_rnew_dt").prop("disabled",true);

                  $('#cert_no').val('');
                  $('#cert_date').val(date1);
                  $('#cert_rnew').val('');
                   $('#certID').val('');
                }else{}

           }

        });

  });

});

</script>
<script type="text/javascript">

$(document).ready(function(){

   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate: 'today'
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