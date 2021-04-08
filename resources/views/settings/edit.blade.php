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
                    <td><input type="text" name="bl_user_id" class="form-control"></td>
                  </tr>

                  <tr>
                    <th>ホスト名</th>
                    <td><input type="text" name="hostname" class="form-control"></td>
                  </tr>
                  <tr>
                    <th>APIキー</th>
                    <td><input type="text" name="api_key" class="form-control"></td>
                  </tr>
                  <th>プロジェクトキー(カンマ区切り)</th>
                  <td><input type="text" name="proj_key" class="form-control"></td>
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