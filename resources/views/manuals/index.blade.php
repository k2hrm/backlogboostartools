@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>マニュアル</h1>
      <ul>
        <li><a href="{{ url('/manuals/aggregate') }}">期間集計ツール</a></li>
        <li><a href="{{ url('/manuals/send') }}">一斉送信ツール</a></li>
        <li><a href="{{ url('/manuals/dailyreport') }}">日報作成ツール</a></li>
        <li><a href="{{ url('/manuals/settings') }}">設定</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection