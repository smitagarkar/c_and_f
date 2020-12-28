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

            Master Gl Key

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/view-gl-key-mast')}}">Master Gl Key</a></li>

            <li class="Active"><a href="{{ URL('/finance/view-gl-key-mast')}}">Add</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Gl Key</h2>

              

              

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

                        Glkey Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="glkey_code" value="{{ $glkeycode }}" placeholder="Enter Glkey Code">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glkey_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      </div>

                    <!-- /.form-group -->
                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Gl Code : <span class="required-field"></span></label>

                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                          </div>

                          <input list="accountList" id="gl_code" name="gl_code" class="form-control  pull-left" value="{{ $glcode }}" placeholder="Select Gl Code" >

                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($gl_code_list as $key)

                            <option value='<?php echo $key->gl_code?>'   data-xyz ="<?php echo $key->gl_name; ?>" ><?php echo $key->gl_name ; echo " [".$key->gl_code."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                      </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div><!-- /.col -->

              </div>

              <!-- /.row -->


              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Acctype Code : <span class="required-field"></span></label>

                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                          </div>

                          <input list="accountTypeList" id="acctype_code" name="acctype_code" class="form-control  pull-left" value="{{  $acctypecode }}" placeholder="Select Acctype Code" >

                          <datalist id="accountTypeList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acctype_code_list as $key)

                            <option value='<?php echo $key->acctype_code?>'   data-xyz ="<?php echo $key->acctype_name; ?>" ><?php echo $key->acctype_name ; echo " [".$key->acctype_code."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountTypeText"></div>

                      </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div><!-- /.col -->


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Amt Type : 

                        <span class="required-field"></span>

                      </label><br>


                              <input type="radio" name="amt_type" value="1" <?php if($amt_type == '1'){ echo "checked";}else{ echo '';} ?>> Yes
                              <input type="radio" name="amt_type" value="0" <?php if($amt_type == '0'){ echo "checked";}else{ echo '';} ?>> No


                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('amt_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      </div>

                    <!-- /.form-group -->
                  </div>

              </div>

              <!-- /.row -->



              <div style="text-align: center;">

                <input type="hidden" name="key_id" value="{{ $getid }}">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/finance/view-gl-key-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Gl Key</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')

<script type="text/javascript">
   $(document).ready(function(){

      $("#gl_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

      });

      $("#acctype_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountTypeText").innerHTML = msg; 

        });

   });
</script>


@endsection