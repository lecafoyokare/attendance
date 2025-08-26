@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/list.css')}}">
@endsection

@section('content')
<div class="list">
    <div  id="list_inner" class="list_inner">
        <h2 class="list_ttl">
                勤怠一覧
                <!-- 西玲奈さんの勤怠 -->
        </h2>
        <div class="calendar">
            <div class="month">
                <a href="{{ route('list.byMonth', ['year' => $previousMonth->year, 'month' => $previousMonth->month]) }}">&larr;<span>前月</span></a>
            </div>
            <form action="" class="calendar_form">
                <label>
                    <input type="date" value="{{$displayDate}}"/>
                </label>
            </form>
            <div class="month">
                <a href="{{ route('list.byMonth', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"><span>翌月</span>&rarr;</a>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>通勤</th>
                <th>休憩</th>
                <th>会計</th>
                <th>詳細</th>
            </tr>
            @foreach ($dates as $date)
            <tr>
                <td>{{ \Carbon\Carbon::parse($date)->isoFormat('MM/DD (ddd)') }}</td>
                @if (isset($attendancesDate[$date]))
                    @php
                        $attendance = $attendancesDate[$date];
                    @endphp
                    <td>{{ optional($attendance->clock_in)->format('H:i') }}</td>
                    <td>{{ optional($attendance->clock_out)->format('H:i') }}</td>
                    <td>{{ optional($attendance->rest)->format('H:i') }}</td>
                    <td>{{ optional($attendance->total)->format('H:i') }}</td>
                    <td><a href="/attendance/{{ $attendance->id }}">詳細</a></td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>詳細</td>
                @endif
            </tr>
            @endforeach
        </table>
        <div class="correction">
            <button>
                CSV出力
            </button>
        </div>
    </div>
</div>
@endsection