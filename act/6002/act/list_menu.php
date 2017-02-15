<?php
/*
 * 文件名称：list_menu.php
 * 功能描述：栏目信息的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$ws_id = i_ws_id_get();

include_once '../mod/mod_menu.php';
$mod = new mod_menu();

switch ($act) {
    case 'list_num':
        $mod->list_num($ws_id);
        break;
    case 'list_read':
        $mod->list_read($ws_id);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'list_read4news':
        $mod->list_read4news($ws_id);
        break;
    case 'list_read4link':
        $mod->list_read4link($ws_id);
        break;
    case 'list_read4qa':
        $mod->list_read4qa($ws_id);
        break;
    case 'list_read4menu':
        $position = $_GET['position'];
        $mod->list_read4menu($ws_id, $position);
        break;
    case 'list_read4forum':
        $mod->list_read4forum($ws_id);
        break;
}

//echo i_act_time();
?>
