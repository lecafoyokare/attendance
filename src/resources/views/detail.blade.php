@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail">
    <div  id="detail_inner" class="detail_inner">
        <h2 class="detail_ttl">
                勤怠詳細
        </h2>
        <table class="detail_list">
            <tr class="detail_item">
                <th>名前</th>
                <td>{{Auth::user()->name}}</td>
            </tr>
            <tr class="detail_item">
                <th>日付</th>
                <td>
                    <div class="space top">
                        <span class="space_item">{{ optional($attendance->date)->isoFormat('Y年') }}</span>
                        <span class="space_item">{{ optional($attendance->date)->isoFormat('M月D日') }}</span>
                    </div>
                </td>
            </tr>
            <tr class="detail_item">
                <th>出勤・退勤</th>
                <td>
                    <div class="space">
                        <div class="space_item">
                            <input type="text" value="{{ optional($attendance->clock_in)->format('H:i')}}">
                        </div>
                        <span class="space_item">～</span>
                        <div class="space_item">
                            <input type="text" value="{{ optional($attendance->clock_out)->format('H:i')}}">
                        </div>
                    </div>
                </td>
            </tr>
            @if($attendance->rests->isNotEmpty())
                @foreach($attendance->rests as $index => $rest)
                    <tr class="detail_item">
                        <th>休憩{{ $index + 1 }}</th>
                        <td>
                            <div class="space">
                                <div class="space_item">
                                    <input type="text" value="{{ optional($rest->rest_start)->format('H:i') }}">
                                </div>
                                <span class="space_item">～</span>
                                <div class="space_item">
                                    <input type="text" value="{{ optional($rest->rest_end)->format('H:i') }}">
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            <tr class="detail_item">
                <th>備考</th>
                <td>
                    <div class="space">
                        <div class="space_item">
                            <textarea name="" id=""></textarea>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="correction">
            <!-- <button>
                修正
            </button> -->
            <!-- <span class="error">*承認待ちのため修正はできません。</span> -->
            <!-- <form action="">
                <input type="hidden" name="id" value="">
                <button>承認</button>
            </form> -->
            <div class="approved">承認済み</div>
        </div>
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