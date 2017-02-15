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

$ws['menuer'] = $mod->list_read_menu('0');
//工作动态
$ws['index_menu1'] = $mod->info_read_menu(207);
$ws['index_news1'] = $mod->list_read_news(207, 7);

//党建知识
$ws['index_menu2'] = $mod->info_read_menu(208);
$ws['index_news2'] = $mod->list_read_news(208, 9);

//党务指南
$ws['index_menu3'] = $mod->info_read_menu(209);
$ws['index_news3'] = $mod->list_read_news(209, 9);

//支部建设
$ws['index_menu4'] = $mod->info_read_menu(212);
$ws['index_news4'] = $mod->list_read_news(212, 9);

//党员风采
$ws['index_menu5'] = $mod->info_read_menu(210);
$ws['index_news5'] = $mod->list_read_news(210, 9);

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>