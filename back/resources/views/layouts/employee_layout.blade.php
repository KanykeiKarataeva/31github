<?php
$l = request()->segment(1, '');
$lang = url()->current();
$k = request()->getRequestUri();
$langru = "";
$langkg = "";
if($l == "ru"){
    $langru = $lang;
    $langkg = str_replace("/ru", "", $lang);
}
else if($l == ""){
    $langru = $lang.'/ru';
    $langkg = $lang;
}
else{
    $langru = url('/').'/ru'.$k;
    $langkg = $lang;
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Aruu</title>
    <link rel="apple-touch-icon" href="{{asset('employee_template/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('new_template/img/aruu%20logo1.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/vendors/css/charts/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/vendors/css/charts/chartist-plugin-tooltip.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/app.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/core/menu/menu-types/vertical-compact-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/pages/timeline.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/pages/dashboard-ico.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/app-assets/css/free.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('employee_template/assets/css/style.css')}}">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<style>


    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: relative;
        background-color: #f9f9f9;
        width: 140px;
    }

    .dropbtnru
    {
        background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
        padding-left: 25px;
        width: auto;
    }
    .dropbtnkg
    {
        background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
        padding-left: 25px;
        width: auto;
    }

    .dropbtnkg::after {
        /*background: rgba(0, 0, 0, 0) url("https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_keyboard_arrow_down_48px-16.png") no-repeat scroll center center;*/
        content: "";
        height: 16px;
        position: absolute;
        right: 0;
        top: 7px;
        width: 16px;
    }




    .dropdown-content a:first-child
    {
        background: url('http://icons.iconarchive.com/icons/custom-icon-design/flag-3/16/Russia-Flag-icon.png') no-repeat left center;
    }

    .dropdown-content a:last-child
    {
        background: url('https://icons.iconarchive.com/icons/famfamfam/flag/16/kg-icon.png') no-repeat left center;
    }

    /* Links inside the dropdown */

    /* Change color of dropdown links on hover */

    /*# sourceMappingURL=style.css.map */
</style>

<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
    <div class="navbar-wrapper">
        <div class="navbar-header d-md-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item d-md-none"><a class="navbar-brand" href="{{route('index')}}"><img class="brand-logo d-none d-md-block" src="{{asset('dist/img/logo_aruu.jpg')}}"><img class="brand-logo d-sm-block d-md-none" alt="Aruu logo sm" src="{{asset('dist/img/logo_aruu.jpg')}}"></a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v">   </i></a></li>
            </ul>
        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <div class="navbar-nav">
{{--                        <div class="dropdown">--}}
{{--                            <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                <i class="bi-globe" style="font-size: 25px; color: #5f1dea"></i>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu" style="padding:10px; right: 0; left: auto;!important;">--}}
{{--                                <li class="dropbtnru"><a href="{{ $langru }}" class="dropdown-item">Русский</a></li>--}}
{{--                                <li class="dropbtnkg"><a href="{{ $langkg }}" class="dropdown-item">Кыргызча</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi-globe" style="font-size: 25px; color: #5f1dea"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="padding: 10px">
                                <li class="dropbtnru"><a href="{{ $langru }}" class="dropdown-item">Русский</a></li>
                                <li class="dropbtnkg"><a href="{{ $langkg }}" class="dropdown-item">Кыргызча</a></li>                            </div>
                        </div>
                    </div>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item">
                        <a href="{{route('index')}}" class="nav-link">
                            <btn class="btn btn-outline-primary" style="border-color:#5f1dea; background-color:#5f1dea; color: white">@lang('lang.back_btn')</btn>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item">
                        <a href="{{route('user.logout')}}" class="nav-link">
                            <btn class="btn btn-outline-primary" style="border-color:#5f1dea; background-color:#5f1dea; color: white">@lang('lang.log_out')</btn>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="app-content content">
    @yield('content')
</div>

<div class="main-menu menu-fixed menu-dark">
    <div class="main-menu-content"><a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="{{route('index')}}"><img class="brand-logo" style="border-radius: 10px;" alt="Aruu logo" src="{{asset('dist/img/logo_aruu.jpg')}}"/></a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href="{{route('employee', auth()->user()->id)}}"><i class="icon-grid"></i><span class="menu-title" data-i18n="">@lang('lang.emp_main')</span></a>

            </li>
            <li class=" nav-item "><a href="{{route('employee.group.index')}}"><i class="cil-group"></i><span class="menu-title" data-i18n="">@lang('lang.emp_group')</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('employee.payment.index')}}"><i class="icon-wallet"></i><span class="menu-title" data-i18n="">@lang('lang.emp_payment')</span></a>

            </li>
            <li class=" nav-item"><a href="{{route('employee.attendance.index')}}"><i class="icon-user-following"></i><span class="menu-title" data-i18n="">@lang('lang.emp_attendance')</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('employee.gallery.index')}}"><i class="fas fa-photo-video"></i><span class="menu-title" data-i18n="">Галерея</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="icon-user"></i><span class="menu-title" data-i18n="">Аккаунт</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('employee.profile', auth()->user()->id)}}">@lang('lang.user_profile')</a>
                    </li>
                    <li><a class="menu-item" href="{{route('user.logout')}}">@lang('lang.log_out')</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('employee_template/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('employee_template/app-assets/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('employee_template/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('employee_template/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('employee_template/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('employee_template/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('employee_template/app-assets/js/scripts/pages/dashboard-ico.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
</body>
</html>

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>kindergarten</title>--}}
{{--    <!-- Google Font: Source Sans Pro -->--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
{{--    <!-- Font Awesome -->--}}
{{--    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">--}}
{{--    <!-- Ionicons -->--}}
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
{{--    <!-- Theme style -->--}}
{{--    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">--}}

{{--    <link rel="stylesheet" href="{{asset('table/jquery.dataTables.min.css')}}">--}}
{{--    <script type="text/javascript" language="javascript" src="{{asset('table/jquery-3.5.1.js')}}"></script>--}}

{{--    <script type="text/javascript" language="javascript" src="{{asset('table/jquery.dataTables.min.js')}}" defer></script>--}}

{{--    <script type="text/javascript" class="init">--}}
{{--        $(document).ready(function () {--}}
{{--            $('#example').DataTable();--}}
{{--        });--}}
{{--    </script>--}}
{{--</head>--}}
{{--<body class="hold-transition sidebar-mini layout-fixed">--}}
{{--<div class="wrapper">--}}

{{--    <!-- Preloader -->--}}
{{--    <!-- <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--      <img class="animation__shake" src="front/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div> -->--}}

{{--    <!-- Navbar -->--}}
{{--    <nav class="main-header navbar navbar-expand navbar-white navbar-light">--}}
{{--        <!-- Left navbar links -->--}}
{{--        <ul class="navbar-nav">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>--}}
{{--            </li>--}}
{{--        </ul>--}}

{{--        <!-- Right navbar links -->--}}
{{--        <ul class="navbar-nav ml-auto">--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('index')}}" class="nav-link">--}}
{{--                    <btn class="btn btn-outline-primary" style="border-color:#5f1dea; background-color:#5f1dea; color: white">Back</btn>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('user.logout')}}" class="nav-link">--}}
{{--                    <btn class="btn btn-outline-primary" style="border-color:#5f1dea; background-color:#5f1dea; color: white">Sign out</btn>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--    <!-- /.navbar -->--}}

{{--    <!-- Main Sidebar Container -->--}}
{{--    <aside class="main-sidebar sidebar-dark-primary elevation-4">--}}
{{--        <!-- Brand Logo -->--}}
{{--        <a href="{{route('admin')}}" class="brand-link">--}}
{{--            <img src="{{asset('dist/img/logo_aruu.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
{{--            <span class="brand-text font-weight-light">ARUU</span>--}}
{{--        </a>--}}

{{--        <!-- Sidebar -->--}}
{{--        <div class="sidebar">--}}
{{--            <!-- Sidebar user panel (optional) -->--}}
{{--            <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--                <div class="info text-center">--}}
{{--                    <a href="{{route('admin.profile', auth()->user()->id)}}" class="d-block">{{auth()->user()->name}} {{auth()->user()->surname}}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Sidebar Menu -->--}}
{{--            <nav class="mt-2">--}}
{{--                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.user.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-users"></i>--}}
{{--                            <p>--}}
{{--                                Users--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.group.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-list"></i>--}}
{{--                            <p>--}}
{{--                                Groups--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.children.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-child"></i>--}}
{{--                            <p>--}}
{{--                                Children--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-file"></i>--}}
{{--                            <p>--}}
{{--                                Resumes--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.resume.index')}}" class="nav-link">--}}
{{--                                    <i class="far nav-icon"></i>--}}
{{--                                    <p>Employee Resumes</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.resume.question.index')}}" class="nav-link">--}}
{{--                                    <i class="far nav-icon"></i>--}}
{{--                                    <p>Questions</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.enroll.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-tasks"></i>--}}
{{--                            <p>--}}
{{--                                Queue--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.payment.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-money-check-alt"></i>--}}
{{--                            <p>--}}
{{--                                Payment--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.mainGallery.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-photo-video"></i>--}}
{{--                            <p>--}}
{{--                                Main gallery--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.attendance.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon far fa-check-square"></i>--}}
{{--                            <p>--}}
{{--                                Attendance--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </aside>--}}
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--    </aside>--}}
{{--    <!-- /.control-sidebar -->--}}
{{--</div>--}}
{{--<!-- ./wrapper -->--}}
{{--@yield('content')--}}
{{--<!-- jQuery -->--}}
{{--<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>--}}
{{--<!-- Bootstrap 4 -->--}}
{{--<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{asset('dist/js/adminlte.js')}}"></script>--}}
{{--</body>--}}
{{--</html>--}}
