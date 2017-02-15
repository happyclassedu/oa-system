<?php
/**
 * 文件名称：lianhuren_admin.php
 * 功能描述：“莲湖英才网”--管理主页。
 * 代码作者：孙振强（创建）
 * 当前版本：V1.0
 * 创建日期：2010-06-30
 * 修改日期：2010-06-30
*/

include_once '../inc/common.php';

$act = i_get_act();

include_once '../mod/mod_admin.php';
$mod_admin = new mod_admin();

switch ($act) {
    case 'svn_update':
        $result_arr = $mod_admin->svn_update_oa();
        break;
}
?>
