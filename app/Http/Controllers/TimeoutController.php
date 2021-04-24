<?php

namespace App\Http\Controllers;

use App\Models\Outputitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Setting;
use App\Models\Outputitems;
use App\Models\Project;
use App\Models\UserProject;
use Validator;
use Illuminate\Support\Facades\Auth;

class TimeoutController extends Controller
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
    public function timeout()
    {
        return view('/timeout');
    }

    public function store(Request $request)
    {
        Cookie::queue('api_key', $request->api_key, 10);
        return redirect('/home');
    }
}
