@extends('backend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/persianDatepicker-default.css')}}">
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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">فرم ویرایش تبلیغ</h3>
            </div>
            @include('backend.partials.form-errors')
            <div class="d-flex flex-column flex-md-row bg-white w-100">
                <div class="col-12 col-md-2 mt-3">
                    @if ($commercial->photo->originalName=='webm')
                        <video width="100px">
                            <source src="{{'/storage'.$commercial->photo->path}}" type="video/mp4" >
                        </video>
                    @else
                        <img src="{{'/storage'.$commercial->photo->path}}" alt="" class="my-1" style="width:100px;">
                    @endif
                </div>
                <form class="col-12 col-md-10 customform p-3 w-100" method="post" action="{{route('commercial.update',$commercial->id)}}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">عنوان :</label>
                    <div class="col-sm-6">
                        <input type="text" class="custom-field form-control form-control-sm" value="{{$commercial->title}}" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="banner" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  بنر تبلیغاتی :</label>
                    <input type="hidden" value="{{$commercial->banner}}" name="banner" id="banner">
                    <div class="col-sm-6">
                        <div id="photo" class="dropzone" ></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="click_count" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تعداد کلیک :</label>
                    <div class="col-sm-6">
                        <input type="number" value="{{$commercial->total_click}}" class="custom-field form-control form-control-sm" id="click_count" name="total_click">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="url" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">آدرس :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$commercial->url}}" class="custom-field form-control form-control-sm" id="url" name="url">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="start_at" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تاریخ شروع :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$commercial->start_date}}" class="custom-field form-control form-control-sm" id="input3" name="start_date" />
                        <span id="span3"></span>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="finish_at" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تاریخ پایان :</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$commercial->finish_date}}" class="custom-field form-control form-control-sm" id="input1" name="finish_date" />
                        <span id="span1"></span>
                    </div>
                </div>
                <div class="d-flex align-items-end">
                    <div class="col-sm-8 px-0">
                        <button type="submit" class="btn custombutton custombutton-success py-2 px-4"> ذخیره</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('backend/js/dropzone.js')}}"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{{asset('backend/js/persianDatepicker.min.js')}}"></script>
    <script>
        $(function() {
            $("#input1, #span1").persianDatepicker();
            $("#input3, #span3").persianDatepicker();
        });

        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg,.gif,.png,.webm',
            maxFilesize: 1000, // MB
            contentsCss: "style.css",
            url: "{{ route('banner.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('banner').value = response.url
            }
        });
    </script>
@endsection
