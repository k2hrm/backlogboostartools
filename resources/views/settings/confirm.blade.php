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
      <h1>Backlog基本設定の確認</h1>
      <p>下記の内容で設定を保存します。よろしいですか？</p>
      @include('common.errors')
      <form action="{{ url('settings/store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
          <div class="col-sm-6">
            <table>
              <tr>
                <th>ユーザーID</th>
                <td><input type="hidden" name="bl_user_id" class="form-control" value="@if($request) {{$request->bl_user_id}} @endif">{{$request->bl_user_id}}</td>
              </tr>
              <tr>
                <th>ホスト名</th>
                <td><input type="hidden" name="hostname" class="form-control" value="@if($request) {{$request->hostname}} @endif">{{$request->hostname}}</td>
              </tr>
              <tr>
                <th>プロジェクト</th>
                <td>
                  @for($i=0;$i<count($request->project_keys_old);$i++)
                    <ul>
                      <li>キー: <input type="hidden" name="project_keys_old[]" value="{{$request->project_keys_old[$i]}}">{{$request->project_keys_old[$i]}}
                        <input type="hidden" name="user_project_ids[]" value="{{$request->user_project_ids[$i]}}">
                        <input type="hidden" name="asignee_ids_old[]" value="{{$request->asignee_ids_old[$i]}}">
                      </li>
                      <li>担当者: {{$request->asignee_ids_old[$i]}}
                        @foreach($userIdNames as $userIdName)
                        @if($request->asignee_ids_old[$i] == $userIdName[0])
                        {{$userIdName[1]}}
                        @break
                        @endif
                        @endforeach
                      </li>
                    </ul>
                    @endfor
                    <ul id="user_projects"></ul>
                </td>
              </tr>
              <tr>
                <th>出力項目</th>
                <td>
                  <input type="checkbox" name="vip_issueType" id="vip_issueType" value="vip_issueType" @if($request->vip_issueType) checked @endif><label for="vip_issueType">種別</label>
                  <input type="checkbox" name="vip_key" id="vip_key" value="vip_key" @if($request->vip_key) checked @endif><label for="vip_key">キー</label>
                  <input type="checkbox" name="vip_summary" id="vip_summary" value="vip_summary" @if($request->vip_summary) checked @endif ><label for="vip_summary">件名</label>
                  <input type="checkbox" name="vip_assigner" id="vip_assigner" value="vip_assigner" @if($request->vip_assigner) checked @endif ><label for="vip_assigner">担当者</label>
                  <input type="checkbox" name="vip_status" id="vip_status" value="vip_status" @if($request->vip_status) checked @endif ><label for="vip_status">状態</label>
                  <input type="checkbox" name="vip_priority" id="vip_priority" value="vip_priority" @if($request->vip_priority) checked @endif ><label for="vip_priority">優先度</label>
                  <input type="checkbox" name="vip_created" id="vip_created" value="vip_created" @if($request->vip_created) checked @endif ><label for="vip_created">登録日</label>
                  <input type="checkbox" name="vip_startDate" id="vip_startDate" value="vip_startDate" @if($request->vip_startDate) checked @endif ><label for="vip_startDate">開始日</label>
                  <input type="checkbox" name="vip_updated" id="vip_updated" value="vip_updated" @if($request->vip_updated) checked @endif >更新日</label>
                  <input type="checkbox" name="vip_createdUser" id="vip_createdUser" value="vip_createdUser" @if($request->vip_createdUser) checked @endif ><label for="vip_createdUser">登録者</label>
                </td>
              </tr>
            </table>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="api_key" class="form-control" value="@if($request) {{$request->api_key}} @endif">
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
    @endsection