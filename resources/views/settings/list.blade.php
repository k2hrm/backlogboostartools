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
                    <p><a href="{{ url('/') }}">戻る</a></p>
                    <h2>Backlog基本設定 <a href="settings/edit">編集</a></h2>
                    <ul>
                        @foreach($settings as $setting)
                        <li>ホスト名 : {{$setting->hostname}}</li>
                        <li>APIキー : {{$setting->api_key}}</li>
                        <li>ユーザーID : {{$setting->bl_user_id}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection