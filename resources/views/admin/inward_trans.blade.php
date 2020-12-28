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

  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

  .setinmobileDiv{

    margin-top: 0%;

  }

  @media screen and (max-width: 600px) {

  .setinmobileDiv{

    margin-top: 8%;

  }

  .formTitle{

        margin-right: 43% !important;

  }

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

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transation </a></li>

            <li class="active"><a href="{{ url('/form-inward-trans') }}">Inward Trans </a></li>

            <li class="active"><a href="{{ url('/form-inward-trans') }}">Add Inward Trans</a></li>
          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Add Inward Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Inward Trans</a>

              </div>



            </div><!-- /.box-header -->

            <div class="box-body">

             <form action="{{ url('inward-trans-submit') }}" method="POST" id="InwardTrnas">



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

                </div> <!-- /.col -->


                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="Depot" name="depot_code" class="form-control  pull-left" value="{{ old('depot_code')}}" placeholder="Select Depot Name" >



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
                

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $fromDate; ?>" id="FromDateFy">
                        <input type="hidden" name="" value="<?php echo $toDate; ?>" id="ToDateFy">
                        <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" placeholder="Select Transaction Date" value="{{ old('transaction_date')}}">

                      </div>
                      <small id="showmsgfordate"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->
                

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Number : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transaction_no" name="transaction_no" placeholder="Enter Transaction Number" value="{{ old('transaction_no')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                

                <div class="col-md-4 setinmobileDiv">

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

              </div>



              <div class="row">

                <div class="col-md-4 setinmobileDiv">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-bus" aria-hidden="true"></i>

                          </div>



                          <input list="transList" id="transporter_code" name="transporter_code" class="form-control  pull-left" value="{{ old('transporter_code')}}" placeholder="Select Transporter">



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

                            {!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4 setinmobileDiv">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Enter Vehicle No" value="{{ old('vehicle_no')}}" minlength="0" maxlength="14">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="invoic_no" name="invoice_no" placeholder="Enter Invoice No" value="{{ old('invoice_no')}}" minlength="0" maxlength="14">



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

                      <label for="exampleInputEmail1">Invoice Date : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="invoice_date" id="invoic_date" class="form-control datepicker" placeholder="Select Invoice Date" value="{{ old('invoice_date')}}">
                        



                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('invoice_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->



                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-ship" aria-hidden="true"></i>

                        </div>

                        <!-- <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter Item"> -->



                        <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Select Item Code">



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

                      <small id="errorItem" class="form-text text-muted">

                           

                      </small>

                  </div>

                </div><!-- /.col -->

              </div>



              



              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">STO Qty UM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                           <input type="hidden" name="" id="cfactor" value="">

                          <input type="text" class="form-control Number" name="sto_qty" id="sto_qtyum" placeholder="Enter STO Qty UM" value="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('sto_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>



                    </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                        <label for="exampleInputEmail1">UM : </label>

                        <input type="email" class="form-control" id="UnitM" value=""  placeholder="Enter UM" disabled="">

                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">STO Qty AUM : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control Number" id="sto_qtyaum" name="sto_aqty" placeholder="Enter STO Qty AUM" value="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('sto_aqty', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                        <label for="exampleInputEmail1">AUM :</label>

                        <input type="email" class="form-control" id="unitAum" placeholder="Enter AUM"  disabled="">

                    </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Recived Quantity UM : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="hidden" name="" id="recivdcfactor" value="">

                          <input type="text" class="form-control Number" id="recd_qty" name="qty_recd" placeholder="Enter Recived Quantity UM" value="">

                      </div>
                      <small id="showerrrcv" style="color: red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('qty_recd', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">UM : </label>

                       <input type="text" class="form-control" id="recivdUm" placeholder="Enter UM" disabled="">

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Recived AQuantity AUM : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control Number" id="recd_aqty" name="aqty_recd" placeholder="Enter Recived AQuantity AUM" value="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('aqty_recd', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">AUM : </label>

                       <input type="text" class="form-control" id="recivdAum" placeholder="Enter AUM" disabled="">

                  </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Sort Quantity UM :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="hidden" name="" id="sortcfactor" value="">

                          <input type="text" class="form-control Number" id="sort_qty" name="sort_qty" placeholder="Enter Sort Quantity UM" value="">

                      </div>
                     
                      <small id="showerrsort" style="color: red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('sort_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">UM : </label>

                       <input type="text" class="form-control" id="sortUm" placeholder="Enter UM" disabled="">

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Sort Quantity AUM : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          

                          <input type="text" class="form-control Number" id="sort_aqty" name="sort_aqty" placeholder="Enter Sort Quantity AUM" value="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('sort_aqty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">AUM : </label>

                       <input type="text" class="form-control" id="sortAum" placeholder="Enter AUM" disabled="">

                  </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Damage Quantity UM : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="hidden" name="" id="damagecfactor" value="">

                          <input type="text" class="form-control Number" id="damg_qty" name="damage_qty" placeholder="Enter Damage Quantity UM" value=""> 

                      </div>
                      
              
                      <small id="showerrdmg" style="color: red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('damage_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">UM : </label>

                       <input type="text" class="form-control" id="damageUm" placeholder="Enter UM" disabled="">

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Damage AQuantity AUM : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          

                          <input type="text" class="form-control Number" id="damg_aqty" name="damage_aqty" placeholder="Enter Damage AQuantity AUM" value="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('damage_aqty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">AUM : </label>

                       <input type="text" class="form-control" id="damageAum" placeholder="Enter AUM" disabled="">

                  </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Return Qty : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-retweet" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="return_qty" name="return_qty" placeholder="Enter Return Qty" value="{{ old('return_qty')}}" readonly>

                      </div>

              <small id="showerrrtn" style="color: red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('return_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-6">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Flag : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-flag-checkered" aria-hidden="true"></i>

                          </div>


                          <select class="form-control" id="flag" name="flag">
                            <option value="">-- Select Flag --</option>
                            <option value="D">D</option>
                            <option value="U">U</option>
                          </select>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('flag', '<p class="help-block" style="color:red;">:message</p>') !!}

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



        $("#Depot").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

        });



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



        $("#transporter_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

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



        $("#sto_qtyum").on('input',function(){

            var stoQty = $("#sto_qtyum").val();

            var cFactor = $("#cfactor").val();

            var result = stoQty*cFactor;

            if(stoQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#sto_qtyum").val('0');

               $("#sto_qtyaum").val('');

            }else{

               $("#sto_qtyaum").val(result);

            }

        });



        $("#recd_qty").on('change',function(){

            var recdQty = $("#recd_qty").val();

            var cFactor = $("#recivdcfactor").val();

            var sto_qty = $("#sto_qtyum").val();

            var result = recdQty*cFactor;

            if(recdQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#recd_qty").val('0');

               $("#recd_aqty").val('');

            }else{

               $("#recd_aqty").val(result);

            }


            if(parseInt(recdQty) > parseInt(sto_qty)){
              $("#showerrrcv").html('Please Enter Recived Quantity less Than Sto Qty  ');
              $("#recd_qty").val('');
              $("#recd_aqty").val('');
              $("#sort_qty").val('');
              $("#sort_aqty").val('');
              $("#damg_qty").val('');
              $("#damg_aqty").val('');
              $("#return_qty").val('');
              //return false;
            }else if(parseInt(recdQty) < parseInt(sto_qty)){
              $("#showerrsort").html('Please Enter Sort Qty');
              $("#showerrdmg").html('Please Enter Damage Qty');
              $("#showerrrtn").html('Please Enter Return Qty');
              $("#showerrrcv").html('');
              $("#recd_aqty").html('');
              $("#sort_qty").val('');
              $("#sort_aqty").val('');
              $("#damg_qty").val('');
              $("#damg_aqty").val('');
              $("#return_qty").val('');
             // return false;
            }else{
              $("#showerrsort").html('');
              $("#showerrdmg").html('');
              $("#showerrrtn").html('');
              $("#showerrrcv").html('');
              $("#sort_qty").val('');
              $("#sort_aqty").val('');
              $("#damg_qty").val('');
              $("#damg_aqty").val('');
              $("#return_qty").val('');
             // return true;
            }

          
        });



        $("#sort_qty").on('input',function(){

            var sortQty = $("#sort_qty").val();

            var cFactor = $("#sortcfactor").val();

            var result = sortQty*cFactor;

            if(sortQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#sort_qty").val('0');

               $("#sort_aqty").val('');

            }else{

               $("#sort_aqty").val(result);

            }

        });

        $("#damg_qty").on('input',function(){

            var stoQty = $("#damg_qty").val();

            var cFactor = $("#damagecfactor").val();
            var result = stoQty*cFactor;

            if(stoQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#damg_qty").val('0');

               $("#damg_aqty").val('');



            }else{

               $("#damg_aqty").val(result);

            }

        });


        $('#sto_qtyaum').on('input',function(){

            var stoQtyAum = $('#sto_qtyaum').val();
            var stoCfactor = $('#cfactor').val();

            result = stoQtyAum / stoCfactor;

            $('#sto_qtyum').val(result.toFixed(2));

        });

        /*$('#recd_aqty').on('input',function(){

            var recdAum = $('#recd_aqty').val();
            var recivdcfactor = $('#recivdcfactor').val();

            var recdUmresult = recdAum/recivdcfactor;
            $('#recd_qty').val(recdUmresult.toFixed(2));
        });*/

         $('#recd_aqty').on('change',function(){

            

            var recdAum = $('#recd_aqty').val();
            var recivdcfactor = $('#recivdcfactor').val();

            var recdUmresult = recdAum/recivdcfactor;
            $('#recd_qty').val(recdUmresult.toFixed(2));

            var stoqtyUm = parseFloat($('#sto_qtyum').val());
            var recdqtyUm = $('#recd_qty').val();
            

            if(recdqtyUm > stoqtyUm){
              //alert('Please Enter Recived Quantity less Than STO Quantity');
              $("#showerrrcv").html('Please Enter Recived Quantity less Than Sto Qty');
              $('#recd_qty').val('');
              $('#recd_aqty').val('');
              $('#sort_qty').val('');
              $('#sort_aqty').val('');
              $('#damg_qty').val('');
              $('#damg_aqty').val('');
              $('#return_qty').val('');
              return false;
            }else if(recdqtyUm < stoqtyUm){
              $("#showerrsort").html('Please Enter Sort Qty');
              $("#showerrdmg").html('Please Enter Damage Qty');
              $("#showerrrtn").html('Please Enter Return Qty');
              $("#showerrrcv").html('');
              $('#sort_qty').val('');
              $('#sort_aqty').val('');
              $('#damg_qty').val('');
              $('#damg_aqty').val('');
              $('#return_qty').val('');
              return false;
            }else{
              $("#showerrsort").html('');
              $("#showerrdmg").html('');
              $("#showerrrtn").html('');
              $("#showerrrcv").html('');
              $('#sort_qty').val('');
              $('#sort_aqty').val('');
              $('#damg_qty').val('');
              $('#damg_aqty').val('');
              $('#return_qty').val('');
              return true;
            }
        });


        $('#sort_aqty').on('input',function(){
            var sortAum = $('#sort_aqty').val();
            var sortcfactor = $('#sortcfactor').val();

            var sortUmresult = sortAum/sortcfactor;
            $('#sort_qty').val(sortUmresult.toFixed(2));
        });

        /*$('#damg_aqty').on('input',function(){
            var damgAum = $('#damg_aqty').val();
            var damagecfactor = $('#damagecfactor').val();

            var damgUmresult = damgAum/damagecfactor;

          
            $('#damg_qty').val(damgUmresult.toFixed(2));
        });*/

        $('#damg_aqty').on('change',function(){
            var damgAum = $('#damg_aqty').val();
            var damagecfactor = $('#damagecfactor').val();

            var damgUmresult = damgAum/damagecfactor;

            $('#damg_qty').val(damgUmresult.toFixed(2));

            var sortqtyUM = $('#sort_qty').val();
            var damgqtyUM = $('#damg_qty').val();
            var stoqtyUm = $('#sto_qtyum').val();

            var recdqtyUm = $('#recd_qty').val();

           var addofSortDamg = parseFloat(sortqtyUM)+parseFloat(damgqtyUM);
           $('#return_qty').val(addofSortDamg.toFixed(2));

            var total = parseFloat(recdqtyUm)+parseFloat(addofSortDamg);

            if( total== stoqtyUm){
                  $("#showerrsort").html('');
                  $("#showerrdmg").html('');
                  $("#showerrrtn").html('');
                  return true;
            }else{
                alert('sto qty and rcv qty + return qty not equal');
                 $('#sort_qty').val('');
                 $('#sort_aqty').val('');
                 $('#damg_qty').val('');
                 $('#damg_aqty').val('');
                 $('#return_qty').val('');
                 return false;
            }
            

            
        });




    })



    $(document).ready(function() {

      $("#item_code").change(function(){

         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var itemcode =  $(this).val();

                  $('#UnitM').val('');

                  $('#unitAum').val('');

                  $('#cfactor').val('');

                  $('#sto_qtyum').val('');

                  $('#sto_qtyaum').val('');

                  $('#recd_qty').val('');

                  $('#recd_aqty').val('');

                  $('#sort_qty').val('');

                  $('#sort_aqty').val('');

                  $('#damg_qty').val('');

                  $('#damg_aqty').val('');

        $.ajax({

          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    // console.log(data1.data[0].um_code);

                  $('#UnitM').val(data1.data[0].um_code);

                  $('#unitAum').val(data1.data[0].aum);

                  $('#cfactor').val(data1.data[0].aum_factor);


                  $('#recivdUm').val(data1.data[0].um_code);

                  $('#recivdAum').val(data1.data[0].aum);

                  $('#recivdcfactor').val(data1.data[0].aum_factor);


                  $('#sortUm').val(data1.data[0].um_code);

                  $('#sortAum').val(data1.data[0].aum);

                  $('#sortcfactor').val(data1.data[0].aum_factor);


                  $('#damageUm').val(data1.data[0].um_code);

                  $('#damageAum').val(data1.data[0].aum);

                  $('#damagecfactor').val(data1.data[0].aum_factor);

                }
           }

        });

      });

    });

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#damg_qty').on('change',function(){
      sortqty = $('#sort_qty').val();
      damgqty = $('#damg_qty').val();
      recvqty = $('#recd_qty').val();
      stoqtyum = $('#sto_qtyum').val();

      //AddSortNDamgQty = parseInt(sortqty)+parseInt(damgqty);

      AddSortNDamgQty = parseFloat(sortqty)+parseFloat(damgqty);

      Addrecvrtn = parseFloat(recvqty)+parseFloat(AddSortNDamgQty);

      $('#return_qty').val(AddSortNDamgQty);

      if(stoqtyum == Addrecvrtn){
              $("#showerrsort").html('');
              $("#showerrdmg").html('');
              $("#showerrrtn").html('');
        return true;
      }else{
           alert('sto qty and rcv qty + return qty not equal');
           $('#sort_qty').val('');
           $('#sort_aqty').val('');
           $('#damg_qty').val('');
           $('#damg_aqty').val('');
           $('#return_qty').val('');
           return false;
      }
      
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
    });
</script>

@endsection