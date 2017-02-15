<?php
/*
 * 文件名称：www_index.php
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

$ws['index_news0_m'] = $mod->list_read_menu('1', '409');
$ws['index_news0_1'] = $mod->list_read_news('402', '6'); // 402 新闻中心
$ws['index_news0_2'] = $mod->list_read_news('412', '6'); //412 通知公告
$ws['index_news0_3'] = $mod->list_read_news('410', '6'); //410 主题年活动
$ws['link_pics'] = $mod->list_read_link('407', '4'); //首页图片新闻1
//$ws['index_menu0'] = $mod->info_read_menu('1549'); //领导风采
$ws['index_resume'] = $mod->list_read_resume('1', '5'); //简历信息
$ws['index_news1'] = $mod->read_index_news1();
$ws['index_menu2'] = $mod->list_read_menu('3', '1520');
$ws['link_coms'] = $mod->list_read_news('401', '6');

$ws['seo']['title'] = '西安市碑林人才网首页--';
$ws['seo']['keys']  = '西安市碑林人才网首页';
$ws['seo']['desc']  = '西安市碑林人才网首页';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>