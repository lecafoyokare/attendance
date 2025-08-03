<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    function list()
    {
        return view('request');
    }

    function staff()
    {
        return view('staff');
    }
}
