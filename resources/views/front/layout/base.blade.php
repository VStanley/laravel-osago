<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Заголовок браузера</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="MobileOptimized" content="320">

    <link rel="stylesheet" type="text/css" href="/front/css/frontIndex.css">



    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/front/img/favico.png">

    @yield('scriptHeader')

</head>
<body>

<div data-scroll-index='0' style="width:100%;float:left;">

    <!-- header section start -->
    @include('front.layout.header')
    <!-- header section end -->

    <!-- navigation section start -->
    @include('front.layout.mainmenu')
    <!-- navigation section end -->

    <!--content section start-->
    @yield('content')
    <!--text section end-->

    <!--footer start-->
    @include('front.layout.footer')
    <!--footer end-->

</div>

<!--js start-->
<script src="/front/js/frontIndex.js" type="text/javascript"></script>

@yield('js')

</body>
</html>