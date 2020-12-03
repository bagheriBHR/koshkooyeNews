<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @yield('style')

    <title>خانه خبر کشکوییه</title>
</head>
<body>
{{--header--}}
<div>header</div>

@yield('content')

<!-- footer -->
<div class="footer d-flex flex-column p-2 p-md-3">
    <div class="d-flex justify-content-center follow py-2 pr-2 pr-md-5">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-telegram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="d-flex flex-wrap navigation mb-4">
            <li class="nav-item">
                <a class="nav-link" href="#">صفحه اصلی </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">همه عناوین</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">سیاسی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">اقتصادی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">فرهنگی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">اجتماعی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">عکس</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">درباره ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">تماس با ما</a>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-column flex-md-row">
        <div class="col-12 col-md-5 d-flex flex-column flex-md-row">
            <div class="col px-0 pl-md-2">
                <h3 class="footer-title">خبرهای پر بازدید</h3>
                <div class="d-flex justify-content-start news-navigation">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col px-0">
                <h3 class="footer-title">خبرهای ویژه</h3>
                <div class="d-flex justify-content-start news-navigation">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <h3 class="footer-title">درباره ما</h3>
            <p class="text-justify">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می‌رسد و قلم‌ها و اندازه‌بندی‌ها چگونه در نظر گرفته</p>
        </div>
        <div class="col-12 col-md-4">
            <h3 class="footer-title">تماس با ما</h3>
            <form>
                <div class="form-group">
                    <input class="form-control form-control-sm" type="text" placeholder="نام و نام خانوادگی">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-sm" type="text" placeholder="ایمیل">
                </div>
                <div class="form-group">
                    <textarea class="form-control form-control-sm" rows="5" placeholder=""></textarea>
                </div>
                <button type="submit" class="btn btn-blue mb-2">ارسال</button>
            </form>
        </div>
    </div>
</div>
<div class="p-2 footer-end">
    <p class="mb-0">News Agency  is licensed under a  Creative Commons Attribution 4.0 International License</p>
</div>
<!-- end of footer -->


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@yield('script')

</body>
</html>
