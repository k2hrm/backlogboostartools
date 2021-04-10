@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4 mt-2">
            <h1>一斉送信結果</h1>
            {{$proj_key}}
            <p><a href="../ist/">戻る</a></p>
        </div>
    </div>
</div>
@endsection