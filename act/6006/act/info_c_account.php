<?php
/*
* 文件名称：info_cregister.php
* 功能描述：企业会员注册（曲江人才）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_com.php';
$mod = new mod_com();

switch ($act) {
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_edit':
        $mod->info_edit($xid);
        break;
    case 'info_isRegister':
        $mod->info_checkUser();
        break;
    case 'info_checkemail':
        $mod->info_checkemail();
        break;
}
?>
