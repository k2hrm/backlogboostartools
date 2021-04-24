@extends('layouts.app')
@section('title', 'Backlog一斉送信ツール')
@section('description', '同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>一斉送信ツール</h1>
      <p>休暇のお知らせなどの同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。 <a href="manuals/send">使い方</a></p>
      @if(count($settings) > 0)
      @if($api_key)
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
          @foreach($settings as $setting)
          <tr>
            <th>プロジェクトキーと担当者ID</th>
            <td>
              @foreach($user_projects as $user_project)
              <ul>
                <li>
                  <input type="checkbox" name="project_keys[]" value="{{$user_project->project_key}}" id="{{$user_project->project_key}}" onclick="togglenext(event);">
                  <input type="checkbox" class="chkboxhide" name="asignee_ids[]" value="{{$user_project->asignee_id}}" id="{{$user_project->asignee_id}}"><label for="{{$user_project->project_key}}">
                    {{$user_project->project_key}}(担当者ID:{{$user_project->asignee_id}}
                    担当者名:
                    @foreach($userIdNames as $userIdName)
                    @if($user_project->asignee_id === $userIdName[0])
                    {{$userIdName[1]}}
                    @break
                    @endif
                    @endforeach

                    )</label>
                </li>
              </ul>
              @endforeach
            </td>
          </tr>
          </tr>
        </table>
        <p><a href="{{ url('settings/edit') }}">設定変更</a></p>
        <input type="hidden" name="hostname" value="{{$setting->hostname}}">
        <input type="hidden" name="api_key" value="{{$setting->api_key}}">
        <input class="btn btn-primary" type="submit" value="送信内容確認">
        @endforeach
      </form>
      @else
      APIキーを入力してください。
      <form action="{{ url('send/refresh') }}" method="POST" class="form-horizontal">
        @csrf
        <input type="text" name="api_key">
        <input class="btn btn-primary" type="submit" value="送信">
      </form>
      @endif
      <script>
        function togglenext(e) {
          var next = e.target.nextElementSibling;
          if (e.target.checked === false) {
            next.checked = false;
          } else {
            next.checked = true;
          }
        }
      </script>

      @else
      <p>Backlogの情報が設定されていません。<a href="settings/edit">こちら</a>から設定してください</p>
      @endif
    </div>
  </div>
</div>
@endsection