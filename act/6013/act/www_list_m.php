<?php
/*
 * 文件名称：www_list_m.php
 * 功能描述：测试前台smarty。
 * 代码作者：王争强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息
}

$ws['banner_id'] = $xid;
$ws['nav'] = $mod->read_nav($xid);
$ws['fmenu'] = $mod->info_read_menu($xid);;
$ws['left_menu'] =  $mod->list_read_menu('0', $xid);
$ws['list_m'] =  $mod->list_read_menu_news($xid, '2', '5');

$ws['act'] = 'list_m';
$ws['tpl'] = 'list_m.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/list_m_' .$xid . '.htm';  //定义生成文件路径

i_tpl2www_act();
?>
