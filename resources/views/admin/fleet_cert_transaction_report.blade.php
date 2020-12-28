@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  .hideDIV{
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
            Fleet Certificate Report 
            <small>View Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('dashboard') }}">Logistic</a></li>
            <li><a href="{{ url('/logistic/fleet-certificate-report') }}">Reports</a></li>
            <li><a href="{{ url('/logistic/fleet-certificate-report') }}">Fleet Certificate Report</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-xs-12">
             

              <div class="box box-primary">
                <div class="box-header with-border" style="text-align: center;" >
                  <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Fleet Certificate Report </h2>
                 
                </div><!-- /.box-header -->

                <div class="box-body">

             <form id="myForm">

               @csrf

              <div class="row">

                <!-- <div class="col-md-3">

                    <label>From Date</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  
                      <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="">

                    </div>
                     <small id="show_err_from_date"></small>

                </div>

                <div class="col-md-3">

                   <label>To Date</label>

                   <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Enter To  Date" value="">

                  </div>
                    <small id="show_err_to_date"></small>
                </div> -->
                <div class="col-md-2"></div>
                <div class="col-md-4">

                    <label>Truck No</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></span>
                        <input id="TRUCK_NO" name="TRUCK_NO" class="form-control  pull-left" value="{{ old('TRUCK_NO')}}" placeholder="Enter Truck No" >

                      </div>
                   
                     <small id="truck_no_err"></small>
                </div>

                <div class="col-md-4" style="margin-top: 3.5%;">

                  <div class="row">

                    <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                    <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                  </div>

                </div>
                <div class="col-md-2"></div>

              </div><!-- /.row -->



              

             </form>

          </div>
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
             <div class="box-body hideDIV" id="ajaxTable">
                  <table  id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                       <tr>
                        <th>Sr No</th>
                        <th>Truck No</th>
                        <th>Certificate Of Fitness</th>
                        <th>State Permit</th>
                        <th>National Permit</th>
                        <th>RTO Tax</th>
                        <th>Danta Tax</th>
                        <th>Vehicle Insurance</th>
                        <th>PUC</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                    </tbody>
                  </table>
                </div> 

            
                 <div class="box-body" id="firstTable">
                  <table  id="example" class="table table-bordered table-striped table-hover example">
                    <thead>
                       <tr>
                        <th>Truck No</th>
                        <th>Certificate Of Fitness</th>
                        <th>State Permit</th>
                        <th>National Permit</th>
                        <th>RTO Tax</th>
                        <th>Danta Tax</th>
                        <th>Vehicle Insurance</th>
                        <th>PUC</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($fetchdata as $key) { ?>
                        <tr>
                          <td><?php echo $key['truck_no'] ?></td>
                          <td><?php echo $key['due_date_cf'] ?></td>
                          <td><?php echo $key['due_date_spermit'] ?></td>
                          <td><?php echo $key['due_date_npermit'] ?></td>
                          <td><?php echo $key['due_date_rto'] ?></td>
                          <td><?php echo $key['due_date_danta'] ?></td>
                          <td><?php echo $key['due_date_insurance'] ?></td>
                          <td><?php echo $key['due_date_puc'] ?></td>
                            
                        </tr>
                     <?php }  ?>
                      
                    </tbody>
                  </table>
                </div> 
<!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>

@include('admin.include.footer')


 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
 

<script type="text/javascript">

    $(function() {

     $(".example").DataTable({

       "scrollX": true,

       "columnDefs": [

        { "width": "10%", "targets": 0 },


      ],
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

     });



});

</script>

<script type="text/javascript">
  function getId(id)
  {
   
    $("#exampleModalDelete").modal('show');
    $("#DepotID").val(id);
  }
</script>

<script type="text/javascript">

  $(document).ready(function(){

   

      function load_data(truck_no='',from_date='',to_date=''){

        $("#ajaxTable").removeClass('hideDIV');
        $("#firstTable").addClass('hideDIV');

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

          $('#example').DataTable({

              
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

                            { "width": "10%", "targets": 0, "className": "alignCenterClass"},

                            { "width": "10%", "targets": 1, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass"},

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 7, "className": "alignCenterClass" },

                            { "width": "10%", "targets": 8, "className": "alignCenterClass" },
                            

                          ],
              ajax:{
                url:'{{ url("/logistic/fleet-cert-report") }}',
                data: {truck_no:truck_no,from_date:from_date,to_date:to_date},
                
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'truck_no',
                    name:'truck_no'
                },

                {
                    data:'due_date_cf',
                    name:'due_date_cf'
                },
                {
                    data:'due_date_spermit',
                    name:'due_date_spermit'
                },
                {
                    data:'due_date_npermit',
                    name:'due_date_npermit'
                },
                
                {
                    data:'due_date_rto',
                    name:'due_date_rto'
                },
                {
                    data:'due_date_danta',
                    name:'due_date_danta'
                },
                {
                    data:'due_date_insurance',
                    name:'due_date_insurance'
                },
                {
                    data:'due_date_puc',
                    name:'due_date_puc'
                },
                

              ],




          });


       }

       $('#btnsearch').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var truck_no =  $('#TRUCK_NO').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(truck_no);return false;

          if (truck_no!='' || from_date!='' || to_date!='') {

        
            load_data(truck_no,from_date,to_date);

          }else{

             
          }


        });

        $('#ResetId').click(function(){

            $('#TRUCK_NO').val('');
            
            location.reload();
      

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

    $('.datepicker1').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate : 'today',
      autoclose: 'true'

    });

});
</script>

@endsection

