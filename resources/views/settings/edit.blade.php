@extends('layouts.app')
@section('title', 'Backlog基本設定')
@section('description', 'Backlog基本設定を定義します。')
@section('content')
<div class="container">
  <div class="col-md-8">
    <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <h1>Backlog基本設定の編集 </h1>
      <p><a href="{{ url('settings/') }}">設定トップへ</a></p>
      @include('common.errors')
      <form action="{{ url('settings/confirm') }}" method="GET" class="form-horizontal">
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
                <th>プロジェクト</th>
                <td>
                  @if($user_projects)
                  @foreach($user_projects as $user_project)
                  <ul>
                    <li>キー: <input type="text" name="project_keys_old[]" value="{{$user_project->project_key}}"></li>
                    <li>担当者: <input type="text" name="asignee_ids_old[]" value="{{$user_project->asignee_id}}"></li>
                    <input type="hidden" name="user_project_ids[]" value="{{$user_project->id}}">
                  </ul>
                  @endforeach
                  @else
                  @endif
                  <ul id="user_projects"></ul>
                  <input type="button" value="追加" onclick="addpj();">
                </td>
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
              内容確認
            </button>
          </div>
        </div>
      </form>
    </div>
    @endsection