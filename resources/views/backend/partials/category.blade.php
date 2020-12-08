@foreach($categories as $key=>$category)
    <tr>
        <td class="text-right" scope="row"></td>
        <td class="text-right">
            @can('update',$category)
                <a href="{{route('category.edit',$category->id)}}">{{str_repeat('___',$level)}}{{ $category->name }}</a>
            @endcan
            @cannot('update',$category)
                    {{str_repeat('------',$level)}}{{ $category->name }}
            @endcan
        </td>
        <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->formatDate() }}</td>
        <td>
            <div class="d-flex justify-content-end">
                @if(count($category->articles)>0)
                    <form action="/admin/category/{{$category->id}}/articleList" method="post">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="filter" value="category">
                        <button type="submit" class="btn custombutton custombutton-primary py-2 px-4">لیست مقالات </button>
                    </form>
                @endif
                @can('delete',$category)
                    <form action="{{route('category.destroy',$category->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('آیا از حذف دسته بندی مطمئن هستید؟');" type="submit" class=" mr-2 btn custombutton custombutton-danger py-2 px-4">حذف </button>
                    </form>
                @endcan
            </div>
        </td>
    </tr>
    @if(count($category->childrenRecursive)>0)
        @include('backend.partials.category',['categories'=>$category->childrenRecursive , 'level'=>$level+1])
    @endif
@endforeach
