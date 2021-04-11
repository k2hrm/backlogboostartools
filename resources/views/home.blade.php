@extends('layouts.app')

@section('content')
<div class="container toppage">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1><img src="{{ url('/img/bools_title_short.png') }}" />
                Backlog Booster Tools</h1>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <h2>期間集計ツール<span>Period Aggregation Tool</span></h2>
            <p>Backlogの標準機能にはない、期間指定しての工数集計が簡単にできるツールです。 <a href="aggregate/">>>Go</a></p>
            <h2>一斉送信ツール<span>Send At Once Tool</span></h2>
            <p>同じ投稿をバックログの複数プロジェクトに一斉送信できるツールです。 <a href="send/">>>Go</a></p>
            <h2>日報作成ツール<span>Daily-report Creation Tool</span></h2>
            <p>特定ユーザーの日報を生成できるツールです。 <a href="dailyreport/">>>Go</a></p>
            <h2>設定<span>Settings</span></h2>
            <p>各種設定情報を登録します。<a href="settings/">>>Go</a></p>
            <h2>マニュアル<span>DOCS</span></h2>
            <h3>Manuals</h3>
            <ul>
                <li><a href="guide/aggregate">期間集計ツール</a></li>
                <li><a href="guide/send">一斉送信ツール</a></li>
                <li><a href="guide/dailyreport">日報作成ツール</a></li>
            </ul>
            <h3>Magazine</h3>
            <p>第一回 : Backlog APIを使ってできること<a href="mag/1">>>Go</a></p>
        </div>
    </div>
</div>
@endsection