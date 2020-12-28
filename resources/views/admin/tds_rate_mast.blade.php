@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  .required-field::before {

    content: "*";

    color: red;

  }
</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master TDS Rate

            <?php if($button=='Save') { ?>
            <small>Add Details</small>
            <?php } else { ?>
              <small>Update Details</small>
            <?php } ?>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

           <?php if($button=='Save') { ?>
           
            <li class="Active"><a href="{{ URL('/finance/tds-rate-mast')}}">Master TDS Rate</a></li>
            <li class="Active"><a href="{{ URL('/finance/tds-rate-mast')}}">Add TDS Rate</a></li>
           
           <?php } else { ?>

             <li class="Active"><a href="{{ URL('/finance/edit-tds-rate-mast/'.base64_encode($tdsrate_id))}}">Master TDS Rate</a></li>
             <li class="Active"><a href="{{ URL('/finance/edit-tds-rate-mast/'.base64_encode($tdsrate_id))}}">Update TDS Rate</a></li>
           <?php } ?>
            

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master TDS Rate</h2>

             <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master TDS Rate</h2>

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

                        TDS Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <select class="form-control" name="tds_code">

                            <option value="">--SELECT--</option>

                            @foreach($tds_list as $key)

                            <option value="{{ $key->tds_code }}" <?php if($tds_code==$key->tds_code){ echo 'selected';} ?>> {{ $key->tds_code }} = {{ $key->tds_name }}</option>



                            @endforeach

                          </select>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tds_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        ACC Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <select class="form-control" name="acc_code">

                            <option value="">--SELECT--</option>

                            @foreach($acc_list as $key)

                            <option value="{{ $key->acc_code }}" <?php if($acc_code==$key->acc_code){ echo 'selected';} ?>> {{ $key->acc_code }} = {{ $key->acc_name }}</option>

                            @endforeach

                          </select>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        TDS Rate : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="tds_rate" value="{{$tds_rate}}" placeholder="Enter TDS Rate">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tds_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        From Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control datepicker" name="from_date" value="{{$from_date}}" placeholder="Enter From Date">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       To Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control datepicker" name="to_date" id="to_date" value="{{$to_date}}" placeholder="Enter To Rate">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>
              <!-- /.row -->

             

               

<?php if($button=='Update') { ?>
              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       TDS Block : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="tdsrate_block" value="1" <?php if($tdsrate_block=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="tdsrate_block" value="0" <?php if($tdsrate_block=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tdsrate_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                </div>
<?php } ?>


              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">
                  <input type="hidden" name="idtds" value="{{$tdsrate_id}}">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/finance/view-tds-rate-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS Rate</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')


<script type="text/javascript">
  
  $(document).ready(function() {

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        orientation: 'bottom',
        todayHighlight: 'true',
        endDate: 'today'
    });
   

  });

  
</script>

<!-- <script type="text/javascript">
  $('#itemcategory_name').on('change',function(){

   var email =  $('#itemcategory_name').val();

    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
        alert('wrong');
        $('#itemcategory_name').val('');
        return false;
      }else{
        return true;
      }

  });
</script> -->


@endsection