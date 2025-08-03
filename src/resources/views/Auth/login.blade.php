@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="login">
    <div class="login_form">
        <h2 class="login_ttl">
                <!-- 管理者 -->
                ログイン
        </h2>
        <form id="login_form" action="/login" method="post">
        @csrf
            <div class="login_form_item">
                <span>メールアドレス</span>
                <input type="email" name="email" value="{{ old('email') }}" />
                <sapn class="error">@error('email'){{ $message }}@enderror</sapn>
            </div>
            <div class="login_form_item">
                <span>パスワード</span>
                <input type="password" name="password" />
                <span class="error">@error('password'){{ $message }}@enderror</span>
            </div>
        </form>
        <div class="login_form_btn">
            <button form="login_form" type="submit">
                ログインする
            </button>
        </div>
        <a href="/register" class="register_link">会員登録はこちら</a>
    </div>
</div>
@endsection