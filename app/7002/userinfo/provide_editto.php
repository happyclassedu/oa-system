<?
require_once('../lib07/auto_load.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=chkstring(addslashes(trim($_POST['id'])));	
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

//$userid=$_SESSION["userdlname"];
//$username=$_SESSION["username"];
// 

$zcdate=date('Y-m-d H:i:s', time());	
		
//$sql="insert into provide(companyname,sheng,shi,telcountrycode,telareacode,tel,faxcountrycode,faxareacode,fax,linkname,mobile,email,address,postcode,mainproduct,beiz,adduser,addtime) values ('$companyname','$sheng','$chinacomcity','$telcountrycode','$telareacode','$tel','$faxcountrycode','$faxareacode','$fax','$linkname','$mobile','$email','$address','$postcode','$mainproduct','$beiz','$userid','$zcdate')";
$sql="update provide set companyname='".$companyname."'".","."sheng='".$sheng."'".","."shi='".$chinacomcity."'".","."telcountrycode='".$telcountrycode."'".","."telareacode='".$telareacode."'".","."tel='".$tel."'".","."faxcountrycode='".$faxcountrycode."'".","."faxareacode='".$faxareacode."'".","."fax='".$fax."'".","."linkname='".$linkname."'".","."mobile='".$mobile."'".","."email='".$email."'".","."address='".$address."'".","."postcode='".$postcode."'".","."mainproduct='".$mainproduct."'".","."beiz='".$beiz."' where id='".$id."'";
$result=$obj->exec($sql);
	if($result)
		{
			echo "<script language=javascript>alert('供应商信息修改成功!');document.location.href=('provide_manage.php');</script>";
			exit;
			}
		else
		{
			echo "<script language=javascript>alert('供应商信息修改失败，请与系统管理员联系!');document.location.href=('provide_manage.php');</script>";
			exit;
			}

?>