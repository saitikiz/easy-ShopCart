@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Giriş
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="Email" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Şifre">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Beni Hatırla</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Giriş Yap
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        Şifremi Unuttum
                    </a>
                </p>
            @endif
            <p class="mb-1">
                <a class="text-center" href="{{ route('register') }}">
                    Kayıt Ol
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
