@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>日報作成ツール<a href="guide/dailyreport">使い方</a></h1>
      <form action="{{ url('dailyreport/result') }}" method="post">
        @csrf
        <table>
          <tr>
            <th>ユーザーID</th>
            <td>
              <input type="text" name="bl_user_id" />
            </td>
          </tr>
          <tr>
            <th>APIキー</th>
            <td><input type="text" name="api_key" /></td>
          </tr>
          <tr>
            <th>ホスト名</th>
            <td><input type="text" name="hostname" /></td>
          </tr>
          <tr>
            <th>対象日付</th>
            <td>
              <input type="radio" id="check_this" name="day" value="this" checked="checked">
              <label for="check_this">本日分</label>
              <input type="radio" id="check_last" name="day" value="last">
              <label for="check_last">昨日分</label>
            </td>
          </tr>
        </table>
        <p><input type="submit" value="送信"></p>
      </form>
      <p>メンバー登録すると、こんなことができます！</p>
      <ul>
        <li>
          プロジェクトキー、APIキー、ホスト名、出力項目の保存、呼び出し
        </li>
      </ul>
      <p><a href="register">メンバー登録する</a></p>
      <p>すでにメンバー登録している方は<a href="login">ログイン</a>してください。</p>
      </p>
      </form>
    </div>
  </div>
</div>
@endsection