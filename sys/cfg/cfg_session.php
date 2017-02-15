<?php
/*
 * 文件名称：config_session.php
 * 功能描述：Session的保存路径设置及初始化。
 * 代码作者：Mirrado Sun
 * 创建日期：2008-12-14
 * 修改日期：2008-04-16
 * 当前版本：V1.0
 */

$session_save_path = g_tmp.'sessions/'.$session_name;  //session 的 存放目录

i_dir_mk($session_save_path);

if (is_writeable($session_save_path) && is_readable($session_save_path)) {
    session_save_path($session_save_path);
}
session_start();
?>