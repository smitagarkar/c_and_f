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

  .showmsg{

    display: none;

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


</style>



<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



        Print Fleet Challan Receipt



            <small> Print Fleet Challan Receipt</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Fleet</a></li>



            <li class="active"><a href="{{ url('/fleet-challan-receipt') }}"> Fleet Challan Receipt</a></li>



          </ol>



        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Manage Fleet Challan Receipt</h2>



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

                      <label for="exampleInputEmail1">Date: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                    <input  id="date" name="date" class="form-control datepicker" value="{{ date('Y-m-d') }}" disabled>
                         

                      </div>


                    

                  </div>



                </div>
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Challan No: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input id="challan_no" name="challan_no" class="form-control"  placeholder="Enter Challan No" readonly>
                          

                      </div>



                        <small>  
                        
                        <div class="pull-left showSeletedName" id="accountText"></div>
                        
                        </small>

                     <small id="show_err_acct_code">

                     </small>

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

<table id="PartyBill" class="table table-bordered table-striped table-hover">


  <thead class="theadC">

    <tr>

      
      <th class="text-center">Sr.No</th>

      <th class="text-center">Date</th>
  
      <th class="text-center">L R No </th>

      <th class="text-center">Invoice No </th>

      <th class="text-center">Shipment No</th>

      <th class="text-center">Truck No</th>

      <th class="text-center">Owner Name </th>

      <th class="text-center">Party Name</th>

      <th class="text-center">Destination</th>

      <th class="text-center">Qty</th>

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

    <?php foreach ($fleetdata as $key) { ?>

      <td> <?php echo $key->id; ?> </td>
      <td> <?php echo $key->TR_DATE; ?> </td>
      <td> <?php echo $key->LR_NO; ?> </td>
      <td> <?php echo $key->INVOICE_NO; ?> </td>
      <td></td>
      <td> <?php echo $key->TRUCK_NO; ?> </td>
      <td></td>
      <td> <?php echo $key->ACC_CODE; ?> </td>
      <td> <?php echo $key->AREA_CODE; ?> </td>
      <td> <?php echo $key->UM; ?> </td>
      <td> <?php echo $key->ADMIN_EXP; ?> </td>
      <td> <?php echo $key->ULOADING_EXP; ?> </td>
      <td> </td>
      <td><?php echo $key->FOODING_EXP; ?> </td>
      <td> <?php echo $key->TOLL_EXP; ?> </td>
      <td></td>
      <td> <?php echo $key->TOTAL_ADV; ?> </td>
      <td> <?php echo $key->DIESEL_CR; ?> </td>
      <td> <?php echo $key->DIESEL_SLIP_NO; ?> </td>

    <?php } ?>

  </tbody>

</table>

<!-- <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success'>submit</button> 
 -->


</div><!-- /.box-body -->
 </div>



  </section>



</div>

@include('admin.include.footer')

 <script>
   $(function () {


        $(".select2").select2();


        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

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

          document.getElementById("accountText").innerHTML = msg; 

        });


    });


</script>


<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>



<script>
      $(function () {
      
        $('#PartyBill').DataTable({
          dom: 'Bfrtip',
           scrollX: true,
            buttons: ['print',
                        {
                      text: 'Refresh',
                      className:'refreshBtn',
                      attr:{
                        id:'refreshId'
                      },
                      action: function ( e, dt, node, config ) {
                        window.location = '{{ url('logistic/fleet-challan-receipt') }}';
                      }
              }],
        });
      });
    </script>





<script type="text/javascript">



  $(document).ready(function() {

    $('.datepicker').datepicker({



      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',

      //startDate :from_date,
      endDate : 'today'

    });

  



});



</script>



@endsection