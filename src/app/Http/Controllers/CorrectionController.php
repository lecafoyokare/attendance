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
        $status = 1;

        $data = [
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'reason' => $request->reason,
            'requested_at' => date('Y-m-d H:i:s'),
            'approval_status' => $status,
        ];

        $attendance = Attendance::findOrFail($attendance_id)->update($data);

        if (count($rests_id) !== 0) {
            foreach ($request->rest_start as $index => $rest_start) {
                $restData = [
                    'rest_start' => $rest_start,
                    'rest_end' => $request->rest_end[$index],
                ];
                Rest::findOrFail($rests_id[$index])->update($restData);
            }
        }

        $attendanceController = new AttendanceController();
        $attendanceController->restTotal($attendance_id);
        $attendanceController->workingTime($attendance_id);

        return back();
    }
}
