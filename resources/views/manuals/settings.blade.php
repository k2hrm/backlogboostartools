@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>設定</h1>
      <h2>確認画面</h2>
      <p>現在保存されているBacklog基本設定を確認できます。</p>
      <p>「編集」ボタンを押すことで、この基本設定を編集できます。</p>
      <img src="{{ url('/img/manuals/settings/settings.png') }}" />
      <h2>編集画面</h2>
      入力エリアを編集し「保存」ボタンを押すことで、基本設定を保存できます。
      <img src="{{ url('/img/manuals/settings/settings_edit.png') }}" />

    </div>
  </div>
</div>
@endsection