@extends('layouts.app')
@section('content')
<div class="mk-page-form contact-page">
  <div class="contact-page__greetings">
    <h1>Contacto</h1>
    <p>
      Envianos tu consulta por medio de nuestro formulario de contacto. <br>
      Te responderemos a la brevedad.
    </p>
  </div>
  <form class="contact-form" action="{{ route('pages.contact-save') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-item">
      <input type="text" name="name" required placeholder="Nombre *">
    </div>
    <div class="input-item">
      <input type="email" name="email" required placeholder="Email *">
    </div>
    <div class="input-item">
      <input type="text" name="phone" required placeholder="Teléfono">
    </div>
    <div class="input-item">
      <textarea name="message" rows="8" cols="40" placeholder="Mensaje *" maxlength="256" minlength="5"></textarea>
    </div>
    <button type="submit">Enviar mensaje</button>
  </form>
</div>
@endsection
