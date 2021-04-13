@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>マニュアル : 一斉送信ツール</h1>
      <p>休暇のお知らせなどの同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。</p>
      <h2>タイトル、本文、送信先プロジェクトの設定</h2>
      <p>会員登録済みの方はタイトルと本文を入れ、登録したプロジェクトキー一覧から、送信したいプロジェクトのプロジェクトキーをお選びいただき「送信」ボタンを押してください。</p>
      <img src="{{ url('/img/manuals/send/send_member.png') }}" />
      <p>会員登録しないでご利用される方はタイトルと本文、プロジェクトキーをカンマ区切りで入れ、APIキー、ホスト名を入力して「送信」ボタンを押してください。</p>
      <img src="{{ url('/img/manuals/send/send_nomember.png') }}" />
      <h2>送信の確認</h2>
      <p>本当に送信して良いかどうかの確認ダイアログが出ますので、「OK」を押してください。</p>
      <p>会員の場合</p>
      <img src="{{ url('/img/manuals/send/send_member_confirm.png') }}" />
      <p>非会員の場合</p>
      <img src="{{ url('/img/manuals/send/send_nomember_confirm.png') }}" />
      <h2>送信完了の確認</h2>
      <p>送信完了後、「一斉送信が完了しました。」という文字が出ますので、バックログで送信されたことをご確認ください。</p>
      <img src="{{ url('/img/manuals/send/send_complete.png') }}" />
      <ul>
        <li><a href="{{ url('/send') }}">一斉送信ツールを使ってみる</a></li>
        <li><a href="{{ url('/manuals') }}">マニュアルTOPへ</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection