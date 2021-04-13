<form method="POST" action="{{route('categories.store')}}">
    @csrf

    <label>{{__('adminpanel.name')}}</label>
    <input type="text" placeholder="{{__('adminpanel.name')}}" name="name" class="@error('name') is-invalid @enderror" value="{{old('name')}}">
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label>{{__('adminpanel.parent_category')}}</label>
    <select name="parent_id">
        <option selected value="0">{{__('adminpanel.without_category')}}</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>

    <input type="submit" value="{{__('adminpanel.update')}}">

</form>