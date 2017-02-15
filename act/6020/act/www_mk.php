<?php
/*
* 文件名称：index.php
* 功能描述：测试前台smarty。
* 代码作者：王争强
* 当前版本：V2.0
* 创建日期：2010-05-25
* 修改日期：2010-05-25
*/

include_once '../inc/www_comm.php';

$act = i_get_act();  //获取 处理方法
$xid = i_get_xid();  //获取 操作对象id

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息
}

define('ws_mk', 1);  //网站是否进行生成。
$ws['mk'] = '';
$mod->ws_url_load();

switch ($xid) {
    case 'header':
        i_tpl2www_part();
        break;
    case 'menuer':
        $ws['menuer'] = $mod->list_read_menu('0');
        i_tpl2www_part();
        break;
    case 'footer':
        $ws['footer_menu'] = $mod->list_read_menu('2');
        i_tpl2www_part();
        break;
    case 'banner1':
        $arr = $mod->list_read_link(67, 1);
        $ws['banner1'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'banner2':
        $arr = $mod->list_read_link(68, 1);
        $ws['banner2'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'link0':
        $ws['link']['info'] = $mod->info_read_menu_base(60);
        $ws['link']['list'] = $mod->list_read_link(60, 12);
        i_tpl2www_link();
        break;
    case 'link1':
        $ws['link']['info'] = $mod->info_read_menu_base(58);
        $ws['link']['list'] = $mod->list_read_link(58, 12);
        i_tpl2www_link();
        break;
    case 'link2':
        $ws['link']['info'] = $mod->info_read_menu_base(59);
        $ws['link']['list'] = $mod->list_read_link(59, 12);
        i_tpl2www_link();
        break;
    case 'link3':
        $ws['link']['info'] = $mod->info_read_menu_base(57);
        $ws['link']['list'] = $mod->list_read_link(57, 14);
        i_tpl2www_link();
        break;
    case 'link4':
        $ws['link']['info'] = $mod->info_read_menu_base(70);
        $ws['link']['list'] = $mod->list_read_link(70, 15);
        i_tpl2www_link();
        break;
    case 'index':
        include_once 'www_index.php';
        break;
    case 'list_all':
        $arr_mod = $mod->mk_list_all();
        break;
    case 'list':
        $xid = $_GET['id'];
        $arr_mod = $mod->mk_list();
        break;
    case 'list_m':
        $xid = $_GET['id'];
        include "www_list_m.php";
        break;
    case 'list_m_all':
        $arr_mod = $mod->list_read_menu_mod('7');
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_list_m.php";
        }
        break;
    case 'info_all':
        $arr_mod = $mod->list_read_news_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_info.php";
        }
        break;
    case 'info':
        $xid = $_GET['id'];
        include "www_info.php";
        break;
    case 'ws_url_bat':
        $mod->ws_url_bat();
        break;
    case 'htm2www':
        $arr_htm = array(
//                'info_clogin',
//                'info_cregister'
        );

        foreach ($arr_htm as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }
}

echo 'mk_ok';
?>