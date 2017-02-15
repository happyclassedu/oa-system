<?php
/*
 * 文件名称：list_alipay.php
 * 功能描述：支付接口信息的列表控制器
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();
$ws_id = $_GET['ws_id'];

include_once '../mod/mod_alipay.php';
$mod = new mod_alipay();

switch ($act) {
    case 'list_read':
        $mod->list_read4alipay();
        break;
    case 'list_num':
        $mod->list_num4alipay();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
}
?>
