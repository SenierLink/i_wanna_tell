<?php


namespace IWT\app;


use IWT\framework\Controller;
use IWT\framework\Message;
use mysql_xdevapi\Exception;

class MessageCon extends Controller
{

    /**
     * 2019-12-8 20:27:01
     * 这里需要重写，query方法返回的对象变成了数组。
     * @param $messageid
     */

    public $testarr = array(
        'title' => 'helloworld323213211',
        'content' => '123123',
        'message_kind' => 'tes',
        'create_time' => '2019-11-30 20:17:39',
        'agree_num' => '0',
        'browse_num' => '0',
        'author_id' => '1007',
        'id' => null,
    );



    public function queryAllMessages($messageid = null){
        $tempdb = new MessageModule();

        if ($messageid){
            $temp = $tempdb->getMessageById($messageid);
        }else{
            $temp = $tempdb->queryAllMessages();
        }

        $tempdb = null;
        $temp = json_encode($temp);
        echo $temp;


    }

    /**
     * 将post传来的message，储存到数据库中。
     * @param String
     */
    public function addMessage(){
// 好像是跨文件的哦这个。
        $input = file_get_contents('php://input');
        if (!$input)
        {
            throw new Exception("php://input is empty");
        }
        $json = json_decode($input);
        // $json 是一个对象。需要变成数组才好。或者写个接口，让message构造函数的参数是一个对象，可以是数组，可以是对象。但是，php数组好像不是对象。问题不大。直接在这对象变数组把。

        $arr = (array) $json;

        $mess = new Message($arr);
        $is_suc = $mess->store();

        header("content-type", "application/json");
        echo "$is_suc";
    }

}