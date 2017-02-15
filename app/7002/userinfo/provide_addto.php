<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$companyname=chkstring(addslashes(trim($_POST['companyname'])));	
$sheng=chkstring(addslashes(trim($_POST['sheng'])));	
$chinacomcity=chkstring(addslashes(trim($_POST['chinacomcity'])));
$telcountrycode=chkstring(addslashes(trim($_POST['telcountrycode'])));
$telareacode=chkstring(addslashes(trim($_POST['telareacode'])));
$tel=chkstring(addslashes(trim($_POST['tel'])));

$faxcountrycode=chkstring(addslashes(trim($_POST['faxcountrycode'])));
$faxareacode=chkstring(addslashes(trim($_POST['faxareacode'])));
$fax=chkstring(addslashes(trim($_POST['fax'])));

$linkname=chkstring(addslashes(trim($_POST['linkname'])));
$mobile=chkstring(addslashes(trim($_POST['mobile'])));

$email=chkstring(addslashes(trim($_POST['email'])));
$address=chkstring(addslashes(trim($_POST['address'])));
$postcode=chkstring(addslashes(trim($_POST['postcode'])));
$mainproduct=chkstring(addslashes(trim($_POST['mainproduct'])));
$beiz=chkstring(addslashes(trim($_POST['beiz'])));

$userid=$_SESSION["userdlname"];
$username=$_SESSION["username"];
	//检查用户名数据库中否已经存在
	$sql="select companyname from provide where companyname='".$companyname."'";
	
		if($rs=$obj->exec($sql))
			{
				if($obj->num_rows($rs))
				{
					mssql_free_result($rs);
					echo "<script language=javascript>alert('此公司名称已经存在，请重新填写!');history.go(-1)</script>";
					exit;
				}	
	
			}
			else 
			{
					echo "<script language=javascript>alert('数据库错误4');history.go(-1)</script>";
					exit;	
			}

$zcdate=date('Y-m-d H:i:s', time());	
		
$sql="insert into provide(companyname,sheng,shi,telcountrycode,telareacode,tel,faxcountrycode,faxareacode,fax,linkname,mobile,email,address,postcode,mainproduct,beiz,adduser,addtime) values ('$companyname','$sheng','$chinacomcity','$telcountrycode','$telareacode','$tel','$faxcountrycode','$faxareacode','$fax','$linkname','$mobile','$email','$address','$postcode','$mainproduct','$beiz','$userid','$zcdate')";
$result=$obj->exec($sql);
	if($result)
		{
			echo "<script language=javascript>alert('供应商信息成功增加!');document.location.href=('provide_add.php');</script>";
			exit;
			}
		else
		{
			echo "<script language=javascript>alert('供应商信息增加失败，请与系统管理员联系!');document.location.href=('provide_add.php');</script>";
			exit;
			}

?>