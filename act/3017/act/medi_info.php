<?php
/*
 * 文件名称：medi_info.php
 * 功能描述：医疗保险系统的功能。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_medi.php';
$mod_medi = new mod_medi();

switch ($act) {
    case 'info_read':
        $mod_medi->info_read($xid);
        break;
    case 'info_edit':
        $mod_medi->info_edit($xid);
        break;
    case 'info_add':
        $mod_medi->info_add();
        break;
    case 'info_del':
        $mod_medi->info_del($xid);
        break;
}
?>
