<?php
/*
 * 文件名称：www_info_resume.php
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

$ws['info'] = $mod->info_read_resume($xid);
$ws['info']['remark'] = urldecode($ws['info']['remark']);

$ws['nav'] = $mod->read_nav(0);
$tmp['name'] = '推荐简历';
$tmp['url'] = 'list_resume_1_1.htm';
$ws['nav'][] = $tmp;

$ws['seo']['title'] = '推荐简历--';
$ws['seo']['keys']  = '推荐简历，';
$ws['seo']['desc']  = '推荐简历，';

$ws['act'] = 'info_resume';
$ws['tpl'] = 'info_resume.htm';

$tpl = 'master1.htm';  //定义页面模板路径
$mkf = m_app . 'www/info_resume_' .$xid . '.htm';  //定义生成文件路径

i_tpl2www_act();
?>
