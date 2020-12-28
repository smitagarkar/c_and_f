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

            Master GL

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/gl-mast')}}">Master GL</a></li>

            <li class="Active"><a href="{{ URL('/finance/gl-mast')}}">Add GL </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master GL</h2>

              

              

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

            <form action="{{ url('form-glmast-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Gl Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>

                           <input type="text" class="form-control" name="gl_code" value="{{old('gl_code')}}" placeholder="Enter Gl Code">
                          
                       
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

                       Gl Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="gl_name" value="{{old('gl_name')}}" placeholder="Enter Gl Name">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                      Gl Type : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <select name="glsch_type" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1">Asses</option>
                            <option value="2">Liability</option>
                            <option value="3">Expenditure</option>
                            <option value="4">Revenue</option>
                            <option value="9">Others</option>
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

                      <label for="exampleInputEmail1">Glsch Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="glsch_codeList"  id="glsch_code" name="glsch_code" class="form-control  pull-left" value="{{ old('glsch_code')}}" placeholder="Select Glsch Code" >



                          <datalist id="glsch_codeList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($glsch_lists as $key)

                            

                            <option value='<?php echo $key->glsch_code?>'   data-xyz ="<?php echo $key->glsch_name; ?>" ><?php echo $key->glsch_name ; echo " [".$key->glsch_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="glsch_codeText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->



                  

              </div>

              <!-- /.row -->

              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Auto Posting : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                         

                          <input type="radio" class="optionsRadios1" name="autoposting" value="1" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="autoposting" value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>



              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/finance/view-gl-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Gl</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')

<script type="text/javascript">

    $(document).ready(function(){

        $("#glsch_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glsch_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("glsch_codeText").innerHTML = msg; 

        });
    });
</script>


@endsection