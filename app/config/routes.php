<?php
$route = Route::instance();
$route->connect('page/(\d*)/(\d*)', 'pages_FirstPage/index/$1/$2');
$route->connect('page', 'page/index');
$route->connect('page/test', 'test/main');
unset($route);