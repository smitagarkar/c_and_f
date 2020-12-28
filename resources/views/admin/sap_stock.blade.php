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
            SAP Stock
            <small>  SAP Stock Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/home/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
          </ol>
        </section>
  <section class="content">
     <div class="box box-primary Custom-Box">
      <?php if(!empty($depot_list)){ ?>
            <div class="box-header with-border" style="text-align: center;">
                <?php 

                $blah = array_slice($depot_list, 0, 1);

                $depot_code = $blah[0]->Depot; 
                $item_code = $blah[0]->item; 
              ?>
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> SAP Stock Report : {{ ucfirst($depot_name) }} ({{ $depot_code }}) : {{ $item_code }}</h2>
              <!-- <div class="box-tools pull-right">
                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>
              </div> -->

            </div><!-- /.box-header -->
           
      <?php } ?>
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Sr.No</th>
                    <th class="text-center">Month</th>
                    <th class="text-center">Opening</th>
                    <th class="text-center">Receipt </th>
                    <th class="text-center">Issue</th>
                    <th class="text-center">closing</th>
                  </tr>
                </thead>
                <tbody>

                     <?php if(!empty($actual_stock)){   foreach ($actual_stock as $row1) {
                    $j=1;
                    $i=0;
                    foreach ($row1 as $row) {
                     
                    

                  if($row->item=='JSWCHD-01'){ 

                    if($i==0){
                          $opening= $row->reciept_qty_mt;
                               
                        }else
                          {
                            
                          }

                    $closing=$opening+($row->reciept_qty_mt- $row->sap_qty_mt);

                    ?>
                    <tr>
                        <td align="center">{{ $j }}</td>
                        <td align="center">{{ $row->month_std_month }}</td>
                        <td align="center">{{ number_format($opening,2) }}</td>
                        <td align="center">{{ number_format($row->reciept_qty_mt,2) }}</td>
                        <td align="center">{{ number_format($row->sap_qty_mt,2) }}</td>
                        <td align="center">{{ number_format($closing,2) }}</td>
                       
                    </tr>

                  <?php } $opening =$closing; $j++; $i++; } } }?>
                </tbody>
              </table>

            </div><!-- /.box-body -->
           
      </div>
  </section>
</div>


@include('admin.include.footer')

<script type="text/javascript">
$(function() {
$("#example").DataTable({
"scrollX": true,



});

});
</script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy/mm/dd',
      orientation: 'bottom',
      todayHighlight: 'true',
    });
});
</script>

@endsection