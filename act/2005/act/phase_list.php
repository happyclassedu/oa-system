<?php
/**
 * 文件名称：phase_list.php
 * 功能描述：招聘会信息管理系统
 * 代码作者：钱宝伟(创建)，王争强（优化） 
 * 创建日期：2010-06-07
 * 修改日期：2010-06-07
 * 当前版本：V1.0
 */
include_once '../inc/common.php';
$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_phase.php';

$mod_phase  = new  mod_phase();


switch($act) {
    case "read_list";
        $mod_phase->read_list();
        break;
    case "read_num":
        $mod_phase->read_num();
        break;
    case "del_info":
        $mod_phase->del_info($xid);
        break;
}
?>
