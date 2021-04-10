@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Backlog Boostar Tools</h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h2>KST<span style="font-size: 0.6em;">(期間別集計ツール)</span></h2>
                    <p>Backlogの標準機能にはない、期間別の工数集計が簡単にできるツールです。 <a href="kst/">>>Go</a></p>
                    <h2>IST<span style="font-size: 0.6em;">(一斉送信ツール)</span></h2>
                    <p>同じ投稿をバックログの複数プロジェクトに一斉送信できるツールです。 <a href="ist/">>>Go</a></p>
                    <h2>NST<span style="font-size: 0.6em;">(日報作成ツール)</span></h2>
                    <p>特定ユーザーの日報を生成できるツールです。 <a href="nst/">>>Go</a></p>
                    <h2>Settings<span style="font-size: 0.6em;">(設定)</span></h2>
                    <p>各種設定情報を登録します。<a href="settings/">>>Go</a></p>
                    <h2>DOCS<span style="font-size: 0.6em;">(マニュアル)</span></h2>
                    <h3>Manuals</h3>
                    <ul>
                        <li><a href="guide/kst">KST</a></li>
                        <li><a href="guide/ist">IST</a></li>
                        <li><a href="guide/nst">NST</a></li>
                    </ul>
                    <h3>Magazine</h3>
                    <p>第一回 : Backlog APIを使ってできること<a href="mag/1">>>Go</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection