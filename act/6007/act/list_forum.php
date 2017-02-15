<?php
/**
 * 文件名称：list_forum.php
 * 功能描述：论坛信息的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$ws_id = @$_GET['ws_id'];
$menu_id = @$_GET['menu_id'];

include_once '../../2030/mod/mod_forum.php';
$mod = new mod_forum();
switch ($act) {
    case 'list_read':
        $mod->list_read4forum($ws_id, $menu_id, '0');
        break;
    case 'list_num' :
        $mod->list_num4forum($ws_id, $menu_id , '0');
        break;
}
?>