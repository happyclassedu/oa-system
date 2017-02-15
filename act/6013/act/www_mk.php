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
        $ws['header_menu'] = $mod->list_read_menu('0');
        i_tpl2www_part();
        break;
    case 'footer':
        $ws['footer_menu'] = $mod->list_read_menu('2');
        i_tpl2www_part();
        break;
    case 'lefter':
        $ws['left_news1_m'] = $mod->info_read_menu('412');
        $ws['left_news1'] = $mod->list_read_news('412', '6');
        $ws['left_news2_m'] = $mod->info_read_menu('402');
        $ws['left_news2'] = $mod->list_read_news('402', '6');
        i_tpl2www_part();
        break;
    case 'banner0':
        $arr = $mod->list_read_link('414', '1');
        $ws['banner0'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'link0':
// 1548 图片链接-首页顶部1区即服务指南的图片链接
        $ws['link0']['list'] = $mod->list_read_link('1548', '12');
        i_tpl2www_part();
        break;
    case 'link1':
// 408 图片链接-首页中部1区
        $ws['link1']['list'] = $mod->list_read_link('408', '12');
        i_tpl2www_part();
        break;
    case 'link2':
//415 友情链接-文字
        $ws['link2']['list'] = $mod->list_read_link('415', '18');
        i_tpl2www_part();
        break;
    case 'link3':
//1532 友情链接-图片
        $ws['link3']['list'] = $mod->list_read_link('1532', '12');
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
    case 'info_resume':
        $xid = $_GET['id'];
        include "www_info_resume.php";
        break;
    case 'info_resume_all':
        $arr_mod = $mod->list_read_resume_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_info_resume.php";
        }
        break;
    case 'list_resume_all':
        $j = 1;
        for ($i=0; $i<$j; $i++) {
            $j++;
            include "www_list_resume.php";
            if ('ok' == $list_mk) {
                break;
            }
        }
        break;
    case 'ws_url_bat':
        $mod->ws_url_bat();
        break;
    case 'htm2www':
        $arr_htm = array(
                'login',
                'info_q',
                'info_pregister',
                'ucenter_p',
                'info_p_resume',
                'info_cregister',
                'ucenter_c',
                'info_c_detail',
                'info_job',
                'list_job'
        );

        foreach ($arr_htm as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master1.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }

         $arr_htm1 = array(
                'list_search',
        );

         foreach ($arr_htm1 as $val) {
             $ws['act'] = $val;
             $ws['tpl'] = '../htm/' . $val. '.htm';
             $tpl = 'master2.htm';  //定义页面模板路径
             $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
             i_tpl2www(0, 1);
         }
}

echo 'mk_ok';
?>