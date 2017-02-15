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

$ws['cfg'] = $mod->info_read_ws_cfg_base();

define('ws_mk', 1);  //网站是否进行生成。
$mod->ws_url_load();
$ws['mk'] = '';
$ws['act'] = $xid;

switch ($xid) {
    case 'header':
//        $ws['topbar_menu'] = $mod->list_read_menu('1');
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
        $arr_htm = array(
                'info_clogin',
                'info_cregister',
                'info_cregister_ok',
                'info_com',
                'info_com_detail',
                'info_com_pdw',
                'info_job',
                'list_job',
                'info_person',
                'info_plogin',
                'info_pregister',
                'info_pregister_ok',
                'info_p_resume',
                'info_q'
        );

        foreach ($arr_htm as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
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
    case 'list_job_all':
        $j = 1;
        for ($i=0; $i<$j; $i++) {
            $j++;
            include "www_list_job.php";
            if ('ok' == $list_mk) {
                break;
            }
        }
        break;
    case 'info_job_all':
        $arr_mod = $mod->list_read_job_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_info_job.php";
        }
        break;
    case 'info_com_all':
        $arr_mod = $mod->list_read_com_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            include "www_info_com.php";
        }
        break;
}

echo 'mk_ok';
?>