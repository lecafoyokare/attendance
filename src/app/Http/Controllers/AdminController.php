<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class AdminController extends Controller
{
    public function login() {
        return view('Auth.login');
    }

    public function list($year = null, $month = null,$day = null) {

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

    public function staffList() {
        $users = User::where('role', 'staff')->get();
        return view('admin.staff', compact('users'));
    }

    public function staffAttendance(User $id, $year = null, $month = null) {

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
}
