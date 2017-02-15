<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_POST['id']));

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
//$sqllog="insert into linkname(userid,clew,name,sex,zhiwu,clientid,clientname,department,email,hometel,officetel,mobile,fax,birthday,qq,skypeid,assistant,assistanttel,address,postcode,remark,addtime,username) values ('$userid','$xiansuo','$xingming','$sex','$zhiwu','$clientid','$clientname','$bumen','$email','$hometel','$officetel','$mobile','$fax','$birthday','$qq','$skypeid','$zhuli','$zhulitel','$address','$postcode','$remark','$zcdate','$username')";

$sqllog="update linkname set clew='".$xiansuo."'".","."name='".$xingming."'".","."sex='".$sex."'".","."zhiwu='".$zhiwu."'".","."clientid='".$clientid."'".","."clientname='".$clientname."'".","."department='".$bumen."'".","."email='".$email."'".","."hometel='".$hometel."'".","."officetel='".$officetel."'".","."mobile='".$mobile."'".","."fax='".$fax."'".","."birthday='".$birthday."'".","."qq='".$qq."'".","."skypeid='".$skypeid."'".","."assistant='".$zhuli."'".","."assistanttel='".$zhulitel."'".","."address='".$address."'".","."postcode='".$postcode."'".","."remark='".$remark."'".","."username='".$username."' where id='".$id."'";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('联系人信息成功修改!');document.location.href=('linkman_manage_list.php');</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('联系人信息修改失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>