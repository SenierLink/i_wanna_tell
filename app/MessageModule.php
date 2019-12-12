<?php

namespace IWT\app;

use IWT\framework\Messages;
use IWT\framework\Message;
use IWT\framework\Module;
use \PDO;


/**
 * Class MessageModule
 *
 *
 */
class MessageModule
{
    /** @var null */
    private $dbname = null;
    protected $myPDO;
    private $sql_select_all = "SELECT * FROM message;";

    /**
     *构造函数
     * @param PDO $myPDO
     */
    public function __construct(PDO $myPDO = null)
    {

//      $config = include "./config/db.conf.php";
//      这样就报错，奇怪了
        $dbconfig = include "config/db.conf.php";

        // 依赖注入
        if ($myPDO) {
            $this->myPDO = $myPDO;
        } else {
            $this->myPDO = new PDO($dbconfig['dsn'], $dbconfig['user'], $dbconfig['pass']);
        }
    }

    /**
     * 向数据库添加messages，我觉得可以合并成一个。
     * @param Message $message
     * @return bool 是否添加成功
     */
    public function storeMessage(Message $message)
    {
//      bug在于，这里面传值以后两边没有''.
//      $sql = "INSERT INTO message (title, message_kind, content, author_id) VALUES ($message->title, $message->message_kind, $message->content, $message->author_id)";
        $sql = "INSERT INTO message (title, message_kind, content, author_id) VALUES (:title, :message_kind, :content, :author_id)";
        try {
            $sth = $this->myPDO->prepare($sql);
            $is_success =  $sth->execute(array(':title' => $message->title, ':message_kind' => $message->message_kind, ':content' => $message->content, ':author_id' => $message->author_id,));
            return $is_success;
        } catch (Exception $e) {
            return false;
        }

    }


    /**
     * 查询返回，返回Message对象
     * 其实这里用一个迭代器才是最好的办法，但是我不想做了，如果需要优化，可以把这个换成一个迭代器，节约更多内存。下一次同类型需求的时候再用迭代器叭。
     * @return array [Message, ...Message]
     */
    public function queryAllMessages()
    {
        $message_arr = [];
        $stmt = $this->myPDO->query($this->sql_select_all);
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($message_arr, new Message($item));
        }
        return $message_arr;


        // 需要echo一个json，可以return数组，然后去用json对象
    }

    /**
     * 根据message_id返回message对象。
     * @param $message_id
     */
    public function getMessageById($message_id)
    {

    }

    /**
     * @return null
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * 修改database table 选择
     * @param $dbname 新的database table name
     * @example
     */
    public function changeDbname($dbname)
    {
        mysqli_query($this->myMysql, "");
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        // 释放数据库连接，不知道这么做会不会带来频繁连接数据库。
        $this->myPDO = null;
    }
}

