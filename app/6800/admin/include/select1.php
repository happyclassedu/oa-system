<?php
header('Content-Type:text/html;charset=GB2312');
include_once('../admin_global.php');
$id = $_GET['sid'];
fun_str_ck($id);
if(!empty($id)){
$query = "select * from `xm_industry` where `pid` = '".$id."'";
$result = $db->query($query);
while($row = $db->fetch_array($result)){
    echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
}

}
?>