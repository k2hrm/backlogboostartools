@extends('layouts.app')
@section('title', 'Backlog一斉送信ツール')
@section('description', '同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>一斉送信ツール</h1>
      <p>休暇のお知らせなどの同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。 <a href="{{ url('manuals/send') }}">>> 使い方</a></p>
      <div style="border: 1px solid #c3bebe;padding: 30px;border-radius: 10px;">
        <form action="{{ url('send/confirm') }}" method="POST" class="form-horizontal">
          @csrf
          <table>
            <tr>
              <th><label for="title">タイトル</label></th>
              <td><input type="text" name="title" id="title" /></td>
            </tr>
            <tr>
              <th><label for="textarea">メッセージ本文:</label></th>
              <td>
                <textarea name="description" id="description" /></textarea>
              </td>
            </tr>
            <tr>
              <th>
                プロジェクトキー / 担当者
              </th>
              <td>
                <ul id="user_projects">
                  <li>キー:<input type="text" name="project_keys[]"></li>
                  <li>担当者:<input type="text" name="asignee_ids[]"></li>
                </ul>
                <input type="button" value="追加" onclick="addpj();">
              </td>
              </td>
            </tr>
            <tr>
              <th>APIキー</th>
              <td><input type="text" name="api_key">
              </td>
            </tr>
            <tr>
              <th>ホスト名</th>
              <td><input type="text" name="hostname">
              </td>
            </tr>
          </table>
          <input type="submit" value="送信内容確認">
          <p>メンバー登録すると、次回ログイン時に同じ設定を呼び出すことができます。</p>
          <p><a href="register">メンバー登録する</a></p>
          <p>すでにメンバー登録している方は<a href="login">ログイン</a>してください。</p>
      </div>
    </div>
  </div>
</div>
@endsection