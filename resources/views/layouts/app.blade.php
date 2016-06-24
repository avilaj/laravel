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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tether-select/1.1.1/css/select-theme-default.min.css">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.0/owl.carousel.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.15/jquery.zoom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.3.2/js/tether.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether-select/1.1.1/js/select.min.js"></script>
</head>
<body>
    @include("layouts.header")
    @yield("content")
    @include("layouts.footer")
    <script src="{{ elixir('js/all.js') }}"></script>
</body>
</html>