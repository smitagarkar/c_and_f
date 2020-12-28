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

Inward Transaction

<small>View Details</small>

</h1>

<ol class="breadcrumb">

<li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

<li><a href="{{ url('/dashboard') }}"> Transaction</a></li>

<li class="active"><a href="{{ url('/view-inward-trans') }}">Inward Trans</a></li>

<li class="active"><a href="{{ url('/view-inward-trans') }}"> View Inward Trans</a></li>

</ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

<div class="box-header with-border" style="text-align: center;">

<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Inward Trans</h3>

<div class="box-tools pull-right">

<a href="{{ url('/form-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Inward Trans</a>

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

<table id="OutwardDispatch" class="table table-bordered table-striped table-hover">

  <thead>

    <tr>

      <th class="text-center">Sr. No</th>

      <th class="text-center">Company</th>

      <th class="text-center">Fy Year </th>

      <th class="text-center">Depot</th>

      <th class="text-center">Invoice No</th>

      <th class="text-center">Vehicle No</th>

      <th class="text-center">Account Code</th>

      <th class="text-center">Action</th>

    </tr>

  </thead>



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

<!-- view model -->

<div class="modal fade" id="inwardTransview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog viewpagein" role="document">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #5696bb;text-align: center;">View Inward Transaction</h4>

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

                          <input type="text" class="form-control" id="company_code" name="company_code" placeholder="Enter Company Name" value="" readonly>

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

                          <input type="text" class="form-control" id="fiscal_year" name="company_code" placeholder="Enter fiscal Year" value="" readonly>

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

                          <input type="text" class="form-control" id="trans_date" name="company_code" placeholder="Enter Transaction Date" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Number : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="trans_num" name="company_code" placeholder="Enter Transaction Number" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="depot_name" name="company_code" placeholder="Enter Depot Name" value="" readonly>

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

                          <input type="text" class="form-control" id="acc_code" name="company_code" placeholder="Enter Account Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                         <i class="fa fa-bus" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transport" name="company_code" placeholder="Enter Transporter " value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="vehicl_num" name="company_code" placeholder="Enter Depot Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="invoc_num" name="company_code" placeholder="Enter Account Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice Date : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                          </div>

                          <input type="text" class="form-control" id="Invoice_date" name="company_code" placeholder="Enter Invoice Date " value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-ship" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="item_name" name="company_code" placeholder="Enter Item Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">STO Qty UM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="sto_qty_um" name="company_code" placeholder="Enter STO Qty UM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">STO Qty AUM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="sto_qty_aum" name="company_code" placeholder="Enter STO Qty AUM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Recived Quantity UM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="recvd_qty_um" name="company_code" placeholder="Enter Recived Quantity UM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Recived AQuantity AUM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="recv_aqty_aum" name="company_code" placeholder="Enter Recived AQuantity AUM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Sort Quantity UM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="sort_qty_um" name="company_code" placeholder="Enter STO Qty UM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Sort Quantity AUM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="sort_qty_aum" name="company_code" placeholder="Enter Sort Quantity AUM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Damage Quantity UM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="damg_qty_um" name="company_code" placeholder="Enter Damage Quantity UM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Damage AQuantity AUM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="damg_aqty_aum" name="company_code" placeholder="Enter Damage AQuantity AUM" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Return Qty : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-retweet" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="return_qty" name="company_code" placeholder="Enter Return Qty" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Flag : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                          <i class="fa fa-flag-checkered" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="flag" name="company_code" placeholder="Enter Flag" value="" readonly>

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



  <div class="modal fade" id="inwardTransDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

      <form action="{{ url('/delete-inward-trans') }}" method="post">

      @csrf

            <input type="hidden" name="id" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">

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


          $('#OutwardDispatch').DataTable({

              
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

                            { "width": "10%", "targets": 3, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 7, "className": "alignCenterClass" }

                          ],
              ajax:{
                url:'{{ url("/view-inward-trans") }}'
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'comp_code',
                    name:'comp_code'
                },
                {
                    data:'fy_year',
                    name:'fy_year'
                },
                {
                    data:'depotName',
                    name:'depotName'
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
  function deleteinwrd(id){
      //console.log(id);
     $('#getuserid').val(id);

  }
</script>


<script type="text/javascript">
  function inwardView(id){
    // var formid = $('#getuserfrmid').val(id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({

          url:"{{ url('fetch-inwardrecord-for-view') }}",

           method : "POST",

           type: "JSON",

           data: {id: id},

           success:function(data){
                //console.log(data);
            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    //console.log(data1.data[0]);
                    $('#company_code').val(data1.data[0].comp_code);
                    $('#fiscal_year').val(data1.data[0].fy_year);
                    $('#trans_date').val(data1.data[0].vr_date);
                    $('#trans_num').val(data1.data[0].vr_no);
                    $('#depot_name').val(data1.data[0].depot_code);
                    $('#acc_code').val(data1.data[0].acc_code);
                    $('#transport').val(data1.data[0].trpt_code);
                    $('#vehicl_num').val(data1.data[0].truck_no);
                    $('#invoc_num').val(data1.data[0].invoice_no);
                    $('#Invoice_date').val(data1.data[0].invoice_date);
                    $('#item_name').val(data1.data[0].item_code);
                    $('#sto_qty_um').val(data1.data[0].sto_qty);
                    $('#sto_qty_aum').val(data1.data[0].sto_aqty);
                    $('#recvd_qty_um').val(data1.data[0].qty_recd);
                    $('#recv_aqty_aum').val(data1.data[0].aqty_recd);
                    $('#sort_qty_um').val(data1.data[0].short_qty);
                    $('#sort_qty_aum').val(data1.data[0].short_aqty);
                    $('#damg_qty_um').val(data1.data[0].damage_qty);
                    $('#damg_aqty_aum').val(data1.data[0].damage_aqty);
                    $('#return_qty').val(data1.data[0].return_qty);
                    $('#flag').val(data1.data[0].flag);
                 
                }
           }

        });
  }
</script>

@endsection

