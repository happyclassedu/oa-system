<?php
/*
 * 文件名称：index.php
 * 功能描述：测试前台smarty。
 * 代码作者：王争强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息
}

$ws['info'] = $mod->info_read_news($xid);
$ws['info']['remark'] = urldecode($ws['info']['remark']);

$tmp = $mod->read_menu4info($xid);

if ($tmp) {
    if( '0' != $tmp['fid']){
        $nav_id = $tmp['fid'];
        $fid = $tmp['fid'];
    } else {
        $nav_id = $tmp['id'];
        $fid = $tmp['id'];
    }
} else {
    $nav_id = $ws['info']['menu_id'];
    $arr = $mod->info_read_menu($nav_id);
    $fid = $arr['fid'];
}

$ws['nav'] = $mod->read_nav($nav_id);
$ws['fmenu'] = $mod->info_read_menu($nav_id);
$ws['left_menu'] = $mod->list_read_menu('0', $fid);
$ws['seo']['title'] = $ws['info']['name'] . '--';
$ws['seo']['keys']  = $ws['info']['tag'] . ',';
$ws['seo']['desc']  = $ws['info']['intro'] . ',';

$ws['act'] = 'info';
$ws['tpl'] = 'info.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/info_' .$xid . '.htm';  //定义生成文件路径

i_tpl2www_act();
?>
