<?php
/*
 * 文件名称：info_moh_print_c.php
 * 功能描述：业务办理--打印功能的功能。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_moh.php';
$mod = new mod_moh();

switch ($act) {
    case 'info_print':
        $mod->info_print();
        break;
}
?>
