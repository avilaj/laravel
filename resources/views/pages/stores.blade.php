@extends('layouts.app')
@section('content')
<div class="stores">
  <h1>Nuestros Locales</h1>
  <div class="stores__list">
    <div class="store-box">
      <div class="store-box__info">
        <h3>Palermo</h3>
        <p>
          Av. Córdoba 4814, Buenos Aires <br>
          <strong>Tel:</strong> (54 11) 4904-1085 <br>
          <strong>Email:</strong> sucpalermo@markshop.com.ar <br>
          <strong>Horario:</strong> Lun a Sáb  de 10:00 a 19:30
        </p>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-map-marker"></i></a>
      </div>
      <div class="store-box__gallery">
        <img src="/images/locales-1-a.jpg" alt="Palermo">
        <img src="/images/locales-1-b.jpg" alt="Palermo">
        <img src="/images/locales-1-c.jpg" alt="Palermo">
      </div>
    </div>

    <div class="store-box">
      <div class="store-box__info">
        <h3>Caballito</h3>
        <p>
          Av. Acoyte 86, Buenos Aires <br>
          <strong>Tel:</strong> (54 11) 4904-1085 <br>
          <strong>Email:</strong> succaballito@markshop.com.ar <br>
          <strong>Horario:</strong> Lun a Sáb  de 10:00 a 19:30
        </p>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-map-marker"></i></a>
      </div>
      <div class="store-box__gallery">
        <img src="/images/locales-2-a.jpg" alt="Palermo">
        <img src="/images/locales-2-b.jpg" alt="Palermo">
        <img src="/images/locales-2-c.jpg" alt="Palermo">
      </div>
    </div>

  </div>

  <div class="stores__map">
    <iframe src="https://www.google.com/maps/d/embed?mid=zgjTv9AqtRl4.k-bFB059Es6c" width="100%" height="400"></iframe>
  </div>

</div>

@endsection
