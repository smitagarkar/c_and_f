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
  .viewpagein{
    width: 70%;
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

Outward Transaction

<small>View Details</small>

</h1>

<ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/view-outward-trans') }}">Outward Trans</a></li>

            <li class="active"><a href="{{ url('/view-outward-trans') }}">View Outward Trans</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Depot</h3>

<div class="box-tools pull-right">

<a href="{{ url('/form-outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Outward Trans</a>

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

<table id="OutwardTrans" class="table table-bordered table-striped table-hover">

  <thead>

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Depot</th>

      <th class="text-center">Transaction Date </th>

      <th class="text-center">Transaction No</th>

      <th class="text-center">Challan No</th>

      <th class="text-center">Vehicle No</th>

      <th class="text-center">Account Code</th>

      <th class="text-center">Action</th>

    </tr>

  </thead>

  <tbody>

  

  </tbody>

  

</table>

</div><!-- /.box-body -->

</div><!-- /.box -->

</div><!-- /.col -->

</div><!-- /.row -->

</section><!-- /.content -->

</div>


<!-- delete record -->

  
  <div class="modal fade" id="OutwardTranssDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

      <form action="{{ url('/delete-outward-trans') }}" method="post">

      @csrf

            <input type="hidden" name="id" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">

          </form>

         </div>

      </div>

    </div>

  </div>

<!-- delete record -->


<!-- view model -->

<div class="modal fade" id="outwardtransView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog viewpagein" role="document">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #5696bb;text-align: center;">View Outward Transaction</h4>

      </div>

      <div class="modal-body">

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="company_code" name="comp_code" placeholder="Enter Company Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">fiscal Year : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="fisacal_year" name="comp_code" placeholder="Enter fiscal Year" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="transaction_date" name="comp_code" placeholder="Enter Transaction Date" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="depot_code" name="comp_code" placeholder="Enter Depot Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="account_Code" name="comp_code" placeholder="Enter Account Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Area Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="areaCode" name="comp_code" placeholder="Enter Area Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="trans_number" name="comp_code" placeholder="Enter Transaction No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Type : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptch_type" name="comp_code" placeholder="Enter Despatch Type" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="invoiceNum" name="comp_code" placeholder="Enter Invoice No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-ship" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="item_name" name="comp_code" placeholder="Enter Item" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Quantity : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                           <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptch_qty" name="comp_code" placeholder="Enter Despatch Quantity" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch AQuantity : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptach_aqty" name="comp_code" placeholder="Enter Despatch AQuantity" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="vehicl_num" name="comp_code" placeholder="Enter Vehicle No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transport : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="transport" name="comp_code" placeholder="Enter Transport" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Challan No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                           <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="chalan_num" name="comp_code" placeholder="Enter Challan No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Driver Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Enter Driver Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Driver Contact Number : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="driver_number" name="driver_number" placeholder="Enter Driver Contact Number" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

          </div>
          <div class="modal-footer" style="text-align: center;">

            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancle</button>

          </div>
        </div>
      </div>
    </div>


<!-- view model -->


@include('admin.include.footer')




<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(){


          $('#OutwardTrans').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignCenterClass"},

                            { "width": "10%", "targets": 1, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass"},

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 7, "className": "alignCenterClass" }

                          ],
              ajax:{
                url:'{{ url("/view-outward-trans") }}'
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'depotName',
                    name:'depotName'
                },
                {
                    data:'tr_date',
                    name:'tr_date'
                },
                {
                    data:'tr_no',
                    name:'tr_no'
                },
                
                {
                    data:'chalan_no',
                    name:'chalan_no'
                },
                {
                    data:'truck_no',
                    name:'truck_no'
                },
                {
                    data:'accountName',
                    name:'accountName'
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
  function deleteoutwrd(id){
      $('#getuserid').val(id);
  }
</script>

<script type="text/javascript">
  function outwardView(id){
    // var formid = $('#getuserfrmid').val(id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({

          url:"{{ url('fetch-otwardrecord-for-view') }}",

           method : "POST",

           type: "JSON",

           data: {id: id},

           success:function(data){
               // console.log(data);
            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    //console.log(data1.data[0]);
                  $('#company_code').val(data1.data[0].comp_code);
                  $('#fisacal_year').val(data1.data[0].fy_year);
                  $('#transaction_date').val(data1.data[0].tr_date);
                  $('#depot_code').val(data1.data[0].depot_code);
                  $('#account_Code').val(data1.data[0].acc_code);
                  $('#areaCode').val(data1.data[0].area_code);
                  $('#trans_number').val(data1.data[0].tr_no);
                  $('#desptch_type').val(data1.data[0].desp_type);
                  $('#invoiceNum').val(data1.data[0].inv_no);
                  $('#item_name').val(data1.data[0].item_code);
                  $('#desptch_qty').val(data1.data[0].desp_qty);
                  $('#desptach_aqty').val(data1.data[0].desp_aqty);
                  $('#vehicl_num').val(data1.data[0].truck_no);
                  $('#transport').val(data1.data[0].trans_code);
                  $('#chalan_num').val(data1.data[0].chalan_no);
                  $('#driver_name').val(data1.data[0].driver_name);
                  $('#driver_number').val(data1.data[0].driver_number);

                

                }
           }

        });
  }
</script>


@endsection
