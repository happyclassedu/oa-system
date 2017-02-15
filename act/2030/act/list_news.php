<?php
/*
 * 文件名称：list_news.php
 * 功能描述：新闻信息的列表控制器
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_news.php';
$mod = new mod_news();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'list_read4desk':
        $mod->list_read4desk();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}

//echo i_act_time();
?>
