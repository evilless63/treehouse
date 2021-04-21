@extends('admin.layouts.main')

@section('page_title')
    {{ "Размеры -- Список" }}
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

    @foreach($sizes as $size)
    <li style="list-style-type: none">
        <h3>{{{ $size->getLocalizeTitleRu() }}} ----- <a href="{{route('sizes.edit', $size->id)}}">{{__('adminpanel.edit')}}</a></h3>
    </li>
    @endforeach
@endsection