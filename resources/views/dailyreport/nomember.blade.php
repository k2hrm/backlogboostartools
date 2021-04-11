@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>日報作成ツール</span></h1>
      <p>プロジェクトごとの指定期間内での作業実績時間を集計します。<a href="{{ url('guide/ist') }}">使い方</a></p>
      <div style="border: 1px solid #c3bebe;padding: 30px;border-radius: 10px;">
        <form action="{{ url('kst/result') }}" method="POST" class="form-horizontal">
          @csrf
          <p>
            <label for="check_flex">期間指定</label>
            :
            <select name="periodyearfrom">
              <?php
              $thisyear = date('Y');
              $lastyear = date('Y', strtotime('-1 year'));
              $nextyear = date('Y', strtotime('+1 year'));
              echo '<option value="' . $lastyear . '">' . $lastyear . '</option>';
              echo '<option value="' . $thisyear . '" selected>' . $thisyear . '</option>';
              echo '<option value="' . $nextyear . '">' . $nextyear . '</option>';
              ?>
            </select>
            <select name="periodmonthfrom">
              <?php
              for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
            <select name="perioddayfrom">
              <?php
              for ($i = 1; $i <= 31; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
            ～
            <select name="periodyearto">
              <?php
              $thisyear = date('Y');
              $lastyear = date('Y', strtotime('-1 year'));
              $nextyear = date('Y', strtotime('+1 year'));
              echo '<option value="' . $lastyear . '">' . $lastyear . '</option>';
              echo '<option value="' . $thisyear . '" selected>' . $thisyear . '</option>';
              echo '<option value="' . $nextyear . '">' . $nextyear . '</option>';
              ?>
            </select>
            <select name="periodmonthto">
              <?php
              for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
            <select name="perioddayto">
              <?php
              for ($i = 1; $i <= 31; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
          </p>
          <table style="margin-bottom: 20px;">
            <tr>
              <th>プロジェクトキー</th>
              <td><input type="text" name="proj_key"></li>
              </td>
            </tr>
            <tr>
              <th>出力項目</th>
              <td>
                <input type="checkbox" name="vip_issueType" id="vip_issueType" value="vip_issueType"><label for="vip_issueType">種別</label>
                <input type="checkbox" name="vip_key" id="vip_key" value="vip_key" checked="checked"><label for="vip_key">キー</label>
                <input type="checkbox" name="vip_summary" id="vip_summary" value="vip_summary"><label for="vip_summary">件名</label>
                <input type="checkbox" name="vip_assigner" id="vip_assigner" value="vip_assigner"><label for="vip_assigner">担当者</label>
                <input type="checkbox" name="vip_status" id="vip_status" value="vip_status"><label for="vip_status">状態</label>
                <input type="checkbox" name="vip_priority" id="vip_priority" value="vip_priority"><label for="vip_priority">優先度</label>
                <input type="checkbox" name="vip_created" id="vip_created" value="vip_created"><label for="vip_created">登録日</label>
                <input type="checkbox" name="vip_startDate" id="vip_startDate" value="vip_startDate"><label for="vip_startDate">開始日</label>
                <input type="checkbox" name="vip_estimatedHours" id="vip_estimatedHours" value="vip_estimatedHours"><label for="vip_estimatedHours">予定時間</label>
                <input type="checkbox" name="vip_updated" id="vip_updated" value="vip_updated"><label for="vip_updated">更新日</label>
                <input type="checkbox" name="vip_createdUser" id="vip_createdUser" value="vip_createdUser"><label for="vip_createdUser">登録者</label>
                </li>
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
          <p>
            <input type="submit" value="確認">
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
</div>
@endsection