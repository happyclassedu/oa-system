<?php
/*
* 文件名称：info_resume_look.php
* 功能描述：查看简历（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_resume.php';

$mod = new mod_resume();

switch ($act) {
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'list_read_i':
        $mod->list_read_i();
        break;
}
?>
