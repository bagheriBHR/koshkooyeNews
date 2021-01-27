<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>صفحه درخواستی شما یافت نشد.</title>
</head>
<body class="bg-dark" dir="rtl">
<div class="down d-flex align-items-center justify-content-center">
    <div class="not-found col-9 col-md-6 p-5 d-flex flex-column align-items-center">
        <h1 class="mb-3">چنین صفحه ای موجود نیست.</h1>
        <p>احتمالاً آدرس را اشتباه تایپ کرده‌اید. برای دسترسی به وب سایت بر روی <a href="{{route('home')}}">خانه</a> کلیک کنید.</p>
        <div class="d-flex justify-content-center">
            <span class="ml-1">{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::now()->format(' %d %B %Y') ) }}</span>
{{--            <span><span class="ml-1">|</span>{{$setting?$setting->website_name:''}}</span>--}}
        </div>
    </div>
</div>
</body>
</html>
