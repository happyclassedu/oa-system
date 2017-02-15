<?php
header('Content-Type:text/html;charset=GB2312');
include_once("global.php");
$chkname=$_POST[Action];
switch ($chkname){
	case member:
	fun_str_ck($_POST[User]);
	$sql="SELECT * FROM `{$dbpre}member` WHERE `userid`='$_POST[User]'";
	$query=mysql_query($sql);
	$user=mysql_num_rows($query);
	if(empty($user)){
		echo "<font color='green'>此账号可以使用</font>";
	}else{
		echo "<font color='red'>此账号己存在请点这里登录!</font>";
	}
	break;
	case email:
	fun_str_ck($_POST[email]);
	$sql="SELECT * FROM `{$dbpre}member` WHERE `email`='$_POST[email]'";
	$query=mysql_query($sql);
	$user=mysql_num_rows($query);
	if(empty($user)){
		echo "<font color='green'>此邮箱可以使用</font>";
	}else{
		echo "<font color='red'>此邮箱己在本站注册过请更换!</font>";
	}
	break;
}
?>
