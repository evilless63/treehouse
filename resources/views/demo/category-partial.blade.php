<ul style="margin-block-start: 0em;margin-block-end: 0em;">
    @foreach($childs as $child)
    <li style="list-style-type: none">
        <h4>{{{ $child->name }}}</h4>
        @if(count($child->products))
        @include('demo.product ',['products' => $child->products])
        @endif
        @if(count($child->childs))
        @include('demo.category-partial',['childs' => $child->childs])
        @endif
    </li>
    @endforeach
</ul>