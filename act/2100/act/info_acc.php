<?php
/*
* 文件名称：info_acc.php
* 功能描述：参保信息的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_setting.php';
$mod = new mod_setting();

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
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'info_name_check':
        $mod->info_name_check($xid);
        break;
}
?>
