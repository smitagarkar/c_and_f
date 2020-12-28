@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .defaultClass{

    display: none;

  }

  .shotable{

    display: block)

  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }

</style>

<!-- < ?php 
$formDate = date("Y-m-d", strtotime($formDate)); 
$toDate = date("Y-m-d", strtotime($toDate)); 

  ?> -->

  <div class="content-wrapper">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Outward Dispatch Register

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/outward-dispatch') }}">List Outward Dispatch Register</a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box box-primary">

                <div class="box-header">

                  <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Outward Despatch Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div>

                  <div class="row">

                    <div class="col-md-4">

                    <label>From Date</label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="hidden" name="" id="from_date_default" value="{{ $from_date }}">
                    <input type="hidden" name="" id="to_date_default" value="{{ $to_date }}">
                    <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="">

                  </div>
                  <small id="show_err_from_date"></small>

                    </div>



                    <div class="col-md-4">

                   <label>To Date</label>

                   <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                    <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Enter To  Date" value="">

                  </div>
                  <small id="to_date_err"></small>
                    </div>



                    <div class="col-md-4">

                      <label>Depot</label>

                    
                       <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                      <input list="depotList"  id="depot" name="depot" class="form-control  pull-left" value="{{ old('depot')}}" placeholder="Select Depot Name" >

                  <datalist id="depotList">
                      <option value="">--Select Depot--</option>

                      @foreach($depot_list as $key)

                      

                       <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>


                      @endforeach

                  </datalist>
                </div>

                    <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>
                     <small id="dept_code_err"></small>

                    </div>

                  </div>

                  <div>&nbsp;</div>

                  <div class="row">

                    <div class="col-md-4">

                      <label>Account Code</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                       <input list="accountList" id="acc_code" name="acc_code" class="form-control  pull-left" value="{{ old('acc_code')}}" placeholder="Select Account Code" >

                       <datalist id="accountList">
                            <option value="">--Select Account--</option>

                            @foreach($dealer_list as $row)

                            

                            <option value='<?php echo $row->acc_code?>'   data-xyz ="<?php echo $row->acc_name; ?>" ><?php echo $row->acc_name ; echo " [".$row->acc_code."]" ; ?></option>

                            @endforeach

                      </datalist>
                    </div>
                   
                <small>  

                        <div class="pull-left showSeletedName" id="accountText" ></div>

                     </small>
                     <small id="acct_code_err"></small>
                    </div>

                    

                    <div class="col-md-4">

                      <label>Transporter</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bus" aria-hidden="true"></i></span>

                    <!-- <select class="form-control" name="trans_code" id="trans_code"> -->
                      <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter">

                      <datalist id="transList">

                          <option value="">--Select Transporter--</option>

                          @foreach($transporter_list as $row)

                        <option value='<?php echo $row->acc_code?>'   data-xyz ="<?php echo $row->acc_name; ?>" ><?php echo $row->acc_name;?></option>

                          @endforeach

                       </datalist>
                 </div>

                   <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>
                     <small id="trans_code_err"></small>
                     <span id='searcherr' style="color: red;"></span>
                    </div>

                    <div class="col-md-4" style="margin-top: 3%">


                     <button type='button' name='btnsearch' class='btn btn-success' id="btnsearch" value='btnsearch'> Search </button>
                     <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                   </div>

                 </div>

                  <!-- /.box-header -->

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



            

                <div class="box-body" style="overflow-x:auto;width: 100%;">

                  <table id="OutwardDispatch" class="table table-bordered table-striped table-hover">

                    <thead class="theadC">

                      <tr>

                       

                        <th>Depot</th>

                        <th>party</th>

                        <th>date</th>

                        <th>challan no</th>

                        <th>destination</th>

                        <th>vehicle no</th>

                        <th>qty mt</th>

                        <th>qty bag</th>

                        <th>Transporter</th>

                        

                      </tr>

                    </thead>

                  </table>

                </div>



                <!-- /.box-body -->

<!-- TABLE -->

       

<!--END  TABLE -->


                </div>

                </div>
              </div><!-- /.box -->

            <!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>


@include('admin.include.footer')


<script type="text/javascript">

    $(document).ready(function(){

       $("#acc_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });


       $("#depot").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

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
       

     });


</script>



<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(depotCode= '', accCode='',formDate='',toDate='',transCode){


          $('#OutwardDispatch').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 1, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass" },

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignRightClass" },

                            { "width": "10%", "targets": 7, "className": "alignRightClass" },

                            { "width": "10%", "targets": 8, "className": "alignRightClass" }

                          ],
              ajax:{
                url:'{{ url("/outward-dispatch") }}',
                data: {depotCode:depotCode,accCode:accCode,formDate:formDate,toDate:toDate,transCode:transCode}
              },
              columns: [

                {
                    data:'depot_code',
                    name:'depot_code'
                },
                {
                    data:'acc_code',
                    name:'acc_code'
                },
                {
                    data:'tr_date',
                    name:'tr_date'
                },
                
                {
                    data:'chalan_no',
                    name:'chalan_no'
                },
                {
                    data:'area_code',
                    name:'area_code'
                },
                {
                    data:'truck_no',
                    name:'truck_no'
                },
                {
                    data:'desp_qty',
                    name:'desp_qty'
                },
                {
                    data:'desp_aqty',
                    name:'desp_aqty'
                },
                {
                    data:'trans_code',
                    name:'trans_code'
                },

              ]


          });


       }


       $('#btnsearch').click(function(){


          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var dept_code =  $('#depot').val();

          var acct_code =  $('#acc_code').val();

          var trans_code =  $('#trans_code').val();

          var btnsearch =  $('#btnsearch').val();

          
          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (dept_code!='' || acct_code!='' || from_date!='' || to_date!='' || trans_code!='') {

                $('#show_err_from_date').html('');
                $('#to_date_err').html('');
                $('#dept_code_err').html('');
                $('#acct_code_err').html('');
                $('#trans_code_err').html('');

                if(from_date!=''){
                  if(to_date==''){
                    $('#to_date_err').html('Please select to date').css('color','red');
                    
                    return false;
                  }
                }

                if(to_date!=''){
                  if(from_date==''){
                    $('#show_err_from_date').html('Please select from date').css('color','red');
                    return false;
                  }
                }

            $('#OutwardDispatch').DataTable().destroy();
            load_data(dept_code, acct_code,from_date,to_date,trans_code);

          }else{

            $('#OutwardDispatch').DataTable().destroy();
            load_data();
           /*$('#show_err_from_date').html('Please select from date').css('color','red');
           $('#to_date_err').html('Please select to date').css('color','red');
           $('#dept_code_err').html('Please select depot').css('color','red');
           $('#acct_code_err').html('Please select account code').css('color','red');
           $('#trans_code_err').html('Please select transporter').css('color','red');*/

          }


        });

       $('#ResetId').click(function(){

            $('#from_date').val('');
            
            $('#to_date').val('');
            
            $('#depot').val('');
            
            $('#acc_code').val('');

          document.getElementById("depotText").innerHTML = '';
          document.getElementById("accountText").innerHTML = '';
          $('#OutwardDispatch').DataTable().destroy();
          load_data();

        });

  });





</script>

<script type="text/javascript">

  $(document).ready(function() {


    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date
    });
  

});

$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date

    });

});

</script>



 

@endsection



