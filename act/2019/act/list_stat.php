<?php
/*
 * 文件名称：list_stat.php
 * 功能描述：户籍信息统计表的功能。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_stat.php';
$mod = new mod_stat();

switch ($act) {
    case 'info_stat':
        $mod->info_stat();
        break;
}
?>
