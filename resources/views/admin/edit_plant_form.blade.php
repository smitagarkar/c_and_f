@extends('admin.main')







@section('AdminMainContent')







@include('admin.include.header')



<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.navbar')







@include('admin.include.sidebar')





<style type="text/css">





.stepwizard-step p {

    margin-top: 10px;

}



.stepwizard-row {

    display: table-row;

}



.stepwizard {

    display: table;

    width: 100%;

    position: relative;

}



.stepwizard-step button[disabled] {

    opacity: 1 !important;

    filter: alpha(opacity=100) !important;

}



.stepwizard-row:before {

    top: 14px;

    bottom: 0;

    position: absolute;

    content: " ";

    width: 100%;

    height: 1px;

    background-color: #ccc;

    z-order: 0;



}



.stepwizard-step {

    display: table-cell;

    text-align: center;

    position: relative;

}



.btn-circle {

  width: 30px;

  height: 30px;

  text-align: center;

  padding: 6px 0;

  font-size: 12px;

  line-height: 1.428571429;

  border-radius: 15px;

}

/*.hidebtn{

  display: none;

}*/



</style>



<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Plant



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Master Tran Tax  </a></li>



            <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Update Tran Tax </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-10">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Plant</h2>



            </div><!-- /.box-header -->

            <div>

                <a href="{{ url('/finance/view-mast-plant') }}" class="btn btn-primary pull-right" style="margin-right: 2%"><i class="fa fa-plus"></i>&nbsp;&nbsp;View Plant</a>

            </div>



            <div class="box-body">





              <div class="stepwizard">

                  <div class="stepwizard-row setup-panel">

                      <div class="stepwizard-step">

                          <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>

                          <p>Basic Details</p>

                      </div>

                      <div class="stepwizard-step hidebtn showbtn">

                          <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>

                          <p>Amount Field</p>

                      </div>

                      <div class="stepwizard-step hidebtn showbtn">

                          <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>

                          <p>Non Accounting Field</p>

                      </div>

                  </div>

              </div>

             <form id="submitdata">

                  <div class="row setup-content" id="step-1">

                      <div class="col-xs-12">

                          <div class="col-md-12">

                              <h5 style="text-align: center;"><span id="showmsg" style="color: green"></span></h5>

                              <div class="row">



                

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Plant Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control Number" name="plant_code" id="plant_code" value="{{ $plant_data->plant_code }}" placeholder="Enter Plant Code">



                      </div>

                      <small id="plantc_err" style="color: red;"></small>

                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Plant Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          

                          <input type="text" class="form-control" name="plant_name" id="plant_name" value="{{ $plant_data->plant_name }}" placeholder="Enter Plant Name">



                      </div>

                        <small id="plantn_err" style="color: red;"></small>

                     

                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>



                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Company Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>





                            

                          <select name="comp_code" id="comp_code" class="form-control">

                            <option value=''>--SELECT--</option>

                           @foreach($comp_list as $row)



                            <option value='{{ $row->comp_code }}'<?php if($plant_data->company_code==$row->comp_code) { echo 'selected'; } else { echo '';}?>>{{ $row->comp_code }} = {{ $row->comp_name }} </option>



                           @endforeach

                          </select>



                        </div>

                          <small id="comp_err" style="color: red;"></small>

                         







                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Profit Center Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                        

                          <select class="form-control" name="profit_code" id="profit_code">

                            <option value="">--SELECT--</option>

                            <option value="{{ $plant_data->pfct_code}}" <?php if(!empty($plant_data->pfct_code)) { echo 'selected'; } ?>>{{ $plant_data->pfct_code}}</option>

                          </select>



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Address : 



                      </label>



                      <div class="input-group">



                         



                          <input type="text" class="form-control" name="address1" id="address1" value="{{ $plant_data->address1 }}" placeholder="Address 1">



                          <input type="text" class="form-control" name="address2" id="address2" value="{{ $plant_data->address2 }}" placeholder="Address 2" style="margin-top: 2%;">



                          <input type="text" class="form-control" name="address3" id="address3" value="{{ $plant_data->address3 }}" placeholder="Address 3" style="margin-top: 2%;">



                      </div>



                      



                    </div>



                    



                    <!-- /.form-group -->



                  </div>

                 

                 

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Phone No 1: 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control Number" name="phone1"  id="phone1" value="{{ $plant_data->phone1 }}" placeholder="Phone No 1" maxlength="10">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Phone No 2:



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control Number" id="phone2" name="phone2" value="{{ $plant_data->phone2 }}" placeholder="Enter Phone No 2" maxlength="10">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>



                <div class="row">

                 



                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Fax: 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="fax" id="fax" value="{{ $plant_data->fax }}" placeholder="Enter Fax">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Email-id: 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="email" class="form-control" name="email_id" id="email_id" value="{{ $plant_data->email }}" placeholder="Enter Email-id">



                      </div>



                      



                      <small id="email_err" style="color: red;"></small>

                    </div>

                    <!-- /.form-group -->



                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Country : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="country" id="country" value="{{ $plant_data->country }}" placeholder="Enter Country">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       State : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="state" value="" placeholder="Enter State">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                

                <!-- /.col -->



              </div>



              <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       District : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="district" id="district" value="{{ $plant_data->district }}" placeholder="Enter District">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       City : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="city" id="city" value="{{ $plant_data->city }}" placeholder="Enter City">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                

                <!-- /.col -->



              </div>

              <div class="row">

                <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Pincode : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control Number" name="pincode" value="{{ $plant_data->pin }}" placeholder="Enter Pincode" maxlength="8">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

              </div>

                              

                  

               <input type="hidden" name="updateid1" id="updateid1" value="{{ $plant_data->id }}">                

              <button class="btn btn-primary  pull-right" type="button" id="submitBtn">Update</button>

                          </div>

                      </div>

              </div>



            </form>



            <form id="submitdata2">

                  <div class="row setup-content" id="step-2">

                      <div class="col-xs-12">

                          <div class="col-md-12">

                              <h5 style="text-align: center;"> <span id="showmsg1" style="color: green;"></span></h5>

                              <div class="row">



                

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        TAN No. :



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="tan_no" id="tan_no" value="{{ $plant_data->tan_no }}" placeholder="Enter TAN No">



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



                       TIN No. : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tin_no"  id="tin_no" value="{{ $plant_data->tin_no }}" placeholder="Enter TIN No">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>



                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Sale Tax No: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="tetx" name="sale_tax_no" id="sale_tax_no" class="form-control" value="{{ $plant_data->sales_taxno }}" placeholder="Enter Sale Tax No">



                        </div>



                          





                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        CSale Tax No : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                        

                         <input type="text" name="csale_tax_no" id="csale_tax_no" class="form-control" value="{{ $plant_data->csales_taxno }}" placeholder="Enter CSale Tax No">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

                

                <div class="row">

                 



                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                     Service Tax No. : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="service_tax_no"  id="service_tax_no" value="{{ $plant_data->service_taxno }}" placeholder="Service Tax No">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                  

                 

                </div>

                <input type="hidden" name="lastid" id="lastid" value="{{ $plant_data->id }}">

                      <button class="btn btn-primary pull-right" type="button" id="submitBtn2">Update</button>

                          </div>

                      </div>

                  </div>

                </form>

                <form id="submitdata3">

                  <div class="row setup-content" id="step-3">

                      <div class="col-xs-12">

                          <div class="col-md-12">

                            <h5 style="text-align: center;"> <span id="showmsg2" style="color: green;"></span></h5>

                    <div class="row">



                

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        ECC No. : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="ecc_no"  id="ecc_no" value="{{ $plant_data->ecc_no }}" placeholder="Enter ECC No">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Range No : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="range_no" id="range_no" value="{{ $plant_data->range_no }}" placeholder="Enter Range No">



                      </div>



                     



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>



                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Range Name: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" name="range_name" id=

                          "range_name" value="{{ $plant_data->range_name }}" class="form-control" placeholder="Enter Range Name">



                        </div>



                          







                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Range Address1 : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                         <input type="text" name="range_addres1" id=

                          "range_addres1" value="{{ $plant_data->range_add1 }}" class="form-control" placeholder="Enter Range Address1">

                          



                      </div>



                  



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

                



                <div class="row">

                 



                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Range Address2: 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="range_addres2"  id="range_addres2" value="{{ $plant_data->range_add2 }}" placeholder="Range Address2">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Division: 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="division" id="division" value="{{ $plant_data->division }}" placeholder="Enter Division">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Collector : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          

                          <input type="text" class="form-control" name="collector" id="collector" value="{{ $plant_data->collector }}" placeholder="Enter Rfhead 5">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>



                 

                

                <!-- /.col -->



              </div>

              <div style="text-align: center;">

                  <input type="hidden" name="lastid1" id="lastid1" value="{{ $plant_data->id }}">

                   <button type="button" class="btn btn-primary" id="submitBtn3">



                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Update





                   </button>



                </div>

                          </div>

                      </div>

                  </div>

                



              </form> 



          </div>



      </div>



</div>



<div class="col-sm-1"></div>





    </div>



     



  </section>



</div>



@include('admin.include.footer')



<script type="text/javascript">

$(document).ready(function(){

   $("#submitBtn").click(function(event) {



    var plant_code = $("#plant_code").val();

    var plant_name = $("#plant_name").val();

    var comp_code  =  $("#comp_code").val();

    var email_id   =  $("#email_id").val();

    var filter = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;

     

    if(plant_code=='' && plant_name=='' && comp_code=='' && email_id==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      $("#comp_err").html('The comp code field is required.');

      $("#email_err").html('The email field is required.');

      return false;

    }

    if(plant_code=='' && plant_name=='' && comp_code==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      $("#comp_err").html('The comp code field is required.');

      return false;

    }

    if(plant_code=='' && plant_name==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      return false;

    }

    if(comp_code=='' && email_id==''){

       $("#comp_err").html('The comp code field is required.');

      $("#email_err").html('The email field is required.');

      return false;

    }

    if(plant_code==''){

      $("#plantc_err").html('The plant code field is required.');

      return false;

    }

    if(plant_name==''){

     $("#plantn_err").html('The plant name field is required.');

    }

    if(comp_code==''){

      $("#comp_err").html('The comp code field is required.');

      return false;

    }if(email_id==''){

        $("#email_err").html('The email field is required.');

        return false;

    }else if(!filter.test(email_id))
    {
       $("#email_err").html('The valid email field is required.');

        return false;;       
    }

    

  

   var data = $("#submitdata").serialize();



    $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



    $.ajax({

        type: 'POST',

        url: "{{ url('/finance/form-mast-plant-update') }}",

        data: data, // here $(this) refers to the ajax object not form

        success: function (data) {



             $('#showmsg').html('Plant Was Successfully updated...!');

           setTimeout(function(){ window.location.reload();},1000);

        },

    });





     /* Act on the event */

   });



});

</script>



<script type="text/javascript">

$(document).ready(function(){

   $("#submitBtn2").click(function(event) {



   var data = $("#submitdata2").serialize();



    $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



    $.ajax({

        type: 'POST',

        url: "{{ url('/finance/form-mast-plant-save2') }}",

        data: data, // here $(this) refers to the ajax object not form

        success: function (data) {

             var data1 = JSON.parse(data);

            

           /*$('.showbtn').removeClass('hidebtn');*/

           $('#showmsg1').html('Plant Was Successfully updated...!');

          setTimeout(function(){ window.location.reload();},1000);

        },

    });





     /* Act on the event */

   });



});

</script>

<script type="text/javascript">

$(document).ready(function(){

   $("#submitBtn3").click(function(event) {



   var data = $("#submitdata3").serialize();



    $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



    $.ajax({

        type: 'POST',

        url: "{{ url('/finance/form-mast-plant-save3') }}",

        data: data, // here $(this) refers to the ajax object not form

        success: function (data) {

             var data1 = JSON.parse(data);

            

           /*$('.showbtn').removeClass('hidebtn');*/

           $('#showmsg2').html('Plant Was Successfully Updated...!');

           setTimeout(function(){ window.location.reload();},1500);



          

        },

    });





     /* Act on the event */

   });



});

</script>



<script type="text/javascript">

  

      $("#comp_code" ).change(function() {



           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        

      var comp_code = $("#comp_code").val();

     // alert(comp_code);return false;





      $.ajax({

        url: "{{ url('/finance/get_pfct') }}",

        method : 'POST',

        type: 'JSON',

        data: {comp_code: comp_code},

      })

      .done(function(data) {



       // alert(data);return false;



       // var obj = $.parseJSON(data);

        console.log(data);



        $("#profit_code").html(data);



      })

    

    });



</script>

<script type="text/javascript">



    $(document).ready(function(){



        $("#trans_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#transList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("transText").innerHTML = msg; 



        });



        $("#tax_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#taxList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("taxText").innerHTML = msg; 



        });



    });

</script>



<script type="text/javascript">

$(document).ready(function () {



    var navListItems = $('div.setup-panel div a'),

            allWells = $('.setup-content'),

            allNextBtn = $('.nextBtn');



    allWells.hide();



    navListItems.click(function (e) {

        e.preventDefault();

        var $target = $($(this).attr('href')),

                $item = $(this);



        if (!$item.hasClass('disabled')) {

            navListItems.removeClass('btn-primary').addClass('btn-default');

            $item.addClass('btn-primary');

            allWells.hide();

            $target.show();

            $target.find('input:eq(0)').focus();

        }

    });



    allNextBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),

            curStepBtn = curStep.attr("id"),

            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),

            curInputs = curStep.find("input[type='text'],input[type='url']"),

            isValid = true;



        $(".form-group").removeClass("has-error");

        for(var i=0; i<curInputs.length; i++){

            if (!curInputs[i].validity.valid){

                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");

            }

        }



        if (isValid)

            nextStepWizard.removeAttr('disabled').trigger('click');

    });



    $('div.setup-panel div a.btn-primary').trigger('click');

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