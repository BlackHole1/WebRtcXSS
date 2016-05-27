#WebRtcXSS
###所有代码是基于ThinkPHP框架开发的
>项目教程：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

>项目视频：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

>作者：Black-Hole

>邮箱：158099591@qq.com && 158blackhole@gmail.com

###注意：

* 数据库配置在`/Application/Home/Conf/config.php`里

* 如果出现`ERROR 1067 (42000) at line 22: Invalid default value for ‘create_time’`错误<br />
  请移步 [http://blog.csdn.net/xionglang7/article/details/44499307](http://blog.csdn.net/xionglang7/article/details/44499307) ,是因为`create_time`里的时间全为0导致的

* 如果出现`Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`错误
  <p>需要开启PDO扩展</p>

* 因为是伪静态，所以请在nginx配置文件中改动如下：
```nginx
server {
    listen       80;
    server_name  your_domain;
    root   "website_path";
    location / {
        index  index.html index.htm index.php;
        if (!-e $request_filename){
            rewrite ^/(.*)$ /index.php/$1;
        }
        #autoindex  on;
    }
    location ~ \.php(.*)$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO  $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        include        fastcgi_params;
    }
}
```
###其他:
我讨厌markdown╮(╯﹏╰)╭

***
#WebRtcXSS
###All of the code is based on the framework for the development ThinkPHP
>Project Tutorial：[http://www.freebuf.com/articles/web/103097.html](http://www.freebuf.com/articles/web/103097.html)

>Project Video：[http://open.freebuf.com/live/774.html](http://open.freebuf.com/live/774.html)

>Author：Black-Hole

>Email：158099591@qq.com && 158blackhole@gmail.com

###Important：
* Database Config in `/Application/Home/Conf/config.php`

* if(Error === `ERROR 1067 (42000) at line 22: Invalid default value for ‘create_time’`){<br />
   Go here [http://blog.csdn.net/xionglang7/article/details/44499307](http://blog.csdn.net/xionglang7/article/details/44499307),because `create_time`where time equals 0
}

* if(Errot === `Undefined class constant ‘MYSQL_ATTR_INIT_COMMAND’`){<br />
  You need to enable the PDO extension
}

* 
Because it is pseudo-static , so please nginx configuration file changes are as follows：
```nginx
server {
    listen       80;
    server_name  your_domain;
    root   "website_path";
    location / {
        index  index.html index.htm index.php;
        if (!-e $request_filename){
            rewrite ^/(.*)$ /index.php/$1;
        }
        #autoindex  on;
    }
    location ~ \.php(.*)$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO  $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        include        fastcgi_params;
    }
}
```
###Other:
>I hate markdown╮(╯﹏╰)╭

>Translation from Google