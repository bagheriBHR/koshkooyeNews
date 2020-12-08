@extends('frontend.layouts.master')

@section('content')
    <!-- body -->
    <div class="d-flex justify-content-between align-items-center bg-white border mx-2 mx-md-5 p-3 print mt-2">
        <div class="col-12 col-md-3"><img src={{'/storage/photos/avatar/'.$setting->logo_url}}  class="w-100"></div>
        <div class="d-flex flex-column align-items-start col-12 col-md-3">
            <h6 class="mb-3">گروه : {{$article->categories[0]->name}}</h6>
            <h6>تاریخ : {{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($article->publish_date)->format('Y-n-j H:i') ) }}</h6>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main my-2">
        <div class="single col-12 d-flex flex-column px-0">
            <div class="bg-white p-3 border">
                <!-- single -->
                <div class="news-info mt-4 d-flex flex-column align-items-start">
                    <h3 class="roo-titr">{{$article->roo_titr ? $article->roo_titr.' '.':' : ''}}</h3>
                    <h2 class="mb-3">{{$article->title}}</h2>
                    @if($article->summery)
                        <p class="summery">{{$article->summery}}</p>
                    @endif
                    @if($article->type==0)
                        <img src="{{'/storage'.$article->photo->path.'medium_'.$article->photo->originalName }}" class="w-100" alt="">
                    @endif
                    <p>{!! $article->body !!}</p>
                    @if($article->type==1)
                        <div class="w-100 d-flex flex-wrap">
                            @foreach($article->photos as $photo)
                                <div class="col-12 col-md-6 mb-3 px-2">
                                    <img src="{{'/storage'.$photo->path.$photo->originalName}}" class="w-100">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($article->type==2)
                        <video width="100%" controls>
                            <source src="{{ '/storage'. $article->video_url }}" type="video/mp4">
                            مرورگر شمااین ویدیورا پشتیبانی نمی کند.
                        </video>
                    @endif
                    @if($article->type==3)
                        <audio controls style="width: 100%">
                            <source src="{{ '/storage'. $article->video_url }}">
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                            مرورگر شمااین ویدیورا پشتیبانی نمی کند.
                        </audio>
                    @endif
                    <div class="d-flex justify-content-start mt-2 border-top w-100 pt-2">
                        @if($article->reporter)
                            <span class="end ml-4">خبرنگار : {{$article->reporter}}</span>
                        @endif
                        @if($article->photographer)
                            <span class="end d-flex align-items-center"><i class="ml-2 {{$article->type==1 ? 'fa fa-camera' : 'fa fa-film'}}"></i> {{$article->photographer}}</span>
                        @endif
                    </div>
                    @if($article->media_source)
                        <span class="end mt-2">منبع خبر : {{$article->media_source}}</span>
                    @endif
                    <span class="end mt-3">انتها پیام /</span>
                    <div class="tagCard d-flex flex-wrap mt-3 d-flex align-items-center">
                        @foreach($article->tags as $tag)
                            <div class="px-2 py-1 tagItem"><a href="{{route('news.tag',make_slug($tag->name))}}">{{$tag->name}}</a></div>
                        @endforeach
                    </div>
                </div>
                <!-- end of single -->
            </div>
        </div>
    </div>
    <!-- end of body -->

@endsection
@section('script')
    <script type="text/javascript">
        <!--
        window.print();
        //-->
    </script>
@endsection

