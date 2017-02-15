<?php
/**
 * 文件名称：common.php
 * 功能描述：公共引用文件。
 * 代码作者：孙振强
 * 当前版本：V2.0
 * 创建日期：2009-12-13
 * 修改日期：2010-05-20
 */

include_once 'cfg.php';
include_once '../../1001/inc/common.php';
include_once '../../1000/inc/www_func.php';
include_once 'www_func.php';

$tmp = $_SERVER["SCRIPT_FILENAME"];
preg_match('/act(.*?)' . app_code . '/ms', $tmp, $tmp);
$tmp = str_replace('/', '', $tmp[1]);
define('m_app', g_dir . 'app' . $tmp . '/' . app_code . '/');
$ws['mk'] = '_act';
?>