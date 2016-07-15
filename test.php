<?php

//随机IP
function Rand_IP()
{
    $ip2id = round(rand(600000, 2550000) / 10000); //第一种方法，直接生成
    $ip3id = round(rand(600000, 2550000) / 10000);
    $ip4id = round(rand(600000, 2550000) / 10000);
//下面是第二种方法，在以下数据中随机抽取
    $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
    $randarr = mt_rand(0, count($arr_1) - 1);
    $ip1id = $arr_1[$randarr];
    return $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
}

//抓取页面内容
function Curl($url,$id)
{
    //echo '您输入的信息是：'.fgets(STDIN);
    $curlPost = 'id='.urlencode($id);
    $ch2 = curl_init();
    $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36";//模拟windows用户正常访问

    curl_setopt($ch2, CURLOPT_URL, $url);
    curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . Rand_IP(), 'CLIENT-IP:' . Rand_IP()));
    //追踪返回302状态码，继续抓取
    curl_setopt($ch2, CURLOPT_HEADER, true);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

    curl_setopt($ch2, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $curlPost);

    curl_setopt($ch2, CURLOPT_NOBODY, false);
    curl_setopt($ch2, CURLOPT_REFERER, 'http://www.baidu.com/');//模拟来路
    curl_setopt($ch2, CURLOPT_USERAGENT, $user_agent);

    $temp = curl_exec($ch2);
    curl_close($ch2);
    return $temp;
}

fwrite(STDOUT,'请输入投票公司的id：');
$id = fgets(STDIN);
ignore_user_abort();//关闭浏览器仍然执行
set_time_limit(0);//让程序一直执行下去
$interval=1;//每隔一定时间运行
do{
    $msg=date("Y-m-d H:i:s").PHP_EOL;
    file_put_contents("log.log",$msg,FILE_APPEND);//记录日志
    echo $msg;
    print_r(Curl("http://www.cenjd.com/html/2016dzbq/mobile/love.php",$id));
    sleep($interval);//等待时间，进行下一次操作。
}while(true);



