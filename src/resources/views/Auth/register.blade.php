@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register">
    <div class="register_form">
        <h2 class="register_ttl">
            会員登録
        </h2>
        <form id="register_form" action="/register" method="POST">
        @csrf
            <div class="register_form_item">
                <span>ユーザー名</span>
                <input type="text" name="name" value="{{ old('name') }}" />
                <span class="error">@error('name'){{ $message }}@enderror</span>
            </div>
            <div class="register_form_item">
                <span>メールアドレス</span>
                <input type="email" name="email" value="{{ old('email') }} " />
                <span class="error">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="register_form_item">
                <span>パスワード</span>
                <input type="password" name="password" value="{{ old('password') }}"/>
                <sapn class="error">@error('password'){{ $message }}@enderror</sapn>
            </div>
            <div class="register_form_item">
                <span>パスワード確認</span>
                <input type="password" name="password_confirmation" />
            </div>
        </form>
        <div class="register_form_btn">
            <input form="register_form" type="submit" value="登録する">
        </div>
        <a href="/login" class="login_link">ログインはこちら</a>
    </div>
</div>
@endsection