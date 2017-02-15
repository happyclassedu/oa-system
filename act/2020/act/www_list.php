<?php
/*
 * 文件名称：www_list.php
 * 功能描述：测试前台smarty。
 * 代码作者：王争强
 * 当前版本：V2.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';  //引入网站前台公共文件

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id
$pid = i_get_pid();  //获取 当前页码

global $mod, $ws, $tpl, $mkf;

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息
}

$list_mk = '';
if (!$page) {
    $page['page_now'] = $pid;  //当前页码
    $page['show_num'] = '8';  //每页显示内容条数
    $page['info_num'] = $mod->list_read_news_num($xid);  //该栏目共有内容数
    $page['page_num'] = ceil($page['info_num']/$page['show_num']);  //该栏目共有多少页

    if ($page['page_now'] > $page['page_num']) {
        $page['page_now'] = 1;
    }

    $ws['list'] = $mod->info_read_menu($xid);
    $ws['fmenu'] = $mod->info_read_menu($ws['list']['fid']);

    $ws['seo']['title'] = $ws['list']['name'] . '--';
    $ws['seo']['keys']  = $ws['list']['seo_keys'] . ',';
    $ws['seo']['desc']  = $ws['list']['seo_desc'] . ',';

    $ws['act'] = 'list';
    $ws['tpl'] = 'list.htm';

    $tpl = 'master.htm';  //定义页面模板路径
    $ws['page'] = i_list_page($xid, $page);

    $ws['news'] = $mod->list_read_news($xid, $page['show_num'], $page['show_num']*($page['page_now']-1));

    $mkf = m_app . 'www/list_' .$xid . '_' .$page['page_now'] . '.htm';  //定义生成文件路径

    i_tpl2www_act();
} else if ($page['page_now'] >= $page['page_num']) {
    $list_mk = 'ok';
} else {
    $page['page_now']++;
    $ws['page'] = i_list_page($xid, $page);

    $ws['news'] = $mod->list_read_news($xid, $page['show_num'], $page['show_num']*($page['page_now']-1));

    $mkf = m_app . 'www/list_' .$xid . '_' .$page['page_now'] . '.htm';  //定义生成文件路径

    i_tpl2www_act();
}
?>