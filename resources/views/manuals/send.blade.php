@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>期間指定実績時間確認ツール</h1>
      <p>プロジェクトごとの指定期間内での作業実績時間を集計します。</p>
      <img src="{{ url('/img/manuals/send/send_member.png') }}" />
      <img src="{{ url('/img/manuals/send/send_nomember.png') }}" />
      <img src="{{ url('/img/manuals/send/send_member_confirm.png') }}" />
      <img src="{{ url('/img/manuals/send/send_nomember_confirm.png') }}" />
    </div>
  </div>
</div>
@endsection