<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$olduser_str=chkstring(addslashes(trim($_POST['olduser'])));
	$bigls=split("\|",$olduser_str);
	$oldusername=$bigls[1];
	$olduser=$bigls[0];
$newuser_str=chkstring(addslashes(trim($_POST['newuser'])));
	$news=split("\|",$newuser_str);
	$newusername=$news[1];
	$newuser=$news[0];
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />

<?
if ($olduser==$newuser)
{
					echo "<script language=javascript>alert('原用户与移交用户相同，重返回重新选择！');history.go(-1)</script>";
					exit;	
	}
	else
	{
		//移交客户
		$sql="select * from client where userid='".$olduser."'";
		$result=$obj->exec($sql);
		$afrows=$obj->num_rows($result);
		if ($afrows<=0)
		{
			echo "<br>".$olduser."无客户信息！<br>";
			}
			else
			{
				$sql="update client set userid='".$newuser."'".","."username='".$newusername."' where userid='".$olduser."'";
				$result=$obj->exec($sql);
//				$affectrows=$obj->affected_rows();
					if($result)
						{
							echo "<br>客户移交成功，共成功移交<font color=red>[ ".$afrows." ]</font>个客户信息给[".$newuser."]！<br>";
							}
						else
						{
							echo "客户移交<font color=red>失败</font><br>";
							}		
				}
 

		//移交联系人
		$sql="select * from linkname where userid='".$olduser."'";
		$result=$obj->exec($sql);
		$afrows=$obj->num_rows($result);
		if ($afrows<=0)
		{
			echo "<br>".$olduser."无联系人信息！<br>";
			}
			else
			{
				$sql="update linkname set userid='".$newuser."'".","."username='".$newusername."' where userid='".$olduser."'";
				$result=$obj->exec($sql);
//				$affectrows=$obj->affected_rows();
					if($result)
						{
							echo "<br>联系人移交成功，共成功移交<font color=red>[ ".$afrows." ]</font>个联系人信息给[".$newuser."]！<br>";
							}
						else
						{
							echo "联系人移交<font color=red>失败</font><br>";
							}		
				}
		

		//移交市场信息
		$sql="select * from market where userid='".$olduser."'";
		$result=$obj->exec($sql);
		$afrows=$obj->num_rows($result);
		if ($afrows<=0)
		{
			echo "<br>".$olduser."无市场信息！<br>";
			}
			else
			{
				$sql="update market set userid='".$newuser."'".","."username='".$newusername."' where userid='".$olduser."'";
				$result=$obj->exec($sql);
//				$affectrows=$obj->affected_rows();
					if($result)
						{
							echo "<br>市场活动移交成功，共成功移交<font color=red>[ ".$afrows." ]</font>个市场活动给[".$newuser."]！<br>";
							}
						else
						{
							echo "市场活动移交<font color=red>失败</font><br>";
							}		
				}
				
				

		//移交商机
		$sql="select * from chance where userid='".$olduser."'";
		$result=$obj->exec($sql);
		$afrows=$obj->num_rows($result);
		if ($afrows<=0)
		{
			echo "<br>".$olduser."无商机信息！<br>";
			}
			else
			{
				$sql="update chance set userid='".$newuser."'".","."username='".$newusername."' where userid='".$olduser."'";
				$result=$obj->exec($sql);
//				$affectrows=$obj->affected_rows();
					if($result)
						{
							echo "<br>商机移交成功，共成功移交<font color=red>[ ".$afrows." ]</font>个商机给[".$newuser."]！<br>";
							}
						else
						{
							echo "商机移交<font color=red>失败</font><br>";
							}		
				}
				
		//移交日程
		$sql="select * from calendar where userid='".$olduser."'";
		$result=$obj->exec($sql);
		$afrows=$obj->num_rows($result);
		if ($afrows<=0)
		{
			echo "<br>".$olduser."无日程信息！<br>";
			}
			else
			{
				$sql="update calendar set userid='".$newuser."'".","."username='".$newusername."' where userid='".$olduser."'";
				$result=$obj->exec($sql);
//				$affectrows=$obj->affected_rows();
					if($result)
						{
							echo "<br>日程移交成功，共成功移交<font color=red>[ ".$afrows." ]</font>个日程给[".$newuser."]！<br>";
							}
						else
						{
							echo "日程移交<font color=red>失败</font><br>";
							}		
				}

				




}


		
			echo "<script language=javascript>alert('工作移交完成，确定返回!');history.go(-1);</script>";
//			echo "<input type='button' value='全部移交完成，返回' onclick='javascript:history.go(-1);'></input>";
			exit;

?>
