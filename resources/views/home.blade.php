@extends('layouts.app')
@section('title', 'Backlog Booster Tools')
@section('description', 'Backlogの機能拡張ツール群を提供')
@section('content')
<div class="container toppage">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Backlog Booster Tools</h1>
            <img src="{{ url('/img/booster.png') }}" class="topimg" />
            <h2>期間集計ツール<span>Period Aggregation Tool</span></h2>
            <p>プロジェクトごとの指定期間内での作業実績時間を集計します。 <a href=" aggregate/">>>Go</a></p>
            <h2>一斉送信ツール<span>Send At Once Tool</span></h2>
            <p>同じ投稿をバックログの複数プロジェクトに一斉送信できるツールです。 <a href="send/">>>Go</a></p>
            <h2>日報作成ツール<span>Daily-report Creation Tool</span></h2>
            <p>Backlogの活動から、ユーザーの日報を生成するツールです。 <a href="dailyreport/">>>Go</a></p>
            <h2>設定<span>Settings</span></h2>
            <p>各種設定情報を登録します。<a href="settings/">>>Go</a></p>
            <h2>マニュアル<span>Manuals</span></h2>
            <ul>
                <li><a href="{{ url('manuals/aggregate') }}">期間集計ツール</a></li>
                <li><a href="{{ url('manuals/send') }}">一斉送信ツール</a></li>
                <li><a href="{{ url('manuals/dailyreport') }}">日報作成ツール</a></li>
                <li><a href="{{ url('manuals/settings') }}">設定</a></li>
            </ul>
            <h2>お問い合わせ<span>Contanct</span></h2>
            <p>ご要望や不具合報告などはこちらまでお願い致します。<a href="contact/">>>Go</a></p>
        </div>
    </div>
</div>
@endsection