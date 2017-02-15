<?php
/*
* 文件名称：list_resume.php
* 功能描述：简历列表管理（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$pid = $_SESSION['p_id'];

include_once '../mod/mod_resume.php';

$mod = new mod_resume();

switch ($act) {
    case "list_num":
        $mod->list_num($pid);
        break;
    case 'list_read':
        $mod->list_read($pid);
        break;
    case "info_del":
        $mod->info_del($xid);
        break;
    case 'info_init':
        $mod->info_init($pid);
        break;
}
?>
