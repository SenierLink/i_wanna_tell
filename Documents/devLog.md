# 顾名思义，开发日记

## 2019/11/23 23:13:22

### composer autoload 配置

别说了，composer autoload应该写成

    "autoload": {
        "psr-4": {
                "App\\myClass\\": "./php/myClass/"
            }
        }

结果写成

    "autoload": {
        "App\\myClass\\": "./php/myClass/"
        }

就这个就de了半天。查了眼别人demo才看明白。

## 2019/11/30 21:22:21

### 佛系bug，不知道为啥

    $result = $mysqli->query("select * from 'message'");

错误sql语法

    $result = $mysqli->query("select * from message");

正确无bug
鬼知道为啥，把我de哭了。

## 2019/12/7 10:57:26

### nikic/fastroute使用经验

官方文档中给的实例分为三部分，分别是添加路由，解析url，处理路由分发。

其中handle的实际调用在第三部分，这一部分需要自己实现，有点像autoload也需要自己实现。搞了一上午明白了人家的工作机制。垃圾文档真是怎么也看不懂。

现在还没有解决控制器自动加载的问题，TF中给的方法不能很好地结合命名空间psr-4使用，基本上都是靠require，include去引入对象。如果不能解决可能会比较麻烦，但是小框架使用其实还好。

## 2019/12/7 23:59

### nikic/fastroute中call_user_func_array()方法处理handler的类需要完全限定.

```php
$r->addRoute('GET', '/i_wanna_tell/app/public/index.php','IWT\app\MessageModule@queryAllMessages');
// 这样便不会报错
    $r->addRoute('GET', '/i_wanna_tell/app/public/index.php','MessageModule@queryAllMessages');
//这样会报错,除非把MessageModule的namespace换成\
```

应该是call_user_func_array()的问题，他应该是默认解析到\命名空间。



### 2019-12-8 19:29:20

### 不得不承认，我们应该学完设计模式以后来进行本次开发

在目前理解中：框架 = 设计模式 + 约定 + 封装组件

在这次开发中，我们主要是应当使用设计模式，但是设计模式的学习并没有跟上需求，所以写的时候，反复调整了很多次项目架构。