<?php
/*
 * 文件名称：trans_list_sele.php
 * 功能描述：员工调动管理列表选择页面。
 * 代码作者：王争强、钱宝伟
 * 当前版本：V1.0
 * 创建日期：2010-06-21
 * 修改日期：2010-06-21
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_trans.php';
$mod_trans = new mod_trans();

switch ($act) {
    case 'list_num':
        $mod_trans->read_num();
        break;
    case 'list_read':
        $mod_trans->read_list();
        break;
    case 'info_del':
        $mod_trans->del_info($xid);
        break;
}
?>