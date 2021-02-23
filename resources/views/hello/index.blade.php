<html>
<head>
  <title>Hello/Index</title>
</head>
<body>
  <h1>Blade/Index</h1>
  <p>&#064;foreachディレクティブの例</p>
  <ol>
  @foreach($data as $item)
  <li>{{$item}}
  @endforeach
  </ol>
</body>
</html>