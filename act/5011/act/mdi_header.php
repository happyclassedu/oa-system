<?php
/*
 * 文件名称：mdi_header.php
 * 功能描述：主窗口header控制器。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

include_once '../inc/common.php';

$act = i_get_act();

include_once '../mod/mod_mdi_header.php';
$mod = new mod_mdi_header();

switch ($act) {
    case 'read_user_info':
        $infos = $mod->read_user_info();
        break;
    case 'read_calendar':
        $infos = $mod->read_calendar();
        break;
    default:
        break;
}
?>