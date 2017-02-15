<?php
/*
 * 文件名称：pay_set_info.php
 * 功能描述：工资帐套操作功能。
 * 代码作者：王争强
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
    case 'info_read':
        $mod_pay->read_set_info($xid);
        break;
    case 'info_edit':
        $mod_pay->edit_set_info($xid);
        break;
    case 'info_add':
        $mod_pay->add_set_info();
        break;
    case 'info_del':
        $mod_pay->del_set_info($xid);
        break;
    case 'paylist_num':
        $mod_pay->paylist_num($xid);
        break;
    case 'paylist_read':
        $mod_pay->paylist_read($xid);
        break;
    case 'paylist_del':
        $mod_pay->del_info($xid);
        break;
    case 'emlist_num':
        $mod_pay->emlist_num();
        break;
    case 'emlist_read':
        $mod_pay->emlist_read();
        break;
    case 'emlist_del':
        $mod_pay->emlist_del($xid);
        break;
}
?>
