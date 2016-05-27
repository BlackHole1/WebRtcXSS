#WebRtcXSS
##项目教程：http://www.freebuf.com/articles/web/103097.html
##项目视频：http://open.freebuf.com/live/774.html
###整套代码使用了ThinkPHP框架

##数据库配置在/Application/Home/Conf/config.php里

##如果出现"ERROR 1067 (42000) at line 22: Invalid default value for ‘create_time’"错误
###请移步http://blog.csdn.net/xionglang7/article/details/44499307，是因为create_time里的时间全为0导致的

##如果出现"Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’"错误
###需要开启你PDO扩展

##Author：Black-Hole
##Email：158099591@qq.com && 158blackhole@gmail.com