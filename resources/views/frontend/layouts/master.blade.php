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
    <link rel="stylesheet" href="{{asset('css/all-frontend.min.css')}}">

    @yield('style')

    <title>خانه خبر کشکوییه</title>
</head>
<body>
<a href="javascript:" id="return-to-top" title="انتقال به بالا"><i class="fa fa-angle-up"></i></a>
@if ($setting->banner)
    <div class="w-100 banner d-none d-md-block">
        <img src="{{ '/storage/photos/avatar/'.$setting->banner}}" alt="" class="w-100">
    </div>
@endif
<!-- header -->
<div class="header d-flex flex-column no-print position-relative">
   @if ($setting->is_test == 1)
        <div class="position-absolute test">آزمایشی</div>
   @endif
    <div class="top-header d-flex flex-column flex-md-row align-items-center position-relative">
        <img src="{{asset("/images/frontend/dotted-world-map.png")}}" class="position-absolute world-pattern" alt="">
        <div class="d-flex follow py-2 pr-md-2 justify-content-center align-items-center">
            @if($setting->instagram)
                <a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
            @endif
            @if($setting->twitter)
                <a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
            @endif
             @if($setting->facebook)
                <a href="{{$setting->facebook}}"><i class="fab fa-facebook"></i></a>
            @endif
             @if($setting->whatsapp)
                <a href="{{$setting->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
            @endif
                @if($setting->telegram)
                <a href="{{$setting->telegram}}"><i class="fab fa-telegram"></i></a>
            @endif
        </div>
        <div class="search mx-2 ml-md-5">
            <form class=" position-relative my-2 my-md-0 " action="{{route('home')}}" method="post">
                @method('get')
                <input type="text"  onfocus="this.placeholder=''" onblur="this.placeholder='جستجو کنید...'" name="search" placeholder="جستجو کنید..." class="w-100">
                <a><i class="fa fa-search position-absolute search-icon"></i></a>
            </form>
        </div>
        <span class="time d-none d-md-block ml-0 ml-md-5 my-1 my-md-0 d-flex justify-content-center justify-content-md-end">{{'امروز :  '.convertToPersianNumber(\Hekmatinasser\Verta\Verta::now()->format('l %d %B %Y').' - '.\Hekmatinasser\Verta\Verta::now()->format(' H:i') ) }}</span>
    </div>
    <nav class="px-0 navbar navbar-expand-lg navbar-light py-0">
        <a class="navbar-brand py-0 position-relative pr-1 mr-0" href="{{route('home')}}">
            <div class="logo-container d-flex justify-content-md-center justify-content-start"><img src={{'/storage/photos/avatar/'.$setting->logo_url}}  class="h-100"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="middle" id="middleSize">
           <div class="bg-search">
              <div class="h-100 carousel-container pl-1 d-flex align-items-center">
                  <div class="carousel-info ml-2 text-white d-flex align-items-center justify-content-end"><i class="far fa-newspaper ml-2"></i>گزیده خبرها : </div>
                  <div id="carouselExampleControls" class="carousel vert slide w-100" data-ride="carousel">
                      <div class="carousel-inner">
                          @foreach($lastTitr as $key => $article)
                              <div class="carousel-item {{$key== 0 ? 'active' : '' }}">
                                  <a class="h-100 d-flex align-items-center justify-content-start" href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                                      <h6 class="mb-0 text-right">{{ $article->title }}</h6>
                                  </a>
                              </div>
                          @endforeach
                      </div>
                      <a class="carousel-control-prev" style="width: 10px!important;" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next carousel-control-next-costomize " style="width: 10px!important;" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
                  </div>
              </div>
           </div>
            <div class="collapse navbar-collapse m-0" id="navbarNav">
                <ul class="navbar-nav pr-4 pr-md-5 ml-md-4 h-100">
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{route('home')}}">صفحه اصلی </a>
                        <div class="triangle-up position-absolute"></div>
                    </li>
                    @foreach ($parentCategories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('news.category',$category->slug)}}">{{$category->name}}</a>
                            @if(!($category->childrenRecursive->isEmpty()))
                                <ul class="dropdown-menu bg-menu mobile-hidden" role="menu">
                                    @foreach($category->childrenRecursive as $child)
                                        <li >
                                            <a href="{{route('news.category',$child->slug)}}">{{$child->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    @if($archiveCount>0)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('news.archive')}}">آرشیو</a>
                        </li>
                    @endif
                    @if($photoArticleCount>0 || $videoArticleCount>0 || $soundArticleCount>0)
                        <li class="nav-item dropdown">
                            <a class="nav-link" >چند رسانه ای</a>
                            <ul class="dropdown-menu bg-menu" role="menu">
                                @if($photoArticleCount>0)
                                    <li class="nav-item text-right">
                                        <a href="{{route('news.photo')}}">عکس</a>
                                    </li>
                                @endif
                                @if($videoArticleCount>0)
                                    <li class="nav-item text-right">
                                        <a href="{{route('news.video')}}">ویدیو</a>
                                    </li>
                                @endif
                                @if($soundArticleCount>0)
                                    <li class="nav-item text-right">
                                        <a href="{{route('news.sound')}}">صوت</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- end of header -->

@yield('content')

<!-- footer -->
<div class="footer d-flex flex-column p-2 p-md-3 no-print">
    <div class="d-flex justify-content-center follow py-2 pr-2 pr-md-5">
        @if($setting->instagram)
            <a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
        @endif
        @if($setting->twitter)
            <a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
        @endif
        @if($setting->facebook)
            <a href="{{$setting->facebook}}"><i class="fab fa-facebook"></i></a>
        @endif
        @if($setting->whatsapp)
            <a href="{{$setting->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
        @endif
        @if($setting->telegram)
            <a href="{{$setting->telegram}}"><i class="fab fa-telegram"></i></a>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <ul class="d-flex flex-wrap navigation mb-4 pr-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">صفحه اصلی </a>
            </li>
            @foreach ($parentCategories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('news.category',$category->slug)}}">{{$category->name}}</a>
                    </li>
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
                            @if ($loop->index>5) @break @endif
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
                            @if ($loop->index>5) @break @endif
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
            <div class="text-justify">{!! \Illuminate\Support\Str::limit($setting->about_us,750) !!}</div>
        </div>
        <div class="col-12 col-md-4" id="contactHash">
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
                    <input class="form-control text-white form-control-sm" value="{{old('name')}}" type="text" name="name" id="name" placeholder="نام و نام خانوادگی">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group">
                    <input class="form-control text-white form-control-sm" value="{{old('email')}}" type="text" id="email" name="email" placeholder="ایمیل">
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                    <textarea class="form-control text-white form-control-sm" rows="5" id="body" name="body" placeholder="">{{old('body')}}</textarea>
                    <small class="text-danger">{{ $errors->first('body') }}</small>
                </div>
                <button type="submit" class="btn btn-blue mb-2">ارسال</button>
            </form>
        </div>
    </div>
</div>
<div class="p-2 px-md-3 footer-end d-flex flex-column flex-md-row no-print">
    <div class="col-12 col-md-9 d-flex justify-content-center justify-content-md-start align-items-end">
        <p class="mb-0 text-right">{{$setting->footer}}</p>
    </div>
    <div class="col-12 col-md-3 mt-1 mt-md-0 d-flex justify-content-center justify-content-md-end align-items-end">
        <p class="mb-0 design">Design by :<a href="mailto:bagheri.bhr@gmail.com" class="ml-2">B.Bagheri</a></p>
    </div>
</div>
<!-- end of footer -->


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script>

    resizeFunction();
    window.onresize = function(){resizeFunction();};

    function resizeFunction(){
        var screenW = screen.width;
        if (screenW >= 1024){
            var w = (screenW -280);
            document.getElementById('middleSize').setAttribute("style","width:"+w+"px");
        }else{
            document.getElementById("middleSize").style.width ='100%';
        }
    }

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
