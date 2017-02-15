<?php
/*
 * 文件名称：index.php
 * 功能描述：测试前台smarty。
 * 代码作者：王争强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id

include_once '../mod/mod_ws.php';
$mod = new mod_ws();
$arr_menu = $mod->list_read_menu();
$arr_menu2 = $mod->list_read_menu2();
$arr_qyzp = $mod->list_read_qyzp();
$arr_tzgg = $mod->list_read_tzgg();
//print_r($arr);

$g_smarty = i_smarty_create();
$g_smarty->assign('act', $act);
$g_smarty->assign('arr_menu', $arr_menu);
$g_smarty->assign('arr_menu2', $arr_menu2);
$g_smarty->assign('arr_qyzp', $arr_qyzp);
$g_smarty->assign('arr_tzgg', $arr_tzgg);
$g_smarty->display('master.htm');
?>