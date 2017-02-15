<?php
/*
* 文件名称：info_com_pwd.php
* 功能描述：修改密码（企业）的功能。
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
    case 'info_pwd':
        $mod->info_pwd($xid);
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>
