<?php
/*
* 文件名称：index_home.php
* 功能描述：测试前台smarty。
* 代码作者：王争强
* 当前版本：V2.0
* 创建日期：2010-05-25
* 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取操作的方法

$act_arr = array();  //定义可以处理操作方法
$act_arr[] = 'index';
$act_arr[] = 'list';
$act_arr[] = 'list_m';
$act_arr[] = 'info';
$act_arr[] = 'down';
$act_arr[] = 'mk';
$act_arr[] = 'read_hits';
$act_arr[] = 'list_link';
$act_arr[] = 'list_resume';
$act_arr[] = 'info_resume';
$act_arr[] = 'list_job';
$act_arr[] = 'info_job';
$act_arr[] = 'info_com';
$act_arr[] = 'list_qa';

if (!in_array($act, $act_arr)) {  //判断获取的act是否在预定义的act_arr数组里
    $act = 'index';  //否则默认访问首页
}
include_once 'www_' . $act . '.php';
?>