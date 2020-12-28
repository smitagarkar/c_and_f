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

            Master Config
          <?php if($button=='Save') { ?>
            <small>Add Details</small>
          <?php } else { ?>
            <small>Update Details</small>
          <?php } ?>

          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/view-config-mast') }}">Master Config</a></li>

            <?php if($button=='Save') { ?>

            <li class="active"><a href="{{ url('/finance/config-mast') }}">Add Config</a></li>

          <?php } else { ?>
            <li class="active"><a href="{{ url('/finance/config-mast') }}">Update Config</a></li>
          <?php } ?>

          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">


              <?php if($button=='Save') { ?>
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Config Master </h2>
            <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Config Master </h2>
            <?php } ?>
              



              



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



            <form action="{{ url($action) }}" method="POST" >



               @csrf



               <div class="row">


                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Trans Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>





                            

                          <select name="trans_code" class="form-control">

                            <option value=''>--SELECT--</option>

                           @foreach($trans_list as $row)



                            <option value='{{ $row->tran_code }}'<?php if($tran_code==$row->tran_code) { echo 'selected'; } else { echo '';}?>>{{ $row->tran_code }} = {{ $row->tran_head }} </option>



                           @endforeach

                          </select>



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>







                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Series Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="series_code" value="{{ $series_code }}" placeholder="Enter Series Code">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Series Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="series_name" value="{{ $series_name }}" placeholder="Enter Series Name">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        GI Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                        

                          <select class="form-control" name="gi_code">

                            <option value="">--SELECT--</option>

                            @foreach($gl_list as $key)

                            <option value="{{ $key->gl_code }}" <?php if($gl_code==$key->gl_code){ echo 'selected';} ?>> {{ $key->gl_code }} = {{ $key->gl_name }}</option>



                            @endforeach

                          </select>



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('gi_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Rfhead 1 : 



                        



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="Rfhead1" value="{{ $rfhead1 ?? '' }}" placeholder="Enter Rfhead 1">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 2 : 



                       



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="Rfhead2" value="{{ $rfhead2 ?? '' }}" placeholder="Enter Rfhead 2">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 3 : 



                       



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="Rfhead3" value="{{ $rfhead3 ?? '' }}" placeholder="Enter Rfhead 3">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 4 : 



                       



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="Rfhead4" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Rfhead 4">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 5 : 



                        



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="Rfhead5" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Rfhead 5">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>



<?php if($button=='Update') { ?>



                 <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Department Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         



                          <input type="radio" class="optionsRadios1" name="config_block" value="YES" <?php if($config_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="config_block" value="NO" <?php if($config_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('department_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



<?php } ?>

                <!-- /.col -->



                



              </div>



              <!-- /.row -->





              <!-- /.row -->





              <div style="text-align: center;">

              	<input type="hidden" name="config_id" value="{{ $config_id }}">

                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}





                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right">



          <a href="{{ url('/finance/view-config-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Config</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')



<script type="text/javascript">



$(document).ready(function(){

    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

  });

});

</script>







@endsection