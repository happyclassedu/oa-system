<?php
/*
* 文件名称：info_league.php
* 功能描述：团员信息的功能。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_league.php';
$mod = new mod_league();

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
    case 'list_num_loh':
        $mod->list_num_loh($xid);
        break;
    case 'list_read_loh':
        $mod->list_read_loh($xid);
        break;
    case 'info_init':
        $mod->info_init();
        break;
}
?>