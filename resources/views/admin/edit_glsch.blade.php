@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .PageTitle{

    margin-right: 1px !important;

  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master GLSCH

            <small>Update Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/edit-glsch/'.base64_encode($glsch_list->id))}}">Master GLSCH </a></li>

            <li class="Active"><a href="{{ URL('/finance/edit-glsch/'.base64_encode($glsch_list->id))}}">Edit GLSCH </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update GLSCH</h2>

              

              

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

            <form action="{{ url('form-glsch-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Glsch Type : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>

                          <input type="hidden" name="tax_id" value="{{ $glsch_list->id }}">


                          <select name="glsch_type" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1" <?php if($glsch_list->glsch_type == '1'){ echo "selected"; }else{ echo '';} ?>>Asses</option>
                            <option value="2" <?php if($glsch_list->glsch_type == '2'){ echo "selected"; }else{ echo '';} ?>>Liability</option>
                            <option value="3" <?php if($glsch_list->glsch_type == '3'){ echo "selected"; }else{ echo '';} ?>>Expenditure</option>
                            <option value="4" <?php if($glsch_list->glsch_type == '4'){ echo "selected"; }else{ echo '';} ?>>Revenue</option>
                            <option value="9" <?php if($glsch_list->glsch_type == '9'){ echo "selected"; }else{ echo '';} ?>>Others</option>
                          </select>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Glsch Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="glsch_code" value="{{ $glsch_list->glsch_code }}" placeholder="Enter Glsch Code">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('glsch_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>

              <!-- /.row -->

              <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Glsch Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          
                          <input type="text" class="form-control" name="glsch_name" value="{{ $glsch_list->glsch_name }}" placeholder="Enter Glsch Name">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Glsch Sequense No : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="glsch_seqno" value="{{ $glsch_list->glsch_seqno }}" placeholder="Enter Glsch Sequense No">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('glsch_seqno', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



              </div>

              <!-- /.row -->



              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/finance/view-glsch') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Tax</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')


@endsection