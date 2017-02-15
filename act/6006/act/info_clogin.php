<?php
/*
* 文件名称：info_clogin.php
* 功能描述：企业会员登录（曲江人才网）的功能。
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
    case 'info_login':
        $mod->info_login();
        break;
}
?>
