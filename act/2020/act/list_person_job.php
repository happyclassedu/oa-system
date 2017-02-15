<?php
/*
* 文件名称：list_person_job.php
* 功能描述：(个人)职位管理（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_job.php';
$mod = new mod_job();

switch ($act) {
    case 'list_num':
        $mod->list_num_zws();
        break;
    case 'list_read':
        $mod->list_read_zws();
        break;
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_favorite':
        $mod->info_favorite();
        break;
    case 'info_pv':
        $mod->info_pv();
        break;
}
?>
