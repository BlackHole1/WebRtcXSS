<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 安装程序配置文件
 */

define('INSTALL_APP_PATH', realpath('./') . '/');

return array(

    'ORIGINAL_TABLE_PREFIX' => 'webrtc_', //默认表前缀

    /* URL配置 */
    'URL_MODEL' => 3, //URL模式
    'DEFAULT_THEME' =>  'default',  // 默认模板主题名称
    'SESSION_PREFIX' => 'WebRtcXSS', //session前缀
    'COOKIE_PREFIX' => 'WebRtcXSS_', // Cookie前缀 避免冲突

);