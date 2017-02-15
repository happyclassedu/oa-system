<?php
/**
 * 文件名称：info_file.php
 * 功能描述：文件管理的信息控制器
 * 代码作者：孙振强（创建）
 * 创建时间：2010-11-15
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_file.php';
$mod = new mod_file();

switch ($act) {
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_edit':
        $mod->info_edit($xid);
        break;
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'info_name_check':
        $mod->info_name_check($xid);
        break;
    case 'file_down':
        $mod->file_down($xid);
        break;
    case 'file_down_ext1' :
        $mod->file_down_ext1($xid);
        break;
    case 'info_update':
        $mod->info_update($xid);
        break;
    case 'list_read_file':
        $mod->list_read_file4news($xid);
        break;
    case 'file_del4news':
        $mod->file_del4news($xid);
        break;
}
?>