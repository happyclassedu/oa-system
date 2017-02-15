<?php
/**
 * 文件名称：cfg.php
 * 功能描述：配置信息--应用程序。
 * 代码作者：孙振强
 * 当前版本：V2.0
 * 创建日期：2009-12-13
 * 修改日期：2010-05-11
 */
//error_reporting(E_ALL);   //显示报告
error_reporting(NULL);   //隐藏错误报告
error_reporting(E_ALL ^ E_NOTICE);  //隐藏NOTICE报告
header('Content-Type:text/html;charset=UTF-8');
//define('g_app_name', 'common');  //本程序名称
define('g_app_xdb', 'hr_oa');  //本程序所使用数据库配置名称
define('g_app_session', 'hr_oa');  //本程序session存放目录
?>