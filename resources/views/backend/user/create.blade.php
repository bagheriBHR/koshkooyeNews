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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ایجاد کاربر</h3>
            </div>
            @include('backend.partials.form-errors')
            <form class="customform p-3 w-100" method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('first_name')}}" class="custom-field form-control form-control-sm" id="first_name" name="first_name">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="last_name" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام خانوادگی:</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('last_name')}}" class="custom-field form-control form-control-sm" id="last_name" name="last_name">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="last_name" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام کاربری:</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('username')}}" class="custom-field form-control form-control-sm" id="username" name="username">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="password" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">رمز عبور :</label>
                    <div class="col-sm-6">
                        <input autocomplete="new-password" type="password" class="custom-field form-control form-control-sm" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="email" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ایمیل :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{old('email')}}" class="custom-field form-control form-control-sm" id="email" name="email" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نقش :</label>
                    <div class="col-sm-8 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" type="checkbox" id="checkbox1" value="is_author" name="role[]">
                            <label for="checkbox1" class="custom-field-title form-check-label mr-3 ml-3">نویسنده</label>

                            <input class="form-check-input" type="checkbox" id="checkbox2" value="is_editor" name="role[]">
                            <label for="checkbox2" class="custom-field-title form-check-label mr-3 ml-3">مدیر</label>

                            <input class="form-check-input"  type="checkbox" id="checkbox3" value="is_admin" name="role[]">
                            <label for="checkbox3" class="custom-field-title form-check-label mr-3"> مدیر ارشد</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" @if(old('status')==1) checked @endif type="radio" value="1" name="status" id="radio1">
                            <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                            <input class="form-check-input" @if(old('status')==0) checked @endif type="radio" value="0" name="status" id="radio2">
                            <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                    <input type="hidden" value="{{old('avatar')}}" name="avatar" id="avatar">
                    <div class="col-sm-6">
                        <div id="photo" class="dropzone" ></div>
                        <div class="col-3 mt-3">
                            <img src="{{'/storage/photos/avatar/'.old('avatar')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-end">
                    <div class="col-sm-8">
                        <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('backend/js/dropzone.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg,.gif,.png',
            maxFilesize: 1000, // MB
            contentsCss: "style.css",
            url: "{{ route('photo.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('avatar').value = response.url
            }
        });
    </script>
@endsection
