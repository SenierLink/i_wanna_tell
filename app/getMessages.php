<?php

use IWT\app\MessageModule;

require "../vendor/autoload.php";
require "./config/db.conf.php";

try {
    $dbh = new \PDO($dsn, $user, $pass); //初始化一个PDO对象
//    echo "连接成功<br/>";
    /*你还可以进行一次搜索操作
    foreach ($dbh->query('SELECT * from FOO') as $row) {
        print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
    }
    */


    $myMessageModule = new MessageModule($dbh);
    $tamp = ($myMessageModule->queryAllMessages());
    $tamp = json_encode($tamp);

    /**
     * @return json
     * @example [{"title":"helloworld","content":"123","message_kind":"tes","create_time":"2019-11-30 20:17:39","agree_num":"0","browse_num":"0","author_id":"1007","id":"1"},
        {"title":"helloworld2","content":"123","message_kind":"test","create_time":"2019-11-30 20:17:39","agree_num":"0","browse_num":"0","author_id":"1007","id":"2"}]
     */
    echo $tamp;
   // 返回messages

    // 释放数据库链接
    $dbh = null;
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}