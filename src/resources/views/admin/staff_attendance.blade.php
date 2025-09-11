@extends('layout.header')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/list.css')}}">
<link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
@endsection

@section('content')
<div class="list">
    <div  id="list_inner" class="list_inner">
        <h2 class="list_ttl">
                {{ $user_name }}さんの勤怠
        </h2>
        <div class="calendar">
            <div class="month">
                <a href="{{ route('admin.attendance.staff', ['id' => $user_id,'year' => $previousMonth->year, 'month' => $previousMonth->month]) }}">&larr;<span>前月</span></a>
            </div>
            <div class="datepicker_wrapper">
                <div class="input-group date" id="datepicker">
                    <img src={{asset("img/calendar_icon.svg")}} alt="Calendar Icon" id="calendar_icon" class="calendar-icon">
                    <input type="text" class="form-control" id="year_month_start" value="{{$displayDate->format('Y/m')}}" readonly>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>
            <div class="month">
                <a href="{{ route('admin.attendance.staff', ['id' => $user_id,'year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"><span>翌月</span>&rarr;</a>
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
                <a href="/csv-download">CSV出力</a>
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.ja.min.js"></script>

<script>
    $(document).ready(function () {
    $('#year_month_start').datepicker({
        format: 'yyyy/mm',
        language: 'ja',
        autoclose: true,
        minViewMode: 'months'
    });
    });

    $(document).ready(function () {
        $('#year_month_start').datepicker({
            format: 'yyyy/mm',
            language: 'ja',
            autoclose: true,
            minViewMode: 'months'
        }).on('changeDate', function (e) {
            const selectedDate = e.date;
            const selectedYear = selectedDate.getFullYear();
            const selectedMonth = selectedDate.getMonth() + 1;

            const url = `/admin/attendance/staff/{{ $user_id }}/${selectedYear}/${selectedMonth}`;
            window.location.href = url;
        });
    });

    $('#calendar_icon').on('click', function () {
        $('#year_month_start').datepicker('show');
    });
</script>
@endsection