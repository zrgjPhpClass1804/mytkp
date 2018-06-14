<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
if(!defined("ROOT")) define('ROOT', 'http://localhost:8080/tp2/');
// 定义应用目录
define('APP_PATH','./Application/');
//session_start();//创建或查找已存在的PHPSESSID

//第一次访问index.php时，自动创建新模块
//define("BIND_MODULE","Admin");
//第一次访问index.php时，自动创建新模块下的控制器类，但是注意一定要写一个Index。
//define("BUILD_CONTROLLER_LIST", "Index,Admin,Permission");

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单