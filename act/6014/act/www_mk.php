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

$ws['cfg'] = $mod->info_read_ws_cfg_base(); //读取网站配置信息

define('ws_mk', 1);  //网站是否进行生成。
$ws['mk'] = '';
$mod->ws_url_load();

switch ($xid) {
    case 'header':
        $ws['header_menu'] = $mod->list_read_menu('0','1503');
        i_tpl2www_part();
        break;
    case 'footer':
        i_tpl2www_part();
        break;
    case 'lefter':
        $ws['lefter_news0'] =  $mod->list_read_news('425', '6'); //最新视频
        $ws['lefter_news1'] =  $mod->list_read_news('425', '7', '0', '1'); //热点视频
        i_tpl2www_part();
        break;
    case 'lefter0' :
        $ws['left_menu'] =  $mod->list_read_menu('0', '475');
        i_tpl2www_part();
        break;
    case 'banner1':
        //党费管理
        $arr = $mod->list_read_link('429', '1');
        $ws['banner1'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'banner2':
        //党员管理
        $arr = $mod->list_read_link('461', '1');
        $ws['banner2'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'banner3':
        //网上会议
        $arr = $mod->list_read_link('459', '1');
        $ws['banner3'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'banner4':
        //党员之声
        $arr = $mod->list_read_link('476', '1');
        $ws['banner4'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'banner5':
        //心理驿站
        $arr = $mod->list_read_link('467', '1');
        $ws['banner5'] = $arr[0];
        i_tpl2www_part();
        break;
    case 'link0':
//        $ws['link']['info'] = $mod->info_read_menu_base(60);
        $ws['link']['list'] = $mod->list_read_link('427', '4');
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
    case 'list_qa_all':
        $arr_mod = $mod->list_read_link_mod('6');
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
    case 'info_all':
        $mod->mk_info_all();
        break;
    case 'info':
        $xid = $_GET['id'];
        $mod->mk_info();
        break;
    case 'ws_url_bat':
        $mod->ws_url_bat();
        break;
    case 'htm2www':
        $arr_htm1 = array(
                'info_q',
                'info_register',
                'info_thought',
                'list_thought',
                'login'
        );
        foreach ($arr_htm1 as $val) {
            $ws['act'] = $val;
            $ws['tpl'] = '../htm/' . $val. '.htm';
            $tpl = 'master1.htm';  //定义页面模板路径
            $mkf = m_app . 'www/' . $val . '.htm';  //定义生成文件路径
            i_tpl2www(0, 1);
        }

        $arr_htm2 = array(
                'info_order',
                'list_order',
                'confirm_order'
        );
        foreach ($arr_htm2 as $val) {
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