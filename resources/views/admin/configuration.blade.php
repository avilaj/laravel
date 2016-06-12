<form method="POST" action="{{route('admin.settings.save')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group ">
        <label for="collection_title" class="control-label">
            Título
        </label>
        <input class="form-control" name="collection_title" id="collection_title" value="{{ $data->collection_title }}" type="text">
    </div>
    <div class="form-group ">
        <label for="home_products" class="control-label">
            Productos
        </label>
        <input class="form-control" name="home_products" id="home_products" value="{{ $data->home_products}}" type="text">
    </div>
    <div class="form-group ">
        <label for="collection_description" class="control-label">
            Descripción
        </label>
        <input class="form-control" name="collection_description" id="collection_description" value="{{$data->collection_description}}" type="text">
    </div>

    <div>
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


