@extends('layouts.app')
@section('title', '日報作成ツールのマニュアル')
@section('description', '日報作成ツールのマニュアルです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>日報作成ツール</h1>
      <h2>日付(本日/昨日)などの設定</h2>
      <p>「本日分」「昨日分」どちらの日報を作成するかの選択とユーザーID、APIキー、ホスト名を入力し「日報作成」ボタンを押下してください。</p>
      <img src="{{ url('/img/manuals/dailyreport/dailyreport_nomember.png') }}" />
      <h2>日報の確認</h2>
      <p>プロジェクトごとの課題キー、タイトルがリストされます。必要なコメントを追記し、日報としてご使用ください。</p>
      <img src="{{ url('/img/manuals/dailyreport/dailyreport_result.png') }}" />
      <ul>
        <li><a href="{{ url('/dailyreport') }}">日報作成ツールを使ってみる</a></li>
        <li><a href="{{ url('/manuals') }}">マニュアルTOPへ</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection