<?php

namespace IWT\app\test;

use IWT\framework\Message;

require "../../vendor/autoload.php";

$arr =array(
    'title' => 'helloworld',
    'content' => '123',
    'message_kind' => 'tes',
    'create_time' => '2019-11-30 20:17:39',
    'agree_num' => '0',
    'browse_num' => '0',
    'author_id' => '1007',
    'id' => '1',
);

$test = new Message($arr);
$test = $test->toJson();

var_dump($test);
print_r($test);
// toJson 返回的格式好像不太好，但是有点样子了。
// 2019-12-8 22:04:12 解决了。

// 測試toString
$test = new Message($arr);
$test->toString();
