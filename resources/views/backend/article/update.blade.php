@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dropzone.min.css')}}">
@endsection
@section('content')
    <div class="d-flex flex-column flex-md-row w-100 h-100">

        <!-- sidebar -->
        <div class="col-12 col-md-2 px-0 pl-md-2 h-100">
            @include('backend.partials.rightSidebar')
        </div>
        <!-- end of sidebar -->

        <div class="scroll col-12 col-md-10 px-0 px-md-4 mt-3 d-flex flex-column align-items-start pb-3">
            <div class="d-flex flex-column border-bottom w-100">
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ویرایش مقاله ({{$article->title}})</h3>
            </div>
            @include('backend.partials.form-errors')
            @if(Session::has('danger'))
                <div class="alert alert-danger text-right w-100">
                    <div>{{Session('danger')}}</div>
                </div>
            @endif
            <div class="d-flex flex-column flex-md-row bg-white w-100">
                <div class="col-12 col-md-2 mt-3">
                    <img src="{{'/storage'.$article->photo->path.'small_'.$article->photo->originalName }}" alt="" class="img-fluid mb-3">
                    @if ($article->video_url)
                        <video width="100%" controls>
                            <source src="{{ '/storage'. $article->video_url }}" type="video/mp4">
                            مرورگر شمااین ویدیورا پشتیبانی نمی کند.
                        </video>
                    @endif
                </div>
                <form class="customform p-3 col-12 col-md-10" method="post" action="{{route('article.update',$article->id)}}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" value="{{$article->title}}" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام مستعار:</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" value="{{$article->slug}}" id="slug" name="slug">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="roo_titr" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">روتیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" value="{{$article->roo_titr}}" id="roo_titr" name="roo_titr">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> متن خبر:</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" rows="10" id="body" name="body" >{{$article->body}}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="summery" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">خلاصه خبر :</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm" rows="10" id="summery" name="summery" >{{$article->summery}}</textarea>
                    </div>
                </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی خبر:</label>
                        <div class="col-sm-6">
                            <select id="categoryList" name="category_id" class="custom-field form-control form-control-sm">
                                <option value="">انتخاب کنید...</option>
                                @foreach($categories as $category_list)
                                    <option value="{{$category_list->id}}"
                                        @foreach($article->categories as $item)
                                        {{$item->id == $category_list->id ? "selected" : ""}}
                                        @endforeach>{{$category_list->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="body" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> زیر دسته بندی خبر:</label>
                            <div class="col-sm-6">
                                <select id="subcategoryList" class="custom-field form-control form-control-sm" name="subcategory_id">
                                    <option value="">انتخاب کنید...</option>
                                    @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                    class='parent-{{ $subcategory->parent_id }} subcategory'
                                                    @foreach($article->categories as $item)
                                                        {{$item->id == $subcategory->id ? "selected" : ""}}
                                                    @endforeach>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label for="photo_id" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر اصلی :</label>
                            <input type="hidden" name="thumbnail" id="thumbnail" value="{{$article->thumbnail}}">
                            <div class="col-sm-6">
                                <div id="photo" class="dropzone" ></div>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center ">
                            <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نوع خبر:</label>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <div class="col-sm-8 text-right pr-md-0">
                                    <input class="form-check-input" @if($article->type==0) checked @endif type="radio" value="0" name="type" id="radio1">
                                    <label class="custom-field-title form-check-label mx-3">متن</label>

                                    <input class="form-check-input" @if($article->type==1) checked @endif type="radio" value="1" name="type" id="radio2">
                                    <label class="custom-field-title form-check-label mx-3">عکس</label>

                                    <input class="form-check-input" @if($article->type==2) checked @endif type="radio" value="2" name="type" id="radio3">
                                    <label class="custom-field-title form-check-label mx-3">فیلم</label>

                                    <input class="form-check-input" @if($article->type==3) checked @endif  type="radio" value="3" name="type" id="radio4">
                                    <label class="custom-field-title form-check-label mx-3">صوت</label>
                                </div>
                            </div>
                        </div>
                        <div id="type1" class="desc">
                            <div class="form-group row d-flex align-items-center">
                                <label for="photo" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> گالری تصاویر :</label>
                                <input type="hidden" name="image_url[]" id="image_url">
                                <div class="col-sm-6">
                                    <div id="articlePhoto" class="dropzone mb-3"></div>
                                    @if($article->photos)
                                        <div class="row">
                                            @foreach($article->photos as $photo)
                                                <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                                    <img src="{{'/storage'.$photo->path.$photo->originalName}}" class="w-100">
                                                    <button type="button" class="btn btn-danger mx-1 my-0" onclick="removeImages({{$photo->id}})">حذف</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="type2" class="desc media2 media3">
                            <div class="form-group row d-flex align-items-center">
                                <label for="video" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  آپلود فایل :</label>
                                <input type="hidden" name="video_url" id="article_video" value="{{$article->video_url}}">
                                <div class="col-sm-6">
                                    <div id="video" class="dropzone" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="desc media1 media2 media3">
                            <div class="form-group row d-flex align-items-center ">
                                <label for="photographer" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تصویربردار :</label>
                                <div class="col-sm-6 d-flex justify-content-start">
                                    <input type="text" class="custom-field form-control form-control-sm" value="{{$article->photographer}}" id="photographer" name="photographer">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center ">
                                <label for="media_source" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> منبع فایل :</label>
                                <div class="col-sm-6 d-flex justify-content-start">
                                    <input type="text" placeholder="www.youtobe.com" class="custom-field form-control form-control-sm" value="{{$article->media_source}}" id="media_source" name="media_source">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center ">
                            <label for="reporter" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> خبرنگار :</label>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <input type="text" class="custom-field form-control form-control-sm" value="{{$article->reporter}}" id="reporter" name="reporter">
                            </div>
                        </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="tag" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تگ ها :</label>
                        <div class="col-sm-6 text-right">
                            <input type="text" placeholder="تگها را با علامت کاما(،) از هم جدا کنید." class="mb-2 custom-field form-control form-control-sm" name="tag">
                            <div class="row">
                                @foreach($article->tags as $tag)
                                    <div class=" ml-4 d-flex position-relative mb-4"  id="updated_tag_{{$tag->id}}">
                                        <span id="output" class="px-2 py-0 bg-primary text-white"> {{ $tag->name }}</span>
                                        <div class="remove px-1 text-right">
                                            <input class="form-check-input" type="checkbox" id="checkbox_tag_{{$tag->id}}" name="removedTags[]" value="{{$tag->name}}">
                                            <label for="checkbox_tag_{{$tag->id}}" class="custom-field-title form-check-label mr-3">حذف</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت نشر :</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <select name="publish_status" class="w-100 custom-field">
                                <option value="0" @if ($article->publish_status==0) selected @endif> پیشنویس</option>
                                <option value="1" @if ($article->publish_status==1) selected @endif>انتشار یافته</option>
                                <option value="2" @if ($article->publish_status==2) selected @endif>آرشیو</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نمایش در اسلایدر :</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if ($article->is_carousel==0) checked @endif type="radio" value="0" name="is_carousel" id="radio2">
                                <label class="custom-field-title form-check-label mx-3">غیرفعال</label>

                                <input class="form-check-input" @if ($article->is_carousel==1) checked @endif type="radio" value="1" name="is_carousel" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center ">
                        <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">خبر مهم :</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if ($article->is_important==0) checked @endif type="radio" value="0" name="is_important" id="radio2">
                                <label class="custom-field-title form-check-label mx-3">خیر</label>

                                <input class="form-check-input" @if ($article->is_important==1) checked @endif type="radio" value="1" name="is_important" id="radio1">
                                <label class="custom-field-title form-check-label mr-3">بله</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="col-sm-8 px-0">
                            <button onclick="articleGallery()" type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endsection
    @section('script')

        <script type="text/javascript" src="{{asset('backend/js/dropzone.js')}}"></script>
        <script src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
        <script>

            $(document).ready(function() {
                $("div.desc").hide();
                $("#type"+{{$article->type}}).show();
                $("div.media"+{{$article->type}}).show();
                $("input[name$='type']").click(function() {
                    var test = $(this).val();

                    $("div.desc").hide();
                    $("#type" + test).show();
                    $("div.media"+test).show();
                });

                $("#subcategoryList").attr('disabled', false); //enable subcategory select
                $(".subcategory").attr('disabled', true); //disable all category option
                $(".subcategory").hide(); //hide all subcategory option
                $(".parent-" + $('#categoryList').val()).attr('disabled', false); //enable subcategory of selected category/parent
                $(".parent-" + $('#categoryList').val()).show();
            });

            $('#categoryList').on('change', function () {
                $("#subcategoryList").attr('disabled', false); //enable subcategory select
                $("#subcategoryList").val("");
                $(".subcategory").attr('disabled', true); //disable all category option
                $(".subcategory").hide(); //hide all subcategory option
                $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
                $(".parent-" + $(this).val()).show();
            });

            var drop = new Dropzone('#photo', {
                addRemoveLinks: true,
                maxFiles: 1,
                acceptedFiles: '.jpg, .jpeg,.gif,.png',
                maxFilesize: 100, // MB
                contentsCss: "style.css",
                url: "{{ route('thumbnail.upload') }}",
                sending: function(file, xhr, formData){
                    formData.append("_token","{{csrf_token()}}")
                },
                success: function(file, response){
                    document.getElementById('thumbnail').value = response.url
                }
            });

            var drop1 = new Dropzone('#video', {
                addRemoveLinks: true,
                acceptedFiles: '.mp4',
                maxFilesize: 1000, // MB
                timeout: 0,
                maxFiles: 1,
                url: "{{ route('video.upload') }}",
                sending: function(file, xhr, formData){
                    formData.append("_token","{{csrf_token()}}")
                },
                success: function(file, response){
                    document.getElementById('article_video').value = response.url
                }
            });

            var photos = [].concat({{$article->photos->pluck('id')}})
            var photosGallery = []
            var drop3 = new Dropzone('#articlePhoto', {
                addRemoveLinks: true,
                acceptedFiles: '.jpg, .jpeg,.gif,.png',
                maxFilesize: 100, // MB
                contentsCss: "style.css",

                url: "{{ route('gallery.upload') }}",
                sending: function(file, xhr, formData){
                    formData.append("_token","{{csrf_token()}}")
                },
                success: function(file, response){
                    photosGallery.push(response.url)
                }
            });
            articleGallery = function(){
                document.getElementById('image_url').value = photosGallery.concat(photos);
                document.getElementById('removed_tags').value = removedTags;
            }


            CKEDITOR.replace('textareaDescription',{
                customConfig: 'config.js',
                toolbar: 'simple',
                language: 'fa',
                removePlugins: 'cloudservices, easyimage',
                filebrowserUploadUrl: "{{route('photo.ck_upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
            })

            removeImages = function(id){
                var index = photos.indexOf(id)
                photos.splice(index, 1);
                document.getElementById('updated_photo_' + id).remove();
            }

        </script>
    @endsection
