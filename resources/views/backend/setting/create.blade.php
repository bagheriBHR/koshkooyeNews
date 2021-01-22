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

            @if($setting)
            <div class="scroll col-12 col-md-10 px-0 px-md-4 mt-3 d-flex flex-column align-items-start pb-3">
                <div class="d-flex flex-column border-bottom w-100">
                    <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ویرایش تنظیمات</h3>
                </div>
                @include('backend.partials.form-errors')
                <div class="d-flex flex-column flex-md-row bg-white w-100">
                    <div class="d-flex flex-column col-12 col-md-2">
                        <div class="mt-3">
                            <img src="{{ '/storage/photos/avatar/'.$setting->logo_url}}" alt="" class="img-fluid">
                        </div>
                    </div>
                <form class="customform p-3 col-12 col-md-10" method="post" action="{{route('setting.update',$setting->id)}}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="website_name" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2">نام وب سایت :</label>
                        <div class="col-sm-8">
                            <input value="{{$setting->website_name}}" type="text" class="custom-field form-control form-control-sm" id="website_name" name="website_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="logo_url" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> لوگو وب سایت :</label>
                        <input type="hidden" name="logo_url" id="logo_url" value="{{$setting->logo_url}}">
                        <div class="col-sm-8">
                            <div id="photo" class="dropzone" ></div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="logo_url" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> بنر وب سایت :</label>
                        <input type="hidden" name="banner" id="banner" value="{{$setting->banner}}">
                        <div class="col-sm-8">
                            <div id="banner-photo" class="dropzone" ></div>
                            <strong class="text-danger">* سایز عکس باید 75 : 1024 باشد.</strong>
                        @if($setting->banner)
                                <div class="w-100 d-flex justify-content-start align-items-center">
                                    <div class="mt-3">
                                        <img src="{{ '/storage/photos/avatar/'.$setting->banner}}" alt="" id="imgSrc" class="img-fluid">
                                    </div>
                                    <button id="bannerBtn" type="button" class="btn btn-danger mr-3 removeImage" onclick="deleteBanner()">حذف بنر</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="is_active" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> وضعیت وب سایت :</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if($setting->is_active==1) checked @endif  type="radio" value="1" name="is_active" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3" >فعال</label>

                                <input class="form-check-input" @if($setting->is_active==0) checked @endif type="radio" value="0" name="is_active" id="radio2">
                                <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="is_active" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> وب سایت آزمایشی :</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if($setting->is_test==1) checked @endif  type="radio" value="1" name="is_test" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3">بله</label>

                                <input class="form-check-input" @if($setting->is_test==0) checked @endif  type="radio" value="0" name="is_test" id="radio2">
                                <label class="custom-field-title form-check-label mr-3">خیر</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="body" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> تماس با ما :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" rows="10" id="contact_us" name="contact_us" >{{$setting->contact_us}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="body" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> درباره ما :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription2" rows="10" id="about_us" name="about_us" >{{$setting->about_us}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_description" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> متن پاورقی :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm " rows="2" name="footer" >{{$setting->footer}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="whatsapp" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> واتس آپ :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$setting->whatsapp}}" class="custom-field form-control form-control-sm" id="whatsapp" name="whatsapp">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="telegram" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> تلگرام :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$setting->telegram}}" class="custom-field form-control form-control-sm" id="telegram" name="telegram">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="facebook" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> فیس بوک :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$setting->facebook}}" class="custom-field form-control form-control-sm" id="facebook" name="facebook">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="twitter" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> توییتر :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$setting->twitter}}" class="custom-field form-control form-control-sm" id="twitter" name="twitter">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="instagram" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> اینستاگرام :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$setting->instagram}}" class="custom-field form-control form-control-sm" id="instagram" name="instagram">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_keyword" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> کلمات کلیدی متا :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm" rows="2" id="meta_keyword" name="meta_keyword" >{{$setting->meta_keyword}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_description" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> توضیحات متا :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm" rows="10" id="meta_description" name="meta_description" >{{$setting->meta_description}}</textarea>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-sm-11 p-0">
                            <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        @else
            <div class="scroll col-12 col-md-10 px-0 px-md-4 mt-3 d-flex flex-column align-items-start pb-3">
                <div class="d-flex flex-column border-bottom w-100">
                    <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ایجاد تنظیمات</h3>
                </div>
                @include('backend.partials.form-errors')
                <form class="customform p-3 col-12 col-md-8" method="post" action="{{route('setting.store')}}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="website_name" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2">نام وب سایت :</label>
                        <div class="col-sm-8">
                            <input  type="text" value="{{old('website_name')}}" class="custom-field form-control form-control-sm" id="website_name" name="website_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="logo_url" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> لوگو وب سایت :</label>
                        <input type="hidden" value="{{old('logo_url')}}" name="logo_url" id="logo_url">
                        <div class="col-sm-8">
                            <div id="photo" class="dropzone" ></div>
                            @if(old('logo_url'))
                                <div class="col-3 mt-2">
                                    <img src="{{'/storage/photos/avatar/'.old('logo_url')}}" alt="" class="img-fluid mb-3">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="logo_url" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> بنر وب سایت :</label>
                        <input type="hidden" value="{{old('banner')}}" name="banner" id="banner">
                        <div class="col-sm-8">
                            <div id="banner-photo" class="dropzone" ></div>
                            <strong class="text-danger">* سایز عکس باید 75 : 1024 باشد.</strong>
                        @if(old('banner'))
                                <div class="col-3 mt-2">
                                    <img src="{{'/storage/photos/avatar/'.old('banner')}}" alt="" class="img-fluid mb-3">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="is_active" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> وضعیت وب سایت :</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if(old('is_active')==1) checked @endif  type="radio" value="1" name="is_active" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                                <input class="form-check-input" @if(old('is_active')==0) checked @endif  type="radio" value="0" name="is_active" id="radio2">
                                <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="is_active" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> وب سایت آزمایشی :</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if(old('is_test')==1) checked @endif  type="radio" value="1" name="is_test" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3">بله</label>

                                <input class="form-check-input" @if(old('is_test')==0) checked @endif  type="radio" value="0" name="is_test" id="radio2">
                                <label class="custom-field-title form-check-label mr-3">خیر</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="body" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> تماس با ما :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription" rows="10" id="contact_us" name="contact_us" >{{old('contact_us')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="body" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> درباره ما :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm ckeditor" id="textareaDescription2" rows="10" id="about_us" name="about_us" >{{old('about_us')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_description" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> متن پاورقی :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm " rows="2" name="footer" >{{old('footer')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="whatsapp" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> واتس آپ :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{old('whatsapp')}}" class="custom-field form-control form-control-sm" id="whatsapp" name="whatsapp">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="telegram" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> تلگرام :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{old('telegram')}}" class="custom-field form-control form-control-sm" id="telegram" name="telegram">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="facebook" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> فیس بوک :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{old('facebook')}}" class="custom-field form-control form-control-sm" id="facebook" name="facebook">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="twitter" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> توییتر :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{old('twitter')}}" class="custom-field form-control form-control-sm" id="twitter" name="twitter">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="instagram" class="custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> اینستاگرام :</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{old('instagram')}}" class="custom-field form-control form-control-sm" id="instagram" name="instagram">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_keyword" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> کلمات کلیدی متا :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm " rows="2" id="meta_keyword" name="meta_keyword" >{{old('meta_keyword')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="meta_description" class="required custom-field-title col-sm-3 col-form-label text-right font-weight-bold mr-2"> توضیحات متا :</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="custom-field form-control form-control-sm " rows="10" id="meta_description" name="meta_description" >{{old('meta_description')}}</textarea>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-sm-11 p-0">
                            <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('backend/js/dropzone.js')}}"></script>
    <script src="{{asset('backend/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg,.gif,.png',
            maxFilesize: 100, // MB
            contentsCss: "style.css",
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('logo_url').value = response.url
            }
        });
        var drop1 = new Dropzone('#banner-photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            maxFilesize: 100, // MB
            contentsCss: "style.css",
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('banner').value = response.url
            }
        });

        CKEDITOR.replace('textareaDescription',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage',
            filebrowserUploadUrl: "{{route('photo.ck_upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        })
        CKEDITOR.replace('textareaDescription2',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: 'fa',
            removePlugins: 'cloudservices, easyimage',
            filebrowserUploadUrl: "{{route('photo.ck_upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        })

        deleteBanner = function(){
            document.getElementById('banner').value = '';
            document.getElementById('imgSrc').src = "";
            document.getElementById('bannerBtn').style.display = "none";
        }
    </script>
@endsection
