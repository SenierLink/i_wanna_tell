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

### 2019-12-8 21:25:57

### 下一次应该接着去写json格式

~~完成json格式问题，~~完成了！就可以去写addmessage。初步想的用post传一个arr到后台，而后把arr转成一个message，再由controller调用module的store方法。

于是，至此get add完成。

然后就是去把get的算法好好优化，比如只响应X天内的message，后台服务器需要运行脚本，自动清除过期message

<img title="" src="C:\Users\Link\AppData\Roaming\marktext\images\2019-12-11-13-01-30-image.png" alt="" data-align="center" width="405">

### 2019-12-11 14:20:55

### 发现一个好玩的require用法。

require到一个字符串，字符串内部

```php
// config.php
$arr = [];
$test="321";
$arr['insert_message'] = "";
$arr['test'] = "$test";


return $arr;
```

```php
$test = "123";
$db_sql = require "config/db_sql.conf.php";
var_dump($db_sql);
```

结果会是321，也就是arr['test']字符串中的\$test解析出来了。但是如果config.php中没有\$test，就会使用require环境中的\$test来渲染。非常好的功能。

但是思考以后，还是把sql模板放在对应的方法中比较好，起码便于修改，不然参数在方法中，命令在config中也不是什么好事情。

#### 原理思考

require过来的时候，创立了一个作用域，arr便是这个作用域中的。在解析的时候，先在本作用域解析，没有的话再去外层作用域寻找\$test。符合这个现象。

### 2019-12-12 09:22:37

### debug for sql

```php
    /**
     * 向数据库添加messages，我觉得可以合并成一个。
     * @param Message $message
     */
    public function storeMessage(Message $message)
    {
//      bug在于，这里面传值以后两边没有''.
//      $sql = "INSERT INTO message (title, message_kind, content, author_id) VALUES ($message->title, $message->message_kind, $message->content, $message->author_id)";
        $sql = "INSERT INTO message (title, message_kind, content, author_id) VALUES (:title, :message_kind, :content, :author_id)";
        try {
            $sth = $this->myPDO->prepare($sql);
            $sth->execute(array(':title' => $message->title, ':message_kind' => $message->message_kind, ':content' => $message->content, ':author_id' => $message->author_id,));
        } catch (Exception $e) {
            print_r($e);
        }

    }
```



### 2019-12-13 12:35:58

### ajax Json传值后\$\_POST为空

> 当 HTTP POST 请求的 Content-Type 是 application/x-www-form-urlencoded 或 multipart/form-data 时，会将变量以关联数组形式传入当前脚本。

我用的是application json，自然post为空

> “Superglobal”也称为自动化的全局变量。这就表示其在脚本的所有作用域中都是可用的。不需要在函数或方法中用 global $variable; 来访问它。

~~出了脚本就没了。~~php超全局变量不跨脚本。

> php://input 是个可以访问请求的原始数据的只读流。 POST 请求的情况下，最好使用 php://input 来代替 [$HTTP_RAW_POST_DATA](https://www.php.net/manual/zh/reserved.variables.httprawpostdata.php)，因为它不依赖于特定的 php.ini 指令。 而且，这样的情况下 [$HTTP_RAW_POST_DATA](https://www.php.net/manual/zh/reserved.variables.httprawpostdata.php) 默认没有填充， 比激活 [always_populate_raw_post_data](https://www.php.net/manual/zh/ini.core.php#ini.always-populate-raw-post-data) 潜在需要更少的内存。 *enctype="multipart/form-data"* 的时候 php://input 是无效的。



上面都不是正解，但接近了答案，其实是请求的content-type需要PHP中的方法能处理。[php获取post请求的json参数 - 快乐编程](http://www.01happy.com/php-post-request-get-json-param/)



```php
        $input = file_get_contents('php://input');
        var_dump($input);
        $json = json_decode($input);
        var_dump($json);
```

用的这个方法处理的。http请求header content-type:application/json