<?php
/*
 * 文件名称：info_hoh_hjcard.php
 * 功能描述：借出/归还户籍卡的功能。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_hoh.php';
$mod = new mod_hoh();

switch ($act) {
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_init':
        $mod->info_init($xid);
        break;
}
?>
