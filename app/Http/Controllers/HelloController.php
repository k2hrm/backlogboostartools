<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
  public function index() {
    $data =['msg'=>'これはコントローラーから渡されたメッセージです'];
    return view('hello.index',$data);
  }
}