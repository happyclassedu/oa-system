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
		echo "<font color='green'>���˺ſ���ʹ��</font>";
	}else{
		echo "<font color='red'>���˺ż�������������¼!</font>";
	}
	break;
	case email:
	fun_str_ck($_POST[email]);
	$sql="SELECT * FROM `{$dbpre}member` WHERE `email`='$_POST[email]'";
	$query=mysql_query($sql);
	$user=mysql_num_rows($query);
	if(empty($user)){
		echo "<font color='green'>���������ʹ��</font>";
	}else{
		echo "<font color='red'>�����伺�ڱ�վע��������!</font>";
	}
	break;
}
?>
