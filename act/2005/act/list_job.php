<?php
/**
 * 文件名称：list_job.php
 * 功能描述：招聘会职位列表
 * 代码作者：王争强（优化）
 * 创建日期：2010-09-10
 * 修改日期：2010-09-10
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
}
?>

