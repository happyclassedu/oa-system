<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=$_GET['id'];
 
					$gqquery ="SELECT *  from linkname where id='".$id."'"; 
				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>联系人详细信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?

				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$client_name=trim($arrrow[$i]['clientname']);
					$name=trim($arrrow[$i]['name']);
					$clew=trim($arrrow[$i]['clew']);
					$sex=trim($arrrow[$i]['sex']);
					$zhiwu=trim($arrrow[$i]['zhiwu']);
					$email=trim($arrrow[$i]['email']);
					$department=trim($arrrow[$i]['department']);
					$officetel=trim($arrrow[$i]['officetel']);
					$hometel=trim($arrrow[$i]['hometel']);
					$mobile=trim($arrrow[$i]['mobile']);
					$fax=trim($arrrow[$i]['fax']);
					$birthday=trim($arrrow[$i]['birthday']);
					$qq=trim($arrrow[$i]['qq']);
					$skypeid=trim($arrrow[$i]['skypeid']);
					$assistant=trim($arrrow[$i]['assistant']);
					$assistanttel=trim($arrrow[$i]['assistanttel']);
					$address=trim($arrrow[$i]['address']);
					$postcode=trim($arrrow[$i]['postcode']);
					$remark=trim($arrrow[$i]['remark']);
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="client_detail" style="padding:0px;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;联系人:<?=$name;?></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
          <td   class="crm_td">姓名：</td>
          <td   class="crm_input"><?=$name;?> <?=$sex;?></td>
          <td align="right"   class="crm_td">线索来源：</td>
          <td   class="crm_tdright">&nbsp;<?=$clew;?> </td>
        </tr>
        <tr> 
          <td width="15%"   class="crm_td">部门： </td>
          <td width="45%"   class="crm_input">&nbsp;<?=$department;?> </td>
          <td width="40%" align="right"   class="crm_td">职务：</td>
          <td width="40%"   class="crm_tdright">&nbsp;<?=$zhiwu;?> </tr>
        <tr> 
          <td   class="crm_td">邮件：</td>
          <td   class="crm_input">&nbsp;<?=$email;?></td>
          <td align="right"   class="crm_td">住宅电话：</td>
          <td   class="crm_tdright">&nbsp;<?=$hometel;?></td>
        </tr>
        <tr id=chinaaddress1> 
          <td   class="crm_td"> 办公固话：</td>
          <td   class="crm_input"><?=$officetel;?> </td>
          <td align="right"   class="crm_td">手机：</td>
          <td   class="crm_input">&nbsp;<?=$mobile;?> </td>
        </tr>
        <tr> 
          <td   class="crm_td">传真：</td>
          <td  id=areacodetd class="crm_input">&nbsp;<?=$fax;?></td>
          <td align="right"   class="crm_td">生日：</td>
          <td   class="crm_tdright">&nbsp;<?=$birthday;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">QQ：</td>
          <td   class="crm_input">&nbsp;<?=$qq;?></td>
          <td align="right"   class="crm_td">Skype ID：</td>
          <td   class="crm_tdright">&nbsp;<?=$skypeid;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">助理：</td>
          <td   class="crm_input">&nbsp;<?=$assistant;?></td>
          <td align="right"   class="crm_td">助理电话：</td>
          <td   class="crm_tdright">&nbsp;<?=$assistanttel;?> </td>
        </tr>
        <tr> 
          <td   class="crm_td"><font color="#FF0000">*</font>详细地址：</td>
          <td   class="crm_input">&nbsp;<?=$address;?></td>
          <td align="right"   class="crm_td">邮编：</td>
          <td   class="crm_tdright">&nbsp;<?=$postcode;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">备注：</td>
          <td colspan="3"   class="crm_detail">&nbsp;<?=stripslashes($remark);?> </td>
        </tr>
      </table></td>
  </tr>
</table>
<?
					}
				?>				  

</body>
</html>
