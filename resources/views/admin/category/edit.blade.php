<form method="POST" action="{{route('categories.update', $current_category->id)}}">
    @csrf
    @method('patch')

    <label>{{__('adminpanel.name')}}</label>
    
    <input type="text" placeholder="{{__('adminpanel.name')}}" name="name" class="@error('name') is-invalid @enderror" value="{{$current_category->name}}">
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>{{__('adminpanel.parent_category')}}</label>
    <select name="parent_id">
        @if($selected_category == null)
            <option selected value="0">{{__('adminpanel.without_category')}}</option>
        @else
            <option selected value="{{$selected_category->id}}">{{$selected_category->name}}</option>
        @endif
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>

    <input type="submit" value="{{__('adminpanel.create')}}">

</form>