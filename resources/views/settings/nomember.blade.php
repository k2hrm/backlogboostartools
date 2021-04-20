@extends('layouts.app')
@section('title', 'Backlog基本設定')
@section('description', 'Backlog基本設定を定義します。')
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
                    <p>メンバーのみの機能です。</p>
                    <p><a href="register">メンバー登録する</a></p>
                    <p>すでにメンバー登録している方は<a href="login">ログイン</a>してください。</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection