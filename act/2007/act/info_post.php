<?php
/**
 * 文件名称：info_post.php
 * 功能描述：职务管理模块的信息控制器
 * 代码作者：钱宝伟（创建）、孙振强（重构）。
 * 创建日期：2010-06-11
 * 修改日期：2010-06-13
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_post.php';
$mod = new mod_post();

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
    case 'info_name_check':
        $mod->info_name_check($xid);
        break;
}
?>