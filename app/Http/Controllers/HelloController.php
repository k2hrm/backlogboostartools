<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
  public function index() {
    $data =[
        'msg'=>'お名前を入力してください。',
    ];
    return view('hello.index',['msg'=>'']);
  }

  public function post(Request $request)
  {
    return view('hello.index',['msg'=>$request->msg]);
  }
}