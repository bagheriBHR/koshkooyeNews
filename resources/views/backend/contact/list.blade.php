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
                <h3 class="custom-field-title text-right py-2 pr-2 mb-0 font-weight-bold">لیست تماس ها</h3>
            </div>
            <!-- tables -->
            <div class="d-flex flex-column-reverse flex-md-row w-100">

                <div class="col-12 mb-3 mb-md-0 px-0">
                    @if(count($contacts))
                        <table class="customtable table mb-0 pb-0">
                            <thead>
                            <tr>
                                <th class="text-right">شماره</th>
                                <th class="text-right">نام و نام خانوادگی</th>
                                <th class="text-right">ایمیل</th>
                                <th class="text-right">متن تماس</th>
                                <th class="text-right">تاریخ ایجاد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key=>$contact)
                                <tr>
                                    <td class="text-right" scope="row">{{ $key+1 }}</td>
                                    <td class="text-right"><a href="{{route('contact.show',$contact->id)}}">{{$contact->name}}</a></td>
                                    <td class="text-right">{{$contact->email}}</td>
                                    <td class="text-right">{{\Illuminate\Support\Str::limit($contact->body),40}}</td>
                                    <td class="text-center p-0">{{\Hekmatinasser\Verta\Verta::instance($contact->created_at)->formatDate() }}</td>
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
            <div class="w-100 mt-3 d-flex justify-content-center">{{$contacts->links()}}</div>
        </div>
    </div>
@endsection
