<?php
/*
 * 文件名称：mdi.php
 * 功能描述：mdi控制器。
 * 代码作者：孙振强
 * 创建日期：2009-11-21
 * 修改日期：2011-05-26
 * 当前版本：V3.0
*/

include_once '../inc/common.php';

$act = i_get_act();

include_once '../mod/mod_mdi.php';
$mod = new mod_mdi();

switch ($act) {
    case 'mdi_load':
        $arr['user'] = $mod->read_user_info();
        $arr['date'] = $mod->read_date();
        $arr['menu'] = $mod->read_menu();
        $arr = i_php2json($arr);
        print_r($arr);
        break;
//    case 'load_part':
//        $part = @$_GET['p'];
//        $tpl = 'mdi_'.$part.'.htm';
//        $smarty->display($tpl);
//        break;
//    default:
//        $tpl = 'mdi.htm';
//        $smarty->display($tpl);
//        break;
}
?>