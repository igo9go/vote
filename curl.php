<?php


$url = 'http://www.demo.com/vote/ip.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_exec($ch);

curl_close($ch);


/*$url = 'http://blog.snsgou.com';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch); // 已经获取到内容，没有输出到页面上。
curl_close($ch);
echo $response;*/