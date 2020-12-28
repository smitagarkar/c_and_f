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
  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Item Rack

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/finance/form-mast-rack') }}">Master Item Rack</a></li>

            <li class="active"><a href="{{ url('/finance/form-mast-rack') }}">Add Item Rack</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Item Rack </h2>

              

              

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

                       Item Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


                            <input list="itemList"  id="item_code" name="item_code" class="form-control  pull-left" value="{{ $item_code }}" placeholder="Select Item Code" >

                          <datalist id="itemList">
                          
                           
                             <option value="">--SELECT--</option>
                             @foreach($item_list as $key)

                             <option value="{{ $key->item_code }}" data-xyz ="{{ $key->item_name }}" <?php if($item_code == $key->item_code){ echo "selected";} ?>>{{ $key->item_code }} = {{ $key->item_name }}</option>

                             @endforeach
                          </datalist>

                        </div>
                        <div class="pull-left showSeletedName" id="itemText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Rack Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                          <input list="rackList"  id="rack_code" name="rack_code" class="form-control  pull-left" value="{{ $rack_code }}" placeholder="Select Rack Code" >
                        
                          <datalist id="rackList">

                             <option value="">--SELECT--</option>
                             @foreach($rack_list as $row)
                            <option value="{{ $row->rack_code }}" data-xyz ="{{ $row->rack_name }}" <?php if($rack_code ==$row->rack_code){ echo 'selected'; } ?>>{{ $row->rack_code }} = {{ $row->rack_name }}</option>

                             @endforeach
                           </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="rackText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rack_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                </div>
               

                  
                  
                
<?php if($button=='Update') { ?>
<div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Item Rack Block : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                         

                          <input type="radio" class="optionsRadios1" name="item_rack_block" value="YES" <?php if($item_rack_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="item_rack_block" value="NO" <?php if($item_rack_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rack_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

           </div>     
<?php } ?>
                <!-- /.col -->



              <!-- /.row -->


              <!-- /.row -->


              <div style="text-align: center;">
              	<input type="hidden" name="item_rack_id" value="{{ $item_rack_id }}">
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

          <a href="{{ url('/finance/view-mast-item-rack') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Rack</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

    $(document).ready(function(){

        $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });

        $("#rack_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#rackList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("rackText").innerHTML = msg; 

        });

    });
</script>

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