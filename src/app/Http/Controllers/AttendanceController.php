<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function attendance() {

        $status = $this->statusGet();

        return view('attendance',compact('status'));
    }

    public function statusGet() {

        $check_in = Attendance::TodayAttendance()->exists();

        if ($check_in===false) {
            $restCheck = false;
        } else {
            $restCheck = Rest::RecordFind()->exists();
        }

        $check_out = Attendance::TodayAttendance()->
                        whereNotNull('clock_out')->exists();

        switch (true) {
            case $check_out:
                return 3;
                break;

            case $restCheck;
                return 2;
                break;

            case $check_in;
                return 1;
                break;

            default:
                return 0;
                break;
        }
    }

    public function clockIn(Request $request) {

        $now = now();

        Attendance::create([
            'user_id'    => Auth::id(),
            'date' => $now->toDateString(),
            'clock_in'   => $now->toTimeString(),
        ]);

        return back();
    }

    public function clockOut(Request $request) {

        $now = now();

        $attendance = Attendance::TodayAttendance()->first();

        $data = [
            'clock_out' => $now->toTimeString(),
        ];

        Attendance::find($attendance->id)->update($data);

        $this->workingTime();

        return back();
    }

    public function workingTime() {

        $attendance = Attendance::TodayAttendance()->first();
        $clock_in = $attendance->clock_in;
        $clock_out = $attendance->clock_out;
        $rest = $attendance->rest;
        $hours = $rest->hour;
        $minutes = $rest->minute;
        $seconds = $rest->second;

        $totalTimeSeconds = strtotime($clock_out) - strtotime($clock_in);

        $restTimeSeconds = $hours * 3600 + $minutes * 60 + $seconds;

        $workTimeSeconds = $totalTimeSeconds - $restTimeSeconds;

        $workTime = gmdate('H:i:s',$workTimeSeconds);

        $data = [
            'total' => $workTime,
        ];

        Attendance::find($attendance->id)->update($data);

    }

    public function restStart() {
       
        $recordCheck = Rest::RecordFind()->exists(); //画面が切り替わっていなかった場合のエラー回避

        $attendance_id = Attendance::TodayAttendance()->first()->id;

        if ($recordCheck===true) {
            return redirect('/attendance');
        } else {
            $now = now();

            Rest::create([
                'attendance_id' => $attendance_id,
                'rest_start' => $now->toTimeString(),
            ]);

            return back();
        }
    }

    public function restEnd() {

        $now = now();

        $id = Rest::RecordFind()->first()->id;

        $data = [
            'rest_end' => $now->toTimeString(),
        ];

        Rest::find($id)->update($data);

        $this->restTotal();

        return back();

    }

    public function restTotal() {

        $attendance_id = Attendance::TodayAttendance()->first()->id;

        $rests = Rest::where('attendance_id',$attendance_id)->get();

        $totalRestSeconds = 0;

        foreach ($rests as $rest) {
            if ($rest->rest_end && $rest->rest_start) {

                $timeDifference = strtotime($rest->rest_end) - strtotime($rest->rest_start);

                $totalRestSeconds += $timeDifference;
            }
        }

        $totalRestTime = gmdate('H:i:s', $totalRestSeconds);

        $data = [
            'rest' => $totalRestTime,
        ];

        Attendance::find($attendance_id)->update($data);

    }

    public function list() {

        $month = now()->format('m');

        $attendances = Attendance::where('user_id',Auth::id())->whereMonth('date',$month)->get();

        return view('list',compact('attendances'));
    }

    public function detail(Attendance $id) {

        $data = [
            'attendance' => $id,
        ];

        return view('detail',$data);
    }
}
