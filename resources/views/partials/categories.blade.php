<section class="mk-catalog__categories sidebar">
    <pre>
    </pre>
  @if (isset($filters) && count($filters) > 0)
    <h3 class="sidebar__subtitle">Filtros</h3>
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
    <h3 class="sidebar__subtitle">Categorías</h3>
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
    <h3 class="sidebar__subtitle">Marcas</h3>
    <ul class="sidebar__brands">
        @foreach($brands as $brand)
        <li class="sidebar__brand">
            <a href="{{ $brand->url }}" class="sidebar__brand__link" title="{{$brand->name}}">
              <img src="{{$brand->image}}" alt="{{$brand->name}}" />
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    <div id="filtering">
      @if (isset($prices) && !@$filters['price'])
      <h3 class="sidebar__subtitle">Precio</h3>
      <ul>
        @foreach ($prices() as $price)
        <li>
            <a href="{{ $price['url']}}">
                {{ $price['label'] }}
            </a>
        </li>
        @endforeach
      </ul>
      @endif
    </div>
</section>
