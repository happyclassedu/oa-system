<?php
/*
 * 文件名称：recruit_info.php
 * 功能描述：主要是招聘会信息增加、修改操作。
 * 代码作者：王争强
 * 当前版本：V1.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_recruit.php';
$mod_recruit = new mod_recruit();

switch ($act) {
    case 'recruit_phase':
        $mod_recruit->recruit_phase();
        break;
    case 'add_info':
        $mod_recruit->add_info();
        break;
    case 'read_info':
        $mod_recruit->read_info($xid);
        break;
    case 'edit_info':
        $mod_recruit->edit_info($xid);
        break;
    case 'del_info':
        $mod_recruit->del_info($xid);  
        break;
    case "copy_info":
        $mod_recruit->copy_info($xid);
        break;
 
}
?>
