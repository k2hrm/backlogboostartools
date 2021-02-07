<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
public function index(Request $request,Response $response) {
    $html = <<<EOF
<html>
<head>
<title>Hello/Index</title>
<style>
body {font-size:16pt; color:#999;}
h1 {font-size:120pt;}
</style>
</head>
<body>
<h1>Hello</h1>
<h3>Request</h3>
<pre>{$request}</pre>
<h3>response</h3>
<pre>{$response}</pre>
</body>
</html>
EOF;
   $response->setContent($html);
   return $response;
}
}