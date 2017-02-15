<?php
/*
 * 文件名称：list_file.php
 * 功能描述：文件管理的列表控制器
 * 代码作者：孙振强（创建）
 * 创建时间：2010-11-15
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_file.php';
$mod = new mod_file();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'file_down':
        $mod->file_down($xid);
        break;
}

//echo i_act_time();
?>
