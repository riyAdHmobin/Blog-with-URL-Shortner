<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<header>
    @include('layouts.partials.header')
</header>

<div class="wrapper">

    <!-- Preloader -->
{{--    @include('layouts.partials.preloader')--}}

    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer>
        @include('layouts.partials.footer')
    </footer>
</div>
</body>
</html>
