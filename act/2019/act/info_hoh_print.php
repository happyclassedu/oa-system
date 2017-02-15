<?php
/**
 * 文件名称：info_hoh_print.js
 * 功能描述：打印计生证明功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改时间：2010-08-06
 * 当前版本：v1.0
 */

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_hoh.php';
$mod = new mod_hoh();

switch ($act) {
    case 'info_init':
        $mod->info_init($xid);
        break;
}
?>
