<?php
/*
 * 文件名称：list_cp.php
 * 功能描述：参保信息的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_czyl.php';
$mod = new mod_czyl();

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
}

?>
