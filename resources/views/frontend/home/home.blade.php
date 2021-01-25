@extends('frontend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('css/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick/slick-theme.css')}}">
@endsection
@section('content')
    <!-- carousel -->
    <div class="carousel-container d-flex flex-column-reverse flex-md-row-reverse mx-2 mx-md-3 mt-3 pt-0">
        <div class="col px-0 d-flex flex-wrap side">
            @foreach($important as $article)
                <div class="col-12 col-md-6 mb-2 px-1">
                    <div class="w-100 bg-white border  d-flex flex-column align-items-start {{$importantCount>2 ? 'h-100' : ''}}">
                        <div class="w-100 position-relative">
                            <img src="{{'/storage'.$article->photo->path.'large_'.$article->photo->originalName }}" alt="" class="w-100 h-100">
                            <div class="category blue position-absolute">{{$article->categories[0]->name}}</div>
                        </div>
                        <a class="p-2 mb-0 text-justify" href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-12 col-md-7 mb-3 mb-md-0 mb-md-0 px-2 px-md-0 mt-2 mt-md-0">
            <section class="center slider w-100 mt-0" dir="ltr">
                @foreach($sliders as $article)
                    <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                        <div class="topitem2 position-relative" dir="rtl">
                            <div class="title2 position-absolute d-flex align-items-end justify-content-start w-100">
                                <h3 class="p-2 p-md-3 mb-0 w-100 text-right">{{ $article->title }}</h3>
                            </div>
                            <img  src="{{'/storage'.$article->photo->path.'large_'.$article->photo->originalName }}" alt="{{ $article->title }}" class="h-100 w-100">
                        </div>
                    </a>
                @endforeach
            </section>
        </div>
    </div>
    <!-- end of carousel -->

    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-4 main my-3">
        <div class="col-12 col-md-7 d-flex flex-column px-0 pl-md-2">
            <!-- categories -->
            @foreach($categories as $category)
                <div class="d-flex flex-column category px-3 pt-3 pb-0">
                    <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
                        <h2 class="title pb-2 m-0 text-right position-relative pl-5">{{$category->name}}</h2>
                    </div>
                    <div class="d-flex flex-column flex-md-row w-100">
                        <div class="col-12 col-md-6 d-flex flex-column right align-items-right custom-border-bottom custom-border-left mb-3 pb-3 mb-md-0 pb-md-0 pl-md-3 px-0">
                            <div class="position-relative mb-4">
                                <img src="{{'/storage'.$category->articles[0]->photo->path.'medium_'.$category->articles[0]->photo->originalName }}" class="w-100" alt="">
                                <div class="position-absolute">{{$category->name}}</div>
                            @foreach($category->articles[0]->categories as $item)
                                    @if($item->parent_id == $category->id)
                                        <div class="position-absolute">{{$item->name}}</div>
                                    @endif
                                @endforeach
                            </div>
                            <h3 class="roo-titr">{{$category->articles[0]->roo_titr ? $category->articles[0]->roo_titr : '' }}</h3>
                            <a href="{{route('news.show',['id'=>$category->articles[0]->id,'slug'=>$category->articles[0]->slug])}}">{{$category->articles[0]->title}}</a>
                            <span class="text-right">{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($category->articles[0]->publish_date)->format(' %d %B، %Y') ) }}</span>
                            @if($category->articles[0]->summery)
                                <p class="text-justify">{{$category->articles[0]->summery}}</p>
                            @else
                                <div class="mb-0">{!! \Illuminate\Support\Str::limit($category->articles[0]->body,250) !!}</div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 d-flex flex-column left px-0 pr-md-3">
                            @foreach($category->articles as $article)
                                @if ($loop->first) @continue @endif
                                <div class="d-flex section">
                                    <div class="col-3 px-0">
                                        <img src="{{'/storage'.$article->photo->path.'small_'.$article->photo->originalName }}" alt="" class="w-100">
                                    </div>
                                    <div class="col-9 d-flex flex-column justify-content-between pl-0">
                                        <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                                        <span class="my-0"><i class="far fa-clock ml-1"></i>{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($category->articles[0]->publish_date)->format(' %d %B، %Y') ) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="all d-flex justify-content-center border-top py-2 mt-2"><a href="{{route('news.category',$category->slug)}}"> نمایش همه ...</a></div>
                </div>
            @endforeach
            <!-- end of categories -->
        </div>
        @include('frontend.partials.sidaber' , ['activeCommercials' => $activeCommercials])
    </div>
    <!-- end of body -->

    <!-- photo and video news-->
        <div class="image-card d-flex flex-column py-3 px-2 px-md-5 mt-3">
            <div class=" d-flex flex-column flex-md-row">
                <div class="multimedia ol-12 col-md-6 d-flex flex-column flex-md-row pt-3 pt-md-0 px-0">
                    <div class=" col-12 col-md-6 d-flex flex-column justify-content-between px-3 px-md-0 pl-md-3">
                        @if(!($photoArticles->isEmpty()))
                        <div>
                            <h2 class="section-title d-flex align-items-start"><i class="fa fa-image ml-2"></i>خبرهای تصویری</h2>
                            <div class="d-flex flex-wrap">
                                @foreach($photoArticles as $article)
                                    <div class="d-flex section">
                                        <div class="col-3 px-0">
                                            <img src="{{'/storage'.$article->photo->path.'small_'.$article->photo->originalName }}" alt="" class="w-100">
                                        </div>
                                        <div class="col-9 d-flex flex-column justify-content-center pl-0">
                                            <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                            <div class="all2 d-flex justify-content-end py-2 mt-4"><a href="{{route('news.photo')}}"> نمایش همه </a></div>
                        @else
                            <h2 class="section-title d-flex align-items-start"><i class="fa fa-image ml-2"></i>خبرهای تصویری</h2>
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                                <h6 class="multimedia-info">خبر تصویری وجود ندارد.</h6>
                            </div>
                        @endif
                    </div>
                    <div class=" col-12 col-md-6 d-flex flex-column justify-content-between px-3 px-md-0 pr-md-3 custom-border-right">
                        @if(!($soundArticles->isEmpty()))
                        <div>
                            <h2 class="section-title d-flex align-items-start"><i class="fa fa-microphone ml-2"></i>خبرهای صوتی</h2>
                            <div class="d-flex flex-wrap">
                                @foreach($soundArticles as $article)
                                    <div class="d-flex section">
                                        <div class="col-3 px-0">
                                            <img src="{{'/storage'.$article->photo->path.'small_'.$article->photo->originalName }}" alt="" class="w-100">
                                        </div>
                                        <div class="col-9 d-flex flex-column justify-content-center pl-0">
                                            <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">{{$article->title}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="all2 d-flex justify-content-end py-2 mt-4"><a href="{{route('news.sound')}}"> نمایش همه </a></div>
                        @else
                            <h2 class="section-title d-flex align-items-start"><i class="fa fa-microphone ml-2"></i>خبرهای صوتی</h2>
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                                <h6 class="multimedia-info">خبر صوتی وجود ندارد.</h6>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-column justify-content-between videoSection pr-md-5 mr-md-3 pl-md-0 custom-border-right mt-3 mt-md-0">
                    <h2 class="section-title  d-flex align-items-center"><i class="fa fa-film ml-2"></i>خبرهای ویدیویی</h2>
                    @if(!($videoArticles->isEmpty()))
                    <section class="center slider w-100 mt-0" dir="ltr">
                        @foreach($videoArticles as $article)
                           <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                               <div class="topitem2 mt-2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                   <img src="{{'/storage'.$article->photo->path.'medium_'.$article->photo->originalName }}" class="w-100 h-100">
                                   <div class="h-100 w-100 video-hover position-absolute d-flex align-items-center justify-content-center">
                                       <i class="fas fa-play"></i>
                                   </div>
                                    <h3 class="title position-absolute w-100 py-2 px-3 px-md-4 mb-0">{{$article->title}}</h3>
                               </div>
                           </a>
                        @endforeach
                    </section>

                        <div class="all2 d-flex justify-content-end py-2 mt-4"><a href="{{route('news.video')}}"> نمایش همه </a></div>
                    @else
                        <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                            <h3 class="multimedia-info">خبر ویدیویی وجود ندارد.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('css/slick/slick.min.js')}}" charset="utf-8"></script>
    <script>
        $(document).on('ready', function() {
            $(".center").slick({
                dots: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows:true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            centerMode: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: true,
                            centerMode: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection
