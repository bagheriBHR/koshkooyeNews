@extends('frontend.layouts.master')

@section('content')
    <!-- carousel -->
    <div class="carousel-container d-flex flex-column flex-md-row mx-2 mx-md-5 mt-3 bg-white pb-2 pt-md-2 pt-0 border">
        <div class="col-md-2 px-0 d-none d-md-block">
            <div class="d-flex flex-column side">
                <div class="d-flex flex-column align-items-start border-bottom pb-2 mb-2 mx-2">
                    <div class="w-100 position-relative">
                        <img src="./assets/img1.jpg" alt="" class="w-100 h-100">
                        <div class="category blue position-absolute">سیاسی</div>
                    </div>
                    <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                    <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                    <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
                </div>
                <div class="mx-2 d-flex flex-column align-items-start">
                    <div class="w-100 position-relative">
                        <img src="./assets/img2.jpg" alt="" class="w-100 h-100">
                        <div class="category red position-absolute">اقتصادی</div>
                    </div>
                    <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                    <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                    <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 mb-3 mb-md-0 px-2 px-md-0 mt-2 mt-md-0">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/carousel2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>عنوان اسلاید اول</h5>
                            <p>طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/carousel3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>عنوان اسلاید دوم</h5>
                            <p>طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-2 d-flex flex-column side px-0">
            <div class="mx-2 d-flex flex-column align-items-start border-bottom pb-2 mb-2">
                <div class="w-100 position-relative">
                    <img src="./assets/img3.jpg" alt="" class="w-100 h-100">
                    <div class="category yellow position-absolute">فرهنگی</div>
                </div>
                <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
            </div>
            <div class="mx-2 d-flex flex-column align-items-start custom-border-bottom pb-2 mb-2 pb-md-0 mb-md-0">
                <div class="w-100 position-relative">
                    <img src="./assets/img4.jpg" alt="" class="w-100 h-100">
                    <div class="category green position-absolute">اجتماعی</div>
                </div>
                <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
            </div>
        </div>
        <div class="d-block d-md-none col-12 col-md-2 d-flex flex-column side px-0">
            <div class="mx-2 d-flex flex-column align-items-start border-bottom pb-2 mb-2">
                <div class="w-100 position-relative">
                    <img src="./assets/img1.jpg" alt="" class="w-100 h-100">
                    <div class="category blue position-absolute">سیاسی</div>
                </div>
                <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a href="#">
            </div>
            <div class="px-2 d-flex flex-column align-items-start">
                <div class="w-100 position-relative">
                    <img src="./assets/img2.jpg" alt="" class="w-100 h-100">
                    <div class="category red position-absolute">اقتصادی</div>
                </div>
                <h6 class="my-2 text-right">12:31 عصر - 14 آذر</h6>
                <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a href="#">
            </div>
        </div>
    </div>
    <!-- end of carousel -->

    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main mt-3">
        <div class="col-12 col-md-7 d-flex flex-column px-0 pl-md-2">
            <!-- categories -->
            <div class="d-flex flex-column category p-3">
                <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
                    <h2 class="title pb-2 m-0 text-right position-relative pl-5">اقتصادی</h2>
                    <a href="#" class="all"> نمایش همه</a>
                </div>
                <div class="d-flex flex-column flex-md-row w-100">
                    <div class="col-12 col-md-6 d-flex flex-column right align-items-right custom-border-bottom custom-border-left mb-3 pb-3 mb-md-0 pb-md-0 pr-0">
                        <div class="position-relative mb-4">
                            <img src="./assets/img3.jpg" class="w-100" alt="">
                            <div class="position-absolute">اقتصادی</div>
                        </div>
                        <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                        <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
                        <span class="text-right">شهریور 14.1399 - 0 نظر</span>
                        <p class="mb-0">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهر استفاده .</p>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column left pl-0">
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img7.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img5.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img3.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img2.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img1.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img10.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column category p-3">
                <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
                    <h2 class="title pb-2 m-0 text-right position-relative pl-5">فرهنگی و اجتماعی</h2>
                    <a href="#" class="all"> نمایش همه</a>
                </div>
                <div class="d-flex flex-column flex-md-row w-100">
                    <div class="col-12 col-md-6 d-flex flex-column right align-items-right custom-border-bottom custom-border-left mb-3 pb-3 mb-md-0 pb-md-0 pr-0">
                        <div class="position-relative mb-4">
                            <img src="./assets/img9.jpg" class="w-100" alt="">
                            <div class="position-absolute">فرهنگی و اجتماعی</div>
                        </div>
                        <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                        <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
                        <span class="text-right">شهریور 14.1399 - 0 نظر</span>
                        <p class="mb-0">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل استفاده .</p>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column left pl-0">
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img5.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img6.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img7.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img8.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img9.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img2.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column category p-3">
                <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
                    <h2 class="title pb-2 m-0 text-right position-relative pl-5">سیاسی</h2>
                    <a href="#" class="all"> نمایش همه</a>
                </div>
                <div class="d-flex flex-column flex-md-row w-100">
                    <div class="col-12 col-md-6 d-flex flex-column right align-items-right custom-border-bottom custom-border-left mb-3 pb-3 mb-md-0 pb-md-0 pr-0">
                        <div class="position-relative mb-4">
                            <img src="./assets/img1.jpg" class="w-100" alt="">
                            <div class="position-absolute">سیاسی</div>
                        </div>
                        <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                        <a href="#">لورم ایپسوم یا طرح‌نما به متنی آزمایشی و بی‌معنی در صنعت چاپ</a>
                        <span class="text-right">شهریور 14.1399 - 0 نظر</span>
                        <p class="mb-0">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری استفاده .</p>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column left pl-0">
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img10.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img4.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img1.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img3.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img5.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                        <div class="d-flex section">
                            <div class="col-3 px-0">
                                <img src="./assets/img7.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                <a href="#">لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی</a>
                                <span class="my-0">شهریور 14.1399 - 0 نظر</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of categories -->
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
