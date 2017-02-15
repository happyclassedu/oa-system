<?php
/**
 * 文件名称：trans_turnover.php
 * 功能描述：主要是人员离职操作。
 * 代码作者：王争强
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
    case 'info_read':
        $mod_trans->read_info($xid);
        break;
    case 'info_edit':
        $mod_trans->edit_info($xid);
        break;
    case 'init_memers' :
        $mod_trans->member_info($xid);
        break;
}
?>
