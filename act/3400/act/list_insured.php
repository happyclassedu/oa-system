<?php
/*
 * 文件名称：list_insured.php
 * 功能描述：参保人的列表控制器
 * 代码作者：孙振强（创建）
 * 创建日期：2011-05-08
 * 修改日期：2011-05-08
 * 当前版本：V1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_insured.php';
$mod = new mod_insured();

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
