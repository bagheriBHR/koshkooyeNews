@extends('backend.layouts.master')
@section('content')
    <div class="d-flex flex-column flex-md-row w-100 h-100">

        <!-- sidebar -->
        <div class="col-12 col-md-2 px-0 pl-md-2 h-100">
            @include('backend.partials.rightSidebar')
        </div>
        <!-- end of sidebar -->

        <div class="scroll col-12 col-md-10 px-0 px-md-4 mt-3 d-flex flex-column align-items-start pb-3">
            <div class="d-flex flex-column border-bottom w-100">
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست مقالات</h3>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100">
                <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">مقاله را برای تغییر انتخاب کنید</h2>
                <a href="{{route('article.create')}}" class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن مقاله</a>
            </div>

            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 mb-3 mb-md-0 px-0">
                    @if(Session::has('danger'))
                        <div class="alert alert-danger text-right w-100">
                            <div>{{Session('danger')}}</div>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success text-right w-100">
                            <div>{{Session('success')}}</div>
                        </div>
                    @endif
                    @if(Session::has('warning'))
                        <div class="alert alert-warning text-right w-100">
                            <div>{{Session('warning')}}</div>
                        </div>
                    @endif
                    <div class="table-search d-flex justify-content-between w-100 mb-3 py-2 px-2">
                        <form action="{{route('article.search')}}" class="position-relative" method="post">
                            @csrf
                            <input type="text" name="search" placeholder="جستجو بر اساس عنوان و متن مقاله ...">
                            <button  type="submit" class="position-absolute search-icon"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    @if(count($articles))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">تصویر</th>
                                <th class="text-right">تیتر</th>
                                <th class="text-right">تگ ها</th>
                                <th class="text-right">تعداد بازدید</th>
                                <th class="text-right">نمایش در کروسل</th>
                                <th class="text-right">وضعیت نشر</th>
                                <th class="text-right">تاریخ نشر</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key=>$article)
                                @can('view',$article)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-center p-0"><img src="{{ '/storage/photos/articles/'.$article->thumbnail }}" alt="" class="my-1" style="width:40px;"></td>
                                    <td class="text-right"><a href="{{route('article.edit',$article->id)}}">{{ \Illuminate\Support\Str::limit($article->title,40)}}</a></td>
                                    <td class="text-right">
                                        @foreach($article->tags as $tag)
                                            <li class="list-unstyled p-0">{{ $tag->name }}</li>
                                        @endforeach
                                    </td>
                                    <td class="text-right">{{ $article->view_count }}</td>
                                    @if($article->is_carousel==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                                    @elseif($article->is_carousel==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                                    @endif
                                    @if($article->publish_status==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">پیش نویس</span></td>
                                    @elseif($article->publish_status==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1">انتشار یافته</span></td>
                                    @elseif($article->publish_status==2)
                                        <td class="text-center p-0"> <span class="badge badge-primary p-1">آرشیو</span></td>
                                    @endif
                                    <td class="text-right">{{$article->publish_date ? \Hekmatinasser\Verta\Verta::instance($article->publish_date)->formatDate()  : '-' }}</td>
                                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($article->created_at)->formatDate() }}</td>
                                    <td class="">
                                        <div class="d-flex justify-content-end">
                                            @if($article->publish_status==0 || $article->publish_status==2)
                                                <form action="{{route('article.action',$article->id)}}" method="post">
                                                    @method('GET')
                                                    @csrf
                                                    <input type="hidden" name="action" value="publish">
                                                    <button type="submit" class="btn btn custombutton custombutton-success py-2 px-4">نشر دهید</button>
                                                </form>
                                            @else
                                                <form action="{{route('article.action',$article->id)}}" method="post">
                                                    @method('GET')
                                                    @csrf
                                                    <input type="hidden" name="action" value="archive">
                                                    <button type="submit" class="btn btn custombutton custombutton-primary py-2 px-4" >آرشیو کنید</button>
                                                </form>
                                            @endif
                                            @can('update',\Illuminate\Support\Facades\Auth::user(),$article)
                                                <form action="{{route('article.destroy',$article->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('آیا از حذف مقاله مطمئن هستید؟');" class="mr-2 btn custombutton custombutton-danger py-2 px-4">حذف </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                                @endcan
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">مقاله ای یافت نشد.</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- end of tables -->
            <div class="w-100 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
        </div>
    </div>
@endsection

