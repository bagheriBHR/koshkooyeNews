@extends('backend.layouts.master')
@section('content')
    <div class="d-flex flex-column align-items-start px-4 w-100">
     <h2 class="title py-3 font-weight-normal">مدیریت وب گاه</h2>
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
        <div class="d-flex flex-column flex-md-row w-100">

            <!-- sidebar -->
            @include('backend.partials.adminSidebar')
            <!-- end of sidebar -->

            <!-- statistics -->
            <div class="col-12 col-md-7 px-0">

                <div class="d-flex flex-wrap w-100">

                    <div class="col-4">
                        <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                            <h2 class="p-3 w-100 text-right"><i class="fas fa-newspaper ml-3"></i>تعداد مقالات</h2>
                            <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                                <div class="top d-flex justify-content-between w-100">
                                    <h6><i class="fas fa-newspaper ml-3"></i>فعال</h6>
                                    <span>{{$activeArticles}} </span>
                                </div>
                                <div class="down d-flex justify-content-between w-100 mt-3">
                                    <h6><i class="fa fa-plus ml-3"></i>کل</h6>
                                    <span>{{$totalArticles}} </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @can('viewAny',\Illuminate\Support\Facades\Auth::user())
                        <div class="col-4">
                            <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                                <h2 class="p-3 w-100 text-right"><i class="fas fa-user-tie ml-3"></i>تعداد کاربران سامانه</h2>
                                <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                                    <div class="top d-flex justify-content-between w-100">
                                        <h6><i class="fa fa-users text-success ml-3"></i>فعال</h6>
                                        <span>{{$activeUsers}} نفر</span>
                                    </div>
                                    <div class="down d-flex justify-content-between w-100 mt-3">
                                        <h6><i class="fa fa-users text-danger ml-3"></i>غیر فعال</h6>
                                        <span>{{$deactiveUsers}} نفر</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                                <h2 class="p-3 w-100 text-right"><i class="fas fa-ad ml-3"></i>تعداد تبلیغات</h2>
                                <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                                    <div class="top d-flex justify-content-between w-100">
                                        <h6><i class="fas fa-ad ml-3"></i>فعال</h6>
                                        <span>{{$activeCommercials}} </span>
                                    </div>
                                    <div class="down d-flex justify-content-between w-100 mt-3">
                                        <h6><i class="fa fa-plus ml-3"></i>کل</h6>
                                        <span>{{$totalCommercials}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>

            </div>
            <!-- end of statistics -->
        </div>
    </div>
@endsection
