<div class="markshop-logo">
  <a href="/">
    <img src="/images/markshop.png" alt="Markshop">
  </a>
</div>
<div class="search-box">
  <form class="" action="{{route('products.list')}}" method="get">
    <input type="search" placeholder="Buscar" class="search-box__input" name="search">
    <i class="fa fa-search search-box__icon"></i>
  </form>
</div>

<header id="header">
    <nav class="topnav">

        <ul class="topnav__list topnav__followus">
            <li class="topnav__item topnav__followus__label">Seguinos en:</li>
            @if(isset($configuration->facebook_url))
              <li class="topnav__item">
                <a href="{{ $configuration->facebook_url }}"
                  class="topnav__followus__link">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
            @endif
            @if(isset($configuration->twitter_url))
              <li class="topnav__item">
                <a href="{{ $configuration->twitter_url }}"
                  class="topnav__followus__link">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
            @endif
            @if(isset($configuration->youtube_url))
              <li class="topnav__item">
                <a href="{{ $configuration->youtube_url }}"
                  class="topnav__followus__link">
                  <i class="fa fa-youtube"></i>
                </a>
              </li>
            @endif
            @if(isset($configuration->instagram_url))
              <li class="topnav__item">
                <a href="{{ $configuration->instagram_url }}"
                  class="topnav__followus__link">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
            @endif
        </ul>

        <ul class="topnav__list topnav__pages">
          <li class="topnav__item"><a class="topnav__pages__link" href="{{route('products.list')}}">Catalogo</a></li>
          <li class="topnav__item"><a class="topnav__pages__link" href="{{ route('news.list') }}">Novedades</a></li>
          <li class="topnav__item"><a class="topnav__pages__link" href="{{ route('podcast.list') }}">Radio</a></li>
          <!-- <li class="topnav__item"><a class="topnav__pages__link" href="{{ route('pages.about') }}">Nosotros</a></li> -->
          <li class="topnav__item"><a class="topnav__pages__link" href="{{ route('pages.stores') }}">Locales</a></li>
          <li class="topnav__item"><a class="topnav__pages__link" href="{{ route('pages.contact') }}">Contacto</a></li>
        </ul>

        <ul class="topnav__list topnav__account">
          <li class="topnav__item">
            <a href="{{ route('cart.index' )}}" class="topnav__account__link">
              <cart-header></cart-header>
            </a>
          </li>
            @if(Auth::check())
              <li class="topnav__item">
                <a href="/logout" class="topnav__account__link">
                  Cerrar sesión
                </a>
              </li>
            @else
              <li class="topnav__item">
                <a href="/register" class="topnav__account__link">
                  Registrarse
                </a>
              </li>
              <li class="topnav__item">
                <a href="/login" class="topnav__account__link">
                  Ingresar
                </a>
              </li>
            @endif

        </ul>
        <script type="text/javascript">
        var mkStore = mkStore || {};
        </script>
    </nav>
</header>
