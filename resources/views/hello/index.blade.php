<html>
<head>
  <title>Hello/Index</title>
</head>
<body>
  <h1>Blade/Index</h1>
  @if ($msg != '')
  <p>こんにちは、{{$msg}}さん。</p>
  @else
  <p>何か書いてください</p>
  @endif
  <form method="POST" action="/laravel/public/hello">
  {{ csrf_field() }}
  <input type="text" name="msg">
  <input type="submit">
  </form>
</body>
</html>