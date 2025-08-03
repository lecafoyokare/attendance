@extends('layout.header')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance.css')}}">
@endsection

@section('content')
<div class="attendance">
    <div  id="attendance_inner" class="attendance_inner">
        <div class="status_wrapper">
                <span class="status">勤務外</span>
        </div>
        <time id="today" class="today"></time><br>
        <time id="current_time" class="current_time"></time>
        <div class="attendance_btn">
            <button><a href="">出勤</a></button>
            <button class="btn_white"><a href="" class="btn_white">休憩入</a></button>
            <!-- <button class="btn_white"><a href="" class="btn_white">休憩戻</a></button> -->
        </div>
    </div>
</div>

<style>
.attendance_btn {
    /* background-color: aquamarine;
    display: flex;
    justify-content: space-between; */
    text-align: center;
}
</style>

<script src="{{"js/attendance.js"}}"></script>

@endsection