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

            Trpt Payment Advice

            <small>  Trpt Payment Advice Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

            <li><a href="{{ url('/logistic/trpt-payment-advice') }}">Fleet</a></li>

            <li class="active"><a href="{{ url('/logistic/trpt-payment-advice') }}">Trpt Payment Advice</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Trpt Payment Advice</h2>

            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter" >



                          <datalist id="transList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($transpoter_list as $key)

                            
 
                            <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->accName; ?>" ><?php echo $key->accName ; echo " [".$key->ACC_CODE."]" ; ?></option>

                            

                            @endforeach 

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_acct_code">

                        

                     </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Bill No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>


                          <input type="text" id="billNo" name="billNo" class="form-control  pull-left" value="{{ old('billNo')}}" placeholder="Select Transporter">



                      </div>

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

<table id="TrptPaymentAdvice" class="table table-bordered table-striped table-hover">

  <thead class="theadC">
    
    <tr>

      <th class="text-center">Date</th>     
      <th class="text-center">L R No</th>
      <th class="text-center">Depot/Plant</th>    
      <th class="text-center">Invoice No</th>    
      <th class="text-center">Party</th>    
      <th class="text-center">Area</th>
      <th class="text-center">Truck No</th>
      <th class="text-center">Shortage Quantity</th>
      <th class="text-center">Item</th>
      <th class="text-center">Deisel</th>
      <th class="text-center">Driver Exp</th>
      <th class="text-center">Admin Exp</th>
      <th class="text-center">Fooding Exp</th>
      <th class="text-center">Uloading Exp</th>
      <th class="text-center">Toll</th>           
      <th class="text-center">Other Exp</th>           
      <th class="text-center">Total Advance</th>
      <th class="text-center">L R Received Date</th>         
      <th class="text-center">Damage</th>
      <th class="text-center">Shortage </th>
      <th class="text-center">Stamp</th>
      <th class="text-center">Bill No</th>
      <th class="text-center">Bill Date</th>
      <th class="text-center">Rate</th>    















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

<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(trans_code='', billNo=''){


          $('#TrptPaymentAdvice').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5',
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
              
              ajax:{
                url:'{{ url("/logistic/trpt-payment-advice") }}',
                data: {trans_code:trans_code,billNo:billNo}
              },
              columns: [

               {
                    data:'date',
                    name:'date'
                },
                {
                    data:'L_R_NO',
                    name:'L_R_NO'
                },
                {
                    data:'DEPOT_PLANT',
                    name:'DEPOT_PLANT'
                },
                
                {
                    data:'INVOICE_NO',
                    name:'INVOICE_NO'
                },
                {
                    data:'party',
                    name:'party'
                },
                {
                    data:'DESTINATION',
                    name:'DESTINATION'
                },
                {
                    data:'TRUCK_NO',
                    name:'TRUCK_NO'
                },
                {
                    data:'QTY',
                    name:'QTY'
                },
                {
                    data:'MATERIAL',
                    name:'MATERIAL'
                },
                {
                    data:'DEISEL',
                    name:'DEISEL'
                },
                {
                    data:'DRV_Exp',
                    name:'DRV_Exp'
                },
                {
                   data:'P_Exp',
                   name:'P_Exp'
                },
                {
                   data:'Fooding',
                   data:'Fooding'
                },
                {
                    data:'LU_Exp',
                    name:'LU_Exp'
                },
                {
                   data:'toll',
                   name:'toll'
                },
                {
                   data:'Other_Exp',
                   name:'Other_Exp'
                },
                {
                   data:'TOTAL_Adv',
                   name:'TOTAL_Adv'
                },
                {
                   data:'lr_recieved_date',
                   name:'lr_recieved_date'
                },
                {
                   data:'damage',
                   name:'damage'
                },
                {
                   data:'shortage',
                   name:'shortage'
                },
                {
                   data:'stamp',
                   name:'stamp'
                },
                {
                   data:'bill_no',
                   name:'bill_no'
                },
                {
                   data:'bill_date',
                   name:'bill_date'
                }, 
                {
                   data:'rate',
                   name:'rate'
                },


              ]


          });


       }


       $('#btnsearch').click(function(){


          var trans_code =  $('#trans_code').val();

          var bill_no =  $('#billNo').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (trans_code !='' || bill_no!='') {

            $('#show_err_from_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            $('#TrptPaymentAdvice').DataTable().destroy();
            load_data(trans_code,bill_no);

          }else{

            $('#TrptPaymentAdvice').DataTable().destroy();
            load_data(trans_code,bill_no);
          }


        });

       $('#ResetId').click(function(){

              $('#trans_code').val('');
              
              $('#billNo').val('');
              

          document.getElementById("transText").innerHTML = '';
          $('#TrptPaymentAdvice').DataTable().destroy();
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