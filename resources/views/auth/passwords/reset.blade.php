@extends('backend.layouts.master')

@section('content')
    <div class="loginContainer w-100 d-flex flex-column align-items-center px-2 px-md-0">
        <div class="login-card col-12 col-md-4 d-flex flex-column position-relative mt-5 px-5 py-4">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="d-flex flex-column mb-0">
                    <h4 class="text-center mb-5 mt-4 d-flex align-items-center justify-content-center"><i class="fa fa-envelope ml-3"></i>بازیابی رمز عبور</h4>
                    <div class="custom-form-group d-flex flex-column mb-0">
                        <i class="fas fa-user-lock form-icon"></i>
                        <div class="w-100 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email"
                                   type="email"
                                   class="form-control w-100 custom-input"
                                   name="email"
                                   value="{{ $email ?? old('email') }}"
                                   onfocus="this.placeholder=''"
                                   onblur="this.placeholder='پست الکترونیکی خود را وارد کنید'"
                                   placeholder="پست الکترونیکی خود را وارد کنید">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                    </div>
                </div>
                <div class="w-100 custom-form-group ">
                    <i class="fas fa-lock form-icon"></i>
                    <div class="w-100{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password"
                               class="form-control w-100 custom-input" name="password"
                               autocomplete="new-password"
                               onfocus="this.placeholder=''"
                               onblur="this.placeholder='رمز عبور'"
                               placeholder="رمز عبور">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                </div>
                <div class="custom-form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input id="password_confirmation" type="password"
                           class="form-control w-100 custom-input" name="password_confirmation"
                           autocomplete="new-password"
                           onfocus="this.placeholder=''"
                           onblur="this.placeholder='تکرار رمز عبور'"
                           placeholder="تکرار رمز عبور">
                </div>

                <button type="submit" class="btn form-button mb-3">
                    تغییر رمز عبور
                </button>
            </form>
        </div>
    </div>


{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('password.update') }}">--}}
{{--                        @csrf--}}

{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Reset Password') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
