<?
require_once('../lib07/function_form.inc.php');
$_SESSION["userdlname"]="";
$_SESSION["username"]="";
$_SESSION["isfuze"]="";
unset($_SESSION["userdlname"]);
session_destroy();
	if ($_SESSION["userdlname"]=="")
	{
		echo "<script language=javascript>alert('�ɹ��˳�!');document.location.href=('/crm/index.php');</script>";
		}
		else
		{
		echo "�˳�ʧ�ܣ�����ϵͳ����Ա��ϵ��";
		exit;
				}

?>