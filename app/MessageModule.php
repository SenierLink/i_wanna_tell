<?php

namespace IWT\app;

use IWT\framework\Messages;
use IWT\framework\Message;
use \PDO;


/**
 * Class MessageModule
 *
 *
 */
class MessageModule
{
    /** @var null  */
    private $dbname = null;
    protected $myPDO;
    /**
     *构造函数
     *new mysqli对象
     * @param PDO $myPDO
     */
    public function __construct(PDO $myPDO)
    {
        // 依赖注入
        $this->myPDO = $myPDO;
    }

    /**
     * 向数据库添加messages，我觉得可以合并成一个。
     * @param Message $message
     */
    public function addMessage(Message $message){

    }
    public function addMessages(Messages $messages){

    }
    public function queryMessages($db, Message $message){

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
    public function changeDbname($dbname){
        mysqli_query($this->myMysql,"");

    }
}

