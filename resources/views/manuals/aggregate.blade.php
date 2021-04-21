@extends('layouts.app')
@section('title', '期間指定実績時間確認ツールのマニュアル')
@section('description', 'Backlog基本設定を定義します。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>期間指定実績時間確認ツール</h1>
      <p>Backlogプロジェクトごとの指定期間内での作業実績時間を集計します。</p>
      <h2>設定項目を設定する</h2>
      <p>期間、プロジェクトキー、出力項目、APIキー、ホスト名を入力してください。</p>
      <img src="{{ url('/img/manuals/aggregate/aggregate_nomember.png') }}" />
      <h2>集計結果を確認する</h2>
      <p>集計結果をご確認ください。</p>
      <img src="{{ url('/img/manuals/aggregate/aggregate_result.png') }}" />
      <ul>
        <li><a href="{{ url('/aggregate') }}">期間指定実績時間確認ツールを使ってみる</a></li>
        <li><a href="{{ url('/manuals') }}">マニュアルTOPへ</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection