<?php
/*
 * 文件名称：person_pay_info.php
 * 功能描述：员工帐套设置操作功能。
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
        $mod_pay->read_person_info($xid);
        break;
    case 'info_edit':
        $mod_pay->edit_person_info($xid);
        break;
    case 'info_add':
        $mod_pay->add_person_info();
        break;
    case 'info_del':
        $mod_pay->del_person_info($xid);
        break;
    case 'init_memers':
        $mod_pay->member_info($xid);
        break;
    case 'init_zhangtao':
        $mod_pay->zhangtao_info();
}
?>
