<?php

use App\Models\Outputitem;
use App\Models\UserProject;
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
use Illuminate\Support\Facades\Cookie;

Route::get('/', function () {
    return view('home');
});

Route::post('/settings/store', 'App\Http\Controllers\SettingsController@store');

Route::get('/settings', 'App\Http\Controllers\SettingsController@index');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings/edit', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings-edit');
Route::get('/settings/confirm', [App\Http\Controllers\SettingsController::class, 'confirm'])->name('settings-confirm');

Route::get('/aggregate', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        $user_projects = UserProject::where('user_id', Auth::user()->id)->get();
        $api_key = Cookie::get('api_key');
        return view('/aggregate/member', [
            'settings' => $settings,
            'outputitems' => $outputitems,
            'user_projects' => $user_projects,
            'api_key' => $api_key,
        ]);
    } else {
        return view('/aggregate/nomember');
    }
});
Route::get('/send', 'App\Http\Controllers\SendController@index');
Route::post('/send/confirm', 'App\Http\Controllers\SendController@confirm');
Route::post('/send/refresh', 'App\Http\Controllers\SendController@refresh');

Route::get('/dailyreport', function () {
    if (Auth::check()) {
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        $outputitems = Outputitem::where('user_id', Auth::user()->id)->get();
        $api_key = Cookie::get('api_key');
        if ($api_key) {
            return view('/dailyreport/member', [
                'settings' => $settings,
                'outputitems' => $outputitems,
                'api_key' => $api_key
            ]);
        } else {
            return redirect('/timeout');
        }
    } else {
        return view('/dailyreport/nomember');
    }
});

Route::get('/manuals', function () {
    return view('/manuals/index');
});
Route::get('/manuals/aggregate', function () {
    return view('/manuals/aggregate');
});
Route::get('/manuals/send', function () {
    return view('/manuals/send');
});
Route::get('/manuals/dailyreport', function () {
    return view('/manuals/dailyreport');
});
Route::get('/manuals/settings', function () {
    return view('/manuals/settings');
});
Route::get('/manuals/timeout', function () {
    return view('/manuals/timeout');
});
Route::get('/tos/privacy', function () {
    return view('/tos/privacy');
});

Route::get('/contact', function () {
    return view('/contact/index');
});

Route::post('/aggregate/result', 'App\Http\Controllers\AggregateController@result');
Route::post('/aggregate/csv', 'App\Http\Controllers\AggregateController@csv');

Route::post('/send/result', 'App\Http\Controllers\SendController@result');
Route::post('/dailyreport/result', 'App\Http\Controllers\DailyReportController@result');
Route::post('/dailyreport/refresh', 'App\Http\Controllers\DailyReportController@refresh');

Route::get('/mag/1', [App\Http\Controllers\MagController::class, 'index'])->name('index');

route::delete('/user_projects/{user_project}', function (UserProject $user_project) {
    $user_project->delete();
    return redirect('/settings');
});


Route::get('/timeout', 'App\Http\Controllers\TimeoutController@timeout');
Route::post('/timeout/store', 'App\Http\Controllers\TimeoutController@store');
