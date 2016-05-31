<?php
header("Content-Type:text/html;charset=utf-8");

if (version_compare(PHP_VERSION, '5.3.0', '<'))
    die('当前PHP版本' . PHP_VERSION . '，最低要求PHP版本5.3.0 <br/><br/>很遗憾，未能达到最低要求。本系统必须运行在PHP5.3 及以上版本。如果您是虚拟主机，请联系空间商升级PHP版本，如果您是VPS用户，请自行升级php版本或者联系VPS提供商寻求技术支持。');

define('BIND_MODULE', 'Install');
/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
define ('APP_DEBUG', true);
/**
 * 应用目录设置
 * 安全期间，建议安装调试完成后移动到非WEB目录
 */
define ('APP_PATH', './Application/');

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */
require './ThinkPHP/ThinkPHP.php';