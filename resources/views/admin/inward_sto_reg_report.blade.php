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



</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Inward STO Register

            <small> Inward STO Register Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Inward STO Register Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Inward STO Register Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf



              <div class="row">

                <div class="col-md-4">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> From Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="hidden" name="" id="from_date_default" value="{{ $from_date }}">
                        <input type="hidden" name="" id="to_date_default" value="{{ $to_date }}">
                        
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Select Transaction Date" value="{{ old('from_date')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>



                 <div class="col-md-4">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Select Transaction Date" value="{{ old('to_date')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Name : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ old('dept_code')}}" placeholder="Select Depot Name" >



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            

                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                     <small id="show_err_dept_code">

                        

                      </small>

                     

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : </label>

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

                     <small id="show_err_acct_code">

                        

                     </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-bus" aria-hidden="true"></i>

                          </div>



                          <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter">



                          <datalist id="transList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($transpoter_list as $key)

                            

                            <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans">

                        

                      </small>
                     <span id='searcherr' style="color: red;"></span>
                  </div>

                </div><!-- /.col -->

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

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">Date</th>

      <th class="text-center">Depot</th>

      <th class="text-center">Party </th>

      <th class="text-center">Transporter</th>

      <th class="text-center">Invoice No</th>

      <th class="text-center">Vehicle No</th>

      <th class="text-center">STO Qty UM</th>

      <th class="text-center">STO Qty AUM</th>

      <th class="text-center">Recived Qty UM</th>

      <th class="text-center">Recived Qty AUM</th>

      <th class="text-center">Return Qty</th>

      <th class="text-center">Flag</th>

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



 <script>

      $(function () {

        //Initialize Select2 Elements

        $(".select2").select2();



        //Datemask dd/mm/yyyy

        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        //Datemask2 mm/dd/yyyy

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

        //Money Euro

        $("[data-mask]").inputmask();

      });

 </script>



 <script type="text/javascript">

    $(document).ready(function(){



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



       $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });



      $('#acct_code').change(function(){

         

          var acountCode = $('#acct_code').val();

          $('#showaccCode').val(acountCode);

      });



      $('#area_code').change(function(){

         

          var areaCode = $('#area_code').val();

          $('#showAreaCode').val(areaCode);

      });



      $('#trans_code').change(function(){

         

          var transCode = $('#trans_code').val();

          $('#showTransCode').val(transCode);

      }); 



      $('#dept_code').change(function(){

         

          var depotCode = $('#dept_code').val();

          $('#showDepotCode').val(depotCode);

      });



      

    });



   $(document).ready(function() {



    $("#inv_um").change(function(){



            var invqty = $("#inv_um").val();



            var cFactor = $("#cfactor").val();

            var result = invqty*cFactor;

              

            if(invqty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#inv_um").val('0');

               $("#inv_aum").val('');



            }else{



               $("#inv_aum").val(result);

            }

        });

   });


</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(depotCode= '', accCode='',formDate='',toDate='',transCode){


          $('#InwardDispatch').DataTable({

              
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
                url:'{{ url("/rept-inward-sto-reg") }}',
                data: {depotCode:depotCode,accCode:accCode,formDate:formDate,toDate:toDate,transCode:transCode}
              },
              columns: [

               {
                    data:'vr_date',
                    name:'vr_date'
                },
                {
                    data:'depot_code',
                    name:'depot_code'
                },
                {
                    data:'acc_code',
                    name:'acc_code'
                },
                
                {
                    data:'trpt_code',
                    name:'trpt_code'
                },
                {
                    data:'invoice_no',
                    name:'invoice_no'
                },
                {
                    data:'truck_no',
                    name:'truck_no'
                },
                {
                    data:'sto_qty',
                    name:'sto_qty'
                },
                {
                    data:'sto_aqty',
                    name:'sto_aqty'
                },
                {
                    data:'qty_recd',
                    name:'qty_recd'
                },
                {
                    data:'aqty_recd',
                    name:'aqty_recd'
                },
                {
                    data:'return_qty',
                    name:'return_qty'
                },
                {
                    data:'flag',
                    name:'flag'
                },

              ]


          });


       }


       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var dept_code =  $('#dept_code').val();

          var acct_code =  $('#acct_code').val();

          var trans_code =  $('#trans_code').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (dept_code!='' || acct_code!='' || from_date!='' || to_date!='' || trans_code!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

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

            $('#InwardDispatch').DataTable().destroy();
            load_data(dept_code, acct_code,from_date,to_date,trans_code);

          }else{
          	$('#InwardDispatch').DataTable().destroy();
          	load_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });

       $('#ResetId').click(function(){

              $('#from_date').val('');
              
              $('#to_date').val('');
              
              $('#dept_code').val('');
              
              $('#acct_code').val('');

          document.getElementById("depotText").innerHTML = '';
          document.getElementById("accountText").innerHTML = '';
          $('#InwardDispatch').DataTable().destroy();
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