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
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lib/admin-lte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/admin-lte/css/skins/skin-blue.min.css')}}">
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
    <script src="{{asset('lib/admin-lte/js/adminlte.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div>
    <!-- Header -->
    <header class="main-header">
        @include('admin.layouts.header')
    </header>
    <!-- Sidebar -->
    <aside class="main-sidebar">
        @include('admin.layouts.sidebar')
    </aside>
</div>
</body>
</html>