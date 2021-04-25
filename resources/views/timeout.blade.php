@extends('layouts.app')
@section('title', 'Backlog Booster Tools')
@section('description', 'Backlogの機能拡張ツール群を提供')
@section('content')
<div class="container toppage">
    <div class="row justify-content-center">
        セッションがタイムアウトしました。BacklogのAPIキーを入力してください。
        <form action="{{ url('timeout/store') }}" method="POST" class="form-horizontal">
            @csrf
            <input type="text" name="api_key">
            <input class="btn btn-primary" type="submit" value="送信">
        </form>
    </div>
</div>
@endsection