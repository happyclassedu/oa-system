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

//支部介绍
$ws['index_news1_1'] = $mod->info_read_menu('477');

//时政要闻
$ws['index_news2_1'] = $mod->info_read_menu('390');
$ws['index_news2'] =  $mod->list_read_news('390', '6');

//教育学习
$ws['index_news3_1'] = $mod->info_read_menu('425');
$ws['index_news3'] =  $mod->list_read_news('425', '4');

//创先争优
$ws['index_news4_1'] = $mod->info_read_menu('392');
$ws['index_news4'] =  $mod->list_read_news('392', '5');

//支部公告
$ws['index_news5_1'] = $mod->info_read_menu('1113');
$ws['index_news5'] =  $mod->list_read_news('1113', '5');

//党员活动室首页-轮动图片新闻
$ws['link_pics'] = $mod->list_read_link('468', '3');

$ws['seo']['title'] = '西安市莲湖区人力资源服务中心网站首页--党员之家--';
$ws['seo']['keys']  = '西安市莲湖区人力资源服务中心网站首页--党员之家--党员活动室';
$ws['seo']['desc']  = '西安市莲湖区人力资源服务中心网站首页--党员之家--党员活动室';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>