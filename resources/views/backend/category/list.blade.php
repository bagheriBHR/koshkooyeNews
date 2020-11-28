@extends('backend.layouts.master')
@section('content')

    <div class="d-flex flex-column flex-md-row w-100 mt-3">

        <!-- sidebar -->
        <div class="sidebar col-12 col-md-2 pr-md-0">
            <p>
                <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-users ml-2"></i>مدیریت دسته بندی ها
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.index')}}"><i class="fa fa-list ml-2"></i>مشاهده لیست دسته بندی ها</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.create')}}"><i class="fa fa-plus ml-2"></i>افزودن دسته بندی</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <div class="col-12 col-md-10 d-flex flex-column align-items-start">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 px-3">
                <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">دسته بندی را برای تغییر انتخاب کنید</h2>
                <a href="{{route('category.create')}}" class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن دسته بندی</a>
            </div>

            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 mb-3 mb-md-0">
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

                    @if(count($categories))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">عنوان</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-right">
                                        @can('delete',\Illuminate\Support\Facades\Auth::user(),$category)
                                            <a href="{{route('category.edit',$category->id)}}">{{$category->name}}</a>
                                        @endcan
                                        @cannot('delete',\Illuminate\Support\Facades\Auth::user(),$category)
                                            {{$category->name}}
                                        @endcan
                                    </td>
                                    <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->formatDate() }}</td>
                                    <td>
                                        @can('delete',\Illuminate\Support\Facades\Auth::user(),$category)
                                            <form action="{{route('category.destroy',$category->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('آیا از حذف دسته بندی مطمئن هستید؟');" type="submit" class="btn custombutton custombutton-danger py-2 px-4">حذف </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">دسته بندی یافت نشد.</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- end of tables -->
            <div class="col-md-12 mt-3 d-flex justify-content-center">{{$categories->links()}}</div>
        </div>
    </div>
@endsection

