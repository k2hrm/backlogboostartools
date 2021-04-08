@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4 mt-2">
            <h1>{{$from_date}}から{{$to_date}}までの{{$proj_key}}の実績時間集計結果</h1>
            <table border="1">
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