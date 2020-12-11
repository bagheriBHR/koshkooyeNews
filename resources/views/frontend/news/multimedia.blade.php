@extends('frontend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('css/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick/slick-theme.css')}}">
@endsection
@section('content')
    <div class="px-2 px-md-5 mt-3">
        <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
            <h2 class="title pb-2 m-0 text-right position-relative pl-5">گروه {{$group}}</h2>
        </div>
    </div>

    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main my-3">
        <div class="col-12 d-flex flex-column px-0 pl-md-2">
             @if(!($articles->isEmpty()))
                 <!-- carousel -->
                <div class="d-flex flex-wrap w-100">
                    @if($group=='عکس')
                        <section class="center slider col-12 mt-0" dir="ltr">
                            @foreach($articles as $article)
                                @if ($loop->index>=3) @continue @endif
                                <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                                    <div class="topitem3 topitem2 mt-2 d-flex flex-column align-items-center mt-md-0 position-relative h-100">
                                        <img src="{{'/storage'.$article->photo->path.'large_'.$article->photo->originalName }}" class="">
                                        <h3 class="title position-absolute w-100 py-2 px-3 mb-0">{{$article->title}}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </section>
                    @endif
                    @foreach($articles as $article)
                        @if ($loop->index<3 && $group=='عکس') @continue @endif
                        <div class="topitem2 col-12 col-md-3 position-relative mt-3">
                           <div class="multimedia h-100">
                               <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                                   <div class="border bg-white h-100">
                                       <div class=" position-relative">
                                           <img src="{{'/storage'.$article->photo->path.'large_'.$article->photo->originalName }}" alt="" class=" w-100">
                                       @if($article->type == 2 || $article->type == 3)
                                           <div class="h-100 w-100 video-hover position-absolute d-flex align-items-center justify-content-center">
                                               <i class="fas fa-play"></i>
                                           </div>
                                           <div class="h-100 w-100 video-hover p-2 position-absolute">
                                               <div class="customborder w-100 h-100"></div>
                                           </div>
                                       @endif
                                       </div>
                                       <div class="w-100 px-3">
                                           <h3 class="text-right my-2">{{$article->title}}</h3>
                                       </div>
                                   </div>
                               </a>
                           </div>
                        </div>
                    @endforeach
                </div>
                <!-- end of carousel -->
                <div class="w-100 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
            @endif
        </div>
    </div>
    <!-- end of body -->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('css/slick/slick.min.js')}}" charset="utf-8"></script>
    <script>
        $(document).on('ready', function() {

            $('.center').slick({
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 1,
                dots: true,
                arrows:true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection

