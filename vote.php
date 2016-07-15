<?php
echo '222';


$header = array(        //构造头部
    'CLIENT-IP:58.68.44.61',
    'X-FORWARDED-FOR:58.68.44.61',
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/2.php");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  //构造IP
curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/ ");   //构造来路
curl_setopt($ch, CURLOPT_HEADER, 1);
$out = curl_exec($ch);
curl_close($ch);