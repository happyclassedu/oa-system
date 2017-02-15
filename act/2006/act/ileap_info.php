<?php
/**
 * 文件名称：ileap_info.php
 * 功能描述：主要是劳动协理员增加、修改操作。
 * 代码作者：钱宝伟、王争强
 * 当前版本：V1.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_ileap.php';
$mod_ileap = new mod_ileap();

switch ($act) {
    case 'read_info':
        $result_arr = $mod_ileap->read_info($xid);
        break;
    case 'edit_info':
        $result_arr = $mod_ileap->edit_info($xid);
        break;
    case 'add_info':
        $result_arr = $mod_ileap->add_info();
        break;
    case 'del_info':
        $result_arr = $mod_ileap->del_info($xid);
        break;
//    case 'search_street':
//        $result_arr = $mod_ileap->search_street();
//        print_r($result_arr);
//        break;
//      case 'search_community':
//        $result_arr = $mod_ileap->search_community($xid);
//        print_r($result_arr);
//        break;
}
?>
