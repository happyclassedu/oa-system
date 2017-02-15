<?php
/*
 * 文件名称：post_roll_info.php
 * 功能描述：工资管理操作功能。
 * 代码作者：钱宝伟(创建)
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
    case 'info_add':
        $mod_pay->add_roll_info();
        break;
    case 'info_copy':
        $mod_pay->copy_roll_info($xid);
        break;
    case 'init_zhangtao':
        $mod_pay->zhangtao_info();
}
?>
