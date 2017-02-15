<?php
/*
* 文件名称：info_person.php
* 功能描述：个人中心（曲江人才）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_resume.php';
$mod = new mod_resume();

switch ($act) {
    case 'info_session':
        $mod->info_session();
        break;
}
?>
