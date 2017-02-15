<?php
/**
 * 文件名称：info_forum.php
 * 功能描述：论坛信息的信息控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$ws_id = i_ws_id_get();
$menu_id = @$_GET['menu_id'];
$fid = @$_GET['fid'];

include_once '../mod/mod_forum.php';
$mod = new mod_forum();

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
    case 'list_num':
        $mod->list_num($ws_id, $fid);
        break;
    case 'list_read':
        $mod->list_read($ws_id, $fid);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>