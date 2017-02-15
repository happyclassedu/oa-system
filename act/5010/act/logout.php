<?php
/*
 * 文件名称：login.php
 * 功能描述：系统登录控制器。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2010-08-08
 * 当前版本：V3.0
*/

include_once '../inc/common.php';

$act = i_get_act();

include_once '../mod/mod_login.php';
$mod = new mod_login();

switch ($act) {
    case 'logout':
        $mod->logout();
        break;
    default:
        break;
}
?>