<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=$_GET['id'];
 
					$gqquery ="SELECT *  from calendar where id='".$id."'"; 
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
					$activitytype=trim($arrrow[$i]['activitytype']);
					$rctitle=trim($arrrow[$i]['rctitle']);
					$clientname=trim($arrrow[$i]['clientname']);
					$linkname=trim($arrrow[$i]['linkname']);
					$eventstatus=trim($arrrow[$i]['eventstatus']);
					$jhtime=trim($arrrow[$i]['jhtime']);
					$jhm=trim($arrrow[$i]['jhm']);
					$remark=trim($arrrow[$i]['remark']);
					$username=trim($arrrow[$i]['username']);
					$str_address=trim($arrrow[$i]['str_address']);
					$fbdate=trim($arrrow[$i]['fbdate']);
 
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="client_detail" style="padding:0px;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">�ճ���ϸ</td>
  </tr>
  <tr> 
    <td height="30" valign="top" bgcolor="#FFFFFF" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
          <td   class="crm_td">�ճ̸����ˣ�</td>
          <td   class="crm_input">&nbsp; <?=$username;?></td>
          <td align="right"   class="crm_td">�ճ����ͣ�</td>
          <td   class="crm_tdright">&nbsp; <?=$activitytype;?></td>
        </tr>
        <tr> 
          <td width="15%"   class="crm_td"><font color="#FF0000">*</font>�ճ����⣺ 
          </td>
          <td width="45%"   class="crm_input">&nbsp; <?=$rctitle;?></td>
          <td width="40%" align="right"   class="crm_td"><font color="#FF0000">&nbsp; 
            </font>�ݷÿͻ���</td>
          <td width="40%"   class="crm_tdright">&nbsp; <?=$clientname;?></td>
        </tr>
        <tr> 
          <td   class="crm_td"><font color="#FF0000">&nbsp; </font>��ϵ������</td>
          <td   class="crm_input">&nbsp; <?=$linkname;?></td>
          <td align="right"   class="crm_td"><font color="#FF0000">&nbsp; </font>�׶Σ�</td>
          <td   class="crm_tdright">&nbsp; <?=$eventstatus;?></td>
        </tr>
        <tr id=chinaaddress1> 
          <td   class="crm_td"><font color="#FF0000">&nbsp; </font>�ƻ�ʱ�䣺</td>
          <td   class="crm_input">&nbsp;<?=$jhtime."-".$jhm;?> </td>
          <td align="right"   class="crm_td">�ص㣺</td>
          <td   class="crm_input">&nbsp;<?=$str_address;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">������</td>
          <td colspan="3"   class="crm_input">&nbsp; <?=$remark;?></td>
        </tr>
        <tr> 
          <td   class="crm_td">����ʱ�䣺</td>
          <td colspan="3"   class="crm_input">&nbsp; <?=$fbdate;?></td>
        </tr>        
      </table></td>
  </tr>
</table>
<?
					}
				?>				  

</body>
</html>
