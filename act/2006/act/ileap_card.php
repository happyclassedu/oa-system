<?php
/**
 * 文件名称：ileap_card.php
 * 功能描述：主要是劳动协理员工作证的信息获取。
 * 代码作者：孙振强（创建、优化）
 * 当前版本：V1.0
 * 创建日期：2010-06-08
 * 修改日期：2010-06-08
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_ileap.php';
$mod_ileap = new mod_ileap();

switch ($act) {
    case 'read_info':
        $result_arr = $mod_ileap->read_info($xid);
        break;
}
?>
