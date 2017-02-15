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

//最新动态
$ws['index_news1'] = $mod->read_index_news1();
//print_r($ws['index_news1']);
//$ws['index_news0'] = $mod->list_read_news0('6');
$ws['link_pics'] = $mod->list_read_link('386', '4');
//招聘会讯
$ws['index_news3_1'] = $mod->info_read_menu('145');
$ws['index_news3'] =  $mod->list_read_news('145', '8');
////企业会讯
//$ws['index_news2'] =  $mod->list_read_news('155', '7');
////职场快讯
//$ws['index_news3'] =  $mod->list_read_news('158', '7');
//热点·话题
$ws['index_news4'] =  $mod->list_read_news('158', '6');
//热门职位


//品牌企业
$ws['index_news5_1'] = $mod->info_read_menu('157');
$ws['index_news5'] =  $mod->list_read_news('157', '8');
//最新求职简历

//就业明星

//简历指导, 面试技巧, 培训动态, 职业规划, 求职技巧
$ws['index_news2'] = $mod->read_index_news2();
//print_r($ws['index_news2']);

$ws['seo']['title'] = '西安市莲湖人才网首页--';
$ws['seo']['keys']  = '西安市莲湖人才网首页';
$ws['seo']['desc']  = '西安市莲湖人才网首页';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>