<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=$_GET['id'];
 
					$gqquery ="SELECT *  from chance where id='".$id."'"; 
				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>��ϵ����ϸ��Ϣ</title>
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
					$itemname=trim($arrrow[$i]['itemname']);
					$clientname=trim($arrrow[$i]['clientname']);
					$itemmoney=trim($arrrow[$i]['itemmoney']);
					$phase=trim($arrrow[$i]['phase']);
					$nextcontent=trim($arrrow[$i]['nextcontent']);
					$expectationmoney=trim($arrrow[$i]['expectationmoney']);
					$intendingday=trim($arrrow[$i]['intendingday']);
					$shic=trim($arrrow[$i]['shic']);
					$possibility=trim($arrrow[$i]['possibility']);
					$clew=trim($arrrow[$i]['clew']);
					$linkname=trim($arrrow[$i]['linkname']);
					$remark=trim($arrrow[$i]['remark']);
					$username=trim($arrrow[$i]['username']);
          $addtime=trim($arrrow[$i]['addtime']);
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="client_detail" style="padding:0px;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">�̻���ϸ</td>
  </tr>
  <tr> 
    <td height="30" valign="top" bgcolor="#FFFFFF" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
          <td   class="crm_td">�̻������ߣ�</td>
          <td   class="crm_input">&nbsp;<?=$username;?></td>
          <td align="right"   class="crm_td">���ƽ�</td>
          <td   class="crm_tdright">&nbsp;<?=$itemmoney;?> </td>
        </tr>
        <tr> 
          <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>�̻����ƣ�</td>
          <td width="45%"   class="crm_input">&nbsp;<?=$itemname;?> </td>
          <td width="40%" align="right"   class="crm_td"><font color="#FF0000">*</font>Ԥ�Ƴɽ����ڣ�</td>
          <td width="40%"   class="crm_tdright">&nbsp;<?=$intendingday;?> </tr>
        <tr> 
          <td   class="crm_td"><font color="#FF0000">*</font>��ϵ������</td>
          <td   class="crm_input">&nbsp;<?=$linkname;?> </td>
          <td align="right"   class="crm_td"><font color="#FF0000">*</font>�׶Σ�</td>
          <td   class="crm_tdright">&nbsp;<?=$phase;?> </td>
        </tr>
        <tr id=chinaaddress1> 
          <td   class="crm_td"><font color="#FF0000">*</font>�ͻ�����</td>
          <td   class="crm_input">&nbsp;<?=$clientname;?> </td>
          <td align="right"   class="crm_td">�����ԣ�</td>
          <td   class="crm_input">&nbsp;<?=$possibility;?> </td>
        </tr>
        <tr> 
          <td   class="crm_td"> ��һ���� </td>
          <td  id=areacodetd class="crm_input">&nbsp;<?=$nextcontent;?> </td>
          <td align="right"   class="crm_td">�������棺</td>
          <td   class="crm_tdright">&nbsp;<?=$expectationmoney;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">������Դ��</td>
          <td   class="crm_input">&nbsp;<?=$clew;?></td>
          <td align="right"   class="crm_td">�г��Դ��</td>
          <td   class="crm_tdright">&nbsp;<?=$shic;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">��ע��</td>
          <td colspan="3"   class="crm_input">&nbsp;<?=$remark;?> </td>
        </tr>
        <tr> 
          <td   class="crm_td">����ʱ�䣺</td>
          <td colspan="3"   class="crm_input">&nbsp;<?=$addtime;?> </td>
        </tr>        
      </table></td>
  </tr>
</table>
<?
					}
				?>				  

</body>
</html>
