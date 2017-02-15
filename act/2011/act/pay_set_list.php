<?php
/*
 * 文件名称：post_set_list.php
 * 功能描述：工资帐套信息列表。
 * 代码作者：王争强(创建)
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
    case 'num_read':
        $mod_pay->read_set_num();
        break;
    case 'list_read':
        $mod_pay->read_set_list();
        break;
    case 'info_del':
        $mod_pay->del_set_info($xid);
        break;
}
?>
