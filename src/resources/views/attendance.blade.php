@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance.css')}}">
@endsection

@section('content')
<div class="attendance">
    <div  id="attendance_inner" class="attendance_inner">
        <div class="status_wrapper">
            <span class="status">
                @switch($status)
                    @case(3)
                        退勤済
                        @break
                    @case(2)
                        休憩中
                        @break
                    @case(1)
                        出勤中
                        @break
                    @case(0)
                        勤務外
                        @break
                @endswitch
            </span>
        </div>
        <time id="today" class="today"></time><br>
        <time id="current_time" class="current_time"></time>
        <div class="attendance_btn">
            @switch($status)
                @case(3)
                    <span class="thank_you_work">お疲れ様でした。</span>
                    @break

                @case(2)
                    <form action="/attendance/rest_end" method="post">
                        @csrf
                        <button type="submit" class="btn_white">休憩戻</button>
                    </form>
                    @break
                    
                @case(1)
                    <form action="/attendance/clock_out" method="post">
                        @csrf
                        <button type="submit">退勤</button>
                    </form>
                    <form action="/attendance/rest_start" method="post">
                        @csrf
                        <button type="submit" class="btn_white">休憩入</button>
                    </form>
                    @break
                
                @case(0)
                    <form action="/attendance/clock_in" method="post">
                    @csrf
                        <button type="submit">出勤</button>
                    </form>
                    @break
                    
            @endswitch
        </div>
    </div>
</div>

<style>
.attendance_btn {
    @switch($status)
        @case(3)
        @case(2)
        @case(0)
            text-align: center;
            @break
        @case(1)
            display: flex;
            justify-content: space-between;
            @break
    @endswitch
}

.attendance_btn form {
    @switch($status)
        @case(3)
        @case(2)
        @case(0)
        display: inline-block;
        @break
    @endswitch
}
</style>

<script src="{{"js/attendance.js"}}"></script>

@endsection