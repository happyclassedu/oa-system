<?php
/*
 * 文件名称：payy_roll_list.php
 * 功能描述：工资管理列表选择页面。
 * 代码作者：钱宝伟
 * 当前版本：V1.0
 * 创建日期：2010-07-01
 * 修改日期：2010-07-01
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_pay.php';
$mod_pay = new mod_pay();

switch ($act) {
    case 'list_num':
        $mod_pay->read_num();
        break;
    case 'list_read':
        $mod_pay->read_list();
        break;
    case 'info_del':
        $mod_pay->del_info($xid);
        break;
}
?>
