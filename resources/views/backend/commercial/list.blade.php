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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست تبلیغات</h3>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100">
                @can('update',\Illuminate\Support\Facades\Auth::user())
                    <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">عنوان تبلیغ مورد نظر را برای تغییر انتخاب کنید</h2>
                    <a href="{{route('commercial.create')}}" class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن تبلیغ</a>
                @endcan
            </div>

            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 px-0 col-md-10 mb-3 mb-md-0">
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
                        <form action="{{route('commercial.search')}}" class="position-relative" method="post">
                            @csrf
                            <input type="text" name="search" placeholder="جستجو بر اساس عنوان ...">
                            <button  type="submit" class="position-absolute search-icon"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    @if(count($commercials))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">بنر</th>
                                <th class="text-right">عنوان</th>
                                <th class="text-right"> وضعیت</th>
                                <th class="text-right">نوع سرویس دهی</th>
                                <th class="text-right">تعداد کلیک</th>
                                <th class="text-right">زمان شروع</th>
                                <th class="text-right">زمان پایان</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commercials as $key=>$commercial)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-center p-0"><img src="{{'/storage/photos/commercials/'.$commercial->url }}" alt="" class="my-1" style="width:40px;"></td>
                                    <td class="text-right"><a href="{{route('commercial.edit',$commercial->id)}}">{{ $commercial->title}}</a></td>
                                    @if($commercial->status==0)
                                        <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                                    @elseif($commercial->status==1)
                                        <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                                    @else
                                        <td class="text-center p-0"> <span class="badge badge-info p-1"> آرشیو</span></td>
                                    @endif
                                    @if($commercial->type==0)
                                        <td class="text-right p-0"><span class="p-1">تعداد کلیک</span></td>
                                    @elseif($commercial->type==1)
                                        <td class="text-right p-0"> <span class="p-1"> بازه زمانی</span></td>
                                    @endif
                                    <td class="text-right">{{ $commercial->click_count ? $commercial->click_count : '-' }}</td>
                                    <td class="text-center p-0">{{$commercial->start_at ? $commercial->start_at  : '-' }}</td>
                                    <td class="text-center p-0">{{$commercial->finish_at ? $commercial->finish_at : '-'}}</td>
                                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($commercial->created_at)->formatDate() }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            @if($commercial->type==0 && $commercial->status==0)
                                                <form action="{{route('commercial.action',$commercial->id)}}" method="post">
                                                    @method('GET')
                                                    @csrf
                                                    <input type="hidden" name="action" value="activate">
                                                    <button type="submit" class=" ml-2 btn btn custombutton custombutton-success py-2 px-4" > فعالسازی</button>
                                                </form>
                                            @endif
                                            <form action="{{route('commercial.destroy',$commercial->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('آیا از حذف تبلیغ مطمئن هستید؟');" class="ml-2 btn custombutton custombutton-danger py-2 px-4">حذف </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">موردی یافت نشد.</span>
                        </div>
                    @endif
                </div>

                <div class="col-12 px-0 pr-md-2 col-md-2 mb-3">
                    <div class="filter">
                        <h3 class="title mb-0"><i class="fa fa-filter ml-2"></i>فیلتر</h3>
                        <form action="{{route('commercial.filter')}}" method="post">
                            @method('POST')
                            @csrf
                            <div class="filter-sidebar">
                                <div class="right-sidebar w-100">
                                    <div class="menu text-right h-100">
                                        <p class="mb-0">
                                            <a class="btn btntitle w-100 d-flex justify-content-between align-items-center"  data-toggle="collapse" data-target="#collapseExample30" aria-expanded="false" aria-controls="collapseExample">
                                                <span class="d-flex align-items-center"><i class="fa fa-user ml-3"></i> وضعیت تبلیغ</span>
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
                                                <span class="d-flex align-items-center"><i class="fas fa-toggle-off ml-3"></i>نوع سرویس دهی</span>
                                                <span class="fa fa-angle-right js-rotate-if-collapsed"></span>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample31">
                                            <div class="border-0 p-0">
                                                <table class="w-100 text-right">
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="click_count">تعداد کلیک</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 pr-2">
                                                            <button type="submit" name="filter" value="date">بازه زمانی</button>
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
            <div class="w-100 mt-3 d-flex justify-content-center">{{$commercials->links()}}</div>
        </div>
    </div>
@endsection
