
@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .settitle{
    font-weight: 600;
    font-size: 17px;
  }
  sup {
    top: -0.2em;
}
.shadow-lg  { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
.Box1:hover{
    border: 1px solid #a9e1f5;
    border-radius: 5px;
}
.Box2:hover{
    border: 1px solid #a0f5ce;
    border-radius: 5px;
}

</style>



 <!-- =========== Start : demo page ============= -->



      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Dashboard



            <small style="font-weight: 600;color: #3c8dbc;">| C & F Management System</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Dashboard</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <!-- Info boxes -->

          <div class="row">
            
            <div class="col-md-4 col-sm-6 col-xs-12">
              <a href="{{ url('/sap-stock') }}">
                <div class="info-box shadow-lg Box1">

                  <span class="info-box-icon bg-aqua"><i class="fa fa-line-chart" aria-hidden="true"></i></span>

                  <div class="info-box-content">

                    <span class="info-box-text settitle">SAP Stock</span>

                    <span class="info-box-number">90<sup>%</sup></span>

                  </div><!-- /.info-box-content -->

                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->

          


            <!-- fix for small devices only -->

            <div class="clearfix visible-sm-block"></div>



            <div class="col-md-4 col-sm-6 col-xs-12">
              <a href="{{ url('/actual-stock') }}">
                <div class="info-box shadow-lg Box2">

                  <span class="info-box-icon bg-green"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>

                  <div class="info-box-content">

                    <span class="info-box-text settitle">Actual Stock</span>

                    <span class="info-box-number">76<sup>%</sup></span>
                   

                  </div><!-- /.info-box-content -->

                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->

          </div><!-- /.row -->

    	</section><!-- /.content -->
      <div>
       
      </div>
    </div><!-- /.row -->




 <!-- =========== End : demo page ============= -->

@include('admin.include.footer')


@endsection