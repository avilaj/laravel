<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Markshop - {{ $title or 'online store' }} </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Oswald" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.5/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.5/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tether-select/1.1.1/css/select-theme-default.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tether-drop/1.4.2/css/drop-theme-arrows.css">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.7/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

</head>
<body>
    @include("layouts.header")
    @if(isset($slideshow) && $slideshow)
      @include('partials.slideshow', ['slides' => $slideshow->slides])
    @endif
    @yield("content")
    @include("layouts.footer")
    <script src="{{ elixir('js/bundle.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether-drop/1.4.2/js/drop.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.0/owl.carousel.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.15/jquery.zoom.min.js"></script>
</body>
</html>
