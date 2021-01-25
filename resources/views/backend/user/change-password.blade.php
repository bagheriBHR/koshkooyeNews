@extends('backend.layouts.master')
@section('content')

    <div class="d-flex flex-column flex-md-row w-100 mt-3">
        <div class="loginContainer w-100 d-flex flex-column align-items-center px-2 px-md-0">
            <div class="login-card col-12 col-md-4 d-flex flex-column position-relative mt-5 px-5 py-4">
                <form method="POST" action="{{ route('user.password.update')  }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="d-flex flex-column">
                        <h4 class="text-center mb-5 mt-4"><i class="fa fa-user ml-3"></i>تغییر رمز عبور</h4>
                        <div class="w-100 form-group text-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="text-white col-md-4 col-form-label text-md-right"> رمز عبور جدید : </label>
                            <input id="password" type="password"
                                   class="form-control w-100 custom-input" name="password"
                                   required
                                   autocomplete="new-password"
                                   onfocus="this.placeholder=''"
                                   onblur="this.placeholder='رمز عبور'"
                                   placeholder="رمز عبور">

                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <div class="w-100 form-group text-right {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="text-white col-md-4 col-form-label text-md-right">تکرار رمز عبور : </label>
                            <input id="password_confirmation" type="password"
                                   class="form-control w-100 custom-input"  name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   onfocus="this.placeholder=''"
                                   onblur="this.placeholder='تکرار رمز عبور'"
                                   placeholder="تکرار رمز عبور">

                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        </div>

                        <button type="submit" value="ثبت" class="btn form-button">
                            تغییر گذرواژه
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
