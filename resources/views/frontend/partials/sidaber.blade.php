<!-- tabs -->
<div class="col-12 col-md-3 px-0 mt-3 mt-md-0 mb-2 no-print">
    <nav class="formTab p-0">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active d-flex align-items-center" id="most-view-tab" data-toggle="tab" href="#most-view" role="tab" aria-controls="most-view" aria-selected="true"> اخبار پر بازدید</a>
            <a class="nav-item nav-link d-flex align-items-center" id="suggestion-tab" data-toggle="tab" href="#suggestion" role="tab" aria-controls="suggestion" aria-selected="false">آخرین اخبار</a>
        </div>
    </nav>
    <div class="tab-content pt-4 px-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="most-view" role="tabpanel" aria-labelledby="most-view-tab">
            <div class="d-flex flex-column">
                @if($mostVisited)
                    @foreach($mostVisited as $key=>$article)
                    <div class="d-flex flex-column section">
                        <a class="d-flex align-items-start" href="{{route('news.show',['id'=>$article->id,'slug'=>$article->slug])}}">
                            @if($article->type==0)
                                <i class="fas fa-file-alt number"></i>
                            @elseif ($article->type==1)
                                <i class="fa fa-camera number"></i>
                            @elseif ($article->type==2)
                                <i class="fa fa-film number"></i>
                            @elseif ($article->type==3)
                                <i class="fa fa-volume-up number"></i>
                            @endif
                            <h2 class="mb-0">{{$article->title}}</h2>
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade show" id="suggestion" role="tabpanel" aria-labelledby="suggestion-tab">
            <div class="d-flex flex-column">
                @if($latest)
                    @foreach($latest as $key=>$lArticle)
                    <div class="d-flex flex-column section">
                        <a class="d-flex align-items-center" href="{{route('news.show',['id'=>$lArticle->id,'slug'=>$lArticle->slug])}}">
                            @if($lArticle->type==0)
                                <i class="fa fa-circle number" style="font-size:5px"></i>
                            @elseif ($lArticle->type==1)
                                <i class="fa fa-camera number"></i>
                            @elseif ($lArticle->type==2)
                                <i class="fa fa-film number"></i>
                            @elseif ($lArticle->type==3)
                                <i class="fa fa-volume-up number"></i>
                            @endif
                            <h2 class="mb-0">{{$lArticle->title}}</h2>
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!-- end of tabs -->

<!-- commercials -->
<div class="d-none d-md-block col-2 px-0 pr-md-2 mb-2 no-print">
        @foreach($activeCommercials as $c)
            @if ($c->photo->originalName=='webm')
                <a href="{{route('commercial.counter',$c->id)}}">
                    <video width="100%">
                        <source src="{{'/storage'.$c->photo->path}}" type="video/mp4" >
                    </video>
                </a>
            @else
                <div class="mb-2 w-100">
                    <a href="{{route('commercial.counter',$c->id)}}"><img src="{{'/storage'.$c->photo->path}}" alt="" class="w-100"></a>
                </div>
            @endif
        @endforeach
        <div class="border d-flex flex-column align-items-center justify-content-center p-3">
            <h6 class="text-gray">محل قرار گیری تبلیغات شما.</h6>
            <h6 class="text-gray">سایز 200 x ...</h6>
        </div>
</div>
<!-- end of commercials -->
