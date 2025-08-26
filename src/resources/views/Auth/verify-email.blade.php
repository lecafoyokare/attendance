@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/verify-email.css')}}">
@endsection

@section('content')
<div class="verify">
    <div class="verify_inner">
        <p class="verify_message">
                登録していただいたメールアドレスに認証メールを送付しました。<br>メール認証を完了してください。
        </p>
        <div class="guide">
            認証はこちらから
        </div>
        <form method="POST" action="{{ route('verification.send') }}">
        @csrf
            <button type="submit" class="resend">認証メールを再送する</button>
        </form>
    </div>
</div>
@endsection