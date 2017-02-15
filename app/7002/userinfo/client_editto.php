<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$id=addslashes(trim($_POST['id']));
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
//$sqllog="insert into client(userid,username,clientname,clientlevel,address,web,type,calling,suoyq,ygrs,yye,sheng,chinacomcity,telcountrycode,telareacode,tel,faxcountrycode,faxareacode,fax,remark,addtime,postcode) values ('$userid','$username','$clientname','$dengji','$address','$web','$kehlx','$hangy','$suoyq','$yuangrs','$yye','$sheng','$chinacomcity','$telcountrycode','$telareacode','$tel','$faxcountrycode','$faxareacode','$fax','$remark','$zcdate','$postcode')";
$sqllog="update client set userid='".$userid."'".","."username='".$username."'".","."clientname='".$clientname."'".","."clientlevel='".$dengji."'".","."address='".$address."'".","."web='".$web."'".","."type='".$kehlx."'".","."calling='".$hangy."'".","."suoyq='".$suoyq."'".","."ygrs='".$yuangrs."'".","."yye='".$yye."'".","."sheng='".$sheng."'".","."chinacomcity='".$chinacomcity."'".","."telcountrycode='".$telcountrycode."'".","."telareacode='".$telareacode."'".","."tel='".$tel."'".","."faxcountrycode='".$faxcountrycode."'".","."faxareacode='".$faxareacode."'".","."fax='".$fax."'".","."remark='".$remark."'".","."postcode='".$postcode."' where id='".$id."'";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('客户信息成功修改!');document.location.href=('client_manage_list.php');</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('修改失败，请与系统管理员联系!');document.location.href=('client_manage_list.php');</script>";
			exit;
			}

?>