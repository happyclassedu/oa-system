<?php
/**
 * 文件名称：list_resume_c.php
 * 功能描述：企业简历库的列表控制器
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$ws_id = @$_GET['ws_id'];

include_once '../mod/mod_resume_c.php';
$mod = new mod_resume_c();

switch ($act) {
    case 'list_read':
        $mod->list_read4resume_c($ws_id);
        break;
    case 'list_num':
        $mod->list_num4resume_c($ws_id);
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>