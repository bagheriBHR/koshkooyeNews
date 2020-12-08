
@if(isset($category))
    @if(isset($multiple))
        @foreach($categories as $category_list)
            <option value="{{$category_list->id}}"
            @foreach($category as $item)
                {{$item->id == $category_list->id ? "selected" : ""}}
                @endforeach>
                {{str_repeat('-----',$level)}}{{$category_list->name}}
            </option>
            @if(count($category_list->childrenRecursive)>0)
                @include('backend.partials.categoryList',['categories'=>$category_list->childrenRecursive,'level'=>$level+1,'category'=>$category])
            @endif
        @endforeach
    @else
        @foreach($categories as $category_list)
            <option value="{{$category_list->id}}" {{$category == $category_list->id ? 'selected':''}}>{{str_repeat('-----',$level)}}{{$category_list->name}}</option>
            @if(count($category_list->childrenRecursive)>0)
                @include('backend.partials.categoryList',['categories'=>$category_list->childrenRecursive,'level'=>$level+1,'category'=>$category])
            @endif
        @endforeach
    @endif
@else
    @foreach($categories as $category_list)
        <option value="{{$category_list->id}}" >{{str_repeat('-----',$level)}}{{$category_list->name}}</option>
        @if(count($category_list->childrenRecursive)>0)
            @include('backend.partials.categoryList',['categories'=>$category_list->childrenRecursive,'level'=>$level+1])
        @endif
    @endforeach
@endif
