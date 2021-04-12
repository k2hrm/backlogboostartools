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
                    <p><a href="settings/edit">編集</a></p>
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
                            <th>プロジェクトキー</th>
                            <td>{{$setting->proj_key}}</td>
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