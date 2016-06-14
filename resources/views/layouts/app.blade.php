<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.5/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.5/assets/owl.theme.default.min.css">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include("layouts.header")
    @yield("content")
    @include("layouts.footer")
</body>
</html>