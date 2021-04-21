@extends('admin.layouts.main')

@section('page_title')
    {{ "Цвета -- Редактирование" }}
@endsection

@section('content')
    <form method="POST" action="{{route('colors.update', $current_color->id)}}">
        @csrf
        @method('patch')

        @foreach($lang_field_sets as $lang_field_set)
        <label>{{__('adminpanel.name')}} -- {{$lang_field_set->lang}}</label>
        <input type="text" placeholder="{{__('adminpanel.name')}}" name="localization[{{$lang_field_set->lang}}][title]" class="@error('title') is-invalid @enderror" value="{{$lang_field_set->title}}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @endforeach

        <label>HEX</label>
        <input type="text" name="hex" value="{{$current_color->hex}}">
        <input type="submit" value="{{__('adminpanel.edit')}}">

    </form>
@endsection