<?php
/**
 * 文件名称：test.php
 * 功能描述：测试文件。
 * 代码作者：孙振强
 * 当前版本：V1.0
 * 创建日期：2010-05-20
 * 修改日期：2010-05-20
 */

include_once '../inc/common.php';

$result_arr = $g_xdb->read_all('zph_com5', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,10');
$result_arr = i_php2json($result_arr);
//print_r($result_arr);

$tmp = $_GET['a'];
$result_arr = $_POST['arr'];
$result_arr = i_json2php($result_arr);
$result_arr = i_php2json($result_arr);
print_r($result_arr);
?>