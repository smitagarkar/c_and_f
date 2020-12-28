<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | {{ $title ?? 'title' }}</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}">



    <!-- DataTables -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/datatables/dataTables.bootstrap.css') }}">



    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- jvectormap -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/AdminLTE.min.css') }}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/skins/_all-skins.min.css') }}">



    <!-- Select2 -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/select2/select2.min.css') }}">



    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/animate.css') }}">



    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

   

  </head>
<style>
    .Custom-Box {
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
    }
    @media (max-width: 767px){
        .main-sidebar, .left-side {
            padding-top: 47px !important;
        }
    }
</style>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">