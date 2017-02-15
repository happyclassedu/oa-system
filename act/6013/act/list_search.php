<?php
/**
 * 文件名称：list_search.php
 * 功能描述：信息搜索的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_search.php';
$mod = new mod_search();

switch ($act) {
    case 'list_read':
        $mod->list_read();
        break;
    case 'list_num':
        $mod->list_num();
        break;
}
?>