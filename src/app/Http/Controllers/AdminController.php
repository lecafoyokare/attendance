<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function list($year = null, $month = null, $day = null)
    {

        $baseDate = ($year && $month && $day) ? Carbon::create($year, $month, $day) : Carbon::now();

        $displayDate = $baseDate;

        $previousday = $baseDate->copy()->subDay();
        $nextday = $baseDate->copy()->addDay();

        $year = $baseDate->year;
        $month = $baseDate->month;
        $day = $baseDate->day;

        $attendances = Attendance::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->whereDay('date', $day)
            ->get();

        return view('admin.list', compact('attendances', 'displayDate', 'previousday', 'nextday'));
    }

    public function staffList()
    {
        $users = User::where('role', 'staff')->get();
        return view('admin.staff', compact('users'));
    }

    public function staffAttendance(User $id, $year = null, $month = null)
    {

        $user_name = $id->name;

        $baseDate = ($year && $month) ? Carbon::create($year, $month, 1) : Carbon::now();

        $displayDate = $baseDate->format('Y-m-d');

        $previousMonth = $baseDate->copy()->subMonthNoOverflow();
        $nextMonth = $baseDate->copy()->addMonthNoOverflow();

        $year = $baseDate->year;
        $month = $baseDate->month;
        $user_id = $id->id;

        $daysInMonth = $baseDate->daysInMonth;

        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = Carbon::create($year, $month, $day)->toDateString();
        }

        $attendances = Attendance::where('user_id', $user_id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        Session()->put('search_item', [
            'user_id' => $user_id,
            'year' => $year,
            'month' => $month
        ]);

        $attendancesDate = [];
        foreach ($attendances as $attendance) {
            $dateKey = (new DateTime($attendance->date))->format('Y-m-d');
            $attendancesDate[$dateKey] = $attendance;
        }

        $param = [
            'user_name' => $user_name,
            'dates' => $dates,
            'attendancesDate' => $attendancesDate,
            'displayDate' => $displayDate,
            'user_id' => $user_id,
            'previousMonth' => $previousMonth,
            'nextMonth' => $nextMonth
        ];

        return view('admin.staff_attendance', $param);
    }

    public function downloadCsv()
    {
        $searchItem = Session()->get('search_item');
        $user_id = $searchItem['user_id'];
        $year = $searchItem['year'];
        $month = $searchItem['month'];

        $baseDate = Carbon::create($year, $month, 1);

        $daysInMonth = $baseDate->daysInMonth;

        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = Carbon::create($year, $month, $day)->toDateString();
        }

        $attendances = Attendance::where('user_id', $user_id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->with('user')
            ->get();

        $attendancesDate = [];
        foreach ($attendances as $attendance) {
            $dateKey = (new DateTime($attendance->date))->format('Y-m-d');
            $attendancesDate[$dateKey] = $attendance;
        }

        $csvHeader = ['氏名', '打刻開始', '打刻終了', '休憩時間', '勤務時間'];

        foreach ($dates as $date) {
            if (isset($attendancesDate[$date])) {
                $attendance = $attendancesDate[$date];
                $clockIn = optional($attendance->clock_in)->format('H:i');
                $clockOut = optional($attendance->clock_out)->format('H:i');
                $rest = optional($attendance->rest)->format('H:i');
                $total = optional($attendance->total)->format('H:i');
            } else {
                $clockIn = '';
                $clockOut = '';
                $rest = '';
                $total = '';
            }

            $csvData[] = [
                'date' => $date,
                'name' => $attendances->first()->user->name,
                'clock_in' => $clockIn,
                'clock_out' => $clockOut,
                'rest' => $rest,
                'total' => $total
            ];
        }

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            stream_filter_append($handle, 'convert.iconv.UTF-8/SJIS-win');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }
}
