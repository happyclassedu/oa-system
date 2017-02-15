<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../inc/common.php';

$arr = array(1, 10, 12, 8, 9, 50, 70, 90, 75, 80);
$int_num = count($arr);
 function  i_get_sort($arr) {
           $str_sort = '';
           sort($arr);
           foreach($arr as $key => $val) {
                $str_sort = $str_sort. 'arr['.$key.' ]= '. $val . '    ';
           }
           return $str_sort;
        }
     $str_show = '由小到大显示：' . i_get_sort($arr);
?>
<html>
  <head>
  <title>排序</title>
  </head>

  <body>
原顺序：
    <?php
    $str = '';
    foreach($arr as $key => $val) {
            $str = $str. 'arr['.$key.' ]= '. $val . '    ';
       }
     echo $str . '</br>';
    ?>
表zhp_com4最后10个数据：<br>
<?php
    $result_arr = $g_xdb->read_all('zph_com4', '*', 'id<>"0" ORDER BY id DESC LIMIT 0,'.$int_num);
for($i = 0 ; $i <= count($result_arr) ; $i++) {
    echo $result_arr[$i][job1]."  ";
}
?>
<form action="show.php?str=<?php echo $str_show;?>&num=<?php echo $int_num;?>" enctype="multipart/form-data"  method="post">
   <input type="submit" value="顺序" />
</form>
  </body>
</html>
