<?php
/**
 * 文件名称：common.php
 * 功能描述：公共引用文件。
 * 代码作者：孙振强
 * 当前版本：V1.0
 * 创建日期：2009-12-13
 * 修改日期：2009-12-13
 */
@include_once '../../../sys/cfg/cfg_sys.php';

if ('g_lib' == g_lib) {
    echo 'Sorry : include sys config error.';
    exit;
} else {
    include_once g_lib . 'lib_func.php';
    include_once 'cfg.php';
    include_once 'func.php';
    $g_xdb = i_xdo_create(g_app_xdb);
    i_session_create(g_app_session);
    $str = @$_SESSION["MyUID"];
    if ($str) {
        define('u_id',   @$_SESSION["MyUID"]);  //用户--id
        define('u_name', @$_SESSION["MyName"]);  //用户--姓名
        define('u_sex',  @$_SESSION["u_sex"]);  //用户--性别
        define('u_tid',  @$_SESSION["MyTID"]);  //用户--组id
        define('u_post_id', @$_SESSION["post_id"]);  //用户--职务id
    } else {
        define('u_id',   @$_SESSION["u_id"]);  //用户--id
        define('u_name', @$_SESSION["u_name"]);  //用户--姓名
        define('u_sex',  @$_SESSION["u_sex"]);  //用户--性别
        define('ws_id',  @$_SESSION["ws_id"]);  //用户--性别
    }
}
?>