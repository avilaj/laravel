@extends('layouts.app')

@section('content')
<main class="home">
    <section class="home-section home-news news">
        <h3 class="home-section__title"><span>Novedades recientes</span></h3>
        <div id="news-slider" class="owl-carousel">
            <div class="news__box item">
                <a href="#">
                    <div class="news__box__picture"><img src="http://placehold.it/330x190" alt=""></div>
                    <div class="news__box__title">Tony Alba en Buenos Aires</div>
                    <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
                </a>
            </div>
            <div class="news__box item">
                <div class="news__box__picture"><img src="http://placehold.it/330x190" alt=""></div>
                <div class="news__box__title">Tony Alba en Buenos Aires</div>
                <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
            </div>
            <div class="news__box item">
                <div class="news__box__picture"><img src="http://placehold.it/330x190" alt=""></div>
                <div class="news__box__title">Tony Alba en Buenos Aires</div>
                <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
            </div>
            <div class="news__box item">
                <div class="news__box__picture"><img src="http://placehold.it/330x190" alt=""></div>
                <div class="news__box__title">Tony Alba en Buenos Aires</div>
                <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
            </div>
            <div class="news__box item">
                <a href="#">
                    <div class="news__box__picture"><img src="http://placehold.it/330x190" alt=""></div>
                    <div class="news__box__title">Tony Alba en Buenos Aires</div>
                    <div class="news__box__subtitle">La leyenda del skate visita nuestro local.</div>
                </a>
            </div>
        </div>
    </section>
    <section class="home-section home-brands">
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
        <div class="home-brands__item"><img src="http://placehold.it/150x70/ccc/fff?text=brand" alt=""></div>
    </section>
    <section class="home-section home-products">
        <h3 class="home-section__title"><span>Productos destacados</span></h3>
        <div class="home-product-slider owl-carousel">
            @foreach ($products as $product)
                <div class="productBox item">
                    <a class="productBox__link" href="{{ $product->url }}" title="{{ $product->title }}">
                        <img class="productBox__image" src="http://placehold.it/300x370" alt="{{ $product->title }}">
                        <strong class="productBox__title">{{ $product->title }}</strong>
                        <span class="productBox__price">${{ $product->price }}.</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="home-section home-products">
        <h3 class="home-section__title"><span>Productos nuevos</span></h3>
        <div class="home-product-slider owl-carousel">
            <div class="productBox item">
                <a href="#">
                    <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                    <strong class="productBox__title">Titulo del producto</strong>
                    <span class="productBox__price">$320.</span>
                </a>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
            <div class="productBox item">
                <img class="productBox__image" src="http://placehold.it/300x370" alt="titulo de producto">
                <strong class="productBox__title">Titulo del producto</strong>
                <span class="productBox__price">$320.</span>
            </div>
        </div>
    </section>

    <section class="home-section home-section-newsletter-n-local">
        <div class="home-stores">
            <a href="/locales" class="home-stores__cta">Nuestros locales</a>
        </div>
        <div class="home-newsletter">
            <h3 class="home-newsletter__headline">Suscribite a nuestro newsletter</h3>
            <div class="home-newsletter__subline">Y se el primero en enterarte de todas nuestras novedades</div>
            <div class="home-newsletter__input"><input type="email" placeholder="Ingresa tu email"> <i class="fa fa-angle-right"></i></div>
        </div>
    </section>
</main>
@endsection
