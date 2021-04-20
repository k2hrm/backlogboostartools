@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>設定</h1>
      <h2>初期画面</h2>
      <p>現在保存されているBacklog基本設定を確認できます。</p>
      <p>「編集」ボタンを押すことで、この基本設定を編集できます。</p>
      <img src="{{ url('/img/manuals/settings/settings_1.png') }}" />
      <h2>編集画面</h2>
      <p>入力エリアを編集します。</p>
      <ul>
        <li>
          ユーザーID: 数字のIDになります。<a href="https://support-ja.backlog.com/hc/ja/articles/360035642534-%E8%AA%B2%E9%A1%8C%E6%A4%9C%E7%B4%A2%E7%B5%90%E6%9E%9C%E4%B8%80%E8%A6%A7%E3%81%AE%E5%87%BA%E5%8A%9B"> CSVダウンロード</a>で確認する必要がありそうです。 </li>
        <li>
          ホスト名: お使いのバックログのサブドメインから始まるドメイン名を入力します。
        </li>
        <li>
          APIキー: お使いのバックログで発行したAPIキーを入力します。
        </li>
        <li>
          プロジェクト: 当ツールで使うプロジェクトキーと担当者を入力します。必要な数だけ「追加」ボタンで追加できます。
        </li>
      </ul>
      <p>編集終了後、「内容確認」ボタンを押します。</p>
      <img src="{{ url('/img/manuals/settings/settings_2.png') }}" />
      <h2>確認画面</h2>
      <p>内容がよろしければ、保存を押してください。編集入力時に、担当者IDが不正だと、ここでエラーになります。</p>
      <img src="{{ url('/img/manuals/settings/settings_3.png') }}" />

    </div>
  </div>
</div>
@endsection