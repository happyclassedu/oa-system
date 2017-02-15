<?php
/**
 * 文件名称：info_login.php
 * 功能描述：登录信息的信息控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../../2030/mod/mod_user.php';
$mod = new mod_user();

switch ($act) {
    case 'is_user':
        $mod->is_user();
        break;
    case 'info_login':
        $mod->info_login();
        break;
    case 'session_val':
        $mod->session_val();
        break;
}
?>