<?php
/* 
 * 文件名称：ajax_list_test.php
 * 功能描述：测试文件。
 * 代码作者：qianbaowei
 * 当前版本：V1.0
 * 创建日期：2010-05-24
 * 修改日期：2010-05-24
*/
include_once '../inc/common.php';

$g_arr_num = array ();
$g_arr_num = $_POST('sort_txt_num1');
$result_arr = $g_xdb->read_all('zph_com4', 'sort_info', $g_arr_num);

$arr_rsort = array();
$arr_data = $g_xdb->read_all('zph_com4', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,10');
for($i = 0 ; $i < count($arr_data) ; $i++) {
    $arr_rsort[$i] = $arr_data[$i][job1];
}
$result_arr = $arr_rsort;
rsort($result_arr);
$result_arr = i_php2json($result_arr);
print_r($result_arr);
?>
