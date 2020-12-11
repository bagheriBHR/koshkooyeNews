<script type="text/javascript">
    $(".btn-open").click(function(){
        $('.form-reply').css('display', 'none');
        var service = this.id;
        var service_id = '#f-' + service;
        $(service_id).show('slow');
    })
</script>
<div class="col-md-12 pl-0">
    @foreach($comments as $comment)
        <div class="subComment pr-5 border-top pt-3 mt-3">
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
                            <input type="text" class="form-control form-control-sm" name="name" placeholder="نام و نام خانوادگی"/>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control form-control-sm" name="email" placeholder="پست الکترونیکی"/>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea type="text" rows="10" class="custom-field form-control form-control-sm"  name="body" placeholder="توضیحات را وارد کنید..."></textarea>
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
