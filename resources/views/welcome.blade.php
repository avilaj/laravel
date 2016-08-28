@extends('layouts.app')

@section('content')
<main class="home">
  @if(isset($news) && count($news) > 0)
    <section class="home-section home-news news">
        <h3 class="home-section__title">
          <span>Novedades recientes</span>
        </h3>
        <div id="news-slider" class="owl-carousel">
          @foreach($news as $post)
            @include('news.small-box')
          @endforeach
        </div>
    </section>
  @endif

    <section class="home-section home-brands">
      @foreach($brands as $brand)
        <div class="home-brands__item">
          <a href="{{$brand->url}}">
            <img
            src="{{ $brand->image }}"
            alt="{{$brand->name}}">
          </a>
        </div>
      @endforeach
    </section>
    <section class="home-section home-products">
        <h3 class="home-section__title"><span>Productos destacados</span></h3>
        <div class="home-product-slider owl-carousel">
            @foreach ($featured_products as $product)
              @include('products.small-box')
            @endforeach
        </div>
    </section>

    <section class="home-section home-products">
        <h3 class="home-section__title"><span>Productos recientes</span></h3>
        <div class="home-product-slider owl-carousel">
            @foreach ($recent_products as $product)
              @include('products.small-box')
            @endforeach
        </div>
    </section>

    <section class="home-section home-section-newsletter-n-local">
        <div class="home-stores">
            <a href="/locales" class="home-stores__cta">Nuestros locales</a>
        </div>
        <div class="home-newsletter">
            <h3 class="home-newsletter__headline">Suscribite a nuestro newsletter</h3>
            <div class="home-newsletter__subline">Y se el primero en enterarte de todas nuestras novedades</div>
            <div class="home-newsletter__input">
              <newsletter-subscribe></newsletter-subscribe>
            </div>
        </div>
    </section>
</main>
@endsection
