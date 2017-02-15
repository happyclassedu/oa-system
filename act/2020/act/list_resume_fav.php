<?php
/*
* 文件名称：list_resume_fav.php
* 功能描述：简历收藏夹（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_SESSION['c_id'];

include_once '../mod/mod_resume_x.php';
$mod = new mod_resume_x();

switch ($act) {
    case 'list_num':
        $mod->list_num_fav($cid);
        break;
    case 'list_read':
        $mod->list_read_fav($cid);
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_recycle':
        $mod->info_recycle();
        break;
    case 'info_database':
        $mod->info_database($cid);
        break;
     case 'info_interview':
        $mod->info_interview($cid);
        break;
    case 'info_pv':
        $mod->info_pv();
        break;
}
?>
