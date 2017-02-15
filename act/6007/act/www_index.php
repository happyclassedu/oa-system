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

$ws['cfg'] = $mod->info_read_ws_cfg_base();  //网站配置信息

//项目概况
$ws['index_news0_m'] = $mod->info_read_menu('270');
$ws['link_pics'] = $mod->list_read_link('308', '5');

//中部菜单
$ws['sub_menu'] = $mod->list_read_menu('0', '256');

//企业动态
$ws['index_news1_m'] = $mod->info_read_menu('271');
$ws['index_news1'] = $mod->list_read_news('271', '6');

//print_r($ws['index_news1_m']);
//行业动态
$ws['index_news2_m'] = $mod->info_read_menu('272');
$ws['index_news2'] = $mod->list_read_news('272', '6');

$arr = $mod->list_read_link(68, 1);
$ws['index_banner2'] = $arr[0];
$arr = $mod->list_read_link(67, 1);
$ws['index_banner3'] = $arr[0];
//print_r($ws['index_news2_m']);
$ws['seo']['title'] = '立丰地产首页--';
$ws['seo']['keys']  = '立丰地产首页,';
$ws['seo']['desc']  = '立丰地产首页,';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>