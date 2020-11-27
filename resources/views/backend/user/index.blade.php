@extends('backend.layouts.master')
@section('content')

    <div class="d-flex flex-column flex-md-row w-100 mt-3">

        <!-- sidebar -->
        <div class="sidebar col-12 col-md-2 pr-md-0">
            <p>
                <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-users ml-2"></i>مدیریت کاربران
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.index')}}"><i class="fa fa-list ml-2"></i>مشاهده لیست کاربران</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.create')}}"><i class="fa fa-user-plus ml-2"></i>افزودن کاربر</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        @if(count($users))
        <div class="col-12 col-md-10 d-flex flex-column align-items-start">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 px-3">
                <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">کاربر را برای تغییر انتخاب کنید</h2>
                <button class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن کاربر</button>
            </div>


            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 col-md-10 mb-3 mb-md-0">

                    <div class="table-search d-flex justify-content-between w-100 mb-3 py-2 px-2">
                        <form action="" class="position-relative">
                            <input type="text" placeholder="جستجو بر اساس شماره ملی ...">
                            <a href="#"><i class="fa fa-search position-absolute search-icon"></i></a>
                        </form>
                    </div>

                    <div class="d-flex mb-2 date">
                        <a href="#">همه تاریخ ها</a>
                        <a href="#" class="mx-3">فروردین 99</a>
                        <a href="#">شهریور 99</a>
                    </div>

                    <table class="customtable w-100 table mb-0 pb-0">
                        <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">آواتار</th>
                                <th class="text-right"> نام و نام خانوادگی</th>
                                <th class="text-right">ایمیل</th>
                                <th class="text-right">سطح دسترسی</th>
                                <th class="text-right">وضعیت</th>
                                <th class="text-right">تاریخ ایجاد</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $key=>$user)
                            <tr>
                                <td class="text-right" scope="row">{{ $key+1 }}</td>
                                <td class="text-center p-0"><img src="{{ $user->avatar ? $user->avatar : "http://www.placehold.it/400" }}" alt="" class="my-1" style="width:40px;"></td>
                                <td class="text-right"><a href="#">{{ $user->first_name . ' '. $user->last_name}}</a></td>
                                <td class="text-right">{{ $user->email }}</td>
                                <td class="text-right">تحصیلات</td>
                                @if($user->status==0)
                                   <td class="text-center p-0"><span class="badge badge-danger p-1">غیر فعال</span></td>
                                @elseif($user->status==1)
                                    <td class="text-center p-0"> <span class="badge badge-success p-1"> فعال</span></td>
                                @endif
                                <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDate() }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-12 col-md-2 mb-3">
                    <div class="filter">
                        <h3 class="title mb-0"><i class="fa fa-filter ml-2"></i>فیلتر</h3>
                        <ul class="mb-0 p-0">
                            <li><a href="#">کارمندان</a></li>
                            <li><a href="#">مدیران</a></li>
                            <li><a href="#">مربیان</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- end of tables -->
        </div>
        @else
        <h1>کابری برای نمایش وجود ندارد.</h1>
        @endif
    </div>
@endsection
