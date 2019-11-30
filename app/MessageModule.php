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
    private $sql_select_all = "SELECT * FROM message";
        /**
     *构造函数
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
}

