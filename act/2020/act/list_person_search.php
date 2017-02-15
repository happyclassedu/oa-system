<?php
/*
* 文件名称：list_person_search.php
* 功能描述：个人搜索（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$pid = $_SESSION['p_id'];

include_once '../mod/mod_psearch.php';
$mod = new mod_psearch();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_favorite':
        $mod->info_favorite();
        break;
    case 'info_login':
        $mod->info_login();
        break;
    case 'info_init':
        $mod->info_init($pid);
        break;
    case 'info_loginout':
        $mod->info_loginout();
        break;
}
?>
