@extends('backend.layouts.master')
@section('content')
    <div class="d-flex flex-column flex-md-row w-100 h-100">

        <!-- sidebar -->
        <div class="col-12 col-md-2 px-0 pl-md-2 h-100">
            @include('backend.partials.rightSidebar')
        </div>
        <!-- end of sidebar -->

        <div class="scroll col-12 col-md-10 px-0 px-md-4 mt-3 d-flex flex-column align-items-start pb-3">
            <div class="d-flex flex-column border-bottom w-100">
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">دیدگاه شماره {{$comment->id}}</h3>
            </div>
            @include('backend.partials.form-errors')
            <div class="d-flex flex-column bg-white w-100 mt-3">
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class=" custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">نام و نام خانوادگی :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="custom-field form-control form-control-sm" value="{{$comment->name}}" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class=" custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">ایمیل :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="custom-field form-control form-control-sm" value="{{$comment->email}}" id="title" name="title">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="title" class=" custom-field-title col-sm-2 col-form-label text-right font-weight-bold mr-2">دیدگاه :</label>
                    <div class="col-sm-6">
                        <textarea type="text" readonly class="custom-field form-control form-control-sm" id="title" name="title">{{$comment->body}}</textarea>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="col-sm-8 px-0">
                        @if($comment->status==0)
                            <form action="{{route('comment.action',$comment->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="action" value="publish">
                                <button type="submit" class="btn btn custombutton custombutton-success py-2 px-4">تایید</button>
                            </form>
                        @else
                            <form action="{{route('comment.action',$comment->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="action" value="deactive">
                                <button type="submit" class="btn btn custombutton custombutton-danger py-2 px-4" >عدم تایید</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
