<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../inc/common.php';
$str = $_GET['str'];
$num = $_GET['num'];
echo $str.'</br>';
echo '表zhp_com4最后10个数据按顺序排列：</br>';
$result_arr = $g_xdb->read_all('zph_com4', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,'.$num);
sort($result_arr);
for($i = 0 ; $i <= count($result_arr) ; $i++) {
    echo $result_arr[$i][job1]."  ";
}
echo '你的当前IP：</br>';
echo i_read_ip().'</br>';
echo 'curl测试：</br>';
echo i_read_http('http://192.168.4.14/sys_act_6/2002/act/list.php');
?>
