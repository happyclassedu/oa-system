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

switch ($act) {
    case 'read_phase_led':
        include_once '../mod/mod_phase.php';
        $mod_phase = new mod_phase(); //实例模型mod_phase
        $mod_phase->read_phase_led();
        break;
    case 'read_recruit_led':
        include_once '../mod/mod_recruit.php';
        $mod_recruit = new mod_recruit(); //实例模型mod_phase
        $mod_recruit->read_recruit_led($xid);
        break;
}
?>
