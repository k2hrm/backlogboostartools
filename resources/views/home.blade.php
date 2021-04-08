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
                    <h2>Backlog補助ツール</h2>
                    <p>Backlogの標準機能にはないツールを提供します。</p>
                    <h3>Backlog期間別集計</h3>
                    <p>Backlogの標準機能にはない、期間別の工数集計が簡単にできるツールです。 <a href="aggregate/">>>Go</a></p>
                    <h2>設定</h2>
                    <p>設定情報を登録します。まずはここからBacklogのAPIトークン等を設定してください<a href="settings/">>>Go</a></p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection