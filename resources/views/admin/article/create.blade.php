@extends('admin.layouts.main')

@section('page_title')
    {{ "Статьи -- Создание" }}
@endsection

@section('content')
    <form method="POST" action="{{route('articles.store')}}">
        @csrf

        @foreach($locales as $locale)

        <label>{{__('adminpanel.name')}} -- {{$locale}}</label>
        <input type="text" placeholder="{{__('adminpanel.name')}}" name="localization[{{$locale}}][title]" class="@error('title') is-invalid @enderror" value="{{old('title')}}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <textarea name="localization[{{$locale}}][content]" cols="30" rows="10">
        {{old('content')}}
        </textarea>

        @endforeach

        <input type="submit" value="{{__('adminpanel.update')}}">

    </form>
@endsection