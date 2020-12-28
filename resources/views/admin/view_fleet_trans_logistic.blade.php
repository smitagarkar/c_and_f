@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

@include('admin.include.navbar')

@include('admin.include.sidebar')


  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Fleet Transaction 
            <small>View Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('dashboard') }}">Fleet</a></li>
            <li><a href="{{ url('logistic/view-fleet-transaction') }}">Fleet Transaction</a></li>
            <li><a href="{{ url('logistic/view-fleet-transaction') }}">View Fleet Trans</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box box-primary">
                <div class="box-header with-border" style="text-align: center;" >
                  <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Fleet Transaction </h2>
                  <div class="box-tools pull-right">
          <a href="{{ url('logistic/fleet-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fleet Transaction</a>
          </div>
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
                  <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                       <tr>
                        <th>Sr.NO</th>
                        <th>Transaction Date</th>
                        <th>Depot/Plant</th>
                        <th>Account</th>
                        <th>Area</th>
                        <th>L R No</th>
                        <th>Transporter</th>
                        <th>Truck No</th>
                        <th>Item Code</th>
                        <th>STOQty</th>
                        <th>STOAQty</th>
                        <th>Rate</th>
                        <th>Driver Exp</th>
                        <th>Fooding</th>
                        <th>Admin Exp</th>
                        <th>ULoading Exp</th>
                        <th>Toll</th>
                        <th>Diesel </th>
                        <th>Other Exp</th>
                        <th>Total Adv</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sr_no=1; ?>
                        @foreach($fleet_trans as $key)
                      <tr> 
                        

                        <td>{{ $sr_no }}</td>
                        <td>{{ $key->TR_DATE }}</td>
                        <td>{{ $key->DEPOT_CODE }}</td>
                        <td>{{ $key->ACC_CODE }}</td>
                        <td>{{ $key->AREA_CODE }}</td>
                        <td>{{ $key->LR_NO }}</td>
                        <td>{{ $key->TRPT_CODE }}</td>
                        <td>{{ $key->TRUCK_NO }}</td>
                        <td>{{ $key->ITEM_CODE }}</td>
                        <td>{{ $key->UM }}</td>
                        <td>{{ $key->AUM }}</td>
                        <td>{{ $key->RATE }}</td>
                        <td>{{ $key->DRIVER_EXP }}</td>
                        <td>{{ $key->FOODING_EXP }}</td>
                        <td>{{ $key->ADMIN_EXP }}</td>
                        <td>{{ $key->ULOADING_EXP }}</td>
                        <td>{{ $key->TOLL_EXP }}</td>
                        <td>{{ $key->DIESEL_QTY }}</td>
                        <td>{{ $key->OTHER_EXP }}</td>
                        <td>{{ $key->TOTAL_ADV }}</td>
                        <td><a href="{{ url('/logistic/edit-fleet-transaction/'.base64_encode($key->id)) }}"><i class="fa fa-pencil btn btn-warning btn-sm" title="edit"></i></a> | <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#depotDelete_{{ $sr_no }}">
              <i class="fa fa-trash" title="delete"></i>
            </button></td>

                      </tr>
                      <?php $sr_no++; ?>
                        @endforeach
                      
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </tfoot> -->
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>


<?php $sr_no=1; ?>
@foreach($fleet_trans as $key)

<div class="modal fade" id="depotDelete_{{ $sr_no }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">


        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

      You Want To Delete This Fleet Transaction  Data...!

      </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('delete-fleet-trans') }}" method="post">

            @csrf

            <input type="hidden" name="FleetId" id="FleetId" value="{{ $key->id }}">

            <input type="submit" value="Delete" style="margin-top: -22%;" class="btn btn-sm btn-danger">

          </form>

      </div>

    </div>

  </div>

</div>
 <?php $sr_no++; ?>
@endforeach


@include('admin.include.footer')

<script type="text/javascript">
    $(function() {
     $("#example").DataTable({
       "scrollX": true,
       "columnDefs": [
        { "width": "10%", "targets": 0 },
        { "width": "10%", "targets": 1 },
        { "width": "10%", "targets": 2 },
        { "width": "10%", "targets": 3 },
        { "width": "10%", "targets": 4 },
        { "width": "10%", "targets": 5 },
        { "width": "10%", "targets": 6 },
        { "width": "20%", "targets": 7 },
      ]

     });

});
</script>

<script type="text/javascript">
  function getId(id)
  {
   
    $("#exampleModalDelete").modal('show');
    $("#DepotID").val(id);
  }
</script

@endsection

