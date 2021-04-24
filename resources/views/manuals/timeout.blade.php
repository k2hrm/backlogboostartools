@extends('layouts.app')
@section('title', '日報作成ツールのマニュアル')
@section('description', '日報作成ツールのマニュアルです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>セッションがタイムアウトした場合</h1>
      <p>下記の画面になりますのでテキスト入力欄にAPIキーを入力し「送信」ボタンを押下してください。</p>
      <img src="{{ url('/img/manuals/session_timeout.png') }}" />
      <ul>
        <li><a href="{{ url('/manuals') }}">マニュアルTOPへ</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection