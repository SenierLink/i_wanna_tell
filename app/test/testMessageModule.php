<?php
use IWT\app\MessageModule;
use IWT\framework\Message;

require "../../vendor/autoload.php";

$dbconfig = include "../config/db.conf.php";

$dbh = new \PDO($dbconfig['dsn'], $dbconfig['user'], $dbconfig['pass']); //初始化一个PDO对象
//    echo "连接成功<br/>";
/*你还可以进行一次搜索操作
foreach ($dbh->query('SELECT * from FOO') as $row) {
    print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
}
*/

/**
 * queryAllMessagesTest
 */
$test = new MessageModule($dbh);
$showsth = $test->queryAllMessages();
var_dump($showsth);
// 这个就告诉我们，返回的并不是字符串，是一个obj数组，需要去调用toJson方法。
print_r($showsth);
/**
 * test storeMessage()
 */

$arr =array(
    'title' => 'helloworld323213211',
    'content' => '123123',
    'message_kind' => 'tes',
    'create_time' => '2019-11-30 20:17:39',
    'agree_num' => '0',
    'browse_num' => '0',
    'author_id' => '1007',
    'id' => null,
);

$mes = new Message($arr);

$test = new MessageModule($dbh);
$test->storeMessage($mes);
