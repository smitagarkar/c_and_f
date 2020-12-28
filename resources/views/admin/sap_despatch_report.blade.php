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

.alignRightClass{
  text-align: right !important;
}
.alignLeftClass{
  text-align: left !important;
}
.SapBillBackColor{
  background-color: #dfccf5;
}
.DisPatchBackColor{
  background-color: #c2f3e3;
}

</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Sap Despatch

            <small>  Sap Despatch Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/rept-sap-despatch') }}">List Sap Vr Dispatch Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Sap Vs Despatch Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

               <div class="row">

                 <div class="col-md-2">

                 </div>

                 <div class="col-md-3">

                  <div class="form-group">
                  	
                  	<input type="hidden" name="" id="from_date_default" value="{{ $from_date }}">
                  	<input type="hidden" name="" id="to_date_default" value="{{ $to_date }}">
                      <label for="exampleInputEmail1">From Date : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                         <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="">

                      </div>
                    <small id="show_err_from_date" style="color: red;"></small>
                     

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">To Date: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                            <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Enter To  Date" value="">

                      </div>

                      <small id="show_err_to_date" style="color:red;"></small>

                  </div>

                </div><!-- /.col -->

              

               

              </div>

              <div class="row">

                 <div class="col-md-2">

                 </div>

                 <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : </label>

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

                     <small id="dept_code_err" style="color: red;">

                     </small>

                     

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

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

                     <small id="acct_code_err" style="color: red;">

                     </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4" style="margin-top: 3%;">

                    <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="searchdata"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>

               

              </div><!-- /.row -->

              
              <div class="row">
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                  <span id="searcherr" style="color: red;"></span>
                </div>
                
              </div>


               

             </form>

            </div><!-- /.box-body -->



            <div class="box-body">

<table id="SapVsDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

     <tr>

      <th colspan="5" class="text-center SapBillBackColor">SAP Bill</th>

      <th colspan="4" class="text-center DisPatchBackColor">Physical Despatch</th>

    </tr>

    <tr>

      <th class="text-center">Account Code</th>

      <th class="text-center">Item</th>

      <th class="text-center">Date </th>

      <th class="text-center">Qty</th>

      <th class="text-center">Depot</th>

      <th class="text-center">Date</th>

      <th class="text-center">Vehicle No</th>

      <th class="text-center">Qty</th>

      <th class="text-center">Depot</th>

    </tr>

  </thead>
  <tfoot align="right">
    <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
  </tfoot>

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


       $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

        });



        load_data();

        function load_data(depotCode = '', accountCode = '',fromDate='',toDate=''){


          $('#SapVsDispatch').DataTable({

              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var monTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var tueTotal = api
                  .column( 7 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
            
                    $( api.column( 2 ).footer() ).html('Total :-');
                    $( api.column( 3 ).footer() ).html(monTotal);
                    $( api.column( 6 ).footer() ).html('Total :-');
                    $( api.column( 7 ).footer() ).html(tueTotal);
                    
                  },
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
                url:'{{ url("/rept-sap-despatch") }}',
                data: {depotCode:depotCode,accountCode:accountCode,fromDate:fromDate,toDate:toDate}
              },
              columns: [

                {
                    data:'acc_code',
                    name:'acc_code'
                },
                {
                    data:'item_code',
                    name:'item_code'
                },
                {
                    data:'vr_date',
                    name:'vr_date'
                },
                {
                    data:'sto_qty',
                    name:'sto_qty'
                },
                {
                    data:'depot_code',
                    name:'depot_code'
                },
                {
                    data:'vr_date',
                    name:'vr_date'
                },
                {
                    data:'truck_no',
                    name:'truck_no'
                },
                {
                    data:'qty_issued',
                    name:'qty_issued'
                },
                {
                    data:'depot_code',
                    name:'depot_code'
                },

              ]


          });


       }


        $('#searchdata').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var dept_code =  $('#dept_code').val();

          var acct_code =  $('#acct_code').val();

         

          if (dept_code != '' || acct_code != '' || from_date!='' || to_date !='') {
          	$('#show_err_from_date').html('');
            
           $('#show_err_to_date').html('');
           $('#dept_code_err').html('');
           $('#acct_code_err').html('');

           if(from_date != ''){

           	if(to_date==''){
           		 $('#show_err_to_date').html('Please select to date');
           		return false;
           	}
           }

           

            $('#SapVsDispatch').DataTable().destroy();
            load_data(dept_code, acct_code,from_date,to_date);


          }else{


          /* $('#show_err_from_date').html('Please select from date');
            
           $('#show_err_to_date').html('Please select to date');
           $('#dept_code_err').html('Please select depot code');
           $('#acct_code_err').html('Please select account code');*/
           $('#SapVsDispatch').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){

          $('#dept_code').val('');
          $('#acct_code').val('');
          document.getElementById("depotText").innerHTML = '';
          document.getElementById("accountText").innerHTML = '';
          $('#SapVsDispatch').DataTable().destroy();
          $('#searcherr').html('');
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