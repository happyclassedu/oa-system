<?php
/*
 * 文件名称：www_index2.php
 * 功能描述：首页2-企业服务。
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

//公司新闻
//$ws['index_news0'] =  $mod->list_read_news('327', '5');

$ws['seo']['title'] = '西安市莲湖人才网首页--企业服务--首页--';
$ws['seo']['keys']  = '西安市莲湖人才网首页--企业服务--首页';
$ws['seo']['desc']  = '西安市莲湖人才网首页--企业服务--首页';

$ws['act'] = 'index2';
$ws['tpl'] = 'index2.htm';

$tpl = 'master2.htm';  //定义页面模板路径
$mkf = m_app . 'www/index2.htm';  //定义生成文件路径

i_tpl2www_act();
?>