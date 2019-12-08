<?php


namespace IWT\app;


use IWT\framework\Controller;
use IWT\framework\Message;

class MessageCon extends Controller
{

    /**
     * 2019-12-8 20:27:01
     * 这里需要重写，query方法返回的对象变成了数组。
     * @param $messageid
     */
    public function queryAllMessages($messageid){
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

    public function addMessage($arr){
        $mess = new Message($arr);
    }

}