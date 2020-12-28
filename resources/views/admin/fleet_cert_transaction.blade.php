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



  .defualtSearchNew{



    display: none;



  }



  .showSeletedName {



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



 }



  .alignLeftClass{

    text-align: left;

  }

  .alignRightClass{

    text-align: right;

  }

  .alignCenterClass{

    text-align: center;

  }

  .showmsg{

    display: none;

  }





</style>



<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



        Fleet Certificate Transaction



            <small> Search Certificate</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>


            <li><a href="{{ url('/logistic/fleet-certificate-transaction') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/logistic/fleet-certificate-transaction') }}"> Fleet Certificate Transaction</a></li>



          </ol>



        </section>

  <section class="content" style="margin-bottom: -9%;">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Fleet Certificate Transaction</h2>
              <div class="box-tools pull-right">
                  <a href="{{ url('/logistic/fleet-certificate-transaction-form')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Certificate</a>
               </div>



              <!-- <div class="box-tools pull-right">



                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>



              </div> -->

            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">
             @csrf

              <div class="row">


                
                 <div class="col-md-2"></div>
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>

                           <input id="vehicle_no" name="vehicle_no" class="form-control"  placeholder="Enter Vehicle No" >
                          

                      </div>



                        <small>  
                        
                        <div class="pull-left showSeletedName" id="accountText"></div>
                        
                        </small>

                     <small id="show_err_acct_code">

                     </small>

                  </div>



                </div><!-- /.col -->

               <div class="col-md-4" style="margin-top: 3.5%;">
              <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>
              <div class="col-md-2"></div>
              </div>

             </form>

            </div><!-- /.box-body -->

  @if(Session::has('alert-success'))



<div class="alert alert-success alert-dismissible showmsg" style="width: 96%;margin-left: 2%;">

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



<!-- <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success'>submit</button> 
 -->


  </div><!-- /.box-body -->
 </div>



  </section>
<div id="certData"></div>


</div>

@include('admin.include.footer')

<script type="text/javascript">
  
  $(document).ready(function() {
    
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

        $("#btnsearch").on('click', function () {

           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

          var url = "{{ url('/logistic/fleet-certificate-transaction-form-view') }}";
          var vehicle_no = $("#vehicle_no").val();
          var dataString = "vehicle_no="+vehicle_no;

        $.ajax({

           url:url,

           method : "GET",

           type: "JSON",

           data: dataString,

           success:function(returndata){

           
             
              $("#certData").html(returndata);
                
           }

        });

         /* $.post(url,dataString,function(returndata)
          {
            console.log(returndata);
              $("#moreAddress").show();
              
          });*/

        });

        $("#ResetId").on('click', function () {  

             $(".boxclass").addClass('showmsg')
             $("#vehicle_no").val('');

        });

    });


 </script>



@endsection