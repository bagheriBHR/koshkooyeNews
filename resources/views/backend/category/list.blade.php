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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست دسته بندی ها</h3>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100 px-3">
                <h2 class="title2 mb-0 pt-3 py-md-3 font-weight-normal">دسته بندی را برای تغییر انتخاب کنید</h2>
                <a href="{{route('category.create')}}" class="btn custombutton my-3 my-md-0 d-flex align-items-center"><i class="fa fa-plus ml-3 green"></i>افزودن دسته بندی</a>
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

                    @if(count($categories))
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
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-right">
                                        @can('update',$category)
                                            <a href="{{route('category.edit',$category->id)}}">{{$category->name}}</a>
                                        @endcan
                                        @cannot('update',$category)
                                            {{$category->name}}
                                        @endcan
                                    </td>
                                    <td class="text-right p-0">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->formatDate() }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            @if(count($category->articles)>0)
                                                <form action="/admin/category/{{$category->id}}/articleList" method="post">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="hidden" name="filter" value="category">
                                                    <button type="submit" class="btn custombutton custombutton-primary py-2 px-4">لیست مقالات </button>
                                                </form>
                                            @endif
                                            @can('delete',$category)
                                                <form action="{{route('category.destroy',$category->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('آیا از حذف دسته بندی مطمئن هستید؟');" type="submit" class=" mr-2 btn custombutton custombutton-danger py-2 px-4">حذف </button>
                                                </form>
                                            @endcan
                                        </div>
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
            <div class="col-md-12 mt-3 d-flex justify-content-center">{{$categories->links()}}</div>
        </div>
    </div>
@endsection

