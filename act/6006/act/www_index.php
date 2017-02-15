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
    $ws['cfg'] = $mod->info_read_ws_cfg_base();
}

$ws['index_news1'] = $mod->read_index_news1();
$ws['index_news2'] = $mod->read_index_news2();
$ws['link_pics'] = $mod->list_read_link(69, 4);
$ws['link_coms'] = $mod->list_read_news(26, 16);
$ws['index_resume'] = $mod->read_index_resume();

$ws['seo']['title'] = '西安曲江新区人才交流中心政务门户网首页--';
$ws['seo']['keys']  = '曲江人才网首页,';
$ws['seo']['desc']  = '西安曲江新区人才交流中心政务门户网首页,';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>