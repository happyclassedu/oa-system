<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

//exit;
//先删除信息留言里的数据；
		$delsql="delete from department where id='".$id."'";
		if ($rsdel = mysql_query($delsql))
		{

					echo "<script language=javascript>alert('部门删除成功！');document.location.href=('department_add_list.php');</script>";
					exit;				
			}
			else
			{
						echo "<script language=javascript>alert('部门删除错误！');document.location.href=('department_add.php');</script>";
						exit;						
				}

?>