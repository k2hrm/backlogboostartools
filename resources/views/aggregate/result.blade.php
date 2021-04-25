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
            <form action="{{ url('aggregate/csv') }}" method="POST" class="form-horizontal">
                @csrf
                @for($i=0; $i < count($issueKeyAndHoursArrs); $i++) @for($j=0; $j <count($issueKeyAndHoursArrs[$i]); $j++) <input type="hidden" name="result[{{$i}}][{{$j}}]" value={{$issueKeyAndHoursArrs[$i][$j]}}>
                    @endfor
                    @endfor
                    <button type="submit" class="btn btn-primary">
                        CSVダウンロード
                    </button>
            </form>
            <p><a class="btn btn-primary" href="../aggregate/">戻る</a></p>
        </div>
    </div>
</div>
@endsection