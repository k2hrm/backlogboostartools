<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index($id="noname",$pass="unknown") {
        return <<<EOF
<html>
<head>
<title>Hello/Index</title>
</style>
<body>
<p>HelloのIndexアクション</p>
<ul>
<li>ID: {$id}</li>
<li>PASS: {$pass}</li>
</body>
</html>
EOF;
    }
}
