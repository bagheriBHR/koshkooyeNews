@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}">
@endsection
@section('content')
    <div class="d-flex flex-column flex-md-row w-100 mt-3">

        <!-- sidebar -->
        <div class="sidebar col-12 col-md-2 pr-md-0">
            <p>
                <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-users ml-2"></i>مدیریت مقاله
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('article.index')}}"><i class="fa fa-list ml-2"></i>مشاهده مقالات</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('article.create')}}"><i class="fa fa-user-plus ml-2"></i>افزودن مقاله</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <div class="col-12 col-md-10 d-flex flex-column align-items-start">
            @include('backend.partials.form-errors')
            <form class="customform p-3 w-100" method="post" action="{{route('article.store')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="roo_titr" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">روتیتر :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" id="roo_titr" name="roo_titr">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تیتر :</label>
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
                    <label for="body" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> دسته بندی خبر:</label>
                    <div class="col-sm-6">
                        <select name="category_id[]" class="w-100 custom-field" multiple>
                            <option value="">با نگه داشتن کلید Cntrl چندین دسته بندی را انتخاب کنید...</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="body" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> متن خبر:</label>
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
                <div class="form-group row d-flex align-items-center ">
                    <label for="author" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نویسنده :</label>
                    <div class="col-sm-4 d-flex justify-content-start">
                        <select name="author" class="w-100 custom-field">
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
                            <input class="form-check-input" type="radio" value="" name="is_carousel" id="radio1">
                            <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                            <input class="form-check-input" checked type="radio" value="" name="is_carousel" id="radio2">
                            <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر اصلی :</label>
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
                <div class="d-flex align-items-end">
                    <div class="col-sm-6">
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
