@extends('layouts.layout')

@section('content')

<section>
    <article class = "signup__content">
        <div class = "content__wrap">
            <span class = "title">Реєстрація</span>
            
{{--                 <input type = "radio" class = "content__controls" id = "content1" name = "content__control" checked="checked" />
            <input type = "radio" class = "content__controls" id = "content2" name = "content__control" />

            <div class = "content__indicators">
                <label for = "content1" class = "content__indicator">Частна особа</label>
                <label for = "content2" class = "content__indicator">Компанія або ФОП</label>
            </div> --}}
            @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class = "signup__user__form custom__form" action={{ route('register') }} method="POST">
                @csrf
                <div>
                    <input type = "text" name = "name" placeholder = "Ім'я" value="{{ old('name') }}" required autocomplete="name" />
                </div>
                <div>
                    <input type = "email" name = "email" placeholder = "Email" required autocomplete="email" value="{{ old('email') }}"/>
                </div>
                <div>
                    <input type = "tel" name = "phone" placeholder = "Телефон" required autocomplete="phone" value="{{ old('phone') }}" pattern="[0-9]{10}" maxlength="10" required />
                </div>
                <div>
                    <input type = "text" name = "city" placeholder = "Місто" required autocomplete="city" value="{{ old('city') }}" maxlength="50" required />
                </div>
                <div>
                    <input type = "password" name = "password" placeholder = "Пароль" required autocomplete="new-password">
                </div>
                <div>
                    <input type = "password" name = "password_confirmation" placeholder = "Підтвердити пароль" required autocomplete="new-password"/>
                </div>
                <div><button type = "submit" class = "button__reg">Реєстрація</button></div>
            </form>
        </div>
    </article>
</section>



{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
