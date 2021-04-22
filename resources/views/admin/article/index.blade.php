@extends('admin.layouts.main')

@section('page_title')
{{ "Статьи -- Список" }}
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

<a href="{{route('articles.create')}}">Создать статью</a>

@foreach($articles as $article)
<li style="list-style-type: none">
    <h3>{{{ $article->getLocalizeTitleRu() }}} ----- <a href="{{route('articles.edit', $article->id)}}">{{__('adminpanel.edit')}}</a> ----- <a href="{{route('articles.replicate', $article->id)}}">Скопировать</a> -----
        <form method="POST" action="{{route('articles.destroy', $article->id)}}">
            @csrf
            @method('delete')
            <input type="submit" value="Удалить">
        </form>
    </h3>
</li>
@endforeach

@endsection