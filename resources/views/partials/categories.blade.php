<section class="mk-catalog__categories sidebar">
  @if (isset($filters) && count($filters) > 0)
  <h3 class="sidebar__subtitle">Filtros</h3>
    <ul>
      @foreach($filters as $filter)
      <li>
        <a href="{!! $filter['url'] !!}">
          {{$filter['label']}}
          <i class="fa fa-times"></i>
        </a>
      </li>
      @endforeach
    </ul>
  @endif
    @if (isset($categories))
    <h3 class="sidebar__subtitle">Categorías</h3>
    <ul>
        @foreach($categories as $category)
        <li>
            <a href="{{ $category->url }}"
               title="{{$category->name}}">
               {{$category->name}}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    @if (isset($brands))
    <h3 class="sidebar__subtitle">Marcas</h3>
    <ul class="sidebar__brands">
        @foreach($brands as $brand)
        <li class="sidebar__brand">
            <a href="{{ $brand->url }}" class="sidebar__brand__link" title="{{$brand->name}}">
              <img src="/{{$brand->image->small or ''}}" alt="{{$brand->name}}" />
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    <div id="filtering">
      @if (isset($prices))
      <h3 class="sidebar__subtitle">Precio</h3>
      <ul>
        @foreach ($prices as $price)
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
