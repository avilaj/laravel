<form method="POST" action="{{route('admin.settings.save')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group ">
    <label for="collection_title" class="control-label">
      Título
    </label>
    <input class="form-control"
      name="collection_title"
      id="collection_title"
      value="{{ $data->collection_title }}"
      type="text">
  </div>
  <div class="form-group ">
     <label for="home_products[]" class="control-label">
       Productos <span class="text-danger">*</span>
     </label>
     <select id="home_products[]"
     class="form-control input-select"
     multiple="multiple" name="home_products[]">
     @foreach($products as $id => $label)
      <option value="{{$id}}" {{ is_array($data->home_products) && in_array($id, $data->home_products) ? 'selected' : '' }} >
        {{$label}}
      </option>
     @endforeach
   </select>
  </div>
  <div class="form-group ">
    <label for="collection_description" class="control-label">
      Descripción
    </label>
    <input class="form-control"
      name="collection_description"
      id="collection_description"
      value="{{$data->collection_description}}"
      type="text">
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Redes sociales</h3>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="facebook_url" class="control-label">
          Facebook
        </label>
        <input class="form-control"
        name="facebook_url"
        id="facebook_url"
        value="{{$data->facebook_url}}"
        type="text">
      </div>
      <div class="form-group">
        <label for="youtube_url" class="control-label">
          Youtube
        </label>
        <input class="form-control"
        name="youtube_url"
        id="youtube_url"
        value="{{$data->youtube_url}}"
        type="text">
      </div>
      <div class="form-group">
        <label for="instagram_url" class="control-label">
          Instagram
        </label>
        <input class="form-control"
        name="instagram_url"
        id="instagram_url"
        value="{{ $data->instagram_url }}"
        type="text">
      </div>
      <div class="form-group">
        <label for="twitter_url" class="control-label">
          Twitter
        </label>
        <input class="form-control"
        name="twitter_url"
        id="twitter_url"
        value="{{ $data->twitter_url }}"
        type="text">
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Datos de Contacto</h3>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="contact_email" class="control-label">
          Direción de email
        </label>
        <input class="form-control"
          name="contact_email"
          id="contact_email"
          value="{{ $data->contact_email }}"
          type="text">
      </div>
      <div class="form-group">
        <label for="contact_phone" class="control-label">
          Teléfono
        </label>
        <input class="form-control"
          name="contact_phone"
          id="contact_phone"
          value="{{ $data->contact_phone }}"
          type="text">
      </div>
    </div>
  </div>
  <div class="form-actions">
    <div class="btn-group">
      <button type="submit" name="next_action" value="save_and_close" class="btn btn-primary btn-flat">
        <i class="fa fa-check"></i> Guardar
      </button>
    </div>
    <a href="http://homestead.app/admin/configurations" class="btn btn-link">
        <i class="fa fa-ban"></i> Cancel
    </a>
  </div>
</form>
