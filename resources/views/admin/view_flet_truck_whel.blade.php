@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')





  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Fleet Truck Wheel 

            <small>View Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/view-flet-truck-wheel')}}">Master Fleet Truck </a></li>

            <li class="Active"><a href="{{ URL('/view-flet-truck-wheel')}}">View Fleet Truck </a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Fleet Truck Wheel</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/form-fleet-truck-wheel') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fleet Truck Wheel</a>

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

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Wheel code</th>

                        <th class="text-center">Wheel Name</th>

                        <th class="text-center">Action</th>

                      </tr>

                    </thead>

                    <tbody>

                    	<?php $sr_no=1; ?>

                      	@foreach($fleettruck_list as $key)

                      <tr> 

                      	



                        <td align="center">{{ $sr_no }}</td>

                        <td align="center">{{ $key->wheel_code }}</td>

                        <td align="center">{{ $key->wheel_name }}</td>

                        <td align="center">
                          <a href="{{ url('/edit-flet-truck-wheel/'.base64_encode($key->id)) }}">
                            <i class="fa fa-pencil btn btn-warning btn-xs" title="edit"></i>
                          </a> | <button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#fleetDelete_{{ $sr_no }}">

                          <i class="fa fa-trash" title="delete"></i>

                          </button>
                        </td>

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

@foreach($fleettruck_list as $key)



<div class="modal fade" id="fleetDelete_{{ $sr_no }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Fleet Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('delete-fleet-truck-whel') }}" method="post">



            @csrf



            <input type="hidden" name="FleetID" id="FleetID" value="{{ $key->id }}">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



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

      

       "columnDefs": [

        { "width": "10%", "targets": 0 },

        { "width": "10%", "targets": 1 },

        { "width": "10%", "targets": 2 },

        { "width": "10%", "targets": 3 },

        

      ]



     });



});

</script>



<script type="text/javascript">

  function getId(id)

  {

    alert('hi');return false;

    $("#exampleModalDelete").modal('show');

    $("#DepotID").val(id);

  }

</script



@endsection



