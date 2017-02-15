<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_POST['id']));

$userid=addslashes(trim($_POST['userid']));
$leix=addslashes(trim($_POST['leix']));
$marketname=chkstring(addslashes(trim($_POST['marketname'])));
$zhuangt=chkstring(addslashes(trim($_POST['zhuangt'])));
$kaisrq=chkstring(addslashes(trim($_POST['kaisrq'])));

$jiesrq=chkstring(addslashes(trim($_POST['jiesrq'])));
$qiwsy=chkstring(addslashes(trim($_POST['qiwsy'])));	
$qiwcgl=chkstring(addslashes(trim($_POST['qiwcgl'])));
$yuscb=chkstring(addslashes(trim($_POST['yuscb'])));
$shijcb=chkstring(addslashes(trim($_POST['shijcb'])));
$facsl=chkstring(addslashes(trim($_POST['facsl'])));
 
$remark=change2(chkstring(addslashes(trim($_POST['beiz']))));

$username=$_SESSION["username"];

$zcdate=date('Y-m-d H:i:s', time());	
$sqllog="insert into market(userid,leix,marketname,zhuangt,starttime,endtime,qiwsy,qiwcgl,yuscb,shijcb,facsl,remark,addtime,username) values ('$userid','$leix','$marketname','$zhuangt','$kaisrq','$jiesrq','$qiwsy','$qiwcgl','$yuscb','$shijcb','$facsl','$remark','$zcdate','$username')"; 

$sqllog="update market set leix='".$leix."'".","."marketname='".$marketname."'".","."zhuangt='".$zhuangt."'".","."starttime='".$kaisrq."'".","."endtime='".$jiesrq."'".","."qiwcgl='".$qiwcgl."'".","."qiwsy='".$qiwsy."'".","."yuscb='".$yuscb."'".","."shijcb='".$shijcb."'".","."facsl='".$facsl."'".","."remark='".$remark."'".","."addtime='".$zcdate."' where id='".$id."'";
//echo $sqllog;
//exit;
$result=$obj->exec($sqllog);
	if($result)
		{
 
						echo "<script language=javascript>alert('市场活动成功修改!');document.location.href=('market_manage_list.php');</script>";
						exit;						
 							

			}
		else
		{
			echo "<script language=javascript>alert('市场活动修改失败，请与系统管理员联系!');history.go(-1);</script>";
			exit;
			}

?>