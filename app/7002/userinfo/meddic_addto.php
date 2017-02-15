<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

$userid=addslashes(trim($_POST['userid']));
$chancename=addslashes(trim($_POST['chancename']));
$chanceid=chkstring(addslashes(trim($_POST['chanceid'])));
$metrics=chkstring(addslashes(trim($_POST['metrics'])));
$economic=chkstring(addslashes(trim($_POST['Economic'])));
$criteria=chkstring(addslashes(trim($_POST['Criteria'])));

$process=chkstring(addslashes(trim($_POST['Process'])));	
$Identify=chkstring(addslashes(trim($_POST['Identify'])));
$Champions=chkstring(addslashes(trim($_POST['Champions'])));
$Championszt=chkstring(addslashes(trim($_POST['Championszt'])));
 
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));

$username=$_SESSION["username"];

$zcdate=date('Y-m-d H:i:s', time());	
$Submit1=chkstring(addslashes(trim($_POST['submit'])));
$zcdate=date('Y-m-d H:i:s', time());	
if ($Submit1=="-保存并新建-")
$stradd="document.location.href=('meddic_add_list.php');";
else
$stradd="document.location.href=('meddic_manage_list.php');";
$sqllog="insert into meddic(chancename,chanceid,userid,username,metrics,economic,criteria,process,pain,champions,championszt,bz,addtime) values ('$chancename','$chanceid','$userid','$username','$metrics','$economic','$criteria','$process','$Identify','$Champions','$Championszt','$remark','$zcdate')";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('分析数据成功建立，请到管理分析中查看结果!');".$stradd."</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('分析数建立失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>