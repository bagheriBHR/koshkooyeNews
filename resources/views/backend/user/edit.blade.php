@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}">
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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ویرایش مشخصات ({{' '.$user->first_name .' '. $user->last_name.' '}})</h3>
            </div>
            @include('backend.partials.form-errors')
            <div class="d-flex flex-column flex-md-row bg-white w-100">
                <div class="col-12 col-md-2 mt-3">
                    <img src="{{$user->avatar ? '/storage/photos/avatar/'.$user->avatar : 'http://www.placehold.it/400'}}" alt="" class="img-fluid">
                </div>
                <form class="customform p-3 col-12 col-md-10" method="post" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="name" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                        <div class="col-sm-6">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->first_name}}" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="last_name" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام خانوادگی:</label>
                        <div class="col-sm-6">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->last_name}}" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="last_name" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام کاربری:</label>
                        <div class="col-sm-6">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->username}}" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="email" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ایمیل :</label>
                        <div class="col-sm-6">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->email}}" id="email" name="email" >
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نقش :</label>
                        <div class="col-sm-8 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if($user->is_author==1) checked @endif type="checkbox" id="checkbox1" value="is_author" name="role[]">
                                <label for="checkbox1" class="custom-field-title form-check-label mr-3 ml-3">نویسنده</label>

                                <input class="form-check-input" @if($user->is_editor==1) checked @endif type="checkbox" id="checkbox2" value="is_editor" name="role[]">
                                <label for="checkbox2" class="custom-field-title form-check-label mr-3 ml-3">سردبیر</label>

                                <input class="form-check-input" @if($user->is_admin==1) checked @endif type="checkbox" id="checkbox3" value="is_admin" name="role[]">
                                <label for="checkbox3" class="custom-field-title form-check-label mr-3">مدیر</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                        <div class="col-sm-6 d-flex justify-content-start">
                            <div class="col-sm-8 text-right pr-md-0">
                                <input class="form-check-input" @if($user->status==1) checked @endif type="radio" value="1" name="status" id="radio1">
                                <label class="custom-field-title form-check-label mr-3 ml-3">فعال</label>

                                <input class="form-check-input" @if($user->status==0) checked @endif type="radio" value="0" name="status" id="radio2">
                                <label class="custom-field-title form-check-label mr-3">غیرفعال</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                        <input type="hidden" name="avatar" id="avatar" value="{{$user->avatar}}">
                        <div class="col-sm-6">
                            <div id="photo" class="dropzone form-control form-control-sm" ></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <div class="col-sm-8">
                            <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> به روز رسانی</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('/js/dropzone.js')}}"></script>
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
