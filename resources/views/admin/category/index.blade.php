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

<a href="{{route('categories.create')}}">{{__('adminpanel.create_category')}}</a>

@foreach($categories as $category)
<li style="list-style-type: none">
    <h3>{{{ $category->name }}} ----- <a href="{{route('categories.edit', $category->id)}}">{{__('adminpanel.edit')}}</a></h3>
    @if(true == false)
    @if(count($category->products))
    @include('demo.product ',['products' => $category->products])
    @endif
    @endif
    @if(count($category->childs))
    @include('admin.category.includes.childs',['childs' => $category->childs])
    @endif
</li>
@endforeach