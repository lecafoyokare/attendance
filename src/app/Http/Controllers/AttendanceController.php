<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    function attendance()
    {
        return view('attendance');
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
