

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

  <title></title>



  <link href="{{ URL::asset('public/dist/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

  <script src="{{ URL::asset('public/dist/css/bootstrap.min.js') }}"></script>

  <script src="{{ URL::asset('public/dist/css/jquery.min.js') }}"></script>

 <!-- Font Awesome -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/animate.css') }}">



  <!------ Include the above in your HEAD tag ---------->



    <link href="{{ URL::asset('public/dist/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

    <script src="{{ URL::asset('public/dist/css/bootstrap.min.js') }}"></script>

    <script src="{{ URL::asset('public/dist/css/jquery.min.js') }}"></script>

  <!------ Include the above in your HEAD tag ---------->



</head>

<style>

  body#LoginForm{ background-image:url("public/dist/img/cool-background.png");padding:70px;}



.form-heading { color:#fff; font-size:23px;}

.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}

.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}

.login-form .form-control {

  background: #f7f7f7 none repeat scroll 0 0;

  border: 1px solid #d4d4d4;

  border-radius: 4px;

  font-size: 14px;

  height: 50px;

  line-height: 50px;

}

.main-div {

  background: #ffffff none repeat scroll 0 0;

  border-radius: 5px;

  margin: 10px auto 30px;

  max-width: 80%;

  padding: 50px 70px 70px 71px;

}



@media only screen and (max-width: 600px) {

    .main-div {

        background: #ffffff none repeat scroll 0 0;

        border-radius: 5px;

        margin: 10px auto 30px;

        max-width: 100%;

        padding: 50px 70px 70px 71px;

      }



     

  }



.login-form .form-group {

  margin-bottom:20px;

}

.login-form{ text-align:center;}

.forgot a {

  color: #777777;

  font-size: 14px;

  text-decoration: underline;

}

.login-form  .btn.btn-primary {

  background: #f0ad4e none repeat scroll 0 0;

  border-color: #f0ad4e;

  color: #ffffff;

  font-size: 14px;

  width: 100%;

  height: 50px;

  line-height: 50px;

  padding: 0;

}

.forgot {

  text-align: left; margin-bottom:30px;

}

.botto-text {

  color: #ffffff;

  font-size: 14px;

  margin: auto;

}

.login-form .btn.btn-primary.reset {

  background: #ff9900 none repeat scroll 0 0;

}

.back { text-align: left; margin-top:10px;}

.back a {color: #444444; font-size: 13px;text-decoration: none;}

.alertClass{

  font-size: 12px;

  font-weight: 600;

  text-align: center;

  color: red;

  padding-top: 4%;

}

.alertClassNew {

    font-size: 12px;

    font-weight: 600;

    text-align: center;

    color: #60d226;

    padding-top: 4%;

}

.box-shadow{

  -webkit-box-shadow: 0px 0px 11px -1px rgba(0,0,0,0.75);

-moz-box-shadow: 0px 0px 11px -1px rgba(0,0,0,0.75);

box-shadow: 0px 0px 11px -1px rgba(0,0,0,0.75);

}

.aceworth_img{

  padding-left: 24%;padding-top: 32%;width: 131%;

}

.biztech_img{

  padding-top: 16%;padding-left: 24%;

}

.biz_Img{

   width: 133%;

  }

.address-text{

    margin-left: 32%;

    width: 101%;

    padding-top: 18%;



  }

.FadeInwin{
            opacity: 0; 
            transition: opacity 2s;
}
.setinfobox{
  margin-top: -33px;
}

@media only screen and (max-width: 600px) {

  .aceworth_img{

    padding-left: 5%;

    padding-top: 12%;

    width: 131%;

    padding-right: 36%;

  }

  .biztech_img{

    padding-top: 16%;padding-left: 13%;

  }

  .biz_Img{

    width: 81%;

  }

  .row-class{

        margin-top: -31%;

  }

  .address-text {

    margin-left: 0%;

    width: 101%;

    padding-top: 18%;

    padding-bottom: 20%;

  }

  .setinfobox{
    margin-top: 1px;
  }
  .FadeInwin{
            opacity: 0; 
            transition: opacity 2s;
}

}

</style>

<body id="LoginForm">



  <div class="container">

    <div class="row row-class">

      <div class="col-md-6 setinfobox">

        <div class="row">



          

          <div class="col-sm-6">

            <img src="{{ URL::asset('public/dist/img/logo_new.png') }}" class="aceworth_img">

            <div class="biztech_img">

              <img src="{{ URL::asset('public/dist/img/logo2_new.png') }}" class="biz_Img">

            </div>

            <div class="address-text">

              <p class="paragraph">8 Shiv Pooja Apartment, Plot No. 360, Lane - 1, Khare Town, Dharampeth, Nagpur, Maharastra - 440010</p>

              <p><b>Phone:</b> 0712 - 2543272</p>

              <p><b>Email: </b>info@aceworth.in</p>

            </div>

          </div>

         

          



          

         </div>

      </div>

      <div class="col-md-6">

         <div class="login-form animated">

       <!--  <img src="{{ URL::asset('public/dist/img/jswlogo.png') }}" style="width: 51%;margin-top: -66px;"> -->



      <div class="main-div box-shadow">

          <div class="panel">

         <h3>Login</h3>

         <p><!-- Please enter your username and password --></p>

         </div>

         

          <form action="{{ url('login') }}" accept-charset="utf-8" class="form-horizontal" id="Login" method="POST" >



            @csrf

              <div class="form-group ">
               <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" name="username" value="" class="form-control" id="inputEmail" placeholder="Enter Unername"  />                
                </div>
                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('username', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                  </div>
                  <input type="password" name="password" value="" class="form-control" id="inputPassword" placeholder="Enter Password"  />                  
                </div>
                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('password', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>



              <button type="submit" class="btn btn-primary">Login</button>



          </form>

           <hr>



          <div class="text-center">



              <small class="mr-25">



                  @if($message = Session::get('error'))







                      <div class="alert alert-danger alertMessage" role="alert">



                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">



                          <span aria-hidden="true">&times;</span>



                        </button>



                        <strong>Failed...!</strong>



                        {{ $message }}



                      </div>







                  @endif



              </small>



          </div>

      </div>

    </div>

      </div>

      

    </div>

   

  </div>

</div>


<script type="text/javascript">
 $(document).ready(function () {
  console.log('Login Page...!');
    
});
</script>
 <script type="text/javascript">
    $(document).ready(function(){
        $( window ).on( "load", function() {
            $('.FadeInwin').css("opacity","1");
        });
    });
  </script>


  </body>

</html>

