<?
require_once('../lib07/function_form.inc.php');
$_SESSION["userdlname"]="";
$_SESSION["username"]="";
$_SESSION["isfuze"]="";
unset($_SESSION["userdlname"]);
session_destroy();
	if ($_SESSION["userdlname"]=="")
	{
		echo "<script language=javascript>alert('成功退出!');document.location.href=('/crm/index.php');</script>";
		}
		else
		{
		echo "退出失败，请与系统管理员联系！";
		exit;
				}

?>