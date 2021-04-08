<?php

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
        return view('/settings/list', [
            'settings' => $settings
        ]);
    } else {
        return view('/settings/nomember');
    }
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings/edit', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings-edit');
Route::get('/aggregate', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        return view('/aggregate/member', [
            'settings' => $settings
        ]);
    } else {
        return view('/aggregate/nomember');
    }
});
Route::get('/aggregate/usage', [App\Http\Controllers\AggregateController::class, 'usage'])->name('usage');
Route::post('/aggregate/result', 'App\Http\Controllers\AggregateController@result');
