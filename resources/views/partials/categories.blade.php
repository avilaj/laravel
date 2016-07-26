<section class="mk-catalog__categories">
    <pre>
    </pre>
  @if (isset($filters))
    <h3>Filtros</h3>
    <ul>
      @foreach($filters as $filter)
      <li>
        <a href="{!! $filter->link !!}">
          {{$filter->label}}
          <i class="fa fa-times"></i>
        </a>
      </li>
      @endforeach
    </ul>
  @endif
    @if (isset($categories) && !@$filters['category'])
    <h3>Categorías</h3>
    <ul>
        @foreach($categories as $category)
        <li>
            <a href="{{ $category->url.'?'.http_build_query(Request::query()) }}"
               title="{{$category->name}}">
               {{$category->name}}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    @if (isset($brands) && !@$filters['brand'])
    <h3>Marcas</h3>
    <ul>
        @foreach($brands as $brand)
        <li>
            <a href="{{Request::fullUrlWithQuery(['brand' => $brand->id])}}">
                {{ $brand->name }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    <div id="filtering">
      @if (isset($prices) && !@$filters['price'])
      <h3>Precio</h3>
      <ul>
        @foreach ($prices as $value => $label)
        <li>
            <a href="{{Request::fullUrlWithQuery(['price' => $value])}}">
                {{ $label }}
            </a>
        </li>
        @endforeach
      </ul>
      @endif
    </div>
</section>