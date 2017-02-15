<?php
/*
 * 文件名称：medi_list.php
 * 功能描述：医疗保险系统列表的功能。
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
    case 'num_read':
        $mod_medi->num_read();
        break;
    case 'list_read':
        $mod_medi->list_read();
        break;
    case 'info_read':
        $mod_medi->info_read($xid);
        break;
}
?>
