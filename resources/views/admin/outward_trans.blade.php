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

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .showSeletedName {

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

            Outward Transaction

            <small>  Outward Transaction Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-outward-trans') }}">Outward Trans</a></li>

            <li class="active"><a href="{{ url('/form-outward-trans') }}">Add Outward Trans</a></li>

          </ol>

        </section>

	<section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Outward Trans</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  Outward Trans</a>

              </div>



            </div><!-- /.box-header -->

            <div class="box-body">

             <form action="{{ url('outward-trans-submit') }}" method="POST" id="InwardTrnas">



               @csrf



              <div class="row">

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="company_code" name="comp_code" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">fiscal Year : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="fy_year" name="fy_year" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('fy_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>


                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                         <input type="hidden" name="" value="<?php echo $fromDate; ?>" id="FromDateFy">
                        <input type="hidden" name="" value="<?php echo $toDate; ?>" id="ToDateFy">
                        <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" value="{{ old('transaction_date')}}" placeholder="Enter Transaction Date">

                      </div>
                      <small id="showmsgfordate"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->

              </div>

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="depot_code" name="depot_code" class="form-control  pull-left" value="{{ old('depot_code')}}" placeholder="Select Depot Code" >



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            

                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('depot_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                     

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>



                          <input list="accountList" id="account_code" name="account_code" class="form-control  pull-left" value="{{ old('account_code')}}" placeholder="Select Account Code" >



                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)

                            

                            <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('account_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->


                <div class="col-md-4">

                  <label for="exampleInputEmail1">Area Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                          <input list="areaList" id="area_code" name="area_code" class="form-control  pull-left" placeholder="Select Area Code" value="{{ old('area_code')}}">



                          <datalist id="areaList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($area_list as $key)

                            

                            <option value='<?php echo $key->code?>'   data-xyz ="<?php echo $key->name; ?>" ><?php echo $key->name ; echo " [".$key->code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                       <small>  

                        <div class="pull-left showSeletedName" id="areaText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('area_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

                

                

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1"> Transaction No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transaction_no" name="transaction_no" placeholder="Enter Transaction No" value="{{ old('transaction_no')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                     

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Type : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <!-- <input type="text" class="form-control" id="desp_type" name="desp_type" placeholder="Enter Despatch Type" value="{{ old('desp_type') }}"> -->



                           <select id="despatch_type" name="despatch_type" class="form-control">

                              <option value="">-- Select --</option>

                              <option value="D">D</option>

                              <option value="S">S</option>   

                              <option   value="ST">ST</option>

         

                          </select>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('despatch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Enter Invoice No" value="{{ old('invoice_no')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('invoice_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-ship" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="item" name="item" placeholder="Enter Item " value="{{ old('item')}}" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    

                  </div>

                </div><!-- /.col -->

                  <div class="col-md-4">

                  <label for="exampleInputEmail1">Despatch Quantity : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="despatch_qty" name="despatch_qty" placeholder="Enter Despatch Quantity" value="{{ old('despatch_qty')}}" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('despatch_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

                <div class="col-md-4">

                  <label for="exampleInputEmail1">Despatch AQuantity : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="despatch_aqty" name="despatch_aqty" placeholder="Enter Despatch AQuantity" value="{{ old('despatch_aqty')}}" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('despatch_aqty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

    <!--  <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Quantity : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity " value="{{ old('quantity')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('quantity', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                     

                  </div>

                </div> -->

              </div> 



              <div class="row">

                

                

              </div>



              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="Enter Vehicle No" value="{{ old('vehicle_no')}}" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        



                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Transport : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transport_code" name="transport_code" placeholder="Enter Transport" value="{{ old('transport_code')}}" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transport_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        

                    </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <label for="exampleInputEmail1">Challan No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="chalan_no" name="chalan_no" placeholder="Enter Challan No" value="{{ old('chalan_no')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('chalan_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

              </div>


              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Driver Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="Enter Driver Name" value="{{ old('driver_name')}}">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        



                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Driver Contact Number : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control Number" id="driver_number" name="driver_number" placeholder="Enter Driver Contact Number" value="{{ old('driver_number')}}" maxlength="10">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('driver_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        

                    </div>

                </div><!-- /.col -->

              </div>






               <div class="box-footer" style="text-align: center;">

               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save</button>

               </div>

             </form>

            </div><!-- /.box-body -->

           

          </div>

	</section>

</div>





@include('admin.include.footer')



 <script>

      $(function () {

        //Initialize Select2 Elements

        $(".select2").select2();



        //Datemask dd/mm/yyyy

        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        //Datemask2 mm/dd/yyyy

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

        //Money Euro

        $("[data-mask]").inputmask();

      });

 </script>



 <script type="text/javascript">

    $(document).ready(function(){



       $("#account_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



       $("#depot_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

        });



       $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

        });

      

    });







   $(document).ready(function() {

      $("#invoice_no").on('input',function(){

         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var desp_type =  $('#despatch_type').val();
        //alert(desp_type);
       // console.log(desp_type);
        var inv_no =  $('#invoice_no').val();
        var comp_code =  $('#company_code').val();
        var fy_year =  $('#fy_year').val();


         var datastring = "inv_no="+inv_no+"&comp_code="+comp_code+"&fy_year="+fy_year;
       //console.log(datastring);
        if(desp_type == 'D'){

          $.ajax({

          url:"{{ url('get-by-dpt-type') }}",

           method : "POST",

           type: "JSON",

           data: datastring,

           success:function(data){

                var data1 = JSON.parse(data);

                if(data1.response == 'success'){

                getInvoicNo = data1.data[0].invoice_no;

                  if(getInvoicNo == inv_no){

                    $('#item').val(data1.data[0].item_code);

                    $('#vehicle_no').val(data1.data[0].truck_no);

                    $('#transport_code').val(data1.data[0].trpt_code);

                    $('#despatch_qty').val(data1.data[0].sto_qty);

                    $('#despatch_aqty').val(data1.data[0].sto_aqty);

                }else{

                  $('#item').val('');

                  $('#vehicle_no').val('');

                  $('#transport_code').val('');

                  $('#despatch_qty').val('');

                  $('#despatch_aqty').val('');

                }

              }else{

                  $('#item').val('');

                  $('#vehicle_no').val('');

                  $('#transport_code').val('');

                  $('#despatch_qty').val('');

                  $('#despatch_aqty').val('');

                }

           }


        });


        }


      });





        $('#despatch_type').on('change',function(){

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                       }
                });

              var desp_type =  $('#despatch_type').val();

              var inv_no =  $('#invoice_no').val();

              var comp_code =  $('#company_code').val();

              var fy_year =  $('#fy_year').val();

              var datastring = "inv_no="+inv_no+"&comp_code="+comp_code+"&fy_year="+fy_year;

              if(desp_type == 'D'){

                    $.ajax({

                      url:"{{ url('get-by-dpt-type') }}",

                       method : "POST",

                       type: "JSON",

                       data: datastring,

                       success:function(data){

                            var data1 = JSON.parse(data);

                            if(data1.response == 'success'){

                              $('#item').val(data1.data[0].item_code);

                              $('#vehicle_no').val(data1.data[0].truck_no);

                              $('#transport_code').val(data1.data[0].trpt_code);

                              $('#despatch_qty').val(data1.data[0].sto_qty);

                              $('#despatch_aqty').val(data1.data[0].sto_aqty);
                           
                            }else{

                              $('#item').val('');

                              $('#vehicle_no').val('');

                              $('#transport_code').val('');

                              $('#despatch_qty').val('');

                              $('#despatch_aqty').val('');

                            }

                       }

                    });

            }else{

                        $('#item').val('');
                        $('#vehicle_no').val('');
                        $('#transport_code').val('');
                        $('#despatch_qty').val('');
                        $('#despatch_aqty').val('');
            }

         });









    });

</script>





<script type="text/javascript">
  
  $(document).ready(function() {
    $( window ).on( "load", function() {
      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

    $('.transdatepicker').datepicker({

      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans
    });

     });

    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate: 'today'
    });
});
</script>
<script type="text/javascript">
  

    $(document).ready(function(){
        $('#transaction_date').change(function(){
            var transDate = $('#transaction_date').val();

            var fybytrans = new Date(transDate);
           // console.log(invocDateFor);
            var todayDate = new Date();
              if(fybytrans >todayDate){
                $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
                $('#transaction_date').val('');
                return false;
              }else{
                 $('#showmsgfordate').html('');
                return true;
              }
        }); 

        $('.Number').keypress(function (event) {
          var keycode = event.which;
          if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
              event.preventDefault();
          }
       });
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
   
});
</script>


@endsection