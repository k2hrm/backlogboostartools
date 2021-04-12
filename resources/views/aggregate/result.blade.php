@extends('layouts.app')
@section('title', '実行結果|Backlog期間別集計ツール')
@section('description', 'Backlogプロジェクト指定期間内での作業実績時間集計結果です')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4 mt-2">
            <h1>{{$proj_key}}の実績時間集計結果</h1>
            <ul>
                <li>
                    集計期間 : {{$from_date}}から{{$to_date}}まで
                </li>
            </ul>
            <table>
                @foreach($issueKeyAndHoursArrs as $issueKeyAndHoursArr)
                @if($loop->first)
                <tr>
                    @foreach($issueKeyAndHoursArr as $v)
                    <th>{{$v}}</th>
                    @endforeach
                </tr>
                @else
                <tr>
                    @foreach($issueKeyAndHoursArr as $v)
                    <td>{{$v}}</td>
                    @endforeach
                </tr>
                @endif
                @endforeach
            </table>
            <section>
                独自の集計結果にカスタマイズしたい！<br />
                PDFやExcelのファイル形式で出力したい！<br />
                などのお問い合わせはメールboolzjp@gmail.comまで<br />
                お気軽にお問い合わせください
            </section>
            <p><a href="../aggregate/">戻る</a></p>
        </div>
    </div>
</div>
@endsection