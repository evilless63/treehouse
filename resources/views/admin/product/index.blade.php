@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('error'))
<div class="alert alert-error">
    <ul>
        <li>{!! \Session::get('error') !!}</li>
    </ul>
</div>
@endif

@foreach($products as $product)
<li style="list-style-type: none">
    <h3>{{{ $product->name }}} ----- <a href="{{route('products.edit', $product->id)}}">{{__('adminpanel.edit')}}</a></h3>
</li>
@endforeach