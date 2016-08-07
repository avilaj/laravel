<div class="footer-background">
<section id="footer">

    <div class="section">
      <a href="/">
        <img src="/images/markshop.png" alt="Markshop">
      </a>
    </div>

    <div class="section">
        <ul>
            <li class="section__title"><strong>Mapa del sitio</strong></li>
            <li><a href="/novedades">Novedades</a></li>
            <li><a href="/nosotros">Nosotros</a></li>
            <li><a href="/catalogo">Catalogo</a></li>
            <li><a href="/radio">Radio</a></li>
            <li><a href="/locales">Locales</a></li>
            <li><a href="/contacto">Contacto</a></li>
        </ul>
    </div>

    <div class="section">
        <ul>
            <li class="section__title"><strong>Mi cuenta</strong></li>
            <li><a href="/registrarse">Registrarse</a></li>
            <li><a href="/ingresar">Ingresar</a></li>
            <li><a href="/mi-carro">Mi Carro</a></li>
            <li><a href="/check-out">Check Out</a></li>
            <li><a href="/locales">Locales</a></li>
            <li><a href="/contacto">Contacto</a></li>
        </ul>
    </div>

    <div class="section">
        <ul>
            <li class="section__title"><strong>Servicio al cliente</strong></li>
            <li><a href="/privacidad">Privacidad</a></li>
            <li><a href="/terminos-condiciones">Términos y condiciones</a></li>
            <li><a href="/mi-carro">Mi Carro</a></li>
            <li><a href="/check-out">Check Out</a></li>
        </ul>
    </div>

    <div class="section section--contact">
        <ul>
            <li class="section__title"><strong>Seguinos en</strong></li>
            <li>
            @if(isset($configuration->facebook_url))
              <a href="{{ $configuration->facebook_url }}"
                class="topnav__followus__link">
                <i class="fa fa-facebook"></i>
              </a>
            @endif
            @if(isset($configuration->twitter_url))
              <a href="{{ $configuration->twitter_url }}"
                class="topnav__followus__link">
                <i class="fa fa-twitter"></i>
              </a>
            @endif
            @if(isset($configuration->youtube_url))
              <a href="{{ $configuration->youtube_url }}"
                class="topnav__followus__link">
                <i class="fa fa-youtube"></i>
              </a>
            @endif
            @if(isset($configuration->instagram_url))
              <a href="{{ $configuration->instagram_url }}"
                class="topnav__followus__link">
                <i class="fa fa-instagram"></i>
              </a>
            @endif
          </li>
        </ul>
        <ul>
            <li class="section__title"><strong>Contactanos</strong></li>
            @if (isset($configuration->contact_phone))
            <li>
              <i class="fa fa-phone"></i>
              {{ $configuration->contact_phone }}
            </li>
            @endif
            @if (isset($configuration->contact_email))
            <li>
              <i class="fa fa-envelope"></i>
              {{ $configuration->contact_email }}
            </li>
            @endif
        </ul>
    </div>

</section>
</div>
