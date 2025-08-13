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
                <a href="">&larr;<span>前月</span></a>
            </div>
            <form action="" class="calendar_form">
                <label>
                    <input type="date" />
                </label>
            </form>
            <div class="month">
                <a href=""><span>翌月</span>&rarr;</a>
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
                    <td>{{ optional($attendance->date)->isoFormat('MM/DD (ddd)') }}</td>
                    <td>{{ optional($attendance->clock_in)->format('H:i')}}</td>
                    <td>{{ optional($attendance->clock_out)->format('H:i')}}</td>
                    {{-- <td>{{ optional()}}</td> --}}<td></td>
                    {{-- <td>{{ optional()}}</td> --}}<td></td>
                    <td><a href="/attendance/{{$attendance->id}}">詳細</a></td>
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