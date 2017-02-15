<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
$userid=chkstring(strtolower(addslashes(trim($_POST['userid']))));	
$userpwd=chkstring(strtolower(addslashes(trim($_POST['pwd']))));
//echo $userid;
//exit;
$sql="select * from userinfo where userid='".$userid."' and userpwd='".$userpwd."'";
	$rs=$obj->fetchrow($sql);
	if ($rs)
	{
						$username=$rs->username;
						$_SESSION["userdlname"]=$userid;
						$_SESSION["username"]=$username;
						$_SESSION["isfuze"]=trim($rs->fuze);
						$_SESSION["departmentid"]=trim($rs->departmentid);

 
						echo "<script language=javascript>document.location.href=('desktop_manage.php');</script>";
//						exit;		
		}
		else
		{
						echo "<script language=javascript>alert('用户ID或密码错误，请重新登录！');document.location.href=('../index.php');</script>";
						exit;				
			}


?>