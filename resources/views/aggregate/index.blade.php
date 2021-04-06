@extends('layouts.app')

@section('content')
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4 mt-2">
        <h1>Backlog期間指定実績時間確認ツール</h1>
			  <p>プロジェクトごとの指定期間内での作業実績時間を集計します。</p>
			  <div style="border: 1px solid #c3bebe;padding: 30px;border-radius: 10px;">
			  <form action="{{ url('aggregate/result') }}" method="POST" class="form-horizontal">
         @csrf
        <p>プロジェクトキー : <input type="text" name="projkey" /></p>
    <p>
      <label for="check_flex">期間指定</label>
       : 
      <select name ="periodyearfrom">
      <?php
      $thisyear=date('Y');
      $lastyear=date('Y', strtotime('-1 year'));
      $nextyear=date('Y',strtotime('+1 year'));
      echo '<option value="'.$lastyear.'">'.$lastyear.'</option>';
      echo '<option value="'.$thisyear.'" selected>'.$thisyear.'</option>';
      echo '<option value="'.$nextyear.'">'.$nextyear.'</option>';
      ?>
      </select>
      <select name ="periodmonthfrom">
      <?php
     for($i=1;$i<=12;$i++){
     echo '<option value="'.$i.'">'.$i.'</option>';
     } 
      ?>
      </select>
      <select name ="perioddayfrom">
      <?php
      for($i=1;$i<=31;$i++){
        echo '<option value="'.$i.'">'.$i.'</option>';
      }
      ?>
      </select>
      ～
      <select name ="periodyearto">
      <?php
      $thisyear=date('Y');
      $lastyear=date('Y', strtotime('-1 year'));
      $nextyear=date('Y',strtotime('+1 year'));
      echo '<option value="'.$lastyear.'">'.$lastyear.'</option>';
      echo '<option value="'.$thisyear.'" selected>'.$thisyear.'</option>';
      echo '<option value="'.$nextyear.'">'.$nextyear.'</option>';
      ?>
      </select>
      <select name ="periodmonthto">
      <?php
     for($i=1;$i<=12;$i++){
     echo '<option value="'.$i.'">'.$i.'</option>';
     } 
      ?>
      </select>
      <select name ="perioddayto">
      <?php
      for($i=1;$i<=31;$i++){
        echo '<option value="'.$i.'">'.$i.'</option>';
      }
      ?>
      </select>
   </p>
   @foreach($settings as $setting)
        <input type="hidden" name="hostname" value="{{$setting->hostname}}">
        <input type="hidden" name="api_key" value="{{$setting->api_key}}">
        <input type="hidden" name="proj_key" value="{{$setting->proj_key}}">
        <input type="hidden" name="bl_user_id" value="{{$setting->bl_user_id}}">
   @endforeach
    <p>
      <input type="submit" value="確認">
    </p>
  </form>
			  </div>
          </div>
        </div>
      </div>
@endsection
