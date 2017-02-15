<?php
/*
* 文件名称：info_resume_tointerview.php
* 功能描述：邀请面试功能的后台程序。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_SESSION['c_id'];

include_once '../mod/mod_csearch.php';
$mod = new mod_csearch();

switch ($act) {
    case 'info_resume':
        $mod->info_resume();
        break;
    case 'info_interview':
        $mod->info_interview($cid);
        break;
}
?>
