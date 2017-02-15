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
//delete
/*echo '<hr>';
$result_arr = $g_xdb->delete('zph_com4', 'id<>"0"');
print_r($result_arr);
*/
//update, select, insert
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('zph_com', '*', 'id<>"0" LIMIT 0,10');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('zph_com4', '*', 'id<>"0" LIMIT 0,10');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('zph_com4', '*', 'id<>"0" LIMIT 0,10');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->insert('zph_com4', 'zhanwei, com_name', '"123", "456"');
//print_r($result_arr);
//echo '<hr>';
//$arr = array(1, 10, 12, 8, 9, 50, 70, 90, 75, 80);
//$result_arr = $g_xdb->insert_all('zph_com4', 'job1',$arr);
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_xtb_fields('lh_plog');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('lh_medi_plog', '*', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('lh_zpw_r', '*', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>';
////$result_arr = $g_xdb->read_all('lh_zpw_r', '*', 'id<>"0" LIMIT 0,10');
////print_r($result_arr);
////$int_row_num = $g_xdb->read_num('zph_com4', 'id<>"0"');
////echo 'zhp_com4的数据数：'.$int_row_num;
////echo i_act_time();
//$result_arr = $g_xdb->read_all('lh_zpw_r', '*', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>11';
//$result_arr = $g_xdb->read_all('lh_zpw_r', '*',  ' p_id="1" ');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('#@__zpw_r AS x ,#@__zpw_x AS y ', 'x.*,y.*', 'x.drwx=0 AND y.drwx=0  AND x.id=y.r_id AND y.p_id="1"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->update('lh_zpw_r', 'name="gg"', 'id="2"');
//print_r($result_arr);
//echo '<hr>11';
//$result_arr = $g_xdb->read_one('lh_zpw_r', '*', 'id="4" AND drwx=4');
//print_r($result_arr);
//echo '<hr>11';
//$result_arr = $g_xdb->delete('lh_zpw_r', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->delete('lh_zpw_x', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->delete('lh_zpw_x', 'id<>"0"');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('lh_zpw_j  AS x
//            LEFT JOIN (SELECT * FROM (SELECT * FROM lh_zpw_c WHERE drwx=0 ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id= x.cid', ' x.*, y.* ',  '  x.drwx=0 ');
//print_r($result_arr);
//echo '<hr>';
//$result_arr = $g_xdb->read_all('lh_zpw_j  AS x', ' * ',  ' x.id="4" ');
//print_r($result_arr);
//echo '<hr>-----------';

//$result_arr = $g_xdb->read_all('lh_zpw_x  AS x', ' * ',  '  x.drwx=0 AND x.i_type="c_interview" ');
//print_r($result_arr);
//echo '<hr>';

//$result_arr = $g_xdb->read_all('lh_zpw_r_i', ' * ',  'drwx=0 AND r_id="49" AND open="1"');
//print_r($result_arr);
//echo '<hr>';

//$result_arr = $g_xdb->read_all('lh_zpw_r  AS x', ' * ',  '  x.drwx=0');
//print_r($result_arr);
//echo '<hr>';

?>