@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/staff.css')}}">
@endsection

@section('content')
<div class="staff">
    <div  id="staff_inner" class="staff_inner">
        <h2 class="staff_ttl">
                スタッフ一覧
        </h2>
        <table class="table">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>月次勤怠</th>
            </tr>
            <tr>
                <td>西　伶奈</td>
                <td>reina.n@coachtech.com</td>
                <td><a href="">詳細</a></td>
            </tr>
            <tr>
                <td>山田　太郎</td>
                <td>taro.y@coachtech.com</td>
                <td><a href="">詳細</a></td>
            </tr>
            <tr>
                <td>増田　一世</td>
                <td>issei.m@coachtech.com</td>
                <td><a href="">詳細</a></td>
            </tr>
        </table>
    </div>
</div>
@endsection