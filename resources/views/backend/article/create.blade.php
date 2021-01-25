@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-tagsinput.css')}}">
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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ایجاد مقاله</h3>
            </div>
            @include('backend.partials.form-errors')
            @if(Session::has('danger'))
                <div class="alert alert-danger text-right w-100">
                    <div>{{Session('danger')}}</div>
                </div>
            @endif
            <form class="customform p-3 w-100" method="post" action="{{route('article.store')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('title')}}" class="custom-field form-control form-control-sm" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام مستعار:</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('slug')}}" class="custom-field form-control form-control-sm" id="slug" name="slug">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="roo_titr" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">روتیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('roo_titr')}}" class="custom-field form-control form-control-sm" id="roo_titr" name="roo_titr">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> متن خبر:</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" rows="10" id="body" name="body" >{{old('body')}}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="summery" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">خلاصه خبر :</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm" rows="10" id="summery" name="summery" >{{old('summery')}}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی خبر:</label>
                    <div class="col-sm-6">
                        <select id="categoryList" name="category_id" class="custom-field form-control form-control-sm">
                            <option value="">انتخاب کنید...</option>
                            @foreach($categories as $category_list)
                                <option value="{{$category_list->id}}" {{old('category_id')==$category_list->id ? 'selected' : ''}}>{{$category_list->name}}</option>
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
                                    {{old('subcategory_id')==$subcategory->id ? 'selected' : ''}}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر اصلی :</label>
                    <input type="hidden" value="{{old('thumbnail')}}" name="thumbnail" id="thumbnail">
                    <div class="col-sm-6">
                        <div id="photo" class="dropzone" ></div>
                        <strong class="text-danger">* سایز عکس باید 1080 : 1920 باشد.</strong>
                        @if(session('thumbnail_url'))
                            <div class="col-3 mt-2">
                                <img src="{{ '/storage'.session('thumbnail_url')->path.'small_'.session('thumbnail_url')->originalName}}" alt="" class="img-fluid mb-3">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نوع خبر:</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" @if(old('type') && old('type')==0) checked @elseif(!old('type')) checked @endif  type="radio" value="0" name="type" id="radio1">
                            <label class="custom-field-title form-check-label mx-3">متن</label>

                            <input class="form-check-input" @if(old('type')==1) checked @endif type="radio" value="1" name="type" id="radio2">
                            <label class="custom-field-title form-check-label mx-3">عکس</label>

                            <input class="form-check-input" @if(old('type')==2) checked @endif type="radio" value="2" name="type" id="radio3">
                            <label class="custom-field-title form-check-label mx-3">فیلم</label>

                            <input class="form-check-input" @if(old('type')==3) checked @endif type="radio" value="3" name="type" id="radio4">
                            <label class="custom-field-title form-check-label mx-3">صوت</label>
                        </div>
                    </div>
                </div>
                <div id="type1" class="desc">
                    <div class="form-group row d-flex align-items-center">
                        <label for="photo" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> گالری تصاویر :</label>
                        <input type="hidden" name="image_url[]" id="image_url">
                        <div class="col-sm-6">
                            <div id="articlePhoto" class="dropzone"></div>
                            <strong class="text-danger">* سایز عکس باید 1080 : 1920 باشد.</strong>
                            @if(session('imageCount'))
                                <div class="mt-2">
                                    <p class="text-success font-weight-bold"> {{session('imageCount')}} عکس برای گالری تصاویر انتخاب شده</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="type2" class="desc media2 media3">
                    <div class="form-group row d-flex align-items-center">
                        <label for="video" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  آپلود فایل :</label>
                        <input type="hidden" value="{{old('video_url')}}" name="video_url" id="article_video">
                        <div class="col-sm-6">
                            <div id="video" class="dropzone" ></div>
                            @if(old('video_url'))
                                <div class="col-4">
                                    <video width="100%" controls>
                                        <source src="{{ '/storage'. old('video_url') }}" type="video/mp4">
                                        مرورگر شمااین ویدیورا پشتیبانی نمی کند.
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="desc media1 media2">
                    <div class="form-group row d-flex align-items-center ">
                        <label for="reporter" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تصویربردار:</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <input type="text" value="{{old('photographer')}}" class="custom-field form-control form-control-sm" id="photographer" name="photographer">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="reporter" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> منبع فایل :</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <input type="text" placeholder="www.youtobe.com" class="custom-field form-control form-control-sm" value="{{old('media_source')}}" id="media_source" name="media_source">
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="reporter" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> خبرنگار :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <input type="text" class="custom-field form-control form-control-sm" value="{{old('reporter')}}" id="reporter" name="reporter">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="tag" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تگ ها :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <input type="text"  data-role="tagsinput" class="custom-field form-control form-control-sm" value="{{old('tag')}}" id="tag" name="tag">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت نشر :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <select name="publish_status" class="w-100 custom-field">
                            <option value="0" {{old('publish_status')==0 ? 'selected' : ''}}> پیشنویس</option>
                            <option value="1" {{old('publish_status')==1 ? 'selected' : ''}}>انتشار یافته</option>
                            <option value="2" {{old('publish_status')==2 ? 'selected' : ''}}>آرشیو</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نمایش در اسلایدر :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" @if(old('is_carousel')==0) checked @endif type="radio" value="0" name="is_carousel" id="radio2">
                            <label class="custom-field-title form-check-label mx-3">غیرفعال</label>

                            <input class="form-check-input" @if(old('is_carousel')==1) checked @endif type="radio" value="1" name="is_carousel" id="radio1">
                            <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">خبر مهم :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" @if(old('is_important')==0) checked @endif type="radio" value="0" name="is_important" id="radio2">
                            <label class="custom-field-title form-check-label mx-3">خیر</label>

                            <input class="form-check-input" @if(old('is_important')==1) checked @endif type="radio" value="1" name="is_important" id="radio1">
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
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('backend/js/dropzone.js')}}"></script>
    <script src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>

        var old_type= {{ old('type') ? old('type') : 0 }};
        $(document).ready(function() {
            $("div.desc").hide();
            $("#type"+old_type).show();
            $("div.media"+old_type).show();
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
            acceptedFiles: '.mp4,.mp3,.wav',
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

        var photos = [].concat({{session('image')}})
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
            document.getElementById('image_url').value = photosGallery.concat(photos);;
        }

        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage',
            filebrowserUploadUrl: "{{route('photo.ck_upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        })
    </script>
@endsection
