@extends('frontend.layouts.master')

@section('content')
    <!-- body -->
    <div class="d-flex flex-column flex-md-row px-2 px-md-5 main my-3">
        <div class="single col-12 col-md-7 d-flex flex-column px-0 pl-md-2 ">
            <div class="bg-white p-3 border">
                <div class="mt-3">
                    <div class="col-12 d-flex flex-column flex-md-row p-0 mb-3 line position-relative d-flex justify-content-between">
                        <h2 class="title d-flex pb-2 m-0 text-right position-relative pl-5">
                            @foreach($article->categories as $category)
                                @if($category->parent_id == null)
                                    <a href="{{route('news.category',$category->slug)}}">{{$category->name}}</a>
                                @endif
                                @if($category->parent_id!=null)
                                    <span class="mr-2 d-flex align-items-center"><i class="fas fa-angle-left ml-2"></i><a href="{{route('news.category',$category->slug)}}">{{$category->name}}</a></span>
                                @endif
                            @endforeach
                        </h2>
                        <div class="d-flex share py-1 py-md-0">
                            <a class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt ml-2"></i>اشتراک گذاری
                                </a>
                                <div class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
                                    <a href="https://web.whatsapp.com/send?text={{url()->current()}}" target="_blank" class="dropdown-item text-right"><i class="fab fa-whatsapp ml-2"></i>واتس آپ</a>
                                    <a href="https://telegram.me/share/url?url={{url()->current()}}" target="_blank" class="dropdown-item text-right"><i class="fab fa-telegram ml-2"></i>تلگرام</a>
                                    <a href="https://twitter.com/home?status={{url()->current()}}" target="_blank" class="dropdown-item text-right"><i class="fab fa-twitter ml-2"></i>توییتر</a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank" class="dropdown-item text-right"><i class="fab fa-facebook ml-2"></i>فیس بوک</a>
                                </div>
                            </a>
                            <div class="d-none d-md-block"><a href="{{route('printNews',$article->id)}}" class="d-flex align-items-center h-100"><i class="fas fa-print"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- single -->
                <div class="news-info mt-4 d-flex flex-column align-items-start">
                    <h3 class="roo-titr">{{$article->roo_titr ? $article->roo_titr.' '.':' : ''}}</h3>
                    <h2 class="mb-3">{{$article->title}}</h2>
                    @if($article->summery)
                        <p class="summery">{{$article->summery}}</p>
                    @endif
                    <img src="{{'/storage'.$article->photo->path.'medium_'.$article->photo->originalName }}" class="m-2 w-100" alt="">
                    <div class="d-flex align-items-center justify-content-between mt-2 border-bottom w-100 pb-2 mb-2">
                        <div class="d-flex article_info">
                            <span class="d-flex align-items-center px-3  border-left"><i class="fa fa-eye ml-2"></i> {{$article->view_count}}</span>
                            <span class="d-flex align-items-center px-3"><i class="far fa-comment ml-2"></i> {{$comment_count}}</span>
                        </div>
                        <div class="time">{{convertToPersianNumber(\Hekmatinasser\Verta\Verta::instance($article->publish_date)->format(' %d %B، %Y') ) }}</div>
                    </div>
                    <div>{!! $article->body !!}</div>
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

            <!-- comment form -->
            <div id="commentHash" class="comment d-flex flex-column mt-3 p-3 border bg-white">
                @if(Session::has('commentsuccess'))
                    <div class="alert alert-success text-right">
                        <div>{{Session('commentsuccess')}}</div>
                    </div>
                @endif
                <h2 class="section-title">ارسال نظر</h2>
                <form method="post" action="{{route('frontend.comment.store',$article->id)}}">
                    @method('POST')
                    @csrf
                    <div class="form-row form-group">
                        <div class="col">
                            <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="نام و نام خانوادگی">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="col">
                            <input type="text"  value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="پست الکترونیکی">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <textarea type="text"  rows="5" class="form-control" name="body" id="body" placeholder="نظر خود را وارد کنید...">{{old('body')}}</textarea>
                            <small class="text-danger">{{ $errors->first('body') }}</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue">ارسال</button>
                </form>
            </div>
            <!-- end of comment form -->

            <!-- comments -->
            @if(!($article->comments->isEmpty()))
                <div class="comment d-flex flex-column mt-3 p-3 border bg-white no-print" id="replyHash">
                    <h2 class="section-title">نظرات شما</h2>
                    @if(Session::has('replysuccess'))
                        <div class="alert alert-success text-right">
                            <div>{{Session('replysuccess')}}</div>
                        </div>
                    @endif
                    @if(Session::has('replydanger'))
                        <div class="alert alert-danger text-right">
                            <div>{{Session('replydanger')}}</div>
                        </div>
                    @endif
                    @foreach($article->comments as $comment)
                        <div class="comment-card d-flex flex-column p-3 border">
                            <div class="d-flex align-items-end justify-content-between mb-2">
                                <h6>{{$comment->name}} :</h6>
                                <button class="btn-open" id="div-comment-{{$comment->id}}">پاسخ</button>
                            </div>
                            <p class="pr-3">{!! nl2br(e($comment->body)) !!}</p>
                            <div class="form-reply col-md-12" id="f-div-comment-{{$comment->id}}" style="display: none">
                                <form class=" " method="post" action="{{route('frontend.comment.reply')}}">
                                    @method('POST')
                                    @csrf
                                    <div class="d-flex">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control form-control-sm" name="rname" placeholder="نام و نام خانوادگی"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control form-control-sm" name="remail" placeholder="پست الکترونیکی"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm"  name="rbody" placeholder="توضیحات را وارد کنید..."></textarea>
                                    </div>
                                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                    <input type="hidden" name="article_id" value="{{$article->id}}">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-form">ارسال</button>
                                    </div>
                                </form>
                            </div>
                            @if(!($comment->childrenRecursive->isEmpty()))
                                @include('frontend.partials.comments', ['comments' => $comment->childrenRecursive,'article'=>$article])
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- end of comments -->

        </div>

        @include('frontend.partials.sidaber' , ['activeCommercials' => $activeCommercials])

    </div>
    <!-- end of body -->

@endsection
@section('script')
    <script>
        $(".btn-open").click(function(){
            var service = this.id;
            var service_id = '#f-' + service;
            $(service_id).toggle();
        })
    </script>
@endsection
