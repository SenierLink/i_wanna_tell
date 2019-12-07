<?php


namespace IWT\app;


use IWT\framework\Controller;

class MessageCon extends Controller
{


    public function queryAllMessages(){
        $temp = new MessageModule();
        $temp->queryAllMessages();
    }
}