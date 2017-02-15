<?php
/*
 * 文件名称：list_moh.php
 * 功能描述：业务操作列表的功能。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_moh.php';
$mod = new mod_moh();

//$tmp = 'A2f67DA2f63U1T5A2f63U1TA2f63AA2f63U1TemanyA2f63U1TA2f62CA2f63U1T39A2f625ABA2f6255EA2f6258AA2f625C9A2f6255EA2f625A2f63U1TA2f63AA2f63U1Tetats_idemA2f63U1TA2f62CA2f63U1T3A2f63U1TA2f63AA2f63U1TemanuA2f63U1TA2f62CA2f63U1T2A2f63U1TA2f63AA2f63U1TdracdiA2f63U1TA2f62CA2f63U1T1A2f63U1TA2f63AA2f63U1TemanpA2f63U1TA2f67B';
//$tmp = 'A2f67DA2f63U1T39A2f625ABA2f6255EA2f6258AA2f625C9A2f6255EA2f625A2f63U1TA2f63AA2f63U1Tetats_idemA2f63U1TA2f62CA2f63U1TABA2f625CBA2f6255EA2f625FAA2f625C8A2f6256EA2f62599A2f625DAA2f6255EA2f625A2f63U1TA2f63AA2f63U1TemanpA2f63U1TA2f67B';
//$tmp = i_json2php($tmp);
//print_r($tmp);

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
}
?>
