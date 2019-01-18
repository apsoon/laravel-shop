<!DOCTYPE html>
<html>
<head>
    <!-- title -->
    <title>后台管理系统</title>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lib/adminlte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/adminlte/css/skins/skin-blue.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('lib/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('lib/select2/dist/css/select2.min.css')}}">
    <!-- js -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.2.3 -->
    <script src="{{asset('lib/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('lib/adminlte/js/adminlte.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lib/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- adminlte custom -->
    <script src="{{asset('js/adminlte.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <!-- Header -->
    <header class="main-header">
        @include('admin.layouts.header')
    </header>
    <!-- Sidebar -->
    <aside class="main-sidebar">
        @include('admin.layouts.sidebar')
    </aside>
    <!-- Content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('subtitle')</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div>
    <!-- Footer -->
    <footer class="main-footer">
        @include('admin.layouts.footer')
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        {{--@include('admin.layouts.sidebar_control');--}}
    </aside>
    <!-- /.control-sidebar -->
</div>
</body>
</html>