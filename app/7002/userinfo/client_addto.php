<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$userid=addslashes(trim($_POST['userid']));
$dengji=addslashes(trim($_POST['dengji']));
$clientname=chkstring(addslashes(trim($_POST['clientname'])));
$kehlx=chkstring(addslashes(trim($_POST['kehlx'])));
$suoyq=chkstring(addslashes(trim($_POST['suoyq'])));

$hangy=chkstring(addslashes(trim($_POST['hangy'])));	
$sheng=chkstring(addslashes(trim($_POST['sheng'])));
$chinacomcity=chkstring(addslashes(trim($_POST['chinacomcity'])));
$telcountrycode=chkstring(addslashes(trim($_POST['telcountrycode'])));
$telareacode=chkstring(addslashes(trim($_POST['telareacode'])));
$tel=chkstring(addslashes(trim($_POST['tel'])));
$faxcountrycode=chkstring(addslashes(trim($_POST['faxcountrycode'])));
$faxareacode=chkstring(addslashes(trim($_POST['faxareacode'])));
$fax=chkstring(addslashes(trim($_POST['fax'])));

$yuangrs=chkstring(addslashes(trim($_POST['yuangrs'])));
$web=chkstring(addslashes(trim($_POST['web'])));
$yye=chkstring(addslashes(trim($_POST['yye'])));
$address=chkstring(addslashes(trim($_POST['address'])));

$postcode=chkstring(addslashes(trim($_POST['postcode'])));
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));


$username=$_SESSION["username"];

$zcdate=date('Y-m-d H:i:s', time());	
$sqllog="insert into client(userid,username,clientname,clientlevel,address,web,type,calling,suoyq,ygrs,yye,sheng,chinacomcity,telcountrycode,telareacode,tel,faxcountrycode,faxareacode,fax,remark,addtime,postcode) values ('$userid','$username','$clientname','$dengji','$address','$web','$kehlx','$hangy','$suoyq','$yuangrs','$yye','$sheng','$chinacomcity','$telcountrycode','$telareacode','$tel','$faxcountrycode','$faxareacode','$fax','$remark','$zcdate','$postcode')";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('客户信息成功建立!');history.go(-1);</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('入库失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>