<?php
/*
 * 文件名称：list_job.php
 * 功能描述：岗位管理模块的列表控制器
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）。
 * 创建日期：2010-06-11
 * 修改日期：2010-07-10
 * 当前版本：V2.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>
