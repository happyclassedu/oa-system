<?php
/*
* 文件名称：list_bill.php
* 功能描述：职位管理（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_GET['cid'];

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_num':
        $mod->list_num($cid);
        break;
    case 'list_read':
        $mod->list_read($cid);
        break;
    case "info_del":
        $mod->info_del($xid);
        break;
    case "info_refresh":
        $mod->info_refresh();
        break;
    case "info_open":
        $mod->info_open();
        break;
    case "info_close":
        $mod->info_close();
        break;
    case "info_release":
        $mod->info_release();
        break;
    case "info_delete":
        $mod->info_delete();
        break;
}
?>
