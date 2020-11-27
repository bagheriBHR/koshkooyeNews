<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <title>خانه خبر کشکوییه</title>
</head>
<body>

<div class="main d-flex flex-column h-100">

    <!-- header -->
    <div class="header pb-3 pb-md-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mx-2 mx-md-5">
            @if(Auth::check())
                <h1 class="font-weight-normal py-2"><a href="{{route('admin.home')}}">پنل مدیریت</a></h1>
                <form class="search position-relative my-2 my-md-0" >
                    <input type="text"  onfocus="this.placeholder=''" onblur="this.placeholder='جستجو کنید...'" name="search" placeholder="جستجو کنید..." class="w-100">
                    <a><i class="fa fa-search position-absolute search-icon"></i></a>
                </form>
            @else
                <h1 class="font-weight-normal py-2"><a href="#">نمایش وبگاه</a></h1>
            @endif
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mt-2 mt-md-0">
                @if(Auth::check())
                    <h3 class="font-weight-normal m-0 ml-md-3 mb-2 mb-md-0">خوش آمدید، {{Auth::user()->name . ' ' . Auth::user()->last_name}} </h3>
                @endif
                <ul class="nav p-0">
                    <!-- Authentication Links -->
                    @guest

                    @else
                        <li class=" py-0"><a href=""> نمایش وبگاه</a><span class="text-white mx-1">/</span></li>
                        <li class=" py-0"><a href="">تغییر گذرواژه</a><span class="text-white mx-1">/</span></li>
                        <li class="py-0">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                خروج</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
    <!-- end of header -->

    <div class="d-flex flex-column align-items-start mx-4 mb-4">
        @yield('content')
    </div>

</div>


<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

@yield('script')

</body>
</html>
