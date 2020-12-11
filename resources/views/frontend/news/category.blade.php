@extends('frontend.layouts.master')

@section('content')
    <div class="px-2 px-md-5 mt-3">
        <div class="col-12 d-flex p-0 mb-3 line position-relative d-flex justify-content-between">
            <h2 class="title pb-2 m-0 text-right position-relative pl-5">اخبار {{$category->name}}</h2>
        </div>
    </div>

    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main my-3">
            <div class="col-12 col-md-7 d-flex flex-column px-0 pl-md-2">
                @if(!($articles->isEmpty()))
                <!-- carousel -->
                <div class="d-flex flex-wrap">
                    <div class="px-1 w-100">
                        <div class="topitem2 w-100 px-0 position-relative border">
                            <div class="title position-absolute w-100 pr-3">
                                <h3 class="my-2">{{$articles[0]->title}}</h3>
                            </div>
                            @if($articles[0]->type==1)
                                <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-camera"></i></div>
                            @elseif($articles[0]->type==2)
                                <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-film"></i></div>
                            @elseif($articles[0]->type==3)
                                <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-volume-up"></i></div>
                            @endif
                            <a href="{{route('news.show',['id'=>$articles[0]->id,'slug'=>$articles[0]->slug])}}"><img src="{{'/storage'.$articles[0]->photo->path.'medium_'.$articles[0]->photo->originalName }}" alt="" class="h-100 w-100"></a>
                        </div>
                    </div>
                    @foreach($articles as $article)
                        @if ($loop->index<=3)
                            @if ($loop->first) @continue @endif
                            <div class="topitem2 col px-0 mx-md-1 position-relative mt-3 border">
                                <div class="title position-absolute w-100 pr-3">
                                    <h3 class="my-2">{{$article->title}}</h3>
                                </div>
                                @if($article->type==1)
                                    <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-camera"></i></div>
                                @elseif($article->type==2)
                                    <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-film"></i></div>
                                @elseif($article->type==3)
                                    <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-volume-up"></i></div>
                                @endif
                                <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}"><img src="{{'/storage'.$article->photo->path.'large_'.$article->photo->originalName }}" alt="" class="h-100 w-100"></a>
                            </div>
                        @else
                            <div class="category-item mt-3 mx-md-1">
                                <a href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}" class="d-flex flex-wrap p-2">
                                    <div class="col-12 col-md-4 px-0 position-relative">
                                        @if($article->type==1)
                                            <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-camera"></i></div>
                                        @elseif($article->type==2)
                                            <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-film"></i></div>
                                        @elseif($article->type==3)
                                            <div class="type-icon position-absolute d-flex align-items-center justify-content-center"><i class="fa fa-volume-up"></i></div>
                                        @endif
                                        <img src="{{'/storage'.$article->photo->path.'medium_'.$article->photo->originalName }}" alt="{{$article->title}}" class="w-100 h-100">
                                    </div>
                                    <div class="col-12 col-md-8 d-flex flex-column justify-content-center pl-1">
                                        <h3 class="roo-titr">لورم ایپسوم یا طرح‌نما :</h3>
                                        <h2 class="mt-3 mt-md-0">{{$article->title}}</h2>
                                        <p class="mb-2">{!! \Illuminate\Support\Str::limit($article->body,200) !!}</p>
                                        <span>{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($article->publish_date)->format(' %d %B، %Y') ) }}</span>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    <div class="w-100 mt-3 d-flex justify-content-center">{{$articles->links()}}</div>
                </div>
                <!-- end of carousel -->
                @endif
            </div>
        <!-- tabs -->
        @include('frontend.partials.sidaber' , ['activeCommercials' => $activeCommercials])
        <!-- end of tabs -->
    </div>
    <!-- end of body -->
@endsection

