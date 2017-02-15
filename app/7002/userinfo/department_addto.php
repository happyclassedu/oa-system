<?
require_once('../lib07/auto_load.php');

if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$departmentname=chk_num(chkstring(addslashes(trim($_POST['departmentname']))));	
	//检查用户名数据库中否已经存在
	if ($departmentname=="") echo "<script language=javascript>alert('计量单位为空!');document.location.href=('department_add.php');</script>";
	$sql="select departmentname from department where departmentname='".$departmentname."'";
	
		if($rs=$obj->exec($sql))
			{
				if($obj->num_rows($rs))
				{
					mssql_free_result($rs);
					echo "<script language=javascript>alert('部门名称已经存在，不允许重名!');history.go(-1)</script>";
					exit;
				}	
	
			}
			else 
			{
					echo "<script language=javascript>alert('数据库错误5');history.go(-1)</script>";
					exit;	
			}
			
	$sql="select max(departmentid) as departmentid from department";
	$rs=$obj->fetchrow($sql);
	$bigestcode=$rs->departmentid;
//	echo $bigestcode."-<br>";
	$bigestcode=$bigestcode+1;
	$len=strlen($bigestcode);
	if ($len==1) 
	{
		$bigestcode="0".$bigestcode;
		}
	if ($len>=3)
	{
			echo "<script language=javascript>alert('最多为99个，目前已经超出，不允许增加!');document.location.href=('department_add.php');</script>";
			exit;		
		}
//	echo $bigestcode."<br>";
//	exit;
$zcdate=date('Y-m-d H:i:s', time());			
$sql="insert into department(departmentname,departmentid) values ('$departmentname','$bigestcode')";
$result=$obj->exec($sql);
	if($result)
		{
			echo "<script language=javascript>alert('部门成功增加!');document.location.href=('department_add_list.php');</script>";
			exit;
			}
		else
		{
			echo "<script language=javascript>alert('部门增加失败，请与系统管理员联系!');document.location.href=('department_add.php');</script>";
			exit;
			}

?>