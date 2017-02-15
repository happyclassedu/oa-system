<?php
/*
 * 文件名称：recruit_list.php
 * 功能描述：招聘会列表功能
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
    case 'del_info':
        $mod_recruit->del_info($xid);
        break;
    case 'read_num':
        $mod_recruit->read_num();
        break;
    case 'read_list':
        $mod_recruit->read_list();
        break;
}
?>
