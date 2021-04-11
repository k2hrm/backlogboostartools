@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 mb-4 mt-2">
      <h1>一斉送信ツール</h1>
      <p>一斉送信します。<a href="guide/send">使い方</a></p>
      <div style="border: 1px solid #c3bebe;padding: 30px;border-radius: 10px;">
        @if(count($settings) > 0)
        <form action="{{ url('send/result') }}" method="POST" class="form-horizontal" onSubmit="return check()">
          @csrf
          <table>
            <tr>
              <th><label for="title">タイトル</label></th>
              <td><input type="text" name="title" id="title" style="width:400px;" /></td>
            </tr>
            <tr>
              <th><label for="textarea">メッセージ本文:</label></th>
              <td>
                <textarea name="description" id="description" style="width: 800px;" /></textarea>
              </td>
            </tr>
            @foreach($settings as $setting)
            <tr>
              <th>プロジェクトキー</th>
              <td>
                @foreach($settings as $setting)
                @foreach (explode(",",$setting->proj_key) as $pkey)
                <input type="checkbox" name="proj_keys[]" value="{{$pkey}}" id="{{$pkey}}"><label for="{{$pkey}}">{{$pkey}}
                  @endforeach
                  @endforeach
              </td>
            </tr>
            </tr>
          </table>
          <input type="hidden" name="hostname" value="{{$setting->hostname}}">
          <input type="hidden" name="api_key" value="{{$setting->api_key}}">
          <input type="submit" value="送信">
          @endforeach
        </form>
        @else
        <p>Backlogの情報が設定されていません。<a href="settings/edit">こちら</a>から設定してください</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection