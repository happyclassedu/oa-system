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

//解决方案
$ws['index_news0'] = $mod->list_read_news('1510', '4');

////产品中心
//$ws['index_links1'] = $mod->info_read_menu('321');

//客户服务
$ws['index_menu1'] = $mod->list_read_menu('0', '329');
$ws['index_links'] = $mod->list_read_link('1512', '14');

$ws['seo']['title'] = '西安市而立电子科技有限公司门户网首页--';
$ws['seo']['keys']  = '西安市而立电子科技有限公司门户网首页';
$ws['seo']['desc']  = '西安市而立电子科技有限公司门户网首页';

$ws['act'] = 'index';
$ws['tpl'] = 'index.htm';

$tpl = 'master.htm';  //定义页面模板路径
$mkf = m_app . 'www/index.htm';  //定义生成文件路径

i_tpl2www_act();
?>