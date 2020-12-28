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

</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inward Transation
            <small>Inward Transaction Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
          </ol>
        </section>
	<section class="content">
     <div class="box box-primary Custom-Box">
            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Inward Transaction</h2>
              <div class="box-tools pull-right">
                <a href="#" class="btn btn-primary" style="margin-right: 10px;">View Inward Trans</a>
              </div>

            </div><!-- /.box-header -->
            <div class="box-body">
            
           

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="company_code" name="company_code" placeholder="Enter Company Name" value="{{ $inward_list->company_code }}">
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
                          <input type="text" class="form-control" id="fy_year" name="fy_year" placeholder="Enter fy Year" value="fy_year">
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
                        <input type="text" name="tr_date" id="tr_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="tr_date">
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
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="  tr_no" name="  tr_no" placeholder="Enter Company Name" value="{{ $inward_list-> tr_no }}">
                        </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Depot Name : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="fy_year" name="fy_year" placeholder="Enter fy Year" value="{{ $inward_list->Depot }}">
                      </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="acc_code" id="acc_code" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $inward_list->acc_code }}">
                      </div>
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Area Code : <span class="required-field"></span></label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="  area_code" name="area_code" placeholder="Enter Company Name" value="{{ $inward_list-> area_code }}">
                        </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="trans_code" name="trans_code" placeholder="Enter fy Year" value="{{ $inward_list->trans_code }}">
                      </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="vehicl_no" id=" vehicl_no" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $inward_list-> vehicl_no }}">
                      </div>
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Challan No : <span class="required-field"></span></label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="    challan_no" name="challan_no" placeholder="Enter Company Name" value="{{ $inward_list->   challan_no }}">
                        </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </div>
                          <input type="text" class="form-control" id="trans_code" name="trans_code" placeholder="Enter fy Year" value="{{ $inward_list->trans_code }}">
                      </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Invoice Date : <span class="required-field"></span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name=" vehicl_no" id=" vehicl_no" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $inward_list-> vehicl_no }}">
                      </div>
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->

           

             

             
             
            

             
               <div class="box-footer" style="text-align: center;">
               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save</button>
               </div>
            </div><!-- /.box-body -->
           
          </div>
	</section>
</div>


@include('admin.include.footer')


@endsection