<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
  public function index($id='zero') {
    $data =[
        'msg'=>'これはコントローラーから渡されたメッセージです',
        'id'=>$id
    ];
    return view('hello.index',$data);
  }
}