@extends('layouts.app')
@section('title', '一斉送信ツールのマニュアル')
@section('description', 'Backlog 一斉送信ツールのマニュアルです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>マニュアル : 一斉送信ツール</h1>
      <p>休暇のお知らせなどの同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。</p>
      <h2>タイトル、本文、送信先プロジェクトの設定</h2>
      <p>タイトルと本文、プロジェクトキー・担当者のペアをカンマ区切りで入れ、必要な分だけ「追加」ボタンで追加いただき、APIキー、ホスト名を入力して「送信内容確認」ボタンを押してください。</p>
      <img src="{{ url('/img/manuals/send/send_nomember_1.png') }}" />
      <h2>送信の確認</h2>
      <p>確認画面で、バックログプロジェクトキーと担当者名などが正しいかご確認いただき、送信ボタンを押してください。</p>
      <img src="{{ url('/img/manuals/send/send_common_2.png') }}" />
      <p>本当に送信して良いかどうかの確認ダイアログが出ますので、よろしければ「OK」を押してください。</p>
      <img src="{{ url('/img/manuals/send/send_common_3.png') }}" />
      <h2>送信完了の確認</h2>
      <p>送信完了後、「一斉送信が完了しました。」という文字が出ますので、バックログで送信されたことをご確認ください。</p>
      <img src="{{ url('/img/manuals/send/send_common_4.png') }}" />
      <img src="{{ url('/img/manuals/send/send_backlog_verification.png') }}" />
      <ul>
        <li><a href="{{ url('/send') }}">一斉送信ツールを使ってみる</a></li>
        <li><a href="{{ url('/manuals') }}">マニュアルTOPへ</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection