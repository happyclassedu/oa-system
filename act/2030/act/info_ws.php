<?php
/**
 * 文件名称：info_cfg.php
 * 功能描述：发布网站信息的信息控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_ws_id_get();
//$xid = i_get_xid();

include_once '../mod/mod_ws.php';
$mod = new mod_ws();

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
    case 'info_name_check':
        $mod->info_name_check($xid);
        break;
}
?>