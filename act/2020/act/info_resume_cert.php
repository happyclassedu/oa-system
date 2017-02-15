<?php
/*
* 文件名称：info_resume_cert.php
* 功能描述：修改，添加，删除获得证书（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_resume_i.php';
$mod = new mod_resume_i();

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
    case 'list_read':
        $mod->list_read();
        break;
    case 'list_num':
        $mod->list_num();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>
