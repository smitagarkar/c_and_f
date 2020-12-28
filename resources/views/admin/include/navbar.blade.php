

<style type="text/css">

  .signOutBox {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

    border: 1px solid #d2cfcf;

    border-radius: 5px;

}

 .fyText{
    font-size: 18px;;
    font-weight: 800;
    color: white;
}
  .firstyear{
    line-height: 1px;
    margin-top: 13px;
  }
  .seperator{
    line-height: 1px;
  }
  .secondyear{
    line-height: 1px;
    margin-top: 14px;
  }
  .compName{
    text-align: center;
    list-style-type: none;
    margin-bottom: -56px;
    margin-top: 12px;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
  }
@media only screen and (max-width: 600px) {

  .demo{
    width: 10px;
  }

  .btn.btn-flat {
      border-radius: 0;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      border-width: 1px;
  }

  .btnPrimary {
      background-color: #3c8dbc !important;
      border-color: #367fa9 !important;
  }
  .fyText{
    padding-right: 85px;
    padding-top: 6%;
    font-size: 15px;
    font-weight: 800;
    color: white;
  }
  .compName{
    text-align: center;
    list-style-type: none;
    margin-bottom: -56px;
    margin-top: 12px;
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    padding-right: 10%;
  }

}


</style>



<header class="main-header">

    <div  style="position: fixed;">

        <!-- Logo -->

        <a href="{{ url('/dashboard') }}" class="logo ">
          
          <!-- mini logo for sidebar mini 50x50 pixels -->

          <?php 




            $macyaer = Session::get('macc_year');

            if(isset($macyaer)){

              $explode = explode('-',$macyaer);

              $fYear = $explode[0];
              $sYear = $explode[1];

            }else{
              $c_name = 'AceWorth';
            }

          ?>

          <?php
            $FnYear = '';
            $SnYear = '';
            if(isset($fYear) && isset($sYear)){
              $FnYear = $fYear; 
              $SnYear = $sYear;
            }else{

              $FnYear = '0000'; 
              $SnYear = '0000';
            }

           ?>
            
          <span class="logo-mini bounceInDown animated"> <p class="firstyear">{{$FnYear}}</p> <p class="seperator"> - </p> <p class="secondyear">{{$SnYear}}</p></span>

          <!-- logo for regular state and mobile devices -->
         

          <span class="logo-lg bounceInDown animated" style="font-size: 18px;font-weight: 600;">  
                 FY - {{Session::get('macc_year')}}</span>


            

        </a>
    </div>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-fixed-top navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

          </a>

          <ul class="compName">
            <li> {{strtoupper(Session::get('company_name'))}} </li>
          </ul>
      

          <!-- Navbar Right Menu -->

          <div class="navbar-custom-menu bounceInDown animated">

            <ul class="nav navbar-nav">

              
              

              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="{{ URL::asset('public/dist/img/admin_img.jpg') }}" class="user-image" alt="User Image">

                  <span class="hidden-xs">{{strtoupper(Session::get('username'))}}</span>

                </a>

                <ul class="dropdown-menu signOutBox fadeInDown animated" style="padding-right: 1%;">

                  <!-- User image -->

                  <li class="user-header">

                    <img src="{{ URL::asset('public/dist/img/admin_img.jpg') }}" class="img-circle" alt="User Image">

                    <p>

                      {{strtoupper(Session::get('username'))}} - {{strtoupper(Session::get('usertype'))}}

                     

                    </p>

                  </li>

                  <!-- Menu Body -->

                 

                  <!-- Menu Footer-->

                  <li class="user-footer">
                   

                    <div class="pull-left">
                      <a href="#" class="btn btn-primary btn-flat btnPrimary" data-toggle="modal" data-target="#exampleModal">Profile</a>
                    </div>

                    <div class="pull-right">

                      <a href="{{ url('logout') }}" class="btn btn-primary btn-flat btnPrimary">Sign out</a>

                    </div>

                  </li>

                </ul>

              </li>

              <!-- Control Sidebar Toggle Button -->

              

            </ul>

          </div>



        </nav>


      </header>

       

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h4 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Profile Details</h4>
      </div>
      <div class="modal-body">
       <div class="box box-primary Custom-Box">

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

            <form action="{{ url('form-mast-user-save') }}" method="POST" >

               @csrf

               <div class="row">

                <div class="col-md-6">

                  <div class="form-group">



                      <label>

                       Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="name" value="{{ Session::get('name') }}" placeholder="Enter  Name" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                </div>

                  <div class="col-md-6">



                    

                    <div class="form-group">

                      <label>

                        User Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="user_name" value="{{ Session::get('username') }}" placeholder="Enter User Name" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        User Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="user_code" placeholder="Enter User Code" value="{{ Session::get('usercode') }}" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div> 

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Email-Id : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="email_id" value="{{ Session::get('email_id') }}" placeholder="Enter User Email Id" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                   

              </div>



              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Password : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="password" class="form-control" name="password" placeholder="Enter Password" value="{{ Session::get('password') }}" readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('password', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Type : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                         <input type="text" name="" class="form-control" value="{{ Session::get('user_type') }}" readonly="">

                          

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                 

                </div>

                

              </div>

             


              <div style="text-align: center;">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>
      
    </div>
  </div>
</div>
