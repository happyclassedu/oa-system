<?php
/*
* 文件名称：info_com_usercenter.php
* 功能描述：企业管理中心（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$cid = $_SESSION['c_id'];

include_once '../mod/mod_com.php';
$mod = new mod_com();

switch ($act) {
    case 'info_init':
        $mod->info_init($cid);
        break;
    case 'info_session':
        $mod->info_session();
        break;
}
?>
