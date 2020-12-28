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

            Master TDS

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
           
            <li class="Active"><a href="{{ URL('/finance/tds-mast')}}">Master TDS</a></li>
            <li class="Active"><a href="{{ URL('/finance/tds-mast')}}">Add TDS</a></li>
           
           <?php } else { ?>

             <li class="Active"><a href="{{ URL('/finance/edit-tds-mast/'.base64_encode($tds_id))}}">Master TDS</a></li>
             <li class="Active"><a href="{{ URL('/finance/edit-tds-mast/'.base64_encode($tds_id))}}">Update TDS</a></li>
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

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master TDS</h2>

             <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master TDS</h2>

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

                          <input type="text" class="form-control" name="tds_code" value="{{$tds_code}}" placeholder="Enter TDS Code">

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

                       TDS Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tds_name" id="tds_name" value="{{$tds_name}}" placeholder="Enter TDS Name">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tds_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Surcharge Rate : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="surcharge_rate" id="surcharge_rate" value="{{$surcharge_rate}}" placeholder="Enter Surcharge Rate">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('surcharge_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Surchargegl Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="surchargegl_code" value="{{$surchargegl_code}}" placeholder="Enter Surchargegl Code">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('surchargegl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Cess Rate : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="cess_rate" id="cess_rate" value="{{$cess_rate}}" placeholder="Enter Cess Rate">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cess_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Cessgl Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="cessgl_code" value="{{$cessgl_code}}" placeholder="Enter Cessgl Code">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cessgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Form No. : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="form_no" id="form_no" value="{{$form_no}}" placeholder="Enter Form No.">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_no', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        GL Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <select class="form-control" name="gl_code">

                            <option value="">--SELECT--</option>

                            @foreach($gl_list as $key)

                            <option value="{{ $key->gl_code }}" <?php if($gl_code==$key->gl_code){ echo 'selected';} ?>> {{ $key->gl_code }} = {{ $key->gl_name }}</option>



                            @endforeach

                          </select>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       TDS Section : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tds_section" id="tds_section" value="{{$tds_section}}" placeholder="Enter TDS Section">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tds_section', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                          <input type="text" class="form-control datepicker" name="to_date" id="to_date" value="{{$to_date}}" placeholder="Enter To Date">

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

                          <input type="radio" class="optionsRadios1" name="tds_block" value="1" <?php if($tds_block=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="tds_block" value="0" <?php if($tds_block=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tds_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                </div>
<?php } ?>


              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">
                  <input type="hidden" name="idtds" value="{{$tds_id}}">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/finance/view-tds-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS</a>

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