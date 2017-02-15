<?php
/*
 * 文件名称：list_yanglao_log.php
 * 功能描述：养老保险报表功能。
 * 代码作者：孙振强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_yanglao.php';
$mod = new mod_yanglao();

switch ($act) {
    case 'list_num':
        $mod->list_num();
        break;
    case 'list_read':
        $mod->list_read();
        break;
    case 'list_read4excel':
        $date_s = @$_GET['date_s'];
        $date_e = @$_GET['date_e'];
        $date_n = date('Y-m-d', i_time_u());
        $time_n = date('H:i:s', i_time_u());
        if (!$date_s) {
            $date_s = $date_e = $date_n;
        }

        $dates = array('date_s'=>$date_s, 'date_e'=>$date_e, 'date_n'=>$date_n, 'time_n'=>$time_n);
        $infos = $mod->list_read4excel($date_s, $date_e);

        $g_smarty = i_smarty_create(1);
        $g_smarty->assign('dates', $dates);
        $g_smarty->assign('infos', $infos);

        $file_text = i_smarty_get_contents($g_smarty, 'list_read4excel.xml');
        $file_type = '.xls';
        $file_name = '养老保险缴费报表' . $date_s . '至' . $date_e . '';

        $file_down = i_file_down($file_type, $file_name, $file_text);
        break;
}
?>
