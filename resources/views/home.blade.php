@extends('layouts.app')
@section('title', 'Backlog Booster Tools')
@section('description', 'Backlogの機能拡張ツール群を提供')
@section('content')
<div class="container toppage">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="top-title-area">
                <h1>Backlog Boostar Tools</h1>
                <img src="{{ url('/img/booster.png') }}" class="topimg" />
            </div>
            <div class=" tool-list-wrapper">
                <h2><a href=" aggregate/">期間集計ツール<span>Period Aggregation Tool</span></a></h2>
                <p>プロジェクトごとの指定期間内での作業実績時間を集計します。</p>
            </div>
            <div class="tool-list-wrapper">
                <h2><a href="send/">一斉送信ツール<span>Send Group Tool</span></a></h2>
                <p>同じ投稿をバックログの複数プロジェクトに一斉送信できるツールです。</p>
            </div>
            <div class="tool-list-wrapper">
                <h2><a href="dailyreport/">日報作成ツール<span>Daily Report Generate Tool</span></a></h2>
                <p>Backlogの活動から、ユーザーの日報を生成するツールです。 </p>
            </div>
            <div class="tool-list-wrapper">
                <h2><a href="settings/">設定<span>Settings</span></a></h2>
                <p>各種設定情報を登録します。</p>
            </div>
            <div class="tool-list-wrapper">
                <h2><a href="manuals/">マニュアル<span>Manuals</span></a></h2>
                <p>各ツールの操作マニュアルです。</p>
            </div>
            <div class="tool-list-wrapper">
                <h2><a href="https://docs.google.com/forms/d/e/1FAIpQLScPyJopuGMfJMWsE6pLZ92Yr7dV7XDMzybJWnm6fwG5b5q1zQ/viewform">お問い合わせ<span>Contanct</span></a></h2>
                <p>ご要望や不具合報告などはこちらまでお願い致します。</p>
            </div>
            <div>
                <p>開発へのご支援お願い致します(<a href="https://www.amazon.jp/hz/wishlist/ls/37NSY8BOC8IYJ?ref_=wl_share">Amazonウィッシュリスト</a>,
                    <a href=" {{ asset('img/paypay_qr.jpg') }}" target="_blank">寄付(PayPay)</a>)
                </p>
            </div>
        </div>
    </div>
</div>
@endsection