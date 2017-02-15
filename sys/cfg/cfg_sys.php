<?php
/*
 * 文件名称：config_basic.php
 * 功能描述：系统的基本配置信息。
 * 代码作者：Mirrado Sun
 * 当前版本：V1.0
 * 创建日期：2008-12-14
 * 修改日期：2009-04-16
*/

define('g_dir', '/var/www/hr_oa/');  //系统文件在物理地址
define('g_sys', g_dir.'sys/');  //系统文件在物理地址
define('g_act', g_dir.'act/');  //后台目录：php 执行程序目录。
define('g_app', g_dir.'app/');  //前台目录：htm、js、css等前台程序目录。
define('g_doc', g_dir.'doc/');  //文档目录：系统上传文件目录，不可直接被访问。
define('g_img', g_dir.'img/');  //文档目录：系统媒体访问目录。
define('g_bak', g_sys.'bak/');  //备份目录：数据库、文件等备份目录。
define('g_cfg', g_sys.'cfg/');  //配置目录：系统核心配置文件存放目录。
define('g_lib', g_sys.'lib/');  //类库目录：如数据库操作等类目录。
define('g_tmp', g_sys.'tmp/');  //临时目录：如缓存、session等。
?>