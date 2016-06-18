@if ($categories)
<section class="mk-catalog__categories">
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
</section>
@endif