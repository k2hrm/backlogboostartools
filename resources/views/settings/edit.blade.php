@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <h1>Backlog基本設定の編集 <a href="{{ url('settings/') }}">戻る</a></h1>
          @include('common.errors')
          <form action="{{ url('settings/edit') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
              <div class="col-sm-6">
                <table>
                  <tr>
                    <th>ユーザーID</th>
                    <td><input type="text" name="bl_user_id" class="form-control" value="@if($settings) {{$settings->bl_user_id}} @endif"></td>
                  </tr>

                  <tr>

                    <th>ホスト名</th>
                    <td><input type="text" name="hostname" class="form-control" value="@if($settings) {{$settings->hostname}} @endif"></td>
                  </tr>
                  <tr>
                    <th>APIキー</th>
                    <td><input type="text" name="api_key" class="form-control" value="@if($settings) {{$settings->api_key}} @endif"></td>
                  </tr>
                  <th>プロジェクトキー(カンマ区切り)</th>
                  <td><input type="text" name="proj_key" class="form-control" value="@if($settings) {{$settings->proj_key}} @endif"></td>
                  </tr>
                  <tr>
                    <th>出力項目</th>
                    <td>
                      <input type="checkbox" name="vip_issueType" id="vip_issueType" value="vip_issueType" @if($outputitems && $outputitems->vip_issueType) checked @endif><label for="vip_issueType">種別</label>
                      <input type="checkbox" name="vip_key" id="vip_key" value="vip_key" @if($outputitems && $outputitems->vip_key) checked @endif><label for="vip_key">キー</label>
                      <input type="checkbox" name="vip_summary" id="vip_summary" value="vip_summary" @if($outputitems && $outputitems->vip_summary) checked @endif><label for="vip_summary">件名</label>
                      <input type="checkbox" name="vip_assigner" id="vip_assigner" value="vip_assigner" @if($outputitems && $outputitems->vip_assigner) checked @endif><label for="vip_assigner">担当者</label>
                      <input type="checkbox" name="vip_status" id="vip_status" value="vip_status" @if($outputitems && $outputitems->vip_status) checked @endif><label for="vip_status">状態</label>
                      <input type="checkbox" name="vip_priority" id="vip_priority" value="vip_priority" @if($outputitems && $outputitems->vip_priority) checked @endif><label for="vip_priority">優先度</label>
                      <input type="checkbox" name="vip_created" id="vip_created" value="vip_created" @if($outputitems && $outputitems->vip_created) checked @endif><label for="vip_created">登録日</label>
                      <input type="checkbox" name="vip_startDate" id="vip_startDate" value="vip_startDate" @if($outputitems && $outputitems->vip_startDate) checked @endif><label for="vip_startDate">開始日</label>
                      <input type="checkbox" name="vip_updated" id="vip_updated" value="vip_updated" @if($outputitems && $outputitems->vip_updated) checked @endif>更新日</label>
                      <input type="checkbox" name="vip_createdUser" id="vip_createdUser" value="vip_createdUser" @if($outputitems && $outputitems->vip_createdUser) checked @endif><label for="vip_createdUser">登録者</label>
                    </td>
                  </tr>
                </table>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                  保存
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection