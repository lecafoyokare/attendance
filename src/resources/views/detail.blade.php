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
        <form id="correction_form" action="/correction/update" method="POST">
        @csrf
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
                                <input type="text" name="clock_in" value="{{ optional($attendance->clock_in)->format('H:i')}}">
                            </div>
                            <span class="space_item">～</span>
                            <div class="space_item">
                                <input type="text" name="clock_out" value="{{ optional($attendance->clock_out)->format('H:i')}}">
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
                                        <input type="text" name="rest_start[]" value="{{ optional($rest->rest_start)->format('H:i') }}">
                                    </div>
                                    <span class="space_item">～</span>
                                    <div class="space_item">
                                        <input type="text" name="rest_end[]" value="{{ optional($rest->rest_end)->format('H:i') }}">
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
                                <textarea name="reason">{{ $attendance->reason }}</textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <div class="correction">
            @switch ($status)
                @case(0)
                    <button type="submit" form="correction_form">
                        修正
                    </button>
                    @break

                @case(1)
                    <span class="waiting_for_approval">*承認待ちのため修正はできません。</span>
                    @break

                @case(3)
                    <form action="">
                        <input type="hidden" name="id" value="">
                        <button>承認</button>
                    </form>
                    @break

                @case(4)
                    <div class="approved">承認済み</div>
                    @break

            @endswitch
        </div>
    </div>
</div>

<style>
    @switch ($status)
        @case(0)
        @case(4)
            .waiting_for_approval {
                font-weight: 600;
            }

            .approved {
                font-weight: 600;
            }
            @break
    @endswitch
</style>
@endsection