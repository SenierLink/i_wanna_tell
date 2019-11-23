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