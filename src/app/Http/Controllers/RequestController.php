<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function list() {

        $approvals = Attendance::where('user_id', Auth::id())
                                ->where('approval_status', 1)->get();

        return view('request', compact('approvals'));
    }

    public function approvedList() {

        $approvals = Attendance::where('user_id', Auth::id())
                                ->where('approval_status', 4)->get();

        return view('request', compact('approvals'));
    }

    public function staff() {
        return view('staff');
    }
}
