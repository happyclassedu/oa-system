<?php
/*
 * 文件名称：list_job.php
 * 功能描述：职位信息的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$c_id = $_GET['c_id'];

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_num':
        $mod->list_num($c_id);
        break;
    case 'list_read':
        $mod->list_read($c_id);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}

//echo i_act_time();
?>
