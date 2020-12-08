@extends('frontend.layouts.master')

@section('content')
    <div class="about-us d-flex justify-content-center my-3">
        @if($page=='about')
            <div class="col-12 col-md-8 border p-3 bg-white">
                <h2> درباره ما</h2>
                <div class="px-2 w-100">{!! $setting->about_us !!}</div>
            </div>
        @else
            <div class="col-12 col-md-8 border p-3 bg-white">
                <h2> تماس با ما</h2>
                <div class="px-2 w-100">{!! $setting->contact_us !!}</div>
            </div>
        @endif
    </div>
@endsection
