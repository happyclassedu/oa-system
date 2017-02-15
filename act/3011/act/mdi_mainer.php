<?php
/*
 * 文件名称：mdi_mainer.php
 * 功能描述：主窗口mainer控制器。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

include_once '../inc/common.php';

$xid = i_get_xid();
$act = i_get_act();

include_once '../mod/mod_mdi_mainer.php';
$mod = new mod_mdi_mainer();

switch ($act) {
    case 'read_saying':
        $infos = $mod->read_saying();
        break;
    case 'read_all_news':
//        $infos = $mod->read_all_news($xid);
        break;
    default:
        break;
}
?>