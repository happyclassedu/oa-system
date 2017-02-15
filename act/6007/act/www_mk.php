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
}

define('ws_mk', 1);  //网站是否进行生成。
$ws['mk'] = '';
$mod->ws_url_load();

switch ($xid) {
    case 'header':
        $arr = i_get_menu2child($mod->list_read_menu_all('0'));
        $ws['header_menu'] = substr_replace(i_display_multi_menu($arr), '<ul id="jMenu">', 0, 27);
        i_tpl2www_part();
        break;
    case 'footer':
        $ws['footer_menuer'] = $mod->list_read_menu('2');
        i_tpl2www_part();
        break;
    case 'flinks_img':
        $ws['links_menu'] = $mod->info_read_menu('273');
        $ws['links'] = $mod->list_read_link('273', '7');
        i_tpl2www_part();
        break;
    case 'links1':
        $arr = $mod->list_read_link(311, 1);
        $ws['links1'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'links2':
        $arr = $mod->list_read_link(312, 1);
        $ws['links2'] = $arr[0];
        i_tpl2www_part();
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
    case 'list_qa_all':
        $arr_mod = $mod->list_read_menu_mod('6');
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_list_qa.php";
        }
        break;
    case 'qa_all':
        $arr_mod = $mod->list_qa_read_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_qa.php";
        }
        break;
    case 'list_link_all':
        $arr_mod = $mod->list_read_menu_mod('5');
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_list_link.php";
        }
        break;
    case 'list_link':
        $xid = $_GET['id'];
        include "www_list_link.php";
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
        $arr_htm1 = array(
                'login',
                'info_register',
                'info_forum',
                'list_forum',
                'list_forum_all'
        );

        if(is_array($arr_htm1) && ! empty($arr_htm1) ){
            $ws['banner_id'] = '266';
        }

        foreach ($arr_htm1 as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master1.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }
       
        $arr_htm2 = array(
                'info_q' , //留言回复
        );

        if(in_array('info_q', $arr_htm2)){
            $ws['banner_id'] = '261';
            $ws['nav'] = $mod->read_nav('269');
            $ws['fmenu'] = $mod->info_read_menu('261');
            $ws['left_menu'] = $mod->list_read_menu('0', '261');
        }

         foreach ($arr_htm2 as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master2.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }
        
        $arr_htm3 = array(
                'list_news' , 
        );

        if(in_array('list_news', $arr_htm3)){
            $ws['banner_id'] = '257';
            $ws['nav'] = $mod->read_nav('257');
            $ws['fmenu'] = $mod->info_read_menu('257');
            $ws['left_menu'] = $mod->list_read_menu('0', '257');
        }

        foreach ($arr_htm3 as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master2.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }

         $arr_htm4 = array(
                'info_resume'
        );

         if(in_array('info_resume', $arr_htm4)){
            $ws['banner_id'] = '259';
            $ws['nav'] = $mod->read_nav('259');
            $ws['fmenu'] = $mod->info_read_menu('259');
            $ws['left_menu'] = $mod->list_read_menu('0', '259');
        }

        foreach ($arr_htm4 as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master2.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }

       break;
}

echo 'mk_ok';
?>