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
}

$ws['cfg'] = $mod->info_read_ws_cfg_base();

$ws['qa'] = $mod->info_read_qa($xid);
$ws['info'] = $mod->info_read_menu('1522');

$ws['seo']['title'] = $ws['info']['name'] . '--';
$ws['seo']['keys']  = $ws['info']['seo_keys'] . ',';
$ws['seo']['desc']  = $ws['info']['seo_desc'] . ',';

$ws['act'] = 'qa';
$ws['tpl'] = 'qa.htm';

$tpl = 'master1.htm';  //定义页面模板路径
$mkf = m_app . 'www/qa_' .$xid . '.htm';  //定义生成文件路径

i_tpl2www_act();
?>
