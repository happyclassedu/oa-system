<?php
/*
* 文件名称：info_hreg.php
* 功能描述：户籍婚姻系统的功能。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/

include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_hreg.php';
$mod = new mod_hreg();

switch ($act) {
    case 'info_read':
        $mod->info_read($xid);
        break;
    case 'info_edit':
        $mod->info_edit($xid);
        break;
    case 'info_add':
        $mod->info_add();
        break;
    case 'info_del':
        $mod->info_del($xid);
        break;
    case 'list_num_hoh':
        $mod->list_num_hoh($xid);
        break;
    case 'list_read_hoh':
        $mod->list_read_hoh($xid);
        break;
    case 'list_read4excel':
        $type = i_json2php($_GET['type']);
        $date_s = @$_GET['date_s'];
        $date_e = @$_GET['date_e'];
        $date_n = date('Y-m-d', i_time_u());
        $time_n = date('H:i:s', i_time_u());
        if (!$date_s) {
            $date_s = $date_e = $date_n;
        }

        $dates = array('date_s'=>$date_s, 'date_e'=>$date_e, 'date_n'=>$date_n, 'time_n'=>$time_n);
        $infos = $mod->list_read4excel($xid, $type);

        $arr_info = $g_xdb->read_one('#@__pinfo', ' * ', 'id=' . $xid);
        $bname = $arr_info['cname'];

        $g_smarty = i_smarty_create(1);
        $g_smarty->assign('dates', $dates);
        $g_smarty->assign('infos', $infos);
        $g_smarty->assign('pinfos', $arr_info);

        $file_text = i_smarty_get_contents($g_smarty, 'list_read_hoh.xml');
        $file_type = '.xls';
        $file_name = '操作日志  经办人：'. $bname;

        $file_down = i_file_down($file_type, $file_name, $file_text);
        break;
}
?>
