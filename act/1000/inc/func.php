<?php
/*
 * 文件名称：function_basic.php
 * 功能描述：一些基本的、常用的函数
 * 代码作者：孙振强
 * 创建时间：2008-12-13
 * 修改日期：2008-12-14
 * 当前版本：V2.0
*/

/**
 *  初始化系统
 */
function i_mod_base_info() {
    include_once '../../1000/mod/mod_base_info.php';
}

/**
 *  初始化网站基本模型
 */
function i_mod_base_ws() {
    include_once '../../1000/mod/mod_base_ws.php';
}

/**
 *  获取当前操作网站的ws_id
 */
function i_ws_id_get() {
    if ($_SESSION['ws_id']) {
        return $_SESSION['ws_id'];
    } else if ($_GET['ws_id']) {
        return $_GET['ws_id'];
    } else {
        return  '-1';
    }
}
?>