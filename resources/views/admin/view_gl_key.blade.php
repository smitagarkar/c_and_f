@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
 

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }
  }

</style>


<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

<h1>

Gl Key

<small>View Details</small>

</h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/finance/gl-key-mast') }}">Master Gl Key</a></li>

            <li class="active"><a href="{{ url('/finance/gl-key-mast') }}">View Gl Key</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

<div class="box-header with-border" style="text-align: center;">

<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Gl Key</h3>

<div class="box-tools pull-right">

<a href="{{ url('/finance/gl-key-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Gl Key</a>

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

<table id="taxMast" class="table table-bordered table-striped table-hover">

  <thead>

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Gl Key Code</th>

      <th class="text-center">Gl Code </th>

      <th class="text-center">Acc Type Code </th>

      <th class="text-center">Action</th>

    </tr>

  </thead>

</table>

</div><!-- /.box-body -->

</div><!-- /.box -->

</div><!-- /.col -->

</div><!-- /.row -->

</section><!-- /.content -->

</div>



  <div class="modal fade" id="glkeyDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

      <form action="{{ url('/delete-gl-key') }}" method="post">

      @csrf

            <input type="hidden" name="glkeyId" value="" id="glkeyId">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">

          </form>

         </div>

      </div>

    </div>

  </div>




@include('admin.include.footer')



<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(){


          $('#taxMast').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "15%", "targets": 0, "className": "alignCenterClass"},

                            { "width": "20%", "targets": 1, "className": "alignRightClass"},

                            { "width": "20%", "targets": 2, "className": "alignLeftClass"},

                            { "width": "20%", "targets": 3, "className": "alignRightClass"},

                            { "width": "20%", "targets": 4, "className": "alignRightClass"}

                          ],
              ajax:{
                url:'{{ url("/finance/view-gl-key-mast") }}'
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'glkey_code',
                    name:'glkey_code'
                },
                {
                    data:'gl_code',
                    name:'gl_code'
                },
                {
                    data:'acctype_code',
                    name:'acctype_code'
                },
                {
                    data:'action',
                    name:'action',orderable: false, searchable: false
                },
                

              ],




          });


       }

  });

</script>

<script type="text/javascript">
  function GlKeyDlt(id){
      console.log(id);
     $('#glkeyId').val(id);

  }
</script>



@endsection

