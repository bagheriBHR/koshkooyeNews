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
                    <i class="fa fa-users ml-2"></i>مدیریت کاربران
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.index')}}"><i class="fa fa-list ml-2"></i>مشاهده لیست کاربران</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('user.create')}}"><i class="fa fa-user-plus ml-2"></i>افزودن کاربر</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <div class="col-12 col-md-10 d-flex flex-column align-items-start">
            @include('backend.partials.form-errors')
            <form class="customform p-3 w-100" method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="first_name" name="first_name">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="last_name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام خانوادگی:</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="last_name" name="last_name">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="last_name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام کاربری:</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="username" name="username">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="password" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">رمز عبور :</label>
                    <div class="col-sm-4">
                        <input autocomplete="new-password" type="password" class="custom-field form-control form-control-sm" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="email" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ایمیل :</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="email" name="email" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نقش :</label>
                    <div class="col-sm-2 d-flex justify-content-start">
                        <select name="role" class="w-100 custom-field">
                            <option value="is_author">نویسنده</option>
                            <option value="is_editor">سردبیر</option>
                            <option value="is_admin">مدیر</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                    <div class="col-sm-2 d-flex justify-content-start">
                        <select name="status" class="w-100 custom-field">
                            <option value="1"> فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                    <input type="hidden" name="avatar" id="avatar">
                    <div class="col-sm-4">
                        <div id="photo" class="dropzone form-control form-control-sm" ></div>
                    </div>
                </div>
                <div class="d-flex align-items-end">
                    <div class="col-sm-6">
                        <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('/js/dropzone.min.js')}}"></script>
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
