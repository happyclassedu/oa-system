<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$userid=addslashes(trim($_POST['userid']));
$gujje=addslashes(trim($_POST['gujje']));
$chancename=chkstring(addslashes(trim($_POST['chancename'])));
$chengjrq=chkstring(addslashes(trim($_POST['chengjrq'])));
$clientname=chkstring(addslashes(trim($_POST['clientname'])));
$clientid=chkstring(addslashes(trim($_POST['clientid'])));

$jied=chkstring(addslashes(trim($_POST['jied'])));	
$linkname=chkstring(addslashes(trim($_POST['linkname'])));
$linknameid=chkstring(addslashes(trim($_POST['linknameid'])));
$possibility=chkstring(addslashes(trim($_POST['possibility'])));
$next=chkstring(addslashes(trim($_POST['next'])));
$qiwsy=chkstring(addslashes(trim($_POST['qiwsy'])));
$xiansuo=chkstring(addslashes(trim($_POST['xiansuo'])));
$shic=chkstring(addslashes(trim($_POST['shic'])));

$shicid=chkstring(addslashes(trim($_POST['shicid'])));
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));


$username=$_SESSION["username"];

$zcdate=date('Y-m-d H:i:s', time());	
$sqllog="insert into chance(userid,itemmoney,itemname,intendingday,linkname,linknameid,phase,clientnameid,clientname,possibility,nextcontent,expectationmoney,clew,shic,shicid,remark,addtime,username) values ('$userid','$gujje','$chancename','$chengjrq','$linkname','$linknameid','$jied','$clientid','$clientname','$possibility','$next','$qiwsy','$xiansuo','$shic','$shicid','$remark','$zcdate','$username')";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('商机成功建立!');history.go(-1);</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('商机建立失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>