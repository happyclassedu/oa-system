<?php
/*
 * �ļ����ƣ�agent_com.php
 * ��������������λ�������ơ�
 * �������ߣ�����ǿ
 * �������ڣ�2009-11-21
 * �޸����ڣ�2009-11-28
 * ��ǰ�汾��V2.0
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