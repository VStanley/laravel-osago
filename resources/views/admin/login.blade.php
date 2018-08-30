<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>

    <link href="/admin/css/adminIndex.css" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="inqbox-content">
                <h2 class="font-bold text-center">WebAdvancePro</h2>
                <form class="m-t" role="form" action="/lomantine" method="post">
                    @if(session('status'))
                    <div class="row">
                        <div class="col-md-10">
                            <ul>
                                <li style="color: red">{{session('status')}}</li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" name="login" value="{{old('login')}}"
                               placeholder="Логин">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Пароль">
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::display() !!}
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        @include('admin.errors')
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Вход</button>
                </form>

                <p class="m-t">
                    <small>Создание и разработка веб-приложений &copy; 2018</small>
                </p>
            </div>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>

<script src="/admin/js/adminIndex.js"></script>

</body>
</html>