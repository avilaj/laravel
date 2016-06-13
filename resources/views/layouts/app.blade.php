<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body>
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/admin') }}">Admin</a></li>
    </ul>
    @yield("content")
    @include("layouts.footer")
</body>
</html>