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
                    <h1>設定</h1>
                    <h2>Backlog基本設定 </h2>
                    <button class="btn btn-primary" onclick="location.href='settings/edit'" ;>編集</button>
                    @if(count($settings) === 0)
                    まだ設定されていません。<a href="settings/edit">こちら</a>から設定してください。
                    @else
                    <table>
                        @foreach($settings as $setting)
                        <tr>
                            <th>ユーザーID </th>
                            <td> {{$setting->bl_user_id}}</td>
                        </tr>
                        <tr>
                            <th>ホスト名</th>
                            <td>{{$setting->hostname}}</td>
                        </tr>
                        <tr>
                            <th>APIキー</th>
                            <td>{{$setting->api_key}}</td>
                        </tr>
                        <tr>
                            <th>プロジェクト</th>
                            <td>
                                @if($user_projects)
                                @foreach($user_projects as $user_project)
                                <form action="{{ url('user_projects/'.$user_project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <ul id="pj{{$loop->index}}">
                                        <li>キー: {{$user_project->project_key}}</li>
                                        <li>担当者: {{$user_project->asignee_id}}</li>
                                    </ul>
                                    <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                                @endforeach
                                @else
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>出力項目</th>
                            <td>
                                @foreach($outputitems as $outputitem)
                                @if($outputitem->vip_issueType)
                                種別
                                @endif
                                @if($outputitem->vip_key)
                                キー
                                @endif
                                @if($outputitem->vip_summary)
                                件名
                                @endif
                                @if($outputitem->vip_assigner)
                                担当者
                                @endif
                                @if($outputitem->vip_status)
                                状態
                                @endif
                                @if($outputitem->vip_priority)
                                優先度
                                @endif
                                @if($outputitem->vip_created)
                                登録日
                                @endif
                                @if($outputitem->vip_startDate)
                                開始日
                                @endif
                                @if($outputitem->vip_estimatedHours)
                                予定時間
                                @endif
                                @if($outputitem->vip_updated)
                                更新日
                                @endif
                                @if($outputitem->vip_createdUser)
                                登録者
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection