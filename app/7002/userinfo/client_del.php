<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));
//	$sql="select * from linkman where id=".$id;
//	$rs=$obj->fetchrow($sql);
//	$kucsl=trim($rs->kucsl);
//	if ($kucsl<>"")
//	{
//					echo "<script language=javascript>alert('已经有库存，不允许删除！');document.location.href=('bianma_manage.php');</script>";
//					exit;	
//			}
//exit;
//先删除信息留言里的数据；
		$delsql="delete from client where id='".$id."'";
		if ($rsdel = mysql_query($delsql))
		{

					echo "<script language=javascript>alert('客户信息删除成功！');history.go(-1);</script>";
					exit;				
			}
			else
			{
						echo "<script language=javascript>alert('客户删除错误！');document.location.href=('bianma_manage.php');</script>";
						exit;						
				}

?>