@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4 mt-2">
            <h1>日報作成結果</h1>
            {{$userId}}さんの@if($day==="this")本日@else昨日@endif対応したプロジェクト別のチケットです
            @foreach($projKeys as $projKey)
            <h2>{{$projKey}}</h2>
            <ul>
                @foreach($issues as $issue => $item)
                @if($item['pjkey'] == $projKey)
                <li>{{ $item['key'] }} {{ $item['title'] }}</li>
                @endif
                @endforeach
            </ul>
            @endforeach
            <p><a href="../dailyreport/">戻る</a></p>
        </div>
    </div>
</div>
@endsection