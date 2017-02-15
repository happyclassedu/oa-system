<?php
/**
 * 文件名称：func.php
 * 功能描述：函数程序。
 * 代码作者：孙振强
 * 当前版本：V2.0
 * 创建日期：2009-12-13
 * 修改日期：2010-05-11
 */

include_once '../mod/mod_log.php';
$mod_log = new mod_log();

/**
 * m_log_add : .
 * @return $arr : 是否成功.
 */
function m_log_add($arr) {
    global $mod_log;
    return $mod_log->info_add($arr);
}
?>