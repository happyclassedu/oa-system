<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
$userid=chkstring(addslashes(trim($_POST['userid'])));	
$userpwd=chkstring(addslashes(trim($_POST['pwd'])));
//echo $userid;
//exit;
$sql="select * from userinfo where userid='".$userid."' and userpwd='".$userpwd."'";
	$rs=$obj->fetchrow($sql);
	if ($rs)
	{
						$username=$rs->username;
						$_SESSION["userdlname"]=$userid;
						$_SESSION["username"]=$username;

//$logstr="<script language='JavaScript'>";
//$logstr=$logstr."<!--";
//$logstr=$logstr."alert('成功登录！');";
//$logstr=$logstr."function showme() {";
//$logstr=$logstr."var myUrl='base.php';";
//$logstr=$logstr."window.open(myUrl,'aaa','status=yes,top=0,left=0,width='+(screen.availWidth-10)+',height='+(screen.availHeight-30)+',channelmode=no');";
//$logstr=$logstr."}";
////$logstr=$logstr."showme();";
//$logstr=$logstr."//-->";
//$logstr=$logstr."</script>";
//$logstr="<script language=javascript>alert('成功登录！');";
//$logstr=$logstr."window.open('base.php','_blank','status=yes,top=0,left=0,width='+(screen.availWidth-10)+',height='+(screen.availHeight-30)+',channelmode=no');";
//$logstr=$logstr."</script>";
//echo $logstr;
//echo "<script language=javascript>alert('成功登录！');showme();</script>";
						echo "<script language=javascript>document.location.href=('base.php');</script>";
//						exit;		
		}
		else
		{
						echo "<script language=javascript>alert('用户ID或密码错误，请重新登录！');document.location.href=('/index.php');</script>";
						exit;				
			}


?>