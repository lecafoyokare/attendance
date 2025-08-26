<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class AdminController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function list($year = null, $month = null,$day = null)
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
}
