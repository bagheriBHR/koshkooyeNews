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
            <div class="d-flex flex-column border-bottom w-100">
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">تغییر مشخصات ({{' '.$user->first_name .' '. $user->last_name.' '}})</h3>
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
                        <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                        <div class="col-sm-4">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->first_name}}" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="last_name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام خانوادگی:</label>
                        <div class="col-sm-4">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->last_name}}" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="last_name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام کاربری:</label>
                        <div class="col-sm-4">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->username}}" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="email" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> ایمیل :</label>
                        <div class="col-sm-4">
                            <input type="text" class="custom-field form-control form-control-sm" value="{{$user->email}}" id="email" name="email" >
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="roles" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نقش :</label>
                        <div class="col-sm-2 d-flex justify-content-start">
                            <select name="role" class="w-100 custom-field">
                                <option value="is_author" {{$user->is_author ? "selected" : ""}}>نویسنده</option>
                                <option value="is_editor" {{$user->is_editor ? "selected" : ""}}>سردبیر</option>
                                <option value="is_admin" {{$user->is_admin ? "selected" : ""}}>مدیر</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center ">
                        <label for="roles" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                        <div class="col-sm-2 d-flex justify-content-start">
                            <select name="status" class="w-100 custom-field">
                                <option value="1" @if($user->status==1) selected @endif> فعال</option>
                                <option value="0" @if($user->status==0) selected @endif>غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="photo_id" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  تصویر :</label>
                        <input type="hidden" name="avatar" id="avatar" value="{{$user->avatar}}">
                        <div class="col-sm-4">
                            <div id="photo" class="dropzone form-control form-control-sm" ></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <div class="col-sm-6">
                            <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> به روز رسانی</button>
                            <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn custombutton custombutton-danger py-2 px-4">حذف </button>
                            </form>
                        </div>
                    </div>
            </form>
            </div>
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
