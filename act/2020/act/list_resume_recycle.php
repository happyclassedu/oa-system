<?php
/*
* 文件名称：list_resume_recycle.php
* 功能描述：简历回收站（英才网）的功能。
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
        $mod->list_num_recycle($cid);
        break;
    case 'list_read':
        $mod->list_read_recycle($cid);
        break;
    case 'info_read':
        $mod->info_read_recycle($xid);
        break;
    case 'info_revert':
        $mod->info_revert();
        break;
    case 'info_del_true':
        $mod->info_del_forever();
        break;
    case 'info_pv':
        $mod->info_pv();
        break;
}
?>
