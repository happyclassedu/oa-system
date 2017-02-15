<?php
/*
* 文件名称：info_job.php
* 功能描述：（企业）职位发布（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_SESSION['c_id'];

include_once '../mod/mod_job.php';
$mod = new mod_job();

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
    case 'info_com':
        $mod->info_com($cid);
        break;
    case 'info_time':
        $mod->info_time('0');
        break;
}
?>
