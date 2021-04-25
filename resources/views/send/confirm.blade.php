@extends('layouts.app')
@section('title', 'Backlog一斉送信ツール')
@section('description', '同じ投稿をBacklogの複数プロジェクトに一斉送信できるツールです。')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>確認：一斉送信ツール</h1>
      <p>下記の内容で送信します。よろしいですか？</p>
      <form action="{{ url('send/result') }}" method="POST" class="form-horizontal" onSubmit="return check()">
        @csrf
        <table>
          <tr>
            <th><label for="title">タイトル</label></th>
            <td><input type="hidden" name="title" id="title" value="{{$request->title}}" />{{$request->title}}</td>
          </tr>
          <tr>
            <th><label for="textarea">メッセージ本文:</label></th>
            <td>
              <input type="hidden" name="description" id="description" value="{{$request->description}}" />
              {{$request->description}}
            </td>
          </tr>
          <tr>
            <th>
              プロジェクトキー / 担当者
            </th>
            <td>
              <ul id="user_projects">
                @for($i=0;$i<count($request->project_keys);$i++)
                  <li>プロジェクトキー:{{$request->project_keys[$i]}}
                    <input type="hidden" name="project_keys[]" value="{{$request->project_keys[$i]}}" />
                    <input type="hidden" name="asignee_ids[]" value="{{$request->asignee_ids[$i]}}" />
                    担当者ID:{{$request->asignee_ids[$i]}}
                    担当者名:
                    @foreach($userIdNames as $userIdName)
                    @if($request->asignee_ids[$i] == $userIdName[0])
                    {{$userIdName[1]}}
                    @break
                    @endif
                    @endforeach
                    @endfor
                  </li>
              </ul>
            </td>
            </td>
          </tr>
          <tr>
            <th>ホスト名</th>
            <td><input type="hidden" name="hostname" value="{{$request->hostname}}">{{$request->hostname}}
            </td>
          </tr>
        </table>
        <input class="btn btn-primary" type="submit" value="送信">
    </div>
  </div>
</div>
@endsection