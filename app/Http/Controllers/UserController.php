<?php
namespace App\Http\Controllers;
class UserController extends Controller
{
  public function index()
  {
    $name = 'yamada taro';
    return view('user',['name' => $name]);
  }
}
