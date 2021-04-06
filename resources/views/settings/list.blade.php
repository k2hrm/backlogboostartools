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

                    {{ __('You are logged in!') }}
                    <h1>設定</h1>
                    <p><a href="settings/edit">編集</a></p>
                    <p><a href="{{ url('/') }}">戻る</a></p>
                    <!--table>
                      <tr>
                      <th>APIキー</th><td>gjklsdfgdf</td>
                      </tr>
                      <tr>
                      <th>ホスト名</th><td>gjklsdfgdf</td>
                      </tr>
                      <tr>
                      <th>プロジェクトキー</th><td>gjklsdfgdf</td>
                      </tr>
                    </table-->
                    {{Auth::user()->id}}
                    @foreach($settings as $setting)
                    <li>ホスト名 : {{$setting->hostname}}</li>
                    <li>APIキー : {{$setting->api_key}}</li>
                    <li>プロジェクトキー : {{$setting->proj_key}}</li>
                    <li>ユーザーID : {{$setting->bl_user_id}}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
