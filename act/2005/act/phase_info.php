<?php
/**
 * 文件名称：phase_info.php
 * 功能描述：招聘会信息管理系统
 * 代码作者：钱宝伟(创建)，王争强（优化）
 * 创建日期：2010-06-07
 * 修改日期：2010-06-12
 * 当前版本：V2.0
 */
include_once '../inc/common.php';
$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_phase.php';
$mod_phase = new mod_phase(); //实例模型mod_phase

 switch ($act) {
    case 'read_info':
        $mod_phase->read_info($xid);
        break;
    case 'edit_info':
        $mod_phase->edit_info($xid);
        break;
    case 'add_info':
        $mod_phase->add_info();
        break;
    case 'del_info':
        $mod_phase->del_info($xid);
        break;
}
?>
