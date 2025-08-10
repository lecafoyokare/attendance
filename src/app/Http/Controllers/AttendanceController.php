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

        $restCheck = Rest::RecordFind()->exists();

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

        $attendance = Attendance::where('user_id', Auth::id())->where('date', date('Y-m-d'))->first();

        $data = [
            'clock_out' => $now->toTimeString(),
        ];

        Attendance::find($attendance->id)->update($data);

        return back();
    }

    public function restStart() {
        //画面が切り替わっていなかった場合のエラー回避
        $recordCheck = Rest::RecordFind()->exists();

        if ($recordCheck===true) {
            return redirect('/attendance');
        } else {
            $now = now();

            Rest::create([
                'user_id'  => Auth::id(),
                'date'     => $now->toDateString(),
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

        return back();

    }

    function list()
    {
        return view('list');
    }

    function detail()
    {
        return view('detail');
    }
}
