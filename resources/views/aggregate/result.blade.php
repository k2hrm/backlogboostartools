@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4 mt-2">
            <h1>{{$from_date}}から{{$to_date}}までの{{$proj_key}}の実績時間集計結果</h1>
            <table border="1">
                <tr>
                    <th>課題キー</th>
                    <th>課題タイトル</th>
                    <th>課題作成日</th>
                    <th>課題更新日</th>
                    <th>実績時間(h)</th>
                </tr>
                @foreach($issueKeyAndHoursArrs as $value)
                <tr>
                    @foreach($value as $v)
                    <td>{{$v}}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
            <p><a href="../aggregate/">戻る</a></p>
        </div>
    </div>
</div>
@endsection