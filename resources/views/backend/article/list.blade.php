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

                <div class="col-12 col-md-10 mb-3 mb-md-0 px-0">
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

                    @if(!($articles->isEmpty()))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">تصویر</th>
                                <th class="text-right">تیتر</th>
                                <th class="text-right">دسته بندی</th>
                                <th class="text-right">نوع</th>
                                <th class="text-right">اسلایدر</th>
                                <th class="text-right">مهم</th>
                                <th class="text-right">وضعیت نشر</th>
                                <th class="text-right">تاریخ نشر</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key=>$article)
                                @can('view',$article)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-center p-0"><img src="{{ '/storage'.$article->photo->path.'small_'.$article->photo->originalName }}" alt="" class="my-1" style="width:40px;"></td>
                                    <td class="text-right"><a href="{{route('article.edit',$article->id)}}">{{ \Illuminate\Support\Str::limit($article->title,40)}}</a></td>
                                    <td class="text-right">
                                        @foreach($article->categories as $category)
                                            <li class="list-unstyled p-0">{{ $category->name }}</li>
                                        @endforeach
                                    </td>
                                    @if($article->type == 0)
                                        <td class="text-right">متن</td>
                                    @elseif($article->type == 1)
                                        <td class="text-right">عکس</td>
                                    @elseif($article->type == 2)
                                        <td class="text-right">فیلم</td>
                                    @elseif($article->type == 2)
                                        <td class="text-right">صوتی</td>
                                    @endif
                                    @if($article->is_carousel==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                                    @elseif($article->is_carousel==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                                    @endif
                                    @if($article->is_important==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">خیر</span></td>
                                    @elseif($article->is_important==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1"> بله</span></td>
                                    @endif
                                    @if($article->publish_status==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">پیش نویس</span></td>
                                    @elseif($article->publish_status==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1">انتشار یافته</span></td>
                                    @elseif($article->publish_status==2)
                                        <td class="text-center p-0"> <span class="badge badge-primary p-1">آرشیو</span></td>
                                    @endif
                                    <td class="text-right">{{$article->publish_date ? \Hekmatinasser\Verta\Verta::instance($article->publish_date)->formatDate()  : '-' }}</td>
                                    <td class="p-0">
                                        <div class="d-flex justify-content-end">
                                            @if($article->publish_status==0 || $article->publish_status==2)
                                                <form action="{{route('article.action',$article->id)}}" method="post">
                                                    @method('GET')
                                                    @csrf
                                                    <input type="hidden" name="action" value="publish">
                                                    <button type="submit" class="btn btn custombutton custombutton-success p-1">انتشار</button>
                                                </form>
                                            @else
                                                <form action="{{route('article.action',$article->id)}}" method="post">
                                                    @method('GET')
                                                    @csrf
                                                    <input type="hidden" name="action" value="archive">
                                                    <button type="submit" class="btn btn custombutton custombutton-primary p-1" >آرشیو </button>
                                                </form>
                                            @endif
                                            @can('update',\Illuminate\Support\Facades\Auth::user(),$article)
                                                <form action="{{route('article.destroy',$article->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('آیا از حذف مقاله مطمئن هستید؟');" class="mr-2 btn custombutton custombutton-danger p-1">حذف </button>
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
                <div class="col-12 px-0 pr-md-2 col-md-2 mb-3">
                    <div class="filter">
                        <h3 class="title mb-0"><i class="fa fa-filter ml-2"></i>فیلتر</h3>
                        <form action="{{route('article.filter')}}" method="post">
                            @method('POST')
                            @csrf
                            <div class="filter-sidebar">
                                <div class="right-sidebar w-100">
                                    <div class="menu text-right h-100">
                                        <p class="mb-0">
                                            <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample30" aria-expanded="false" aria-controls="collapseExample">
                                                <span class="d-flex align-items-center"><i class="fa fa-user ml-3"></i> وضعیت انتشار</span>
                                                <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample30">
                                            <div class="border-0 p-0">
                                                <table class="w-100 text-right">
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="active"> فعال</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="deactive">غیرفعال</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="archive">آرشیو</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <p class="mb-0">
                                            <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample31" aria-expanded="false" aria-controls="collapseExample">
                                                <span class="d-flex align-items-center"><i class="fas fa-toggle-off ml-3"></i>وضعیت نمایش </span>
                                                <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample31">
                                            <div class="border-0 p-0">
                                                <table class="w-100 text-right">
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="slider">اخبار اسلایدر</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="important">اخبار مهم</button>
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
            <div class="w-100 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
        </div>
    </div>
@endsection

