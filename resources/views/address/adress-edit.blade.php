<form class="address-editor" action="{{ route( 'user.address.save' ) }}" method="post">
  <select name="name">
    <option value="Casa">Casa</option>
    <option value="Trabajo">Trabajo</option>
    <option value="otro">Otro</option>
  </select>
  <input type="text" name="address" value="{{ $address or '' }}">
  <input type="text" name="postal" value="{{ $postal or '' }}">
  <button type="submit">Guardar</button>
</form>
