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
                    <img src="{{'/storage/photos/commercials/'.$commercial->url}}" alt="" class="img-fluid">
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
                    <label for="url" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">  بنر تبلیغاتی :</label>
                    <input type="hidden" value="{{$commercial->url}}" name="url" id="url">
                    <div class="col-sm-6">
                        <div id="photo" class="dropzone form-control form-control-sm" ></div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> وضعیت :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">

                            <input class="form-check-input" @if($commercial->status==0) checked @endif type="radio" value="0" name="status" id="radio2">
                            <label class="custom-field-title form-check-label mx-3">غیرفعال</label>

                            <input class="form-check-input" @if($commercial->status==1) checked @endif type="radio" value="1" name="status" id="radio1">
                            <label class="custom-field-title form-check-label mx-3">فعال</label>

                            <input class="form-check-input" @if($commercial->status==2) checked @endif type="radio" value="2" name="status" id="radio3">
                            <label class="custom-field-title form-check-label mr-3">آرشیو</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center ">
                    <label for="roles" class="required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نوع سرویس دهی :</label>
                    <div class="col-sm-6 d-flex justify-content-start">
                        <div class="col-sm-8 text-right pr-md-0">
                            <input class="form-check-input" @if($commercial->type==0) checked @endif type="radio" value="0" name="type" id="radio1">
                            <label class="custom-field-title form-check-label mr-3 ml-3">تعداد کلیک</label>

                            <input class="form-check-input" @if($commercial->type==1) checked @endif type="radio" value="1" name="type" id="radio2">
                            <label class="custom-field-title form-check-label mr-3">بازه زمانی</label>
                        </div>
                    </div>
                </div>
                <div id="type0" class="desc">
                    <div class="form-group row d-flex align-items-center">
                        <label for="click_count" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">تعداد کلیک :</label>
                        <div class="col-sm-6">
                            <input type="number" value="{{$commercial->click_count}}" class="custom-field form-control form-control-sm" id="click_count" name="click_count">
                        </div>
                    </div>
                </div>
                <div id="type1" class="desc">
                    <div class="form-group row d-flex align-items-center">
                        <label for="start_at" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تاریخ شروع :</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$commercial->start_at}}" class="custom-field form-control form-control-sm" id="input2" name="start_at" />
                            <span id="span2"></span>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="finish_at" class=" required custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> تاریخ پایان :</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$commercial->finish_at}}" class="custom-field form-control form-control-sm" id="input1" name="finish_at" />
                            <span id="span1"></span>
                        </div>
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

        $(document).ready(function() {
            if({{$commercial->type}}){
                $("div.desc").hide();
                $("#type1").show();
            }else{
                $("div.desc").hide();
                $("#type0").show();
            }
            $("input[name$='type']").click(function() {
                var test = $(this).val();

                $("div.desc").hide();
                $("#type" + test).show();
            });
        });

        $(function() {
            $("#input1, #span1").persianDatepicker();
            $("#input2, #span2").persianDatepicker();
        });

        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg,.gif,.png',
            maxFilesize: 1000, // MB
            contentsCss: "style.css",
            url: "{{ route('banner.upload') }}",
            sending: function(file, xhr, formData){
                formData.append("_token","{{csrf_token()}}")
            },
            success: function(file, response){
                document.getElementById('url').value = response.url
            }
        });
    </script>
@endsection
