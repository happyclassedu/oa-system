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

global $mod;

if (!$mod) {
    include_once '../mod/mod_ws.php';
    $mod = new mod_ws();
    $ws['cfg'] = $mod->info_read_ws_cfg_base();
}

if (!$ws['lefter_news']) {
    $ws['lefter_news'] = $mod->read_lefter_news('52', '5');
    $ws['lefter_qyzp'] = $mod->list_read_news('26', '5');
    $ws['lefter_bgxz'] = $mod->list_read_news('30', '5');
}
?>