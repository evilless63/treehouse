<form method="POST" action="{{route('products.update', $current_product->id)}}">
    @csrf
    @method('patch')

    <label>{{__('adminpanel.name')}}</label>
    
    <input type="text" placeholder="{{__('adminpanel.name')}}" name="name" class="@error('name') is-invalid @enderror" value="{{$current_product->name}}">
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>{{__('adminpanel.categories_for_product')}}</label>
    @if($choosed_categories->count() > 0)
    @foreach($categories as $category) 
        @foreach($choosed_categories as $choosed_category)
        {{ $category->name }} --- <input type="checkbox" name="choosed_categories[]" value="{{$category->id}}" @if($category->id == $choosed_category->id) checked @endif>
        @endforeach
    @endforeach
    @else
    @foreach($categories as $category) 
        {{ $category->name }} --- <input type="checkbox" name="choosed_categories[]" value="{{$category->id}}">
    @endforeach
    @endif

    <ul>
    @foreach($current_product->colorVariations as $colorVariation)
    <li>
        {{$colorVariation->color->name}} -- {{$colorVariation->color->hex}}
        <ul>
        @foreach($colorVariation->images as $image)
            <li>{{$image->name}}</li>
        @endforeach
        @foreach($colorVariation->sizeVariations as $sizeVariation)
            <li>{{$sizeVariation->size->name}} -- {{$sizeVariation->price}} р. -- {{$sizeVariation->stock}} шт.</li>
        @endforeach
        </ul>
    </li>
    @endforeach
    </ul>
    <input type="submit" value="{{__('adminpanel.update')}}">

</form>