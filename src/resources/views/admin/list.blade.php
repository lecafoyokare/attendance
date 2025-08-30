@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/list.css')}}">
@endsection

@section('content')
<div class="list">
    <div  id="list_inner" class="list_inner">
        <h2 class="list_ttl">
            {{$displayDate->isoFormat('YYYY年MM月DD日')}} の勤怠一覧
        </h2>
        <div class="calendar">
            <div class="month">
                <a href="{{ route('admin.list', ['year' => $previousday->year, 'month' => $previousday->month, 'day' => $previousday->day]) }}">&larr;<span>前日</span></a>
            </div>
            <form action="" class="calendar_form">
                <label>
                    <input type="date" id="date-picker" value="{{$displayDate->format('Y-m-d')}}"/>
                </label>
            </form>
            <div class="month">
                <a href="{{ route('admin.list', ['year' => $nextday->year, 'month' => $nextday->month, 'day' => $nextday->day]) }}"><span>翌日</span>&rarr;</a>
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
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{$attendance->user->name}}</td>
                <td>{{ optional($attendance->clock_in)->format('H:i') }}</td>
                <td>{{ optional($attendance->clock_out)->format('H:i') }}</td>
                <td>{{ optional($attendance->rest)->format('H:i') }}</td>
                <td>{{ optional($attendance->total)->format('H:i') }}</td>
                <td><a href="/attendance/{{ $attendance->id }}">詳細</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<script>
    document.getElementById('date-picker').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const year = selectedDate.getFullYear();
        const month = selectedDate.getMonth() + 1;
        const day = selectedDate.getDate();

        window.location.href = `/admin/attendance/list/${year}/${month}/${day}`;
    });
</script>
@endsection