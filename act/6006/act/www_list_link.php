<?php
/*
 * 文件名称：www_list.php
 * 功能描述：测试前台smarty。
 * 代码作者：王争强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id
$pid = i_get_pid();  //获取 当前页码

global $mod, $ws, $tpl, $mkf;

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base();
}

$ws['list'] = $mod->info_read_menu($xid);
$ws['link'] = $mod->list_read_link($xid, 120);
$ws['nav'] = $mod->read_nav($xid);

$ws['seo']['title'] = $ws['list']['name'] . '--';
$ws['seo']['keys']  = $ws['list']['seo_keys'] . ',';
$ws['seo']['desc']  = $ws['list']['seo_desc'] . ',';

$ws['act'] = 'list_link';
$ws['tpl'] = 'list_link.htm';

$tpl = 'master1.htm';  //定义页面模板路径
$mkf = m_app . 'www/list_link_' .$xid . '_1.htm';  //定义生成文件路径

i_tpl2www_act();
?>