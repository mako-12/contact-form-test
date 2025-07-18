@extends('layouts.app-auth')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('nav')
    <div class="header-nav">
        {{-- <form class="header-nav__link" action="/register">register</form> --}}
        <a href="/register" class="header-nav__link">register</a>
    </div>
@endsection

@section('content')
    <div class="login-form__content">
        <div class="login-form__heading">
            <h2>Login</h2>
        </div>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__content">
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__input--title">メールアドレス</span>
                    </div>

                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="　例: test@example.com" />
                        </div>
                        <div class="form__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__input--title">パスワード</span>
                    </div>

                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="　例: coachtech1106" />
                        </div>
                        <div class="form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </div>
        </form>
    </div>
@endsection
