<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function waitingList() {

        $routeStatus = 0;
        $cssStatus = 0;

        $approvals = Attendance::where('user_id', Auth::id())
                                ->where('approval_status', 1)->get();

        return view('request', compact('approvals', 'routeStatus', 'cssStatus'));
    }

    public function adminWaitingList() {

        $routeStatus = 1;
        $cssStatus = 0;

        $approvals = Attendance::where('approval_status', 1)->get();

        return view('request', compact('approvals', 'routeStatus', 'cssStatus'));
    }

    public function approvedList() {

        $routeStatus = 0;
        $cssStatus = 1;

        $approvals = Attendance::where('user_id', Auth::id())
                                ->where('approval_status', 3)->get();

        return view('request', compact('approvals', 'routeStatus', 'cssStatus'));
    }

    public function adminApprovedList() {

        $routeStatus = 0;
        $cssStatus = 1;

        $approvals = Attendance::where('approval_status', 3)->get();

        return view('request', compact('approvals', 'routeStatus', 'cssStatus'));
    }

    public function approve(Attendance $attendance_correct_request) {

        session()->put('attendance_id', $attendance_correct_request->id);

        session()->put('rests_id', $attendance_correct_request->rests->pluck('id'));

        $user_name = $attendance_correct_request->user->name;

        $status = 2;

        $data = [
            'user_name' => $user_name,
            'attendance' => $attendance_correct_request,
            'status' => $status,
        ];

        return view('detail', $data);
    }
}
