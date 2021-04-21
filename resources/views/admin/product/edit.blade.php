@extends('admin.layouts.main')

@section('page_title')
    {{ "Товары -- Список" }}
@endsection

@section('content')
    <form method="POST" action="{{route('products.update', $current_product->id)}}">
        @csrf
        @method('patch')

        @foreach($lang_field_sets as $lang_field_set)

        <label>{{__('adminpanel.name')}} -- {{$lang_field_set->lang}}</label>
        <input type="text" placeholder="{{__('adminpanel.name')}}" name="localization[{{$lang_field_set->lang}}][title]" class="@error('title') is-invalid @enderror" value="{{$lang_field_set->title}}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @endforeach
    
        <label>{{__('adminpanel.categories_for_product')}}</label>
        @if($choosed_categories->count() > 0)
        @foreach($categories as $category)
        @foreach($choosed_categories as $choosed_category)
        {{ $category->getLocalizeTitleRu() }} --- <input type="checkbox" name="choosed_categories[]" value="{{$category->id}}" @if($category->id == $choosed_category->id) checked @endif>
        @endforeach
        @endforeach
        @else
        @foreach($categories as $category)
        {{ $category->getLocalizeTitleRu() }} --- <input type="checkbox" name="choosed_categories[]" value="{{$category->id}}">
        @endforeach
        @endif

        <ul>
            @foreach($current_product->colorVariations as $colorVariation)
            <li>
                {{$colorVariation->color->getLocalizeTitleRu()}} -- {{$colorVariation->color->hex}}
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
@endsection