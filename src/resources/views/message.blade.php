@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/message.css')}}">
@endsection

@section('content')
<div class="message">
    <div class="message_inner">
        <p class="guide">
            管理者権限がありません。<br>下記から通常ログインを行ってください。
        </p>
        <form method="get" action="/login">
            <button type="submit" class="login">ログインする</button>
        </form>
    </div>
</div>
@endsection