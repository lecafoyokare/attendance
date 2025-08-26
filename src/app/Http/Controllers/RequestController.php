<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function list() {

        $approvals = Attendance::where('user_id', Auth::id())
                                ->whereNull('approval')->get();

        return view('request', compact('approvals'));
    }

    public function staff() {
        return view('staff');
    }
}
