@extends('backend.layouts.master')
@section('content')

    <h2 class="title py-3 font-weight-normal">مدیریت وب گاه</h2>

    <div class="d-flex flex-column flex-md-row w-100">

        <!-- sidebar -->
        @include('backend.partials.adminSidebar')
        <!-- end of sidebar -->
        <div class="col-12 col-md-4">
            <div class="activity d-flex flex-column justify-content-center align-items-start pb-4">
                <h2 class="py-3 pr-3 w-100 text-right">فعالیت های اخیر</h2>
                <h3 class="font-weight-bold pr-3 pt-2">فعالیت های من</h3>
                <div class="d-flex pr-3 align-items-start mt-2">
                    <img src="img/add.png" alt="" class="ml-2 mt-1">
                    <div class="d-flex flex-column justify-content-center align-items-start">
                        <a href="#">سال مالی منتهی به 99</a>
                        <a href="#"><span>تنظیمات اولیه</span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- statistics -->
        <div class="col-12 col-md-3 px-0">

            <div class="d-flex flex-wrap w-100">

                <div class="col-12">
                    <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                        <h2 class="p-3 w-100 text-right"><i class="fas fa-user-tie ml-3"></i>تعداد کاربران سامانه</h2>
                        <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                            <div class="top d-flex justify-content-between w-100">
                                <h6><i class="fa fa-user ml-3"></i>پرسنل</h6>
                                <span>3000 نفر</span>
                            </div>
                            <div class="down d-flex justify-content-between w-100 mt-3">
                                <h6><i class="fa fa-users ml-3"></i>افراد تحت تکفل</h6>
                                <span>1000 نفر</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                        <h2 class="p-3 w-100 text-right"><i class="fas fa-dumbbell ml-3"></i>تعداد برنامه ورزشی</h2>
                        <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                            <div class="top d-flex justify-content-between w-100">
                                <h6><i class="fas fa-dumbbell ml-3"></i>فعال</h6>
                                <span>200 </span>
                            </div>
                            <div class="down d-flex justify-content-between w-100 mt-3">
                                <h6><i class="fa fa-plus ml-3"></i>کل</h6>
                                <span>450 </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="statistics d-flex flex-column justify-content-center align-items-start ">
                        <h2 class="p-3 w-100 text-right"><i class="fas fa-concierge-bell ml-3"></i>تعداد برنامه غذایی</h2>
                        <div class="p-3 d-flex flex-column justify-content-center align-items-start w-100">
                            <div class="top d-flex justify-content-between w-100">
                                <h6><i class="fas fa-utensils ml-3"></i>فعال</h6>
                                <span>20 </span>
                            </div>
                            <div class="down d-flex justify-content-between w-100 mt-3">
                                <h6><i class="fa fa-plus ml-3"></i>کل</h6>
                                <span>50 </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end of statistics -->
    </div>
@endsection
