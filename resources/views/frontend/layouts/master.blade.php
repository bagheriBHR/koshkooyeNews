<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$setting->meta_description}}">
    <meta name="keywords" content="{{$setting->meta_keyword}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @yield('style')

    <title>خانه خبر کشکوییه</title>
</head>
<body>
<a href="javascript:" id="return-to-top" title="انتقال به بالا"><i class="fa fa-angle-up"></i></a>
@if ($setting->banner)
    <div class="w-100">
        <img src="{{ '/storage/photos/avatar/'.$setting->banner}}" alt="" class="w-100">
    </div>
@endif
<!-- header -->
<div class="header d-flex flex-column no-print">
    <div class="top-header d-flex flex-column flex-md-row align-items-center position-relative">
        <img src="{{asset("/images/frontend/dotted-world-map.png")}}" class="position-absolute world-pattern" alt="">
        <div class="d-flex follow py-2 pr-2 pr-md-5">
            @if($setting->instagram)
                <a href="http://www.instagram.com/{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
            @endif
            @if($setting->twitter)
                <a href="http://www.twitter.com/{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
            @endif
             @if($setting->facebook)
                <a href="http://www.facebook.com/{{$setting->facebook}}"><i class="fab fa-facebook"></i></a>
            @endif
             @if($setting->whatsapp)
                <a href="http://www.whatsapp.com/{{$setting->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
            @endif
                @if($setting->telegram)
                <a href="https://t.me/{{$setting->telegram}}"><i class="fab fa-telegram"></i></a>
            @endif
        </div>
        <div class="search mx-2 ml-md-5">
            <form action="{{ route('home') }}" class="position-relative my-2 my-md-0" method="GET" role="search">
                <input type="text"  onfocus="this.placeholder=''" onblur="this.placeholder='جستجو کنید...'" name="q" placeholder="جستجو کنید..." class="w-100">
                <a href="{{ route('home') }}" class=" mt-1">
                    <button type="submit" class=" position-absolute search-icon"><i class="fa fa-search"></i></button>
                </a>
            </form>
        </div>
        <span class="time mr-auto">{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::now()->format(' %d %B %Y') ) }}</span>
    </div>
    <nav class="px-0 navbar navbar-expand-lg navbar-light py-0">
        <a class="navbar-brand py-0 position-relative pr-4 pr-md-4 mr-0" href="#">
            <div class="logo-container"><img src={{'/storage/photos/avatar/'.$setting->logo_url}}  class="h-100"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse m-0" id="navbarNav">
            <ul class="navbar-nav w-100 pr-4 pr-md-5 ml-md-4 h-100">
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{route('home')}}">صفحه اصلی </a>
                    <div class="triangle-up position-absolute"></div>
                </li>
                @foreach ($parentCategories as $category)
                    @if(count($category->articles))
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('news.category',$category->slug)}}">{{$category->name}}</a>
                            @if(count($category->childrenRecursive))
                                <ul class="dropdown-menu bg-dark" role="menu">
                                    @foreach($category->childrenRecursive as $child)
                                        <li >
                                            <a href="{{route('news.category',$category->slug)}}">{{$child->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
                @if($photoArticleCount>0 || $videoArticleCount>0 || $soundArticleCount>0)
                    <li class="nav-item dropdown">
                    <a class="nav-link" >چند رسانه ای</a>
                    <ul class="dropdown-menu bg-dark" role="menu">
                        @if($photoArticleCount>0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('news.photo')}}">عکس</a>
                            </li>
                        @endif
                        @if($videoArticleCount>0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('news.video')}}">ویدیو</a>
                            </li>
                        @endif
                        @if($soundArticleCount>0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('news.sound')}}">صوت</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<!-- end of header -->

@yield('content')

<!-- footer -->
<div class="footer d-flex flex-column p-2 p-md-3 no-print">
    <div class="d-flex justify-content-center follow py-2 pr-2 pr-md-5">
        @if($setting->instagram)
            <a href="http://www.instagram.com/{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
        @endif
        @if($setting->twitter)
            <a href="http://www.twitter.com/{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
        @endif
        @if($setting->facebook)
            <a href="http://www.facebook.com/{{$setting->facebook}}"><i class="fab fa-facebook"></i></a>
        @endif
        @if($setting->whatsapp)
            <a href="http://www.whatsapp.com/{{$setting->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
        @endif
        @if($setting->telegram)
            <a href="https://t.me/{{$setting->telegram}}"><i class="fab fa-telegram"></i></a>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <ul class="d-flex flex-wrap navigation mb-4 pr-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">صفحه اصلی </a>
            </li>
            @foreach ($parentCategories as $category)
                @if(count($category->articles))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('news.category',$category->slug)}}">{{$category->name}}</a>
                    </li>
                @endif
            @endforeach
            @if($photoArticleCount>0)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news.photo')}}">عکس</a>
                </li>
            @endif
            @if($videoArticleCount>0)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news.video')}}">ویدیو</a>
                </li>
            @endif
            @if($soundArticleCount>0)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news.sound')}}">صوت</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('aboutus',['name'=>'درباره_ما'])}}">درباره ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('aboutus',['name'=>'تماس_با_ما'])}}">تماس با ما</a>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-column flex-md-row">
        <div class="col-12 col-md-5 d-flex flex-column flex-md-row">
            <div class="col px-0 pl-md-2">
                <h3 class="footer-title">خبرهای پر بازدید</h3>
                <div class="d-flex justify-content-start news-navigation">
                    <ul>
                        @foreach($mostVisited as $article)
                            @if ($loop->index>6) @break @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col px-0">
                <h3 class="footer-title">آخرین اخبار</h3>
                <div class="d-flex justify-content-start news-navigation">
                    <ul>
                        @foreach($latest as $article)
                            @if ($loop->index>6) @break @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <h3 class="footer-title">درباره ما</h3>
            <p class="text-justify">{!! \Illuminate\Support\Str::limit($setting->about_us,600) !!}</p>
        </div>
        <div class="col-12 col-md-4">
            <h3 class="footer-title">تماس با ما</h3>
            @if(Session::has('success'))
                <div class="alert alert-success text-right">
                    <div>{{Session('success')}}</div>
                </div>
            @endif
            <form action="{{route('form.contact')}}" method="post" autocomplete="off">
                @method('POST')
                @csrf
                <div class="form-group">
                    <input class="form-control text-white form-control-sm" type="text" name="name" id="name" placeholder="نام و نام خانوادگی">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group">
                    <input class="form-control text-white form-control-sm" type="text" id="email" name="email" placeholder="ایمیل">
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                    <textarea class="form-control text-white form-control-sm" rows="5" id="body" name="body" placeholder=""></textarea>
                    <small class="text-danger">{{ $errors->first('body') }}</small>
                </div>
                <button type="submit" class="btn btn-blue mb-2">ارسال</button>
            </form>
        </div>
    </div>
</div>
<div class="p-2 footer-end no-print">
    <p class="mb-0">News Agency  is licensed under a  Creative Commons Attribution 4.0 International License</p>
</div>
<!-- end of footer -->


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    $('.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).slideDown(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).slideUp(200);
    });

    //scroll to top
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
</script>
@yield('script')

</body>
</html>
