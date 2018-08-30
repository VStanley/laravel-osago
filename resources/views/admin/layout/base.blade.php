<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заголовок браузера</title>

    <link href="/admin/css/adminIndex.css" rel="stylesheet">

    @yield('style')

</head>
<body>

<div id="wrapper">

    <!-- BEGIN SIDEBAR -->
    @include('admin.layout.sidebar')
    <!-- END SIDEBAR -->

    <div id="page-wrapper" class="gray-bg">

        <!-- BEGIN HEADER -->
        @include('admin.layout.header')
        <!-- END HEADER -->

        <div style="clear: both; height: 61px;"></div>

        <!-- BEGIN CONTENT -->
        @yield('content')
        <!-- END CONTENT -->

        <!-- BEGIN FOOTER -->
        @include('admin.layout.footer')
        <!-- END FOOTER -->

    </div>

</div>

<script src="/admin/js/adminIndex.js"></script>

@yield('js')

</body>
</html>