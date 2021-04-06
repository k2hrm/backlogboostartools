<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('settings/list');
    }

        public function edit(Request $request)
    {
        return view('settings/edit');
    }

    public function store(Request $request){
            //dd($request);
        $validator = Validator::make($request->all(), [
        'hostname' => 'required|max:255',
    ]);
        //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

        // Eloquentモデル（登録処理）
    $settings = Setting::find($request->user_id);
    if($settings === null) {
        $settings = new Setting;
    }
    $settings->user_id = $request->user_id;
    $settings->hostname = $request->hostname;
    $settings->api_key = $request->api_key;
    $settings->proj_key = $request->proj_key;
    $settings->bl_user_id = $request->bl_user_id;
    $settings->save(); 
    return redirect('/settings');

    }
}
