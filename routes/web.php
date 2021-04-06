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

Route::post('/settings/edit', 'App\Http\Controllers\SettingsController@store');

Route::get('/settings', function () {
    $settings = Setting::where('user_id',Auth::user()->id)->get();    
    return view('/settings/list',[
        'settings'=>$settings
    ]);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings/edit', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings-edit');
Route::get('/aggregate', function() {
   $settings = Setting::where('user_id',Auth::user()->id)->get();   
    return view('/aggregate/index',[
        'settings'=>$settings
    ]);
});

Route::post('/aggregate/result', 'App\Http\Controllers\AggregateController@result');