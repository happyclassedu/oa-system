<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_once '../inc/common.php';

//$result_arr = $g_xdb->read_xtb_fields('#@__file');
//print_r($result_arr);
//echo '<br>';
//$result_arr = $g_xdb->read_xtb_fields('#@__file_x');
//print_r($result_arr);
echo 'lh_com'. '<br>';
$result_arr = $g_xdb->read_xtb_fields('#@__com');
print_r($result_arr);
echo '<br>';
echo 'lh_resume'. '<br>';
$result_arr = $g_xdb->read_xtb_fields('#@__resume');
print_r($result_arr);
echo '<br>';
echo 'lh_job'. '<br>';
$result_arr = $g_xdb->read_xtb_fields('#@__job');
print_r($result_arr);
echo '<br>';
?>
