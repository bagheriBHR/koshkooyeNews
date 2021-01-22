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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست تگ ها</h3>
            </div>
            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100 mt-3">
                <div class="w-100 mb-3 mb-md-0">
                    @if(!($tags->isEmpty()))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">عنوان</th>
                                <th class="text-right">تاریخ ایجاد</th>
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $key=>$tag)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-right">{{$tag->name}}</td>
                                    <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($tag->created_at)->formatDate() }}</td>
                                    <td class="text-left">
                                        <form action="/admin/tag/{{$tag->id}}/articleList" method="post">
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" name="filter" value="tag">
                                            <button type="submit" class="btn custombutton custombutton-primary py-2 px-4">لیست مقالات </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex justify-content-center">
                            <span class="not-found">دسته بندی یافت نشد.</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- end of tables -->
            <div class="w-100 mt-3 d-flex justify-content-center">{{$tags->links()}}</div>
        </div>
    </div>
@endsection

