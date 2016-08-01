<div class="markshop-logo">
  <a href="/">
    <img src="/images/markshop.png" alt="Markshop">
  </a>
</div>
<header id="header">
    <nav class="topnav">

        <ul class="topnav__list topnav__followus">
            <li class="topnav__item topnav__followus__label">Seguinos en:</li>
            <li class="topnav__item"><a href="#" class="topnav__followus__link"><i class="fa fa-facebook"></i></a></li>
            <li class="topnav__item"><a href="#" class="topnav__followus__link"><i class="fa fa-twitter"></i></a></li>
            <li class="topnav__item"><a href="#" class="topnav__followus__link"><i class="fa fa-instagram"></i></a></li>
            <li class="topnav__item"><a href="#" class="topnav__followus__link"><i class="fa fa-youtube"></i></a></li>
        </ul>

        <ul class="topnav__list topnav__pages">
            <li class="topnav__item"><a class="topnav__pages__link" href="/novedades">Novedades</a></li>
            <li class="topnav__item"><a class="topnav__pages__link" href="/nosotros">Nosotros</a></li>
            <li class="topnav__item"><a class="topnav__pages__link" href="/catalogo">Catalogo</a></li>
            <li class="topnav__item"><a class="topnav__pages__link" href="/radio">Radio</a></li>
            <li class="topnav__item"><a class="topnav__pages__link" href="/locales">Locales</a></li>
            <li class="topnav__item"><a class="topnav__pages__link" href="/contacto">Contacto</a></li>
        </ul>

        <ul class="topnav__list topnav__account">
            <li class="topnav__item"><a href="/registrarse" class="topnav__account__link">Registrarse</a></li>
            <li class="topnav__item"><a href="/login" class="topnav__account__link">Ingresar</a></li>
            <li class="topnav__item"><a href="/check-out" class="topnav__account__link">Mi carrito <cart-total class="cart-product-count"></cart-total> <i class="fa fa-shopping-cart"></i></a></li>
        </ul>
        <script type="text/javascript">
        var mkStore = mkStore || {};
          mkStore.productCount = {{Cart::count()}};
        </script>
    </nav>
</header>
