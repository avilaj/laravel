@extends('layouts.app')

@section('content')
<section class="home-news news">
    <h3 class="slider__title">Novedades recientes</h3>
    <div id="news-slider" class="owl-carousel owl-theme">
        <div class="news__box item">
            <div class="news__box__picture"><img src="http://placehold.it/250x120" alt=""></div>
            <div class="news__box__title">Tony Alba en Buenos Aires</div>
            <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
        </div>
        <div class="news__box item">
            <div class="news__box__picture"><img src="http://placehold.it/250x120" alt=""></div>
            <div class="news__box__title">Tony Alba en Buenos Aires</div>
            <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
        </div>
        <div class="news__box item">
            <div class="news__box__picture"><img src="http://placehold.it/250x120" alt=""></div>
            <div class="news__box__title">Tony Alba en Buenos Aires</div>
            <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
        </div>
        <div class="news__box item">
            <div class="news__box__picture"><img src="http://placehold.it/250x120" alt=""></div>
            <div class="news__box__title">Tony Alba en Buenos Aires</div>
            <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
        </div>
    </div>
</section>

<div class="slider">
    <h3 class="slider__title">Productos destacados</h3>
    <div id="product-slider" class="slider__list owl-carousel">
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
        <div class="productBox item">
            <img class="productBox__image" src="http://placehold.it/240x300" alt="titulo de producto">
            <strong class="productBox__title">Titulo del producto</strong>
            <span class="productBox__price">$320.</span>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.5/owl.carousel.js"></script>
<script src="{{ elixir('js/all.js') }}"></script>
@endsection
