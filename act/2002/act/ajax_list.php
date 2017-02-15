<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_once '../inc/common.php';

$arr_num = array();
$arr_num = $_POST['arr'];
$arr_num = i_json2php($arr_num);
//print_r($arr_num);
$g_xdb->insert_all('zph_com4', 'job1', $arr_num);

$arr_rsort = array();
$arr_data = $g_xdb->read_all('zph_com4', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,10');
for($i = 0 ; $i < count($arr_data) ; $i++) {
    $arr_rsort[$i] = $arr_data[$i][job1];
}
$result_arr = $arr_rsort;
rsort($result_arr);
$result_arr = i_php2json($result_arr);
print_r($result_arr);
//$result_arr = i_json2php($result_arr);
//print_r($result_arr);
?>
