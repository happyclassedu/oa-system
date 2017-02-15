<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$userid=addslashes(trim($_POST['userid']));
$activitytype=addslashes(trim($_POST['activitytype']));
$rctitle=chkstring(addslashes(trim($_POST['rctitle'])));
$clientname=chkstring(addslashes(trim($_POST['clientname'])));
$clientid=chkstring(addslashes(trim($_POST['clientid'])));
$linkname=chkstring(addslashes(trim($_POST['linkname'])));
$linknameid=chkstring(addslashes(trim($_POST['linknameid'])));

$eventstatus=chkstring(addslashes(trim($_POST['eventstatus'])));
$jhtime=chkstring(addslashes(trim($_POST['jhtime'])));
$jhm=chkstring(addslashes(trim($_POST['jhm'])));
$str_address=chkstring(addslashes(trim($_POST['str_address'])));
 
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));

$username=$_SESSION["username"];
$Submit1=chkstring(addslashes(trim($_POST['submit'])));
//$Submit2=chkstring(addslashes(trim($_POST['Submit2'])));
$zcdate=date('Y-m-d H:i:s', time());	
if ($Submit1=="-保存并新建-")
$stradd="document.location.href=('calendar_add_list.php');";
else
$stradd="document.location.href=('calendar_manage_list.php');";
$sqllog="insert into calendar(userid,activitytype,rctitle,clientname,clientid,linkname,linknameid,eventstatus,jhtime,jhm,str_address,remark,username,fbdate) values ('$userid','$activitytype','$rctitle','$clientname','$clientid','$linkname','$linknameid','$eventstatus','$jhtime','$jhm','$str_address','$remark','$username','$zcdate')";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('日程成功建立!');".$stradd."</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('日程建立失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>