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
                    <h2>Backlog基本設定 <a href="settings/edit">編集</a></h2>
                    <ul>
                        @foreach($settings as $setting)
                        <li>ホスト名 : {{$setting->hostname}}</li>
                        <li>APIキー : {{$setting->api_key}}</li>
                        <li>ユーザーID : {{$setting->bl_user_id}}</li>
                        <li>プロジェクトキー : {{$setting->proj_key}}</li>
                        <li>出力項目 :
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
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection