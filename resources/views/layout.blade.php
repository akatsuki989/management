<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta neme="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>
    <br>
    <div class="container">
    @yield('content')
    </div>
</body>
</html>