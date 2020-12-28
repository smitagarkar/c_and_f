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
  .vehiclenumup{
    text-transform: uppercase;
  }





</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            SAP Bill

            <small> SAP Bill Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-sap-bill') }}">SAP Bill</a></li>

            <li class="active"><a href="{{ url('/form-sap-bill') }}">Add SAP Bill</a></li>

          </ol>

        </section>

	<section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add  SAP Bill</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div>



            </div><!-- /.box-header -->

            <div class="box-body">

             <form action="{{ url('sap-bill-submit') }}" method="POST" id="InwardTrnas">



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

                      <label for="exampleInputEmail1">Fiscal Year : <span class="required-field"></span></label>

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

                      <label for="exampleInputEmail1">Depot : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="depot_code" name="depot_code" class="form-control  pull-left" value="{{ old('depot_code')}}" placeholder="Select Depot" >



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

              </div>


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="invoice_date" id="inv_date" class="form-control datepicker" value="{{ old('invoice_date')}}" autocomplete="off" placeholder="Select Invoice Date">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('invoice_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1"> Invoice No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

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

                      <label for="exampleInputEmail1">Customer : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>



                           <input list="accountList" id="account_code" name="account_code" class="form-control  pull-left" value="{{ old('account_code')}}" placeholder="Select Customer" >



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

                  <div class="form-group">

                      <label for="exampleInputEmail1">Area / Destination : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>



                          <input list="areaList" id="area_code" name="area_code" class="form-control  pull-left" value="{{ old('area_code')}}" placeholder="Select Area / Destination">



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

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>
                          <input type="hidden" name="" value="<?php echo $fromDate; ?>" id="FromDateFy">
                          <input type="hidden" name="" value="<?php echo $toDate; ?>" id="ToDateFy">
                          <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" value="{{ old('transaction_date')}}" autocomplete="off" placeholder="Select Transaction Date">

                        </div>

                        <small id="showmsgfordate"></small>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                       

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction No : <span class="required-field"></span></label>

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

                

              </div><!-- /.row -->



             



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                          <input list="transList" id="transport_code" name="transport_code" class="form-control  pull-left" value="{{ old('transport_code')}}" placeholder="Select Transporter">



                          <datalist id="transList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($transpoter_list as $key)

                            

                            <option value='<?php echo $key->acctype_code?>'   data-xyz ="<?php echo $key->acctype_name; ?>" ><?php echo $key->acctype_name ; echo " [".$key->acctype_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transport_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-bus" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control vehiclenumup" id="vehicle_no" name="vehicle_no" placeholder="Enter Vehicle No" value="{{ old('vehicle_no')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        <!-- <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter Item"> -->



                         <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left" value="{{ old('item_code')}}" placeholder="Select Item">



                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->item_code?>'   data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="itemText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                

              </div>



              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Inv qunatity um : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                           <input type="hidden" name="" id="cfactor" value="">

                          <input type="text" class="form-control Number" name="inv_qty_um" id="inv_qty_um" placeholder="Enter Inv qunatity um" value="{{ old('inv_qty_um')}}">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('inv_qty_um', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        



                    </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                        <label for="exampleInputEmail1">UM : </label>

                        <input type="text" class="form-control" id="UnitM" value=""  placeholder="Enter UM" disabled="">

                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Inv qunatity aum : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control Number" id="inv_qty_aum" name="inv_qty_aum" placeholder="Enter Inv qunatity aum" value="{{ old('inv_qty_aum') }}">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('inv_qty_aum', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        

                    </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                        <label for="exampleInputEmail1">AUM :</label>

                        <input type="text" class="form-control" id="unitAum" placeholder="Enter AUM"  disabled="">

                    </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-6">

                  <label for="exampleInputEmail1">Sales Officer : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="so_code" name="so_code" placeholder="Enter SO Code" value="{{ old('so_code')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('so_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

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



       $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

        });



       $("#transport_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

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



       $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });


    });



   $(document).ready(function() {


    $("#inv_qty_um").on('input',function(){

            var invqty = $("#inv_qty_um").val();

            var cFactor = $("#cfactor").val();

            var result = invqty*cFactor;

            if(invqty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#inv_qty_um").val('0');

               $("#inv_qty_aum").val('');

            }else{

               $("#inv_qty_aum").val(result);

            }

        });


    $('#inv_qty_aum').on('input',function(){
            var invqtyAum = $('#inv_qty_aum').val();
            var invCfatcor = $('#cfactor').val();

            var invresult = invqtyAum/invCfatcor;
            $('#inv_qty_um').val(invresult.toFixed(2));
    });



   });





   $(document).ready(function() {

    

      $("#item_code").change(function(){



         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });



        var itemcode =  $(this).val();

        console.log('ItemCdoe => ',itemcode);



                  $('#UnitM').val('');

                  $('#unitAum').val('');

                  $('#cfactor').val('');

                  $('#inv_qty_aum').val('');

                  $('#inv_qty_um').val('');



        $.ajax({



          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            

                var data1 = JSON.parse(data);



                

                //console.log("Data  ==> ",data1.data);

                



                if (data1.response == 'error') {



                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                }else if(data1.response == 'success'){



                  

                 console.log(data1.data[0]);

                  $('#UnitM').val(data1.data[0].um_code);

                  $('#unitAum').val(data1.data[0].aum);

                  $('#cfactor').val(data1.data[0].aum_factor);



                }



           }



        });



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
      endDate : todateintrans,
      autoclose: 'true'
    });

     });

    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate: 'today',
      autoclose: 'true'
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

@endsection