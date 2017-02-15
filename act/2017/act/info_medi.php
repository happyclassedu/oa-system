<?php
/*
* 文件名称：info_medi.php
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
$mod = new mod_medi();

switch ($act) {
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_edit':
        $mod->info_edit($xid);
        break;
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'list_num_moh':
        $mod->list_num_moh($xid);
        break;
    case 'list_read_moh':
        $mod->list_read_moh($xid);
        break;
    case 'info_cue':
        $mod->info_cue($xid);
        break;
}
?>
