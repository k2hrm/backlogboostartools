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
                    <h1>メニュー</h1>
                    <ul>
                        <li><a href="aggregate/">Backlog期間別集計</a></li>
                        <li><a href="settings/">設定</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection