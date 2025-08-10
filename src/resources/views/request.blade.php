@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/request.css')}}">
@endsection

@section('content')
<div class="request">
    <div  id="request_inner" class="request_inner">
        <h2 class="request_ttl">
                申請一覧
        </h2>
        <div class="screen_selection">
            <div class="screen_selection_item">
                <form action="">
                    <button class="waithing_for_approval" onclick="">
                        承認待ち
                    </button>
                    <button class="approved" onclick="">
                        承認済み
                    </button>
                </form>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>状態</th>
                <th class="txt_left">名前</th>
                <th class="txt_left">対象日時</th>
                <th class="txt_left">申請理由</th>
                <th class="txt_left">申請日時</th>
                <th class="txt_left">詳細</th>
            </tr>
            <tr>
                <td>承認待ち</td>
                <td class="txt_left">西怜奈</td>
                <td class="txt_left">2023/06/01</td>
                <td class="txt_left">遅延のため</td>
                <td class="txt_left">2023/06/02</td>
                <td class="txt_left"><a href="">詳細</a></td>
            </tr>
            <tr>
                <td>承認待ち</td>
                <td class="txt_left">西怜奈</td>
                <td class="txt_left">2023/06/01</td>
                <td class="txt_left">遅延のため</td>
                <td class="txt_left">2023/06/02</td>
                <td class="txt_left"><a href="">詳細</a></td>
            </tr>
        </table>
    </div>
</div>

<style>
    /* .waithing_for_approval {
        font-weight: 600;
    }

    .approved {
        font-weight: 600;
    } */
</style>

@endsection