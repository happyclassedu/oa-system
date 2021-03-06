<?php
/*
* 文件名称：info_ext_pay.php
* 功能描述：续保缴费信息的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_log.php';
$mod = new mod_log();

switch ($act) {
     case 'info_add':
        $mod->info_add();
        break;
     case 'info_edit':
        $mod->info_edit($xid);
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
}
?>
