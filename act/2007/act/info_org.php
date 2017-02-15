<?php
/*
 * 文件名称：info_org.php
 * 功能描述：机构管理信息控制器
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）。
 * 创建日期：2010-06-11
 * 修改日期：2010-07-10
 * 当前版本：V2.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_org.php';
$mod = new mod_org();

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
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'list_read_fid':
        $mod->list_read_fid();
        break;
}
?>
