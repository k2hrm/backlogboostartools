@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>期間別集計ツール</h1>
      <p>プロジェクトごとの指定期間内での作業実績時間を集計します。<a href="guide/aggregate">使い方</a></p>
      <div style="border: 1px solid #c3bebe;padding: 30px;border-radius: 10px;">
        @if(count($settings) > 0)

        <form action="{{ url('aggregate/result') }}" method="POST" class="form-horizontal">
          @csrf
          <table style="margin-bottom: 10px;">
            <tr>
              <th>
                <label for="check_flex">期間指定</label>
              </th>
              <td>
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
              </td>
            </tr>
            <tr>
              <th>プロジェクトキー</th>
              <td>
                <select name="proj_key">
                  @foreach($settings as $setting)
                  @foreach (explode(",",$setting->proj_key) as $pkey)
                  <option value="{{$pkey}}">{{$pkey}}</option>
                  @endforeach
                  @endforeach
                </select>
              </td>
            </tr>
            <tr>
              <th>出力項目</th>
              <td>
                @foreach($outputitems as $outputitem)
                <input type="checkbox" name="vip_issueType" id="vip_issueType" value="vip_issueType" @if($outputitem->vip_issueType) checked @endif><label for="vip_issueType">種別</label>
                <input type="checkbox" name="vip_key" id="vip_key" value="vip_key" @if($outputitem->vip_key) checked @endif><label for="vip_key">キー</label>
                <input type="checkbox" name="vip_summary" id="vip_summary" value="vip_summary" @if($outputitem->vip_summary) checked @endif><label for="vip_summary">件名</label>
                <input type="checkbox" name="vip_assigner" id="vip_assigner" value="vip_assigner" @if($outputitem->vip_assigner) checked @endif><label for="vip_assigner">担当者</label>
                <input type="checkbox" name="vip_status" id="vip_status" value="vip_status" @if($outputitem->vip_status) checked @endif><label for="vip_status">状態</label>
                <input type="checkbox" name="vip_priority" id="vip_priority" value="vip_priority" @if($outputitem->vip_priority) checked @endif><label for="vip_priority">優先度</label>
                <input type="checkbox" name="vip_created" id="vip_created" value="vip_created" @if($outputitem->vip_created) checked @endif><label for="vip_created">登録日</label>
                <input type="checkbox" name="vip_startDate" id="vip_startDate" value="vip_startDate" @if($outputitem->vip_startDate) checked @endif><label for="vip_startDate">開始日</label>
                <input type="checkbox" name="vip_updated" id="vip_updated" value="vip_updated" @if($outputitem->vip_updated) checked @endif><label for="vip_updated">更新日</label>
                <input type="checkbox" name="vip_createdUser" id="vip_createdUser" value="vip_createdUser" @if($outputitem->vip_createdUser) checked @endif><label for="vip_createdUser">登録者</label>
                @endforeach
              </td>
            </tr>
          </table>
          <input type="hidden" name="bl_user_id" value="{{$setting->bl_user_id}}">
          <input type="hidden" name="hostname" value="{{$setting->hostname}}">
          <input type="hidden" name="api_key" value="{{$setting->api_key}}">
          <input type="submit" value="確認">
        </form>
        @else
        <p>Backlogの情報が設定されていません。<a href="settings/edit">こちら</a>から設定してください</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection