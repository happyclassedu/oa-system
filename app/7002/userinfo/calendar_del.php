<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

//exit;
//先删除信息留言里的数据；
		$delsql="delete from calendar where id='".$id."'";
		if ($rsdel = mysql_query($delsql))
		{

					echo "<script language=javascript>alert('日程删除成功！');document.location.href=('calendar_manage_list.php');</script>";
					exit;				
			}
			else
			{
						echo "<script language=javascript>alert('删除错误！');document.location.href=('chance_manage_list.php');</script>";
						exit;						
				}

?>