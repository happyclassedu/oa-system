<?php
/*
* 文件名称：info_person_password.php
* 功能描述：个人修改密码（英才网）的功能。
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
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_pwd':
        $mod->info_pwd($xid);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>