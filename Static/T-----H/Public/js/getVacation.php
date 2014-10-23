<?php
function make_cors($origin = '*') {
 
    $request_method = $_SERVER['REQUEST_METHOD'];
 
    if ($request_method === 'OPTIONS') {
 
        header('Access-Control-Allow-Origin:'.$origin);
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
 
        header('Access-Control-Max-Age:1728000');
        header('Content-Type:text/plain charset=UTF-8');
        header('Content-Length: 0',true);
 
        header('status: 204');
        header('HTTP/1.0 204 No Content');
 
    }
 
    if ($request_method === 'POST') {
 
        header('Access-Control-Allow-Origin:'.$origin);
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
 
    }
 
    if ($request_method === 'GET') {
 
        header('Access-Control-Allow-Origin:'.$origin);
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
 
    }
 
}

make_cors();
$ym = $_GET['ym'];
$url = "http://www.easybots.cn/api/holiday.php?m=".$ym;
$jsonData = file_get_contents($url);	
echo($jsonData);