@extends('layouts.app')

@section('content')
<div class="mk-page-form login">
  <form role="form" class="panel" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email">E-Mail</label>

      <div>
        <input id="email" type="email" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
        <span>
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
      <label for="password">Contraseña</label>

      <div>
        <input id="password" type="password" name="password">

        @if ($errors->has('password'))
        <span>
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <button type="submit" class="btn btn-primary">
      <i class="fa fa-btn fa-sign-in"></i> Iniciar sesión
    </button>
    <a class="btn btn-link" href="{{ url('/password/reset') }}">Recuperar contraseña</a>

  </form>
</div>
@endsection
