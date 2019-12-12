<?php

require "./testclass.php";
require "../MessageModule.php";
require "../../vendor/autoload.php";

// 这一块好像是添加路由
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/i_wanna_tell/app/public/index.php/message[/{messageid:d+}]','IWT\app\MessageCon@queryAllMessages');
    $r->addRoute('GET', '/i_wanna_tell/app/public/index.php/message/add/{name}','IWT\app\MessageCon@addMessage');
    $r->addRoute('POST', '/i_wanna_tell/app/public/index.php/message/add', 'IWT\app\MessageCon@addMessage');
});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        list($class, $method) = explode('@', $handler, 2);
        call_user_func_array(array(new $class, $method), $vars);
        // 合适的class， method 已经拿到了，下一步是把class按照psr-4的方法解析。
        break;
}