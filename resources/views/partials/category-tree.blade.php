<li>
  <a href="{{ $category->url }}"
     title="{{$category->name}}">
     {{$category->name}}
  </a>
  @if(isset($category->children) && count($category->children))
    <ul>
      @each('partials.category-tree', $category->children, 'category')
    </ul>
  @endif
</li>
