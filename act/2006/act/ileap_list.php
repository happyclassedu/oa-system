<?php
/*
 * 文件名称：ileap_list.php
 * 功能描述：劳动协理员列表查询功能。
 * 代码作者：钱宝伟、王争强、孙振强（优化）
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_ileap.php';
$mod_ileap = new mod_ileap();

switch ($act) {
    case 'read_num':
        $result_arr = $mod_ileap->read_num();
        break;
    case 'read_list':
        $result_arr = $mod_ileap->read_list();
        break;
    case 'del_info':
        $result_arr = $mod_ileap->del_info($xid);
        break;
}
?>