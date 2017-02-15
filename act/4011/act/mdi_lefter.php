<?php
/*
 * 文件名称：mdi_lefter.php
 * 功能描述：主窗口lefter控制器。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

include_once '../inc/common.php';

$xid = i_get_xid();
$act = i_get_act();

include_once '../mod/mod_mdi_lefter.php';
$mod = new mod_mdi_lefter();

switch ($act) {
    case 'read_type_list':
        $infos = $mod->read_type_list();
        break;
    case 'read_type_info':
        $infos = $mod->read_type_info($xid);
        break;
    default:
        break;
}
?>