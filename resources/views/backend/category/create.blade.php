@extends('backend.layouts.master')

@section('content')
    <div class="d-flex flex-column flex-md-row w-100 mt-3">

        <!-- sidebar -->
        <div class="sidebar col-12 col-md-2 pr-md-0">
            <p>
                <a class="btn btntitle w-100 text-right"  data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-users ml-2"></i>مدیریت دسته بندی ها
                </a>
            </p>
            <div class="collapse show" id="collapseExample2">
                <div class="card card-body mb-4 border-0 p-0">
                    <table class="w-100 text-right">
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.index')}}"><i class="fa fa-list ml-2"></i>مشاهده لیست دسته بندی ها</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-2 font-weight-bold"><a href="{{route('category.create')}}"><i class="fa fa-plus ml-2"></i>افزودن دسته بندی</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <div class="col-12 col-md-10 d-flex flex-column align-items-start">
            @include('backend.partials.form-errors')
            <form class="customform p-3 w-100" method="post" action="{{route('category.store')}}">
                @method('POST')
                @csrf
                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام :</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="name" name="name">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="slug" class="custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2"> نام مستعار:</label>
                    <div class="col-sm-4">
                        <input type="text" class="custom-field form-control form-control-sm" id="slug" name="slug">
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
