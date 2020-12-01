@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}">
    <style>
        .required:after {
            content:" * ";
            color: red;
        }
    </style>
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
            <form class="customform p-3 w-100" method="post" action="{{route('article.store')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام مستعار:</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" id="slug" name="slug">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="roo_titr" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">روتیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" id="roo_titr" name="roo_titr">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> متن خبر:</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" rows="10" id="body" name="body" ></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="summery" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">خلاصه خبر :</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="custom-field form-control form-control-sm" rows="10" id="summery" name="summery" ></textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی خبر:</label>
                    <div class="col-sm-6">
                        <select name="category_id[]" class="w-100 custom-field" multiple>
                            <option value="">با نگه داشتن کلید Cntrl چندین دسته بندی را انتخاب کنید...</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="tag" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تگ ها :</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="تگها را با علامت کاما(،) از هم جدا کنید." class="custom-field form-control form-control-sm" id="tag" name="tag">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="author" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نویسنده :</label>
                    <div class="col-sm-4 d-flex justify-content-start">
                        <select name="author_id" class="w-100 custom-field">
                            <option value="">انتخاب کنید...</option>
                            @foreach($authors as $author)
                                <option value="{{$author->id}}" >{{$author->first_name.' '.$author->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت نشر :</label>
                    <div class="col-sm-4 d-flex justify-content-start">
                        <select name="publish_status" class="w-100 custom-field">
                            <option value="0" selected> پیشنویس</option>
                            <option value="1">انتشار یافته</option>
                            <option value="2">آرشیو</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="publish_status" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نمایش در کروسل :</label>
                    <div class="col-sm-4 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" checked type="radio" value="1" name="is_carousel" id="radio1">
                            <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                            <input class="form-check-input" checked type="radio" value="0" name="is_carousel" id="radio2">
                            <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر اصلی :</label>
                    <input type="hidden" name="thumbnail" id="thumbnail">
                    <div class="col-sm-6">
                        <div id="photo" class="dropzone" ></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">گالری تصاویر</label>
                    <input type="hidden" name="image_url[]" id="image_url">
                    <div class="col-sm-6">
                        <div id="articlePhoto" class="dropzone"></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="video" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  ویدیو :</label>
                    <input type="hidden" name="video_url" id="article_video">
                    <div class="col-sm-6">
                        <div id="video" class="dropzone" ></div>
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

    <script type="text/javascript" src="{{asset('/js/dropzone.js')}}"></script>
    <script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script>
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
            maxFilesize: 100, // MB
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
            document.getElementById('image_url').value = photosGallery
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
