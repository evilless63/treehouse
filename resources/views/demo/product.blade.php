@foreach($products as $product)
<ul style="margin-block-start: 0em;margin-block-end: 0em;    width: 45%;">
<li style="display: flex; list-style-type: none;justify-content: space-between; margin: .2em"
onmouseover="this.style.backgroundColor='#e1d7d7';" onmouseout="this.style.backgroundColor='#fff';">
    {{{ $product->name }}} | 

    <form style="margin-block-end: 0em;" method="POST" action="{{route('make-order')}}">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->product_id}}">
        <input type="submit" value="заказать">
    </form>
</li>
</ul>
@endforeach