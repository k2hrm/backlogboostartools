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
        <form action="{{ url('send/result') }}" method="POST" class="form-horizontal" onSubmit="return check()">
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
                プロジェクトキー<br>(カンマ区切り)
              </th>
              <td>
                <input type="text" name="proj_key" id="proj_key">
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
          <input type="submit" value="送信">
          <p>メンバー登録はいかがですか？</p>
          <p>メンバー登録すると、こんなことができます！</p>
          <ul>
            <li>
              プロジェクトキー、APIキー、ホスト名、タイトル、メッセージ本文の保存、呼び出し
            </li>
          </ul>
          <p><a href="register">メンバー登録する</a></p>
          <p>すでにメンバー登録している方は<a href="login">ログイン</a>してください。</p>

      </div>
    </div>
  </div>
</div>
@endsection