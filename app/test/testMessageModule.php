<?php
use IWT\app\MessageModule;


require "../../vendor/autoload.php";

$dbconfig = include "../config/db.conf.php";

$dbh = new \PDO($dbconfig['dsn'], $dbconfig['user'], $dbconfig['pass']); //初始化一个PDO对象
//    echo "连接成功<br/>";
/*你还可以进行一次搜索操作
foreach ($dbh->query('SELECT * from FOO') as $row) {
    print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
}
*/
$test = new MessageModule($dbh);
$test->queryAllMessages();