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
                    <button class="btn_white"><a href="/attendance/rest_end" class="btn_white">休憩戻</a></button>
                    @break
                    
                @case(1)
                    <button><a href="/attendance/clock_out">退勤</a></button>
                    <button class="btn_white">
                        <a href="/attendance/rest_start" class="btn_white">休憩入</a>
                    </button>
                    @break
                
                @case(0)
                    <button><a href="/attendance/clock_in">出勤</a></button>
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
</style>

<script src="{{"js/attendance.js"}}"></script>

@endsection