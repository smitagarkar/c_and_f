@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

  }

  .required-field::before {

    content: "*";

    color: red;

  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .text-center{
    text-align: center;
  }

    .buttons-print{
    color: #fff!important;
    background-color: #17a2b8!important;
    border-color: #17a2b8!important;
  }

  .dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

.dt-button:before {
  content: '\f02f';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

.refreshBtn{
    color: #fff!important;
       background-color: #3c8dbc;
    border-color: #367fa9;
}
.refreshBtn:before {
  content: '\f021';
  font-family: FontAwesome;
  padding-right: 5px;
  
}
.buttons-excel{

    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}
.buttons-excel:before {
  content: '\f1c9';
  font-family: FontAwesome;
  padding-right: 5px;
  
}


</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Fleet Transaction Report

      <small> Fleet Transaction Report Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Fleet Transaction Report</a></li>

    </ol>

  </section>

  <section class="content">

      <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Fleet Transaction Report</h2>

            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">

               @csrf

              <div class="row">

                <div class="col-md-4">

                    <label>From Date</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  
                      <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="">

                    </div>
                     <small id="show_err_from_date"></small>

                </div>

                <div class="col-md-4">

                   <label>To Date</label>

                   <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="Enter To  Date" value="">

                  </div>
                    <small id="show_err_to_date"></small>
                </div>

                <div class="col-md-4">

                    <label>Depot</label>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                        <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ old('depot')}}" placeholder="Select Depot Name" >

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

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                    <label>Truck No</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                        <input id="TRUCK_NO" name="TRUCK_NO" class="form-control  pull-left" value="{{ old('TRUCK_NO')}}" placeholder="Enter Truck No" >

                      </div>
                   
                     <small id="truck_no_err"></small>
                </div>

                <div class="col-md-4">

                      <label>Transporter</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bus" aria-hidden="true"></i></span>
                        <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter">

                        <datalist id="transList">

                          <option value="">--Select Transporter--</option>

                         @foreach($transporter_list as $row)

                           <option value='<?php echo $row->acc_code?>'   data-xyz ="<?php echo $row->acc_name; ?>" ><?php echo $row->acc_name ; echo " [".$row->acc_code."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small>  
                        <div class="pull-left showSeletedName" id="transText"></div>
                      </small>
                     <small id="trans_code_err"></small>
                     <span id='searcherr' style="color: red;"></span>
                </div>

                <div class="col-md-4" style="margin-top: 3.5%;">

                  <div class="">

                    <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                    <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                  </div>

                </div>

              </div>

             </form>

          </div><!-- /.box-body -->



          <div class="box-body">

            <table id="FletTranReport" class="table table-bordered table-striped table-hover">

                <thead class="theadC">

                  

                  <tr>

                    <th class="text-center">Sr. No</th>
                    <th class="text-center">Tr Date</th>

                    <th class="text-center">Lr No </th>

                    <th class="text-center">Invoice No</th>

                    <th class="text-center">Shipment No</th>

                    <th class="text-center">Truck No</th>

                    <th class="text-center">Transporter</th>

                    <th class="text-center">Account Code</th>

                    <th class="text-center">Area Code</th>

                    <th class="text-center">Quantity</th>

                    <th class="text-center">Admin</th>

                    <th class="text-center">Loading</th>

                    <th class="text-center">Extra Police</th>
                    <th class="text-center">Extra Fooding</th>
                    <th class="text-center">Toll Charge</th>
                    <th class="text-center">Extra Exp</th>
                    <th class="text-center">Trip Advance</th>
                    <th class="text-center">Deisel Cr</th>
                    <th class="text-center">Slip No</th>

                  </tr>

                </thead>

                <tbody id="defualtSearch">

                </tbody>

            </table>

          </div><!-- /.box-body -->

           

      </div>

  </section>

</div>





@include('admin.include.footer')





 <script type="text/javascript">

    $(document).ready(function(){

       $("#trans_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

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



    });



</script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(TRUCK_NO='',dept_code='',trans_code='',from_date='',to_date=''){


          $('#FletTranReport').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
            
               buttons: [ 'excelHtml5',
                    {
                        extend: 'print',
                        title: 'Fleet Transaction Report',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '5pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        }
                    },
                    {
                      text: 'Refresh',
                      className:'refreshBtn',
                      attr:{
                        id:'refreshId'
                      },
                      action: function ( e, dt, node, config ) {
                         location.reload();
                      }
                    }
                ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignRightClass"},

                            { "width": "10%", "targets": 1, "className": "alignRightClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass" },

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 7, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 8, "className": "alignLeftClass" },
                            { "width": "10%", "targets": 9, "className": "alignRightClass" },
                            { "width": "10%", "targets": 10, "className": "alignRightClass" },
                            { "width": "10%", "targets": 11, "className": "alignRightClass" },
                            { "width": "10%", "targets": 12, "className": "alignRightClass" },
                            { "width": "10%", "targets": 13, "className": "alignRightClass" },
                            { "width": "10%", "targets": 14, "className": "alignRightClass" },
                            { "width": "10%", "targets": 15, "className": "alignRightClass" },
                            { "width": "10%", "targets": 16, "className": "alignRightClass" },
                            { "width": "10%", "targets": 17, "className": "alignRightClass" },
                            { "width": "10%", "targets": 18, "className": "alignRightClass" }

                          ],
              ajax:{
                url:'{{ url("/logistic/fleet-trans-report") }}',
                data: {TRUCK_NO:TRUCK_NO,dept_code:dept_code,trans_code:trans_code,from_date:from_date,to_date:to_date}
              },
              columns: [


                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },
                {
                    data:'TR_DATE',
                    name:'TR_DATE'
                },
                {
                    data:'LR_NO',
                    name:'LR_NO'
                },
                {
                    data:'INVOICE_NO',
                    name:'INVOICE_NO'
                },
                
                {
                    data:'SHIPMENT_NO',
                    name:'SHIPMENT_NO'
                },
                {
                    data:'TRUCK_NO',
                    name:'TRUCK_NO'
                },
                {
                    data:'TRPT_CODE',
                    name:'TRPT_CODE'
                },
                {
                    data:'AccName',
                    name:'AccName'
                },
                {
                    data:'AreaName',
                    name:'AreaName'
                },
                {
                    data:'UM',
                    name:'UM'
                },
                {
                    data:'ADMIN_EXP',
                    name:'ADMIN_EXP'
                }, 
                {
                    data:'ULOADING_EXP',
                    name:'ULOADING_EXP'
                },
                {
                    data:'ADMIN_EXP',
                    name:'ADMIN_EXP'
                },
                {
                    data:'FOODING_EXP',
                    name:'FOODING_EXP'
                },
                {
                    data:'TOLL_EXP',
                    name:'TOLL_EXP'
                },
                {
                    data:'DIESEL_EXP',
                    name:'DIESEL_EXP'
                },
                {
                    data:'TOTAL_ADV',
                    name:'TOTAL_ADV'
                },
                {
                    data:'DIESEL_CR',
                    name:'DIESEL_CR'
                },
                {
                    data:'DIESEL_SLIP_NO',
                    name:'DIESEL_SLIP_NO'
                },
              ]


          });


       }


      $('#btnsearch').click(function(){


          var from_date =  $('#from_date').val();
          var to_date =  $('#to_date').val();

          var depot_code =  $('#dept_code').val();

          var truck_no =  $('#TRUCK_NO').val();

          var trans_code =  $('#trans_code').val();

          var btnsearch =  $('#btnsearch').val();

          
          //alert(from_date);return false;

          if (truck_no!='' || depot_code!='' || trans_code!='' || from_date!='' || to_date!='') {
               
                $('#dept_code_err').html('');
                $('#truck_no_err').html('');
                $('#trans_code_err').html('');

                $('#show_err_from_date').html('');
                $('#to_date_err').html('');

                if(from_date!=''){
                  if(to_date==''){
                    $('#show_err_to_date').html('Please select to date').css('color','red');
                  //  setTimeout(function(){$('#show_err_to_date').html('');},4000);
                    return false;
                  }
                }

                if(to_date!=''){
                  if(from_date==''){
                    $('#show_err_from_date').html('Please select from date').css('color','red');
                  //  setTimeout(function(){$('#show_err_from_date').html('');},4000);
                    return false;
                  }
                }

           
            $('#FletTranReport').DataTable().destroy();
            load_data(truck_no,depot_code,trans_code,from_date,to_date);

          }else{

            $('#FletTranReport').DataTable().destroy();
            load_data(truck_no,depot_code,trans_code,from_date,to_date);


          }


        });


       $('#ResetId').click(function(){


              $('#dept_code').val('');
              
              $('#TRUCK_NO').val('');
              
              $('#trans_code').val('');

              $('#from_date').val('');
              
              $('#to_date').val('');

          document.getElementById("depotText").innerHTML = '';
          document.getElementById("transText").innerHTML = '';
          $('#FletTranReport').DataTable().destroy();
          load_data();

        });

  });





</script>

<script type="text/javascript">

 
$(document).ready(function() {
  
//  var from_date = $('#from_date_default').val();
  //  var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      endDate : 'today',
      autoclose: 'true'



    });

});
</script>

@endsection