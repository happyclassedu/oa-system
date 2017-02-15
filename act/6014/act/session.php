<?php
/*
* 文件名称：session.php
* 功能描述：测试session（英才网）的功能。
* 代码作者：王争强
* 创建日期：2010-08-06
* 修改日期：2010-08-06
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

switch ($act) {
    case 'ssession_verify':
        m_ssession_verify();
        break;
}

function m_ssession_verify() {
    if(isset($_SESSION['ws_uid'])) {
        $arr = '1';
    } else {
        $arr = '0';
    }
    echo $arr;
}
?>
