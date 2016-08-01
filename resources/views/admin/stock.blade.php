<form method="POST" action="{{route('admin.add-stock', $product->id)}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="reference_id" class="control-label">
      Modelo <span class="text-danger">*</span>
    </label>
    <select id="reference_id"
    class="form-control input-select" name="reference_id">
      @foreach($references as $reference)
      <option value="{{ $reference->id }}"
        {{
           $reference->id == Request::input('reference_id') ? 'selected': ''
        }}>
        {{ $reference->color->name }}
      </option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="message" class="control-label">
      Razón
    </label>
    <input type="text" name="message" value="" class="form-control">
  </div>
  <div class="row">
    <div class="col-sm-6">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>
              Talle
            </th>
            <th>
              Cantidad
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($sizes as $size)
          <tr>
            <td>
              <label for="sizes[{{$size->id}}]" class="control-label">
                {{ $size->label }}
              </label>
            </td>
            <td>
              <input
              placeholder="Cantidad"
              class="form-control"
              type="number"
              name="sizes[{{$size->id}}]"
              id="sizes[{{$size->id}}]"
              value="">
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div>
    <div class="btn-group">
        <button type="submit" name="next_action" value="save_and_close" class="btn btn-primary btn-flat">
            <i class="fa fa-check"></i> Guardar
        </button>
    </div>
    <a href="http://homestead.app/admin/add-stock" class="btn btn-link">
        <i class="fa fa-ban"></i> Cancel
    </a>
  </div>
</form>
