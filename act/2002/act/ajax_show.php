<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../inc/common.php';
$result_arr = $g_xdb->read_all('zph_com4', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,10');
print_r($result_arr);
?>
