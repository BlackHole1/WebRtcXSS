#WebRtcXSS
###所有代码是基于ThinkPHP框架开发的
>项目教程：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

>项目视频：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

>作者：Black-Hole

>邮箱：158099591@qq.com && 158blackhole@gmail.com

###注意：

* 数据库配置在`/Application/Home/Conf/config.php`里

* 如果出现`ERROR 1067 (42000) at line 22: Invalid default value for ‘create_time’`错误
  <p>请移步 [http://blog.csdn.net/xionglang7/article/details/44499307](http://blog.csdn.net/xionglang7/article/details/44499307) ,是因为`create_time`里的时间全为0导致的</p>

* 如果出现`Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`错误
  <p>需要开启PDO扩展</p>

***
#WebRtcXSS
###All of the code is based on the framework for the development ThinkPHP
>Project Tutorial：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

>Project Video：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

>Author：Black-Hole

>Email：158099591@qq.com && 158blackhole@gmail.com

###Important：
* Database Config in `/Application/Home/Conf/config.php`

* if(Error === `ERROR 1067 (42000) at line 22: Invalid default value for ‘create_time’`){
   <p>Go here [http://blog.csdn.net/xionglang7/article/details/44499307](http://blog.csdn.net/xionglang7/article/details/44499307),because `create_time`where time equals 0</p>
}

* if(Errot === `Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`){
  <p>You need to enable the PDO extension</p>
}

###Other:
I hate markdown╮(╯﹏╰)╭