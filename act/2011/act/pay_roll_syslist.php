<?php
/*
 * 文件名称：pay_roll_syslist.php
 * 功能描述：工资管理操作功能。
 * 代码作者：钱宝伟
 * 创建日期：2010-07-01
 * 修改日期：2010-07-01
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_pay.php';
$mod_pay = new mod_pay();

switch ($act) {
    case 'info_init':
        $mod_pay->info_init();
        break;
    case 'info_edit':
        $mod_pay->edit_info($xid);
        break;
    case 'init_f':
        $mod_pay->init_f($xid);
        break;
    case 'init_c':
        $mod_pay->init_c($xid);
        break;
    case 'init_c_sys':
        $mod_pay->init_c_sys($xid);
        break;
    case 'info_del':
        $mod_pay->del_info($xid);
        break;
}
?>
