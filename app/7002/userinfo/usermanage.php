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
<script type="text/javascript" src="../js/lefttoggler.js"></script>
</head>

<body style="margin:0px 0px 0px 0px;">
<?require_once('../inc/head.inc.php');?>

<table  class="allbody" border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" nowrap  id="frmTitle"  style="width:118px;background:#fff;"   name="frmTitle">
   	     	
		<?require_once('user_left.php');?>
    	
    </td>
    <td width="8" id="switchPoint" title="开启关闭左侧导航栏" style="height:100%;cursor:pointer;background:#6e7879;"   onClick="switchSysBar()"><img src=../myimages/1/toggler_2.gif></td>
    <td align="center" valign="top"  style="width:100%;background:#fff;padding:0px;margin:0px 0px 0px 0px;">

  	
    </td>
  </tr>
</table>

</body>
</html>
