<ul class="list-group">
    @foreach ($subcategories as $subcategory)
    <li class="list-group-item">
        {{ $subcategory['name'] }}
        @if (!empty($subcategory['subcategories']))
        @include('partials.categories', ['subcategories' => $subcategory['subcategories']])
        @endif
    </li>
    @endforeach
</ul>