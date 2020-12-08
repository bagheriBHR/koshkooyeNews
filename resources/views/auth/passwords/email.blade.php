@extends('backend.layouts.master')

@section('content')
    <div class="loginContainer w-100 d-flex flex-column align-items-center px-2 px-md-0">
        <div class="login-card col-12 col-md-4 d-flex flex-column position-relative mt-5 px-5 py-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
                        @csrf
                        <div class="d-flex flex-column">
                            <h4 class="text-center mb-5 mt-4 d-flex align-items-center justify-content-center"><i class="fa fa-envelope ml-3"></i>بازیابی رمز عبور</h4>
                            <div class="custom-form-group d-flex flex-column mb-0">
                                <i class="fas fa-user-lock form-icon"></i>
                                <div class="w-100 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email"
                                           type="email"
                                           class="form-control w-100 custom-input"
                                           name="email"
                                           onfocus="this.placeholder=''"
                                           onblur="this.placeholder='پست الکترونیکی خود را وارد کنید'"
                                           placeholder="پست الکترونیکی خود را وارد کنید">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" value="ورود" class="btn form-button mb-3">
                            ارسال لینک بازیابی رمز عبور
                        </button>
                    </form>
                </div>
            </div>
@endsection
