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
Route::get('/bst', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        return view('/bst/member', [
            'settings' => $settings,
            'outputitems' => $outputitems
        ]);
    } else {
        return view('/bst/nomember');
    }
});
Route::get('/guide/bst', function () {
    return view('/guide/bst');
});

Route::post('/bst/result', 'App\Http\Controllers\BstController@result');
