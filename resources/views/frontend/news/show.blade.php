@extends('frontend.layouts.master')

@section('content')
    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main mt-3">
        <div class="single col-12 col-md-7 d-flex flex-column px-0 pl-md-2 ">
            <div class="bg-white p-3 border">
                <div class="mt-3">
                    <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
                        <h2 class="title d-flex pb-2 m-0 text-right position-relative pl-5"><a href="#">اقتصادی</a><span class="mr-2 d-flex align-items-center"><i class="fas fa-angle-left ml-2"></i><a href="#">نفت</a></span></h2>
                        <div class="d-flex share">
                            <a class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt ml-2"></i>اشتراک گذاری
                                </a>
                                <div class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item text-right"><i class="fab fa-instagram ml-2"></i>اینستاگرام</a>
                                    <a href="#" class="dropdown-item text-right"><i class="fab fa-whatsapp ml-2"></i>واتس آپ</a>
                                    <a href="#" class="dropdown-item text-right"><i class="fab fa-telegram ml-2"></i>تلگرام</a>
                                    <a href="#" class="dropdown-item text-right"><i class="fab fa-twitter ml-2"></i>توییتر</a>
                                    <a href="#" class="dropdown-item text-right"><i class="fab fa-facebook ml-2"></i>فیس بوک</a>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center"><i class="fas fa-print ml-2"></i>چاپ خبر</a>
                        </div>
                        <div class="time position-absolute mr-auto">{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($article->publish_date)->format(' %d %B، %Y') ) }}</div>
                    </div>
                </div>

                <!-- single -->
                <div class="news-info mt-4 d-flex flex-column align-items-start">
                    <h3 class="roo-titr">{{$article->roo_titr ? $article->roo_titr.' '.':' : ''}}</h3>
                    <h2 class="mb-3">{{$article->title}}</h2>
                    <p class="summery">{{$article->summery ? $article->summery : \Illuminate\Support\Str::limit($article->body,200)}}</p>
                    <img src="./assets/img3.jpg" class="w-100" alt="">
                    <p class="mt-3">{!! $article->body !!}</p>
                    <span class="end">توسط : {{$article->user->first_name .' '.$article->user->last_name}}</span>
                     <span class="end mt-2">انتها پیام /</span>
                    <div class="tagCard d-flex flex-wrap mt-3">
                        @foreach($article->tags as $tag)
                         <div class="px-2 py-1 tagItem"><a href="{{route('news.tag',make_slug($tag->name))}}">{{$tag->name}}</a></div>
                        @endforeach
                    </div>
                </div>
                <!-- end of single -->
            </div>

            <!-- comment form -->
            <div class="comment d-flex flex-column mt-3 p-3 border bg-white">
                <h2 class="section-title">ارسال نظر</h2>
                <form>
                    <div class="form-row form-group">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="نام و نام خانوادگی">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="پست الکترونیکی">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <textarea type="text" rows="5" class="form-control" placeholder="نظر خود را وارد کنید..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue">ارسال</button>
                </form>
            </div>
            <!-- end of comment form -->

            <!-- comments -->
            <div class="comment d-flex flex-column mt-3 p-3 border bg-white">
                <h2 class="section-title">نظرات شما</h2>
                <div class="comment-card d-flex flex-column p-3 border">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <h6>نام و نام خانوادگی :</h6>
                        <button>پاسخ</button>
                    </div>
                    <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک</p>
                    <div class="subComment pr-5 border-top pt-3 mt-3">
                        <div class="d-flex align-items-end justify-content-between mb-2">
                            <h6>نام و نام خانوادگی :</h6>
                            <button>پاسخ</button>
                        </div>
                        <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک</p>
                        <div class="subComment pr-5 border-top pt-3 mt-3">
                            <div class="d-flex align-items-end justify-content-between mb-2">
                                <h6>نام و نام خانوادگی :</h6>
                                <button>پاسخ</button>
                            </div>
                            <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک</p>
                        </div>
                    </div>
                </div>
                <div class="comment-card d-flex flex-column p-3 border">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <h6>نام و نام خانوادگی :</h6>
                        <button>پاسخ</button>
                    </div>
                    <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک</p>
                </div>
                <div class="comment-card d-flex flex-column p-3 border">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <h6>نام و نام خانوادگی :</h6>
                        <button>پاسخ</button>
                    </div>
                    <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک</p>
                </div>
            </div>
            <!-- end of comments -->
        </div>

        @include('frontend.partials.sidaber')

    </div>
    <!-- end of body -->

    <!-- photos -->
    <div class="image-card d-flex flex-column py-3 px-2 px-md-5 bg-dark mt-3">
        <div class="d-flex flex-column flex-md-row">
            <div class="col-12 col-md-6 px-0 pl-md-5">
                <h2 class="section-title">خبرهای تصویری</h2>
                <div class="d-flex flex-column flex-md-row">
                    <div class="col-12 col-md-6 px-md-0">
                        <div class="d-flex flex-column">
                            <div class="col-12 mt-2 px-0 pr-md-2">
                                <div class="col p-0">
                                    <div class="topitem2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                        <img src="./assets/img3.jpg" class="w-100 h-100">
                                        <div class="title position-absolute w-100 py-1 px-3">
                                            <a href="#" class="text-justify">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 px-0 pr-md-2">
                                <div class="col p-0">
                                    <div class="topitem2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                        <img src="./assets/img2.jpg" class="w-100 h-100">
                                        <div class="title position-absolute w-100 py-1 px-3">
                                            <a href="#" class="text-justify">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column px-md-0">
                        <div class="d-flex flex-column">
                            <div class="col-12 mt-2 px-0 pr-md-2">
                                <div class="col p-0">
                                    <div class="topitem2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                        <img src="./assets/img4.jpg" class="w-100 h-100">
                                        <div class="title position-absolute w-100 py-1 px-3">
                                            <a href="#" class="text-justify">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 px-0 pr-md-2">
                                <div class="col p-0">
                                    <div class="topitem2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                        <img src="./assets/img1.jpg" class="w-100 h-100">
                                        <div class="title position-absolute w-100 py-1 px-3">
                                            <a href="#" class="text-justify">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 pr-md-5 custom-border-right mt-3 mt-md-0">
                <h2 class="section-title">خبرهای ویدیویی</h2>
                <section class="center slider w-100 pt-4 mt-0" dir="ltr">
                    <div class="position-relative">
                        <img src="./assets/video2.jpg" alt="" class="w-100 h-100">
                        <div class="h-100 w-100 video-hover position-absolute d-flex align-items-center justify-content-center">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div><img src="./assets/video2.jpg" alt="" class="w-100"></div>
                    <div><img src="./assets/video2.jpg" alt="" class="w-100"></div>
                </section>
            </div>
        </div>
    </div>
    <!-- end of photos -->
@endsection
