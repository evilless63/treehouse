@foreach($products as $product)
<ul style="margin-block-start: 0em;margin-block-end: 0em;">
<li style="display: flex; list-style-type: none">
    {{{ $product->name }}} | 

    <form style="margin-block-end: 0em;" method="POST" action="{{route('make-order')}}">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->product_id}}">
        <input type="submit" value="заказать">
    </form>
</li>
</ul>
@endforeach