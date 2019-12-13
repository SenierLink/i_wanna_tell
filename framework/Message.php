<?php

namespace IWT\framework;

use IWT\app\MessageModule;

/**
 * Class Message
 * 数据结构用来储数据
 * 并不属于框架，但也不属于逻辑，由于历史原因，放在了框架里面 2019-12-8 20:28:00
 */
class Message
{
    /**
     * public方便修改，暴露出来算了。
     *
     * 感覺public对browse_num这种封闭，不该被用户修改的数据不好。2019-12-11 14:40:14
     * 是需要这样的，方便MessageModule的insert书写。
     */

    private $init_arr = [
        'title' => null,
        'content' => null,
        'message_kind' => null,
        'create_time' => null,
        'agree_num' => null,
        'browse_num' => null,
        'author_id' => null,
        'id' => null,
    ];

    /**
     * @param $arr mysqli_result对象， 解析出来每一个信息，可以说是序列化成对象
     * @return void
     */
    public function __construct($arr)
    {
        foreach ($arr as $item => $value) {
            if ($arr["$item"]){
                $this->init_arr["$item"] = $value;
            }
        }
        var_dump($this->init_arr);

    }

    public function toJson()
    {
        return json_encode($this->init_arr);
    }

    public function store()
    {
        $mes_module = new MessageModule();
        $mes_module->storeMessage($this);
    }

    public function toString()
    {
        $str = "";
        foreach ($this->init_arr as $item) {
            $str = $str . $item;
        }
        print_r($str);
    }

    /**
     * @param $str_json POST 方法传来的str_json
     */
    public function deToJson($str_json)
    {
        $str_json = json_decode($str_json);
        $arr = $str_json;
        $this->init_arr = $arr;
        $this->title = $arr['title'];
        $this->message_kind = $arr['message_kind'];
        $this->content = $arr['content'];
        $this->create_time = $arr['create_time'];
        $this->agree_num = $arr['agree_num'];
        $this->browse_num = $arr['browse_num'];
        $this->author_id = $arr['author_id'];
        $this->id = $arr['id'];
    }
}