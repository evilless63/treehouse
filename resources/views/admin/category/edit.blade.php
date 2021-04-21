@extends('admin.layouts.main')

@section('page_title')
    {{ "Категории -- Редактирование" }}
@endsection

@section('content')
    <form method="POST" action="{{route('categories.update', $current_category->id)}}">
        @csrf
        @method('patch')

        @foreach($lang_field_sets as $lang_field_set)

        <label>{{__('adminpanel.name')}} -- {{$lang_field_set->lang}}</label>
        <input type="text" placeholder="{{__('adminpanel.name')}}" name="localization[{{$lang_field_set->lang}}][title]" class="@error('title') is-invalid @enderror" value="{{$lang_field_set->title}}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @endforeach

        <label>{{__('adminpanel.parent_category')}}</label>
        <select name="parent_id">
            @if($selected_category == null)
                <option selected value="0">{{__('adminpanel.without_category')}}</option>
            @else
                <option selected value="{{$selected_category->id}}">{{$selected_category->getLocalizeTitleRu()}}</option>
            @endif
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->getLocalizeTitleRu()}}</option>
            @endforeach
        </select>

        <input type="submit" value="{{__('adminpanel.edit')}}">

    </form>
@endsection