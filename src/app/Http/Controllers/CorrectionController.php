<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;

class CorrectionController extends Controller
{
    public function update(Request $request) {

        $attendance_id = session('attendance_id');
        $rests_id = session('rests_id');

        $data = [
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
        ];

        $attendance = Attendance::findOrFail($attendance_id)->update($data);

        // if (count($rests_id) === 0) {
        //     // セッションから取得した配列の要素数が0の場合の処理
        //     echo "レストランIDのリストは空です。";
        // } else {
        //     // 要素数が1以上の場合の処理
        //     echo "レストランIDのリストに要素が含まれています。";
        // }

        $attendanceController = new AttendanceController();
        $attendanceController->restTotal($attendance_id);
        $attendanceController->workingTime($attendance_id);

        return back();
    }
}
