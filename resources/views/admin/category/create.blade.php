@extends('admin.layouts.main')

@section('page_title')
    {{ "Категории -- Создание" }}
@endsection

@section('content')
    <form method="POST" action="{{route('categories.store')}}">
        @csrf

        @foreach($locales as $locale)

        <label>{{__('adminpanel.name')}} -- {{$locale}}</label>
        <input type="text" placeholder="{{__('adminpanel.name')}}" name="localization[{{$locale}}][title]" class="@error('title') is-invalid @enderror" value="{{old('title')}}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @endforeach

        <label>{{__('adminpanel.parent_category')}}</label>
        <select name="parent_id">
            <option selected value="0">{{__('adminpanel.without_category')}}</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->getLocalizeTitleRu()}}</option>
            @endforeach
        </select>

        <input type="submit" value="{{__('adminpanel.update')}}">

    </form>
@endsection