<?
require_once('../lib07/auto_load.php');

if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$global_websitename;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
window.status="欢迎使用<?=$global_websitename;?>！";
</script>

</head>

<body style="margin:0px 0px 0px 0px;" >
<?require_once('../inc/head.inc.php');?>

<table  class="allbody" border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" nowrap  id="frmTitle"  class="class_left" name="frmTitle">
   	 <?require_once('crm_left.php');?>    	

    	
    </td>
    <td width="8" id="switchPoint" title="开启关闭左侧导航栏" class="class_bar"   onClick="switchSysBar()"><img src=../myimages/1/toggler_2.gif></td>
    <td align="center" valign="top"  class="class_right">
		<?require_once('client_add.php');?>  
    </td>
  </tr>
</table>

</body>
</html>
