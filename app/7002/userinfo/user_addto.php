<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$userid=chkstring(addslashes(trim($_POST['userid'])));	
$userpwd=chkstring(addslashes(trim($_POST['userpwd'])));
$username=chkstring(addslashes(trim($_POST['username'])));
$xingb=chkstring(addslashes(trim($_POST['xingb'])));
$usertel=chkstring(addslashes(trim($_POST['usertel'])));
$usermail=chkstring(addslashes(trim($_POST['usermail'])));

$fuze=chkstring(addslashes(trim($_POST['fuze'])));
//if ($Submit1=="-保存并新建-")
//$stradd="document.location.href=('calendar_add_list.php');";
//else
//$stradd="document.location.href=('calendar_manage_list.php');";

$department=chkstring(addslashes(trim($_POST['department'])));
	$bigls=split("\|",$department);
	$departmentname=$bigls[1];
	$departmentid=$bigls[0];
	//检查用户名数据库中否已经存在
	$sql="select userid from userinfo where userid='".$userid."'";
		if($rs=$obj->exec($sql))
			{
				if($obj->num_rows($rs))
				{
					mssql_free_result($rs);
					echo "<script language=javascript>alert('此用户ID已经存在，请重新填写!');history.go(-1)</script>";
					exit;
				}	
	
			}
			else 
			{
					echo "<script language=javascript>alert('数据库错误3');history.go(-1)</script>";
					exit;	
			}
			
	//检查部门中负责人数
	if ($fuze==1)
	{
		$sqlbm="select count(id) as allid from userinfo where departmentname='".$departmentname."' and fuze=1";
		$rsbm=$obj->fetchrow($sqlbm);
		$allid=trim($rsbm->allid);
	//	echo $allid;
	//	exit;
			if($allid>$global_departmenttotal)
				{
						
	//					mssql_free_result($rsbm);
						echo "<script language=javascript>alert('负责人最多为3名，请系统管理员到config中进行配置！');history.go(-1)</script>";
						exit;
				}
   }
						
$zcdate=date('Y-m-d H:i:s', time());			
$sql="insert into userinfo(userid,userpwd,username,xingb,usertel,usermail,addtime,departmentname,departmentid,fuze) values ('$userid','$userpwd','$username','$xingb','$usertel','$usermail','$zcdate','$departmentname','$departmentid','$fuze')";
//echo $sql;
//exit;
$result=$obj->exec($sql);
	if($result)
		{
			echo "<script language=javascript>alert('用户信息成功增加!');document.location.href=('user_add_list.php');</script>";
			exit;
			}
		else
		{
			echo "<script language=javascript>alert('用户信息增加失败，请与系统管理员联系!');document.location.href=('user_add.php');</script>";
			exit;
			}

?>