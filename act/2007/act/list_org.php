<?php
/*
 * 文件名称：list_org.php
 * 功能描述：组织机构管理信息列表查询功能。
 * 代码作者：钱宝伟(创建)、王争强（修改）、孙振强（重构）
 * 创建日期：2010-06-11
 * 修改日期：2010-06-19
 * 当前版本：V2.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_org.php';
$mod = new mod_org();

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
