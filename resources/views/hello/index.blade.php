<html>
<head>
  <title>Hello/Index</title>
</head>
<body>
  <h1>Blade/Index</h1>
  <p>{{$msg}}</p>
  <form method="POST" action="/laravel/public/hello">
  {{ csrf_field() }}
  <input type="text" name="msg">
  <input type="submit">
  </form>
</body>
</html>