@extends('frontend.layouts.master')
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
                    @foreach($articles as $article)
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

