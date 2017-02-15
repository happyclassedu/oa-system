<?
require_once('../lib07/auto_load.php');

if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$classname=chk_num(chkstring(addslashes(trim($_POST['classname']))));
$id=chk_num(chkstring(addslashes(trim($_POST['id']))));
$type=chk_num(chkstring(addslashes(trim($_POST['type']))));

if (strcmp($type,"edit")==0)
{
//	echo $classname." type=".$type." id=".$id;

		//检查当前ID下是否有子类，有则不让改名称
	$sql="select classname from small_class where bid='".$id."'";
		if($rs=$obj->exec($sql))
			{
				if($obj->num_rows($rs))
				{
					mssql_free_result($rs);
						echo "<script language=javascript>alert('当前分类下有子类，不允许改名，请删除其下小类后再改大类名称');window.location='base.php'</script>";
						exit;
				}	
	
			}
			else 
			{
					echo "<script language=javascript>alert('大类数据库错误312');history.go(-1)</script>";
					exit;	
			}
			
	$sql="update small_class set classname='".$classname."' where id='".$id."'";	
			$result=$obj->exec($sql);
				if($result)
					{
						echo "<script language=javascript>alert('大类信息编辑成功!');document.location.href=('base.php');</script>";
						exit;
						}
					else
					{
						echo "<script language=javascript>alert('大类信息编辑失败，请与系统管理员联系!');document.location.href=('base.php');</script>";
						exit;
						}	
	}
	else
	{
				//检查用户名数据库中否已经存在
				if ($classname=="") echo "<script language=javascript>alert('分类信息为空!');document.location.href=('base.php');</script>";
				$sql="select classname from small_class where classname='".$classname."'";
				
					if($rs=$obj->exec($sql))
						{
							if($obj->num_rows($rs))
							{
								mssql_free_result($rs);
								echo "<script language=javascript>alert('此分类名称已经存在，不允许重名!');history.go(-1)</script>";
								exit;
							}	
				
						}
						else 
						{
								echo "<script language=javascript>alert('数据库错误5');history.go(-1)</script>";
								exit;	
						}
				$strbid="0";		
				$sql="select * from small_class where bid='".$strbid."'";
				$queryresult=$obj->exec($sql);
				$ggallrows=$obj->num_rows($queryresult);
				if ($ggallrows>=100)
				{
						echo "<script language=javascript>alert('大类最多为99个，目前已经超出，不允许增加!');document.location.href=('base.php');</script>";
						exit;		
					}
					
				$sql="select max(classcode) as classcode from small_class where bid='".$strbid."'";
				$rs=$obj->fetchrow($sql);
				$bigestcode=$rs->classcode;
				$bigestcode=$bigestcode+1;
				$len=strlen($bigestcode);
				if ($len==1) 
				{
					$bigestcode="0".$bigestcode;
					}
				if ($len>=3)
				{
						echo "<script language=javascript>alert('分类为0-99，目前已经超出，不允许增加!');document.location.href=('base.php');</script>";
						exit;		
					}
			
				$sql="select max(id) as id from small_class";
				$rs=$obj->fetchrow($sql);
				$bid=$rs->id;
				$bid=$bid+1;
				
			$upcode="0";			
			$sql="insert into small_class(id,classname,classcode,bid,code) values ('$bid','$classname','$bigestcode','$upcode','$bigestcode')";
			$result=$obj->exec($sql);
				if($result)
					{
						echo "<script language=javascript>alert('大类信息成功增加!');document.location.href=('base.php');</script>";
						exit;
						}
					else
					{
						echo "<script language=javascript>alert('大类信息增加失败，请与系统管理员联系!');document.location.href=('base.php');</script>";
						exit;
						}
			}
?>