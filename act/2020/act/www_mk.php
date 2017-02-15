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
    case 'link0':
        $ws['link0']['list'] = $mod->list_read_link('177', '15');
        i_tpl2www_part();
        break;
    case 'link1':
        $ws['link1_0']['list'] = $mod->list_read_link('384', '10');
        $ws['link1_1']['list'] = $mod->list_read_link('372', '10');
        i_tpl2www_part();
        break;
    case 'index':
        include_once 'www_index.php';
        break;
    case 'lefter0' :
        $ws['lefter0_news_1'] = $mod->info_read_menu('195');
        $ws['lefter0_news'] = $mod->list_read_news('195', '8');
        $ws['lefter0_link'] = $mod->list_read_link('384', '5');
        i_tpl2www_part();
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
        'info_com_account',
                'info_com_adsearch',
                'info_com_basic',
                'info_com_cert',
                'info_com_clsearch',
                'info_com_contact',
                'info_com_interview',
                'info_com_login',
                'info_com_logo',
                'info_com_look',
                'info_com_mailtpl',
                'info_com_password',
                'info_com_register',
                'info_com_register_ok',
                'info_com_search',
                'info_com_usercenter',
                'info_com_usercenter',
                'info_com_view',
                'info_job',
                'info_job_eavoritd',
                'info_job_look',
                'info_job_report',
                'info_job_view',
                'info_person_account',
                'info_person_adsearch',
                'info_person_basic',
                'info_person_clsearch',
                'info_person_email',
                'info_person_login',
                'info_person_password',
                'info_person_register',
                'info_person_usercenter',
                'info_person_view',
                'info_register',
                'info_resume',
                'info_resume_appraise',
                'info_resume_basic',
                'info_resume_cert',
                'info_resume_create',
                'info_resume_educate',
                'info_resume_home',
                'info_resume_interview',
                'info_resume_item',
                'info_resume_itskill',
                'info_resume_language',
                'info_resume_letter',
                'info_resume_look',
                'info_resume_other',
                'info_resume_skill',
                'info_resume_tointerview',
                'info_resume_train',
                'info_resume_wish',
                'info_resume_work',
                'list_com_search',
                'list_job',
                'list_job_applist',
                'list_job_eavoritd',
                'list_job_fav',
                'list_job_invite',
                'list_person_job',
                'list_person_search',
                'list_resume',
                'list_resume_accept',
                'list_resume_database',
                'list_resume_fav',
                'list_resume_recycle'
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