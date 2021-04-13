@extends('layouts.app')
@section('title', 'Backlog日報作成ツール')
@section('description', 'Backlogの活動から、ユーザーの日報を生成するツールです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>日報作成ツール</h1>
      <p>Backlogの活動から、ユーザーの日報を生成するツールです。<a href="manuals/dailyreport">使い方</a></p>
      @if(count($settings) > 0)
      <form action="{{ url('dailyreport/result') }}" method="post">
        @csrf
        @foreach($settings as $setting)
        <table>
          <tr>
            <th>ユーザーID</th>
            <td>
              {{$setting->bl_user_id}}
            </td>
          </tr>
          <tr>
            <th>APIキー</th>
            <td>{{$setting->api_key}}</td>
          </tr>
          <tr>
            <th>ホスト名</th>
            <td>{{$setting->hostname}}</td>
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
        <p><a href="{{ url('settings/edit') }}">設定変更</a></p>
        <input type="hidden" name="bl_user_id" value="{{$setting->bl_user_id}}">
        <input type="hidden" name="hostname" value="{{$setting->hostname}}">
        <input type="hidden" name="api_key" value="{{$setting->api_key}}">
        @endforeach
        <p><input type="submit" value="日報作成"></p>
      </form>
      @else
      <p>Backlogの情報が設定されていません。<a href="settings/edit">こちら</a>から設定してください</p>
      @endif
    </div>
  </div>
</div>
@endsection