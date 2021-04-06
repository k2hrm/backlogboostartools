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
                    <h1>MENU</h1>
                    <ul>
                        <li><a href="aggregate/">Backlog期間別集計</a></li>
                        <li><a href="#">Backlog課題一斉送信</a></li>
                        <li><a href="settings/">設定</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
