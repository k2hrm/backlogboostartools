@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2 bl-ag-usg">
      <h1>Backlog期間指定実績時間確認ツール</h1>
      <p>プロジェクトごとの指定期間内での作業実績時間を集計します。</p>
      <div>
        <h2>画面例</h2>
        <p>プロジェクトキー欄にバックログのプロジェクトキーを入れ、期間を指定し、確認ボタンを押すと・・・</p>
        <img src="{{ url('/img/bl_aggregate_fig_1.png') }}" />
        <p>Backlogの標準機能にはない、期間別の工数集計ができます。</p>
        <img src="{{ url('/img/bl_aggregate_fig_2.png') }}" />
        <h3>例えばこんな用途に</h3>
        <ul>
          <li>社内の月次の工数管理</li>
          <li>バックログプロジェクトごとの保守月次報告書の作成</li>
          <li>社内の週次報告・日次報告</li>
        </ul>
        <h2>使い方</h2>
        <p>(1)まずはBacklog側でAPIキーを登録します。</p>
        <img src="{{ url('/img/bl_aggregate_fig_3.png') }}" />
        <p>(2)赤枠左下「API」をクリックします。赤枠右上の「個人設定」＞「ユーザー情報」画面の「ユーザーID」をbootoolsの設定＞「ユーザーID」欄に使用します。</p>
        <img src="{{ url('/img/bl_aggregate_fig_4.png') }}" />
        <p>(3)「新しいAPIキーを発行」の入力欄に任意のメモを入れ「登録」ボタンを押します。</p>
        <img src="{{ url('/img/bl_aggregate_fig_5.png') }}" />
        <p>(4)登録されたAPIキーに新しいAPIキーが追加されます。この値をboo.toolsの設定＞「APIキー」欄に使用します。</p>
        <img src="{{ url('/img/bl_aggregate_fig_6.png') }}" />
        <p>(5)bootoolsの設定＞Backlog基本設定をクリックします。</p>
        <img src="{{ url('/img/bl_aggregate_fig_7.png') }}" />
        <p>(6)赤枠「編集」をクリックします。</p>
        <img src="{{ url('/img/bl_aggregate_fig_8.png') }}" />
        <p>(7)(2)で確認したユーザーID,ホスト名(お使いのバックログのドメイン「****.backlog.jp」など),(4)で作成したAPIキーを入力し、赤枠「保存」をクリックします。これで設定は完了です。</p>
        <img src="{{ url('/img/bl_aggregate_fig_9.png') }}" />
        <p>(8)bootoolsのロゴをクリックしTOPに戻ります</p>
        <img src="{{ url('/img/bl_aggregate_fig_10.png') }}" />
        <p>(9)下記赤枠のBacklog期間別集計の>>>Goをクリックします。</p>
        <img src="{{ url('/img/bl_aggregate_fig_11.png') }}" />
        <p>(10)プロジェクトキー欄にバックログのプロジェクトキーを入れ、期間を指定し、確認ボタンを押します。</p>
        <img src="{{ url('/img/bl_aggregate_fig_1.png') }}" />
        <p>(11)課題ごとの集計結果が表示されます。</p>
        <img src="{{ url('/img/bl_aggregate_fig_2.png') }}" />

      </div>
    </div>
  </div>
</div>
@endsection