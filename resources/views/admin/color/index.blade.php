@extends('admin.layouts.main')

@section('page_title')
    {{ "Цвета -- Список" }}
@endsection

@section('content')
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

    @foreach($colors as $color)
    <li style="list-style-type: none">
        <h3>{{{ $color->getLocalizeTitleRu() }}} ----- <a href="{{route('colors.edit', $color->id)}}">{{__('adminpanel.edit')}}</a></h3>
    </li>
    @endforeach
@endsection