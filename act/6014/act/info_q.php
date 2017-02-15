<?php
/**
 * 文件名称：info_q.php
 * 功能描述：留言信息的信息控制器
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../../2030/mod/mod_qa.php';
$mod = new mod_qa();

switch ($act) {
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
}
?>