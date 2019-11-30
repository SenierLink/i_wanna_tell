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