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
                <button class="waithing_for_approval">
                    <a href="/stamp_correction_request/list">承認待ち</a>
                </button>
                <button class="approved">
                    <a href="/stamp_correction_request/list/approved">承認済み</a>
                </button>
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
            @foreach ($approvals as $approval)
            <tr>
                <td>{{ $approval->approval_status === 1 ? ' 承認待ち' : '承認済み' }}</td>
                <td class="txt_left">{{ $approval->user->name }}</td>
                <td class="txt_left">{{ $approval->date->format('Y/m/d') }}</td>
                <td class="txt_left">{{ $approval->reason }}</td>
                <td class="txt_left">{{ $approval->created_at->format('Y/m/d') }}</td>
                @if ($routeStatus === 0)
                    <td class="txt_left"><a href="/attendance/{{ $approval->id }}">詳細</a></td>
                @else
                    <td class="txt_left"><a href="/admin/stamp_correction_request/approve/{{ $approval->id }}">詳細</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>

<style>
    @if ($cssStatus === 0)
    .waithing_for_approval {
        font-weight: 600;
    }
    @else
    .approved {
        font-weight: 600;
    }
    @endif
</style>

@endsection