@extends('backend.layouts.master')
@section('content')

    <div class="d-flex flex-column flex-md-row w-100 mt-3">

        <!-- sidebar -->
        <div class="sidebar col-12 col-md-2 pr-md-0">
            <p>
                <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-users ml-2"></i>مدیریت مقالات
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('article.index')}}"><i class="fa fa-list ml-2"></i>مشاهده لیست مقالات</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('article.create')}}"><i class="fa fa-user-plus ml-2"></i>افزودن مقاله</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <div class="col-12 col-md-10 d-flex flex-column align-items-start">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 px-3">
                <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">مقاله را برای تغییر انتخاب کنید</h2>
                <a href="{{route('article.create')}}" class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن مقاله</a>
            </div>

            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 col-md-10 mb-3 mb-md-0">
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
                            <input type="text" name="search" placeholder="جستجو بر اساس عنوان مقاله ...">
                            <button  type="submit" class="position-absolute search-icon"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    @if(count($articles))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">تصویر</th>
                                <th class="text-right">روتیتر</th>
                                <th class="text-right">تیتر</th>
                                <th class="text-right">متن</th>
                                <th class="text-right">تعداد بازدید</th>
                                <th class="text-right">نمایش در کروسل</th>
                                <th class="text-right">تاریخ نشر</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right">وضعیت نشر</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key=>$article)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-center p-0"><img src="{{ '/storage/photos/avatar/'.$article->thumbnail }}" alt="" class="my-1" style="width:40px;"></td>
                                    <td class="text-right p-0">{{$article->roo_titr}}</td>
                                    <td class="text-right"><a href="{{route('article.edit',$article->id)}}">{{ $article->title}}</a></td>
                                    <td class="text-right p-0">{{\Illuminate\Support\Str::limit($article->body,20)}}</td>
                                    <td class="text-right">{{ $article->view_count }}</td>
                                    @if($article->is_carousel==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                                    @elseif($article->is_carousel==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                                    @endif
                                    <td class="text-right">{{$article->publish_date ? \Hekmatinasser\Verta\Verta::instance($article->publish_date)->formatDate()  : '-' }}</td>
                                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($article->created_at)->formatDate() }}</td>

                                    @if($article->publish_status==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">پیش نویس</span></td>
                                    @elseif($article->publish_status==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1">انتشار یافته</span></td>
                                    @elseif($article->publish_status==2)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1">آرشیو</span></td>
                                    @endif
                                    <td>
                                        <form action="{{route('article.destroy',$article->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('آیا از حذف مقاله مطمئن هستید؟');" class=" btn custombutton custombutton-danger py-2 px-4">حذف </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">مقاله ای یافت نشد.</span>
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-2 mb-3">
                    <div class="filter">
                        <h3 class="title mb-0"><i class="fa fa-filter ml-2"></i>فیلتر</h3>
                        <form action="{{route('article.filter')}}" method="post">
                            @method('POST')
                            @csrf
                            <div class="has-sidebar">
                                <div class="right-sidebar w-100">
                                    <div class="menu text-right h-100">
                                        <p class="mb-0">
                                            <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample10" aria-expanded="false" aria-controls="collapseExample">
                                                <span class="d-flex align-items-center"><i class="fa fa-user ml-3"></i>نقش کاربر</span>
                                                <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample10">
                                            <div class="border-0 p-0">
                                                <table class="w-100 text-right">
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="admin"> مدیر</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="editor">سردبیر</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="author">نویسنده</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <p class="mb-0">
                                            <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                                <span class="d-flex align-items-center"><i class="fas fa-toggle-off ml-3"></i>وضعیت</span>
                                                <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample2">
                                            <div class="border-0 p-0">
                                                <table class="w-100 text-right">
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="active"> فعال</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="deactive">غیر فعال</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- end of tables -->
            <div class="col-md-12 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
        </div>
    </div>
@endsection

