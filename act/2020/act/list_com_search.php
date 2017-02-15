<?php
/*
* 文件名称：list_com_search.php
* 功能描述：搜索（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_SESSION['c_id'];

include_once '../mod/mod_csearch.php';
$mod = new mod_csearch();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
   case 'info_interview':
        $mod->info_interview($cid);
        break;
    case 'info_fav':
        $mod->info_fav($cid);
        break;
    case 'info_init':
        $mod->info_init($cid);
        break;
    case 'info_loginout':
        $mod->info_loginout();
        break;
    case 'info_pv':
        $mod->info_pv();
        break;

}
?>
