<?php
header('Content-Type:text/html;charset=GB2312');
include_once('../admin_global.php');
$id = $_GET['sid'];
fun_str_ck($id);
$query = "select * from {$dbpre}class_county where `pid` = '".$id."'";
$result = $db->query($query);
while($row = $db->fetch_array($result)){
    echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
}
?>