<?php
/*
* 文件名称：list_lbill.php
* 功能描述：工作日结清单的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_lbill.php';
$mod = new mod_lbill();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'info_stat':
        $mod->info_stat();
        break;
}
?>
