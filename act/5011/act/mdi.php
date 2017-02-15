<?php
/*
 * 文件名称：agent_com.php
 * 功能描述：代理单位操作控制。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2009-11-28
 * 当前版本：V2.0
*/

include_once '../inc/common.php';

$xid = get_xid();
$act = get_act();

switch ($act) {
    case 'load':
        $tpl = 'mdi.htm';
        $smarty->display($tpl);
        break;
    case 'load_part':
        $part = @$_GET['p'];
        $tpl = 'mdi_'.$part.'.htm';
        $smarty->display($tpl);
        break;
    default:
        $tpl = 'mdi.htm';
        $smarty->display($tpl);
        break;
}
?>