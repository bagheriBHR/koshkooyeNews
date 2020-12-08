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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست نظرات</h3>
            </div>
            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 mb-3 mb-md-0 px-0">
                    @if(Session::has('danger'))
                        <div class="alert alert-danger text-right w-100">
                            <div>{{Session('danger')}}</div>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success text-right w-100">
                            <div>{{Session('success')}}</div>
                        </div>
                    @endif
                    @if(Session::has('warning'))
                        <div class="alert alert-warning text-right w-100">
                            <div>{{Session('warning')}}</div>
                        </div>
                    @endif
                    @if(count($comments))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">نام و نام خانوادگی</th>
                                <th class="text-right">ایمیل</th>
                                <th class="text-right">دیدگاه</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $key=>$comment)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-right"><a href="{{route('comment.show',$comment->id)}}">{{$comment->name}}</a></td>
                                    <td class="text-right">{{$comment->email}}</td>
                                    <td class="text-right">{{\Illuminate\Support\Str::limit($comment->body),40}}</td>
                                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDate() }}</td>
                                    <td class="">
                                        <div class="d-flex justify-content-end">
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">موردی یافت نشد.</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- end of tables -->
            <div class="w-100 mt-3 d-flex justify-content-center">{{$comments->links()}}</div>
        </div>
    </div>
@endsection
