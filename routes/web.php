<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Setting;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::post('/settings/edit', function(Request $request) {
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
    $settings->proj_key = $request->bl_user_id;
    $settings->save(); 
    return redirect('/settings');
});

Route::get('/settings', function () {
    $settings = Setting::orderBy('created_at','asc')->get();    
    return view('/settings/list',[
        'settings'=>$settings
    ]);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings/edit', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings-edit');
Route::get('/aggregate', function() {
   $settings = Setting::orderBy('created_at','asc')->get();    
    return view('/aggregate/index',[
        'settings'=>$settings
    ]);
});

Route::post('/aggregate/result', function(Request $request) {
    dd($request);
     return view('/aggregate/result');
});