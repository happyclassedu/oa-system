<?php
session_start();
include_once("global.php");
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}
if(isset($_POST[xmf1])&&$_POST[xmf1]=="3qpinpai.com"){
	if(empty($_POST[checkcode])){
		echo "<script >alert('����д��֤��!');</script>";
	}elseif($_SESSION[checkcode]==$_POST[checkcode]){
		foreach($_POST as $val){
			fun_str_ck($val);
		}
		$sql="SELECT * FROM `{$dbpre}member` WHERE `userid`='$_POST[UserName]'";
		$query=$db->query($sql);
		$us=is_array($row=mysql_fetch_array($query));
		if($us){
			echo "<script >alert('��Ҫע����û���������!');</script>";
			exit;
		}
		$sql="SELECT * FROM `{$dbpre}member` WHERE `email`='$_POST[Email]'";
		$query=$db->query($sql);
		$us=is_array($row=mysql_fetch_array($query));
		if($us){
			echo "<script >alert('����д�����伺ע���!');</script>";
			exit;
		}
		$joinip=GetIP();
		$pwd=md5($_POST[PassWord].'elinstudio');
		$jointime=mktime();
		$sql="INSERT INTO `{$dbpre}member`(
`id`,
`userid`,
`userpwd`,
`email`,
`joinip`,
`jointime`
)
VALUES(
NULL,'$_POST[UserName]', '".$pwd."','$_POST[Email]', '".$joinip."','".$jointime."'
)";
	$db->query($sql);
	$str_acive=md5($jointime.$_POST[UserName]);
	$id=mysql_insert_id();
	setcookie("fj_usersid",$id);
    setcookie("fj_usershell",md5($_POST[UserName].$pwd."XMF1"));
	echo "<script>alert('ע��ɹ�');parent.location.href='register.php';</script>";
	require_once("include/class.phpmailer.php");
	smtp_mail ($_POST[Email], "����Ʒ�����˻������ʼ�", "������Ӽ�������˺� register.php?active=ok&str=$str_acive&userid=$id", 'http://www.3qpinpai.com/',$_POST[UserName]);
	}else{
		echo "<script defer>alert('��֤��������������롣');</script>";
	}
}else{
	if(isset($_COOKIE["fj_usersid"])&&!empty($_COOKIE["fj_usershell"])&&!empty($_COOKIE["fj_usersid"])){
		$sql="SELECT * FROM `{$dbpre}member` WHERE `id`='".$_COOKIE["fj_usersid"]."'";
		$query=$db->query($sql);
		$us=is_array($row=mysql_fetch_array($query));
    	$isuser=$us ? $_COOKIE["fj_usershell"]==md5($row[userid].$row[userpwd]."XMF1"):FALSE;
		if($isuser){
			if(empty($row[leveup_time])){
				if(isset($_GET[active])&&$_GET[active]=="ok"&&!empty($_GET[userid])){
				foreach($_GET as $val){
			    fun_str_ck($val);
		        }
				$sql="SELECT * FROM `{$dbpre}member` WHERE `id`='$_GET[userid]'";
				$query=mysql_query($sql);
				$us=is_array($row=mysql_fetch_array($query));
				$isuser=$us ? $_GET["str"]==md5($row[jointime].$row[userid]):FALSE;
				if($isuser){
					$sql="UPDATE `{$dbpre}member` SET `leveup_time` = '1' WHERE `id` ='$_GET[userid]' LIMIT 1 ;";
					mysql_query($sql);
					setcookie("fj_usersid",$row[id]);
    				setcookie("fj_usershell",md5($row[userid].$row[userpwd]."XMF1"));
					$flag="last";
				}
       		}else{
       			$flag="active";
				$user=$row[userid];
				$email=$row[email];

       		}


			}else{

				ShowMsg("����˺ż�����벻Ҫ�ظ�ע�ᣡ",'user_center.php');
			}
		}else{
			 	setcookie("fj_usersid","");
    			setcookie("fj_usershell","");
				ShowMsg("����˺Ŵ��������������Ա��ϵ��",'register.php');

		}

	}else{
		if(isset($_GET[active])&&$_GET[active]=="ok"&&!empty($_GET[userid])){
				foreach($_GET as $val){
			    fun_str_ck($val);
		        }
				$sql="SELECT * FROM `{$dbpre}member` WHERE `id`='$_GET[userid]'";
				$query=mysql_query($sql);
				$us=is_array($row=mysql_fetch_array($query));
				$isuser=$us ? $_GET["str"]==md5($row[jointime].$row[userid]):FALSE;
				if($isuser){
					$sql="UPDATE `{$dbpre}member` SET `leveup_time` = '1' WHERE `id` ='$_GET[userid]' LIMIT 1 ;";
					mysql_query($sql);
					setcookie("fj_usersid",$row[id]);
    				setcookie("fj_usershell",md5($row[userid].$row[userpwd]."XMF1"));
					$flag="last";
				}
       		}

	}

$licence= openfile("licence.txt");


elin_smarty_assign(
array(
'flag',
'user',
'email',
'licence',
),
array(
$flag,
$user,
$email,
$licence,
)
);

	$smarty->display("register.htm");
}
function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
function openfile($url)
{
  $str="";
  $i=0;
  $f=@file($url);
  while($i<count($f)){
    $str=$str.$f[$i]."<br>";
	$i=$i+1;
  }
  return $str;
}



?>