<?php
/*
* 文件名称：list_job_eavoritd.php
* 功能描述：(个人)申请职位（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$pid = $_SESSION['p_id'];

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_read_arr':
        $mod->list_read_arr();
        break;
    case 'list_read_resume':
        $mod->list_read_resume($pid);
        break;
     case 'list_read_letter':
        $mod->list_read_letter($pid);
        break;
     case 'info_eavoritd':
        $mod->info_eavoritd($pid);
        break;
    case 'info_pv':
        $mod->info_pv();
        break;
    
}
?>
