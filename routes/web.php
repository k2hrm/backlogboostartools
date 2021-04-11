<?php

use App\Models\Outputitem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::post('/settings/edit', 'App\Http\Controllers\SettingsController@store');

Route::get('/settings', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        return view('/settings/list', [
            'settings' => $settings,
            'outputitems' => $outputitems
        ]);
    } else {
        return view('/settings/nomember');
    }
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings/edit', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings-edit');
Route::get('/kst', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        return view('/kst/member', [
            'settings' => $settings,
            'outputitems' => $outputitems
        ]);
    } else {
        return view('/kst/nomember');
    }
});
Route::get('/send', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        return view('/send/member', [
            'settings' => $settings,
            'outputitems' => $outputitems
        ]);
    } else {
        return view('/send/nomember');
    }
});
Route::get('/nst', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        return view('/nst/member', [
            'settings' => $settings,
            'outputitems' => $outputitems
        ]);
    } else {
        return view('/nst/nomember');
    }
});


Route::get('/guide/kst', function () {
    return view('/guide/kst');
});
Route::get('/guide/send', function () {
    return view('/guide/send');
});
Route::get('/guide/nst', function () {
    return view('/guide/nst');
});

Route::post('/kst/result', 'App\Http\Controllers\KstController@result');
Route::post('/send/result', 'App\Http\Controllers\SendController@result');

Route::get('/mag/1', [App\Http\Controllers\MagController::class, 'index'])->name('index');
