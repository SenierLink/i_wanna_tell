<?php
namespace IWT\framework;

/**
 * Class Message
 * 数据结构用来储数据
 * 并不属于框架，但也不属于逻辑，由于历史原因，放在了框架里面 2019-12-8 20:28:00
 */
class Message
{
    private $title = null;
    private $content = null;
    private $message_kind = null;
    private $create_time = null;
    private $agree_num = null;
    private $browse_num = null;
    private $author_id = null;
    private $id = null;

    /**
     * @param $arr mysqli_result对象， 解析出来每一个信息，可以说是序列化成对象
     * @return void
     */
    public function __construct($arr){
        $this->title=$arr['title'];
        $this->message_kind=$arr['message_kind'];
        $this->content=$arr['content'];
        $this->create_time=$arr['create_time'];
        $this->agree_num=$arr['agree_num'];
        $this->browse_num=$arr['browse_num'];
        $this->author_id=$arr['author_id'];
        $this->id=$arr['id'];
    }

    public function toJson(){
        var_dump(json_encode($this));
    }

}