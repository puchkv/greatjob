@extends('layouts.layout')

@section('content')
<section>
    <div class = "signin__wrapper">
        <div class = "signin__container">
            <div class = "title">Увійти</div>
             @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" class = "signin__form custom__form" action="{{ route('login') }}">
                @csrf
                <div>
                    <input type = "text" name = "email" placeholder="Email або телефон"  value="{{ old('email') }}" required autocomplete="email" autofocus />
                </div>
                <div>
                    <input type = "password" name = "password" placeholder="Пароль" required autocomplete="current-password">
                </div>
                <div>
                        <label class = "checkbox__container">
                            <span>Запам'ятати мене</span>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class = "checkmark"></span>
                        </label>
                        
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Забув пароль
                        </a>
                    @endif
                    
                </div>
                <div>
                    <input type = "submit" class = "w100" value = "Увійти">
                </div>
            </form>
        </div>

        <div class = "signup__container">
            <h3>{{ $per_count }}</h3>
            <span>Виконавців</span>
            <h3>{{ $tasks_count }}</h3>
            <span>Завдань</span>
            <h3>{{ $reviews_count }}</h3>
            <span>Відгуків</span>

            <span class = "line"></span>
            <span class = "title">
                Приєднуйтесь до великої команди GreatJob
            </span>
            <button onclick="location.href='/register'">Реєстрація</button>
        </div>
    </div>
</section>
@endsection


{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
