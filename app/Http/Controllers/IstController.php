<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IstController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('ist/index');
    }

    public function result(Request $request)
    {
        return view('ist/result', compact('issueKeyAndHoursArrs', 'proj_key', 'from_date', 'to_date'));
    }
}
