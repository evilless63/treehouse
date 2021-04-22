@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@foreach($categories as $category)
<li style="list-style-type: none">
    <h3>{{{ $category->name }}}</h3>
    @if(count($category->products))
    @include('demo.product ',['products' => $category->products])
    @endif
    @if(count($category->childs))
    @include('demo.category-partial ',['childs' => $category->childs])
    @endif
</li>



@endforeach