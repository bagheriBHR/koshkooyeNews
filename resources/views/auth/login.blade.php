@extends('backend.layouts.master')

@section('content')

    <div class="loginContainer w-100 d-flex flex-column align-items-center px-2 px-md-0">
        <div class="login-card col-12 col-md-4 d-flex flex-column position-relative mt-5 px-5 py-4">

            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="d-flex flex-column">
                    <h4 class="text-center mb-5 mt-4"><i class="fa fa-user ml-3"></i>ورود به پنل مدیریت</h4>
                    <div class="custom-form-group d-flex flex-column">
                        <i class="fas fa-user-lock form-icon"></i>
                            <div class="w-100 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username"
                                       type="text"
                                       class="form-control w-100 custom-input"
                                       name="username"
                                       required
                                       onfocus="this.placeholder=''"
                                       onblur="this.placeholder='نام کابری'"
                                       placeholder="نام کاربری">
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                            </div>
                        </div>
                    <div class="custom-form-group">
                        <i class="fas fa-lock form-icon"></i>
                        <input id="password" type="password"
                               class="form-control w-100 custom-input @error('password') is-invalid @enderror" name="password"
                               required
                               autocomplete="new-password"
                               onfocus="this.placeholder=''"
                               onblur="this.placeholder='رمز عبور'"
                               placeholder="رمز عبور">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="grid custom-form-group d-flex align-items-start">
                        <label class="checkbox bounce">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                            <svg viewBox="0 0 21 21">
                                <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                            </svg>
                        </label>
                        <span class="mr-2 forget">مرا به خاطر بسپار</span>
                    </div>
                    <button type="submit" value="ورود" class="btn form-button">
                        ورود
                    </button>
                    <div class="d-flex justify-content-center w-100 mt-4 px-3">
                        @if (Route::has('password.request'))
                            <a class="forget" href="{{ route('password.request') }}" >رمز عبور خود را فراموش کردید؟</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
