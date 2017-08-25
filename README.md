# WebRtcXSS

### 所有代码是基于ThinkPHP框架开发的
> 项目教程：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

> 项目视频：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

> 作者：Black-Hole

> 邮箱：158099591@qq.com && 158blackhole@gmail.com

### 安装说明

#### 修改数据库配置文件

文件位置`/Application/Common/Conf/config.php`

```php
<?php
return array(
	'URL_MODEL' => 0,  //URL模式，不用动
	'DB_TYPE' => 'mysql',  //数据库类型，不要更改
	'DB_HOST' => 'localhost',  //数据库地址
	'DB_NAME' => 'webrtcxss',  //数据库名称
	'DB_USER' => 'root', //数据库管理员账号
	'DB_PWD' => 'root',  //数据库管理员密码
	'DB_PORT' => '3306', //连接数据库的端口
	'DB_PREFIX' => 'webrtc_',  //数据库前缀
);
```
一般来说，你只需要更改DB_USER、DB_PWD就可以了。

#### 导入sql数据库文件

MySQL命令行：
```sh
mysql -uroot -proot < sql.sql //-u后面跟上数据库账号，-p后面跟上数据库密码(没有空格)，sql.sql是sql文件的位置，在项目的根目录下，注意路径，无回显。

mysql -uroot -proot //进入mysql命令行

show databases; //查看是否存在webrtcxss数据库

//如果你在“修改数据库配置文件”时，使用了其他的数据库名称(修改了DB_NAME信息)，切记在sql.sql文件里把“webrtcxss”字符串全部替换成“你修改的字符串”
```

phpmyadmin:

```sh
自行google
```

#### docker

`docker run -dit -p 8080:80 blackhole007/webrtcxss`

#### 结束
然后就没了，整个项目需要注意的地方，只有数据库方面。

### 注意：

* 如果出现`Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`错误
  <p>需要开启PDO扩展</p>

***
# WebRtcXSS

### All of the code is based on the framework for the development ThinkPHP
> Project Tutorial：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

> Project Video：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

> Author：Black-Hole

> Email：158099591@qq.com && 158blackhole@gmail.com

### Important：

* if(Errot === `Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`){<br />
  You need to enable the PDO extension
}

#### docker

`docker run -dit -p 8080:80 blackhole007/webrtcxss`

> Translation from Google
