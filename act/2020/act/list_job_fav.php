<?php
/*
* 文件名称：list_job_fav.php
* 功能描述：(个人)收藏职位（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$pid = $_SESSION['p_id'];

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_num':
        $mod->list_num_favorite($pid);
        break;
    case 'list_read':
        $mod->list_read_favorite($pid);
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'info_del_batch':
        $mod->info_del_batch();
        break;
    case 'info_pv':
        $mod->info_pv();
        break;
}
?>
