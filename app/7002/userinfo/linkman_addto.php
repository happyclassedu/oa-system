<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$userid=addslashes(trim($_POST['userid']));
$xiansuo=addslashes(trim($_POST['xiansuo']));
$xingming=chkstring(addslashes(trim($_POST['xingming'])));
$sex=chkstring(addslashes(trim($_POST['sex'])));
$zhiwu=chkstring(addslashes(trim($_POST['zhiwu'])));

$clientid=chkstring(addslashes(trim($_POST['clientid'])));
$clientname=chkstring(addslashes(trim($_POST['clientname'])));	
$bumen=chkstring(addslashes(trim($_POST['bumen'])));
$email=chkstring(addslashes(trim($_POST['email'])));
$hometel=chkstring(addslashes(trim($_POST['hometel'])));
$officetel=chkstring(addslashes(trim($_POST['officetel'])));
$mobile=chkstring(addslashes(trim($_POST['mobile'])));
$fax=chkstring(addslashes(trim($_POST['fax'])));
$birthday=chkstring(addslashes(trim($_POST['birthday'])));
$qq=chkstring(addslashes(trim($_POST['qq'])));

$skypeid=chkstring(addslashes(trim($_POST['skypeid'])));
$zhuli=chkstring(addslashes(trim($_POST['zhuli'])));
$zhulitel=chkstring(addslashes(trim($_POST['zhulitel'])));
$address=chkstring(addslashes(trim($_POST['address'])));

$postcode=chkstring(addslashes(trim($_POST['postcode'])));
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));


$username=$_SESSION["username"];

$zcdate=date('Y-m-d H:i:s', time());	
$sqllog="insert into linkname(userid,clew,name,sex,zhiwu,clientid,clientname,department,email,hometel,officetel,mobile,fax,birthday,qq,skypeid,assistant,assistanttel,address,postcode,remark,addtime,username) values ('$userid','$xiansuo','$xingming','$sex','$zhiwu','$clientid','$clientname','$bumen','$email','$hometel','$officetel','$mobile','$fax','$birthday','$qq','$skypeid','$zhuli','$zhulitel','$address','$postcode','$remark','$zcdate','$username')";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('联系人信息成功建立!');history.go(-1);</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('联系人信息建立失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>