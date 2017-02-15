<?php
/**
 * 文件名称：test_list.php
 * 功能描述：练习查询功能
 * 代码作者：钱宝伟
 * 创建日期：2010-06-22
 * 修改日期：2010-06-22
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/test_mod.php';
$test_mod = new test_mod();

switch ($act) {
    case 'list_num':
        $test_mod->read_num();
        break;
    case 'list_read':
        $test_mod->read_list();
        break;
//    case 'info_del':
//        $mod_leave->del_info($xid);
//        break;
}
?>
