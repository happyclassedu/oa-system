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

global $mod, $ws, $tpl, $mkf;

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息
}

$ws['info'] = $mod->info_read_news($xid);
$ws['info']['remark'] = urldecode($ws['info']['remark']);

$tmp = $mod->read_menu4info($xid);

$ws['xg_video'] = $mod->info_read_menu($ws['info']['menu_id']);
$ws['xg_video_list'] = $mod->list_read_news($ws['info']['menu_id'], '4');
$ws['seo']['title'] = $ws['info']['name'] . '--';
$ws['seo']['keys']  = $ws['info']['tag'] . ',';
$ws['seo']['desc']  = $ws['info']['intro'] . ',';

$ext = ''; //扩展值

if('' != $ws['info']['type_ext'] && isset($ws['info']['type_ext'])){
    $ext = '0';
}

$ws['act'] = 'info' . $ext;
$ws['tpl'] = 'info' . $ext . '.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/info' . $ext . '_' .$xid . '.htm';  //定义生成文件路径

i_tpl2www_act();
?>
