<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$userid=chkstring(addslashes(trim($_POST['userid'])));
$old_pwd=chkstring(addslashes(trim($_POST['old_pwd'])));
$userpwd=chkstring(addslashes(trim($_POST['userpwd'])));
$userpwdconfirm=chkstring(addslashes(trim($_POST['userpwdconfirm'])));
$userid=$_SESSION["userdlname"];
	//检查部门中负责人数
	$sqlbm="select * from userinfo where userid='".$userid."'";
	$rsbm=$obj->fetchrow($sqlbm);
	$dbuserpwd=trim($rsbm->userpwd);
//	echo $allid;
//	exit;
		if($dbuserpwd<>$old_pwd)
			{
					echo "<script language=javascript>alert('原密码不对，请返回重新输入！');history.go(-1)</script>";
					exit;
			}


$sql="update userinfo set userpwd='".$userpwd."' where userid='".$userid."'";
//echo $sql;
$result=$obj->exec($sql);
	if($result)
		{
			echo "<script language=javascript>alert('密码修改成功!');document.location.href=('user_mody_pwd_list.php');</script>";
			exit;
			}
		else
		{
			echo "<script language=javascript>alert('密码修改失败，请与系统管理员联系!');document.location.href=('user_mody_pwd_list.php');</script>";
			exit;
			}

?>