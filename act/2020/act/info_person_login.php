<?php
/*
* 文件名称：info_person_login.php
* 功能描述：个人会员登录（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_person.php';
$mod = new mod_person();

switch ($act) {
    case 'info_login':
        $mod->info_login();
        break;
    case 'info_session':
        $mod->info_session();
        break;
}
?>