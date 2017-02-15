<?php
/**
 * 文件名称：list_thought.php
 * 功能描述：思想汇报的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../../2030/mod/mod_news.php';
$mod = new mod_news();

switch ($act) {
    case 'list_read':
        $mod->list_read_menu4news();
        break;
    case 'list_num':
        $mod->list_num_menu4news();
        break;
}
?>