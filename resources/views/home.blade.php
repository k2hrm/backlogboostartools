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
                    <h1>MENU</h1>
                    <h2>B.S.T.<span style="font-size: 0.6em;">(Backlog期間別集計ツール)</span></h2>
                    <p>Backlogの標準機能にはない、期間別の工数集計が簡単にできるツールです。 <a href="bst/">>>Go</a></p>
                    <h2>設定</h2>
                    <p>設定情報を登録します。BacklogのAPIトークン等を設定しておけば、次回から保存した設定情報を呼び出せます。<a href="settings/">>>Go</a></p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection