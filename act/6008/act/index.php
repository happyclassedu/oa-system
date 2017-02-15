<?php
/*
* 文件名称：index_home.php
* 功能描述：测试前台smarty。
* 代码作者：王争强
* 当前版本：V2.0
* 创建日期：2010-05-25
* 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取操作的方法

$act_arr = array();  //定义可以处理操作方法
$act_arr[] = 'index';
$act_arr[] = 'list';
$act_arr[] = 'list_m';
$act_arr[] = 'info';
$act_arr[] = 'down';
$act_arr[] = 'mk';

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
}

//党委公告
$ws['index_menu6'] = $mod->info_read_menu(224);
$ws['index_news6'] = $mod->list_read_news(224, 5);

if (in_array($act, $act_arr)) {  //判断获取的act是否在预定义的act_arr数组里
    include_once 'www_' . $act . '.php';
} else {  //否则默认访问首页
    $act = 'index';
    include_once 'www_' . $act . '.php';
}


//    case 'htm_2_www':
//        $arr_htm = array(
//                'info_clogin',
//                'info_cregister',
//                'info_cregister_ok',
//                'info_com',
//                'info_com_detail',
//                'info_com_pdw',
//                'info_job',
//                'list_job',
//                'info_person',
//                'info_plogin',
//                'info_pregister',
//                'info_pregister_ok',
//                'info_resume'
//        );
//
//        foreach ($arr_htm as $val) {
//            $www_file = m_app . 'www/' . $val . '.htm';
//            $act = '../htm/' . $val;
//            $buffer = i_include_get_contents('www_htm.php');
//            $buffer = buffer_replace_www($buffer);
//            i_make_file($www_file, $buffer);
//        }

?>