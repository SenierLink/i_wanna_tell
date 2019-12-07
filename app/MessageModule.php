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
    /** @var null  */
    private $dbname = null;
    protected $myPDO;
    private $sql_select_all = "SELECT * FROM message";
        /**
     *构造函数
     * @param PDO $myPDO
     */
    public function __construct(PDO $myPDO = null)
    {

//      $config = include "./config/db.conf.php";
//      这样就报错，奇怪了

        $dbconfig = include "config/db.conf.php";
        var_dump($dbconfig);

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
     */
    public function addMessage(Message $message){

    }
    public function addMessages(Messages $messages){

    }

    /**
     *
     * @echo void [{'title','content',}]]
     */
    public function queryAllMessages(){
        $stmt = $this->myPDO->query($this->sql_select_all);
        return $stmt->fetchAll(PDO::FETCH_CLASS);

        // 需要echo一个json，可以return数组，然后去用json对象
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

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        // 释放数据库连接，不知道这么做会不会带来频繁连接数据库。
        $this->myPDO = null;
    }
}

