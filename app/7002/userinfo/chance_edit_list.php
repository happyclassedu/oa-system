<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

	$sql="select * from chance where id='".$id."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$id=trim($rs->id);
	$clientname=trim($rs->clientname);
	$clientid=trim($rs->clientid);
  $itemmoney=trim($rs->itemmoney);
  $phase=trim($rs->phase);
  $itemname=trim($rs->itemname);
  $nextcontent=trim($rs->nextcontent);
  $expectationmoney=trim($rs->expectationmoney);
  $intendingday=trim($rs->intendingday);
  $shic=trim($rs->shic);
  $shicid=trim($rs->shicid);
  $possibility=trim($rs->possibility);
  $clew=trim($rs->clew);
  $linkname=trim($rs->linkname);
  $linknameid=trim($rs->linknameid);
  $remark=trim($rs->remark);
	if ($clientname=="")
	{
			echo "<script language=javascript>alert('�̻����ݴ���3');document.location.href=('chance_manage.php');</script>";
			exit;			
		}
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
<!--
function FormCheck() 
{

  if (myform.chancename.value=="")
  {
    alert("�̻����Ʋ���Ϊ�գ�");
    document.myform.chancename.focus();
    return false;
  }
  if (myform.chengjrq.value=="")
  {
    alert("��ѡ��Ԥ�Ƴɽ�����");
    document.myform.chengjrq.focus();
    return false;
  }  
   if (myform.linkname.value=="")
  {
    alert("����ѡ����ϵ������");
    document.myform.linkname.focus();
    return false;
  } 
  if (myform.clientname.value=="")
  {
    alert("����ѡ��ͻ����ƣ�");
    document.myform.clientname.focus();
    return false;
  }  
  
  if (myform.jied.value=="")
  {
    alert("����ѡ��׶Σ�");
    document.myform.jied.focus();
    return false;
  } 
    
   

         
    
  return true;  
}

  
  function   select_linkmans(){   
    window.open("chance_select_linkman.php","mywin",   "menubar=no,width=410,height=480,resizeable=yes");   
  } 
  function   select_markets(){   
    window.open("chance_select_market.php","mywin",   "menubar=no,width=410,height=480,resizeable=yes");   
  }   
function textLimitCheck(thisArea, maxLength)
{
    if (thisArea.value.length > maxLength)
	{
      alert(maxLength + ' ��������. \r�����Ľ��Զ�ȥ��.');
      thisArea.value = thisArea.value.substring(0, maxLength);
      thisArea.focus();
    }
    /*��дspan��ֵ����ǰ��д���ֵ�����*/
   
  }


//-->
</script>

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
          <td>&nbsp;�ͻ���Դ����->�༭�̻�</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;�༭�̻�(<font color="#FF0000">*</font>����д)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="chance_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr> 
                  <td   class="crm_td">�̻������ߣ�</td>
                  <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
                  <td align="right"   class="crm_td">���ƽ�</td>
                  <td   class="crm_tdright"> <input name="gujje"  type="text" value="<?=$itemmoney;?>" id="gujje" size="20"  maxlength="20">
                    <font color="#FF0000">Ԫ/�����</font></td>
                </tr>
                <tr> 
                  <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>�̻����ƣ�</td>
                  <td width="45%"   class="crm_input"> <input name="chancename" type="text" id="chancename"  value="<?=$itemname;?>" size="30" maxlength="40" > 
                  </td>
                  <td width="40%" align="right"   class="crm_td"><font color="#FF0000">*</font>Ԥ�Ƴɽ����ڣ�</td>
                  <td width="40%"   class="crm_tdright"><script type="text/javascript" src="../js/date_select.js"></script> <input name="chengjrq" onClick="return Calendar('chengjrq');" type="text"  id="chengjrq" value="<?=$intendingday;?>"  size="20"  maxlength="20"> 
                </tr>
                <tr> 
                  <td   class="crm_td"><font color="#FF0000">*</font>��ϵ������</td>
                  <td   class="crm_input"> <input name="linkname" type="text" id="linkname" value="<?=$linkname;?>"  readonly size="10" maxlength="20" > 
                    <input type="hidden" name="linknameid"  id="linknameid" value="<?=$linknameid;?>"> 
                    <INPUT name="select_linkman" TYPE="button"   class="submit" id="select_linkman"   onclick="select_linkmans();"   value="ѡ��" title="ѡ����ϵ��ʱ���ͻ���Ҳ�Զ���д">
                  </td>
                  <td align="right"   class="crm_td"><font color="#FF0000">*</font>�׶Σ�</td>
                  <td   class="crm_tdright"> <select name=jied size=1 id="jied" class="crm_select">
                      <OPTION value="" selected>-��ѡ��׶�-</OPTION>
                      <OPTION value="�������" <?if ($phase=="�������") echo "selected";?>>-�������-</OPTION>
                      <OPTION value="�������" <?if ($phase=="�������") echo "selected";?>>-�������-</OPTION>
                      <OPTION value="��ֵ����" <?if ($phase=="��ֵ����") echo "selected";?>>-��ֵ����-</OPTION>
                      <OPTION value="ȷ��������" <?if ($phase=="ȷ��������") echo "selected";?>>-ȷ��������-</OPTION>
                      <OPTION value="�᰸�򱨼�" <?if ($phase=="�᰸�򱨼�") echo "selected";?>>-�᰸�򱨼�-</OPTION>
                      <OPTION value="̸�и���" <?if ($phase=="̸�и���") echo "selected";?>>-̸�и���-</OPTION>
                      <OPTION value="�ɽ��ر�" <?if ($phase=="�ɽ��ر�") echo "selected";?>>-�ɽ��ر�-</OPTION>
                      <OPTION value="��ʧ������" <?if ($phase=="��ʧ������") echo "selected";?>>-��ʧ������-</OPTION>
                      <OPTION value="������ʧ�ر�" <?if ($phase=="������ʧ�ر�") echo "selected";?>>-������ʧ�ر�-</OPTION>
                    </select> </td>
                </tr>
                <tr id=chinaaddress1> 
                  <td   class="crm_td"><font color="#FF0000">*</font>�ͻ�����</td>
                  <td   class="crm_input"><input name="clientname" type="text" id="clientname" value="<?=$clientname;?>" size="30" maxlength="40" readonly> 
                    <input type="hidden" name="clientid"  id="clientid"  value="<?=$clientid;?>"> </td>
                  <td align="right"   class="crm_td">�����ԣ�</td>
                  <td   class="crm_input"><SELECT 
      name=possibility size=1 id="possibility" class="crm_select">
                      <OPTION value="" selected>-��ѡ�������-</OPTION>
<OPTION value=100 <?if ($possibility=="100") echo "selected";?>>100%</OPTION>
<OPTION value=90 <?if ($possibility=="90") echo "selected";?>>90%</OPTION>
<OPTION value=80 <?if ($possibility=="80") echo "selected";?>>80%</OPTION>
<OPTION value=70 <?if ($possibility=="70") echo "selected";?>>70%</OPTION>
<OPTION value=60 <?if ($possibility=="60") echo "selected";?>>60%</OPTION>
<OPTION value=50 <?if ($possibility=="50") echo "selected";?>>50%</OPTION>
<OPTION value=40 <?if ($possibility=="40") echo "selected";?>>40%</OPTION>

                    </SELECT> </td>
                </tr>
                <tr> 
                  <td   class="crm_td">  ��һ���� </td>
                  <td  id=areacodetd class="crm_input"><input name="next" type="text" id="next" value="<?=$nextcontent;?>" size="30" maxlength="50" > 
                  </td>
                  <td align="right"   class="crm_td">�������棺</td>
                  <td   class="crm_tdright"><input name="qiwsy" type="text"  id="qiwsy" size="30" value="<?=$expectationmoney;?>" maxlength="50"></td>
                </tr>
                <tr> 
                  <td   class="crm_td">������Դ��</td>
                  <td   class="crm_input"><select name=xiansuo size=1 id="xiansuo" class="crm_select">
                      <OPTION value="��" selected>-��-</OPTION>
                      <OPTION value="���" <?if ($clew=="���") echo "selected";?>>-���-</OPTION>
                      <OPTION value="�����绰" <?if ($clew=="�����绰") echo "selected";?>>-�����绰-</OPTION>
                      <OPTION value="���׻�" <?if ($clew=="���׻�") echo "selected";?>>-���׻�-</OPTION>
                      <OPTION value="�������" <?if ($clew=="�������") echo "selected";?>>-�������-</OPTION>
                      <OPTION value="�ⲿ����" <?if ($clew=="�ⲿ����") echo "selected";?>>-�ⲿ����-</OPTION>
                      <OPTION value="����ý��" <?if ($clew=="����ý��") echo "selected";?>>-����ý��-</OPTION>
                      <OPTION value="�����ʼ�" <?if ($clew=="�����ʼ�") echo "selected";?>>-�����ʼ�-</OPTION>
                      <OPTION value="��������" <?if ($clew=="��������") echo "selected";?>>-��������-</OPTION>
                      <OPTION value="����" <?if ($clew=="����") echo "selected";?>>-����-</OPTION>
                    </select> </td>
                  <td align="right"   class="crm_td">�г��Դ��</td>
                  <td   class="crm_tdright"><input name="shic" type="text"  value="<?=$shic;?>" id="shic" size="30" readonly maxlength="80">
                    <input type="hidden" name="shicid"  id="shicid"  value="<?=$shicid;?>">
                    <INPUT name="select_market" TYPE="button"   class="submit"   onclick="select_markets();"   value="ѡ��"> 
                  </td>
                </tr>
                <tr> 
                  <td   class="crm_td">��ע��</td>
                  <td colspan="3"   class="crm_input">
			<?
		  					$spintr=trim($remark);
								$spintr=str_replace("<br />","", $spintr);
                $spintr=str_replace("&nbsp;", " ", $spintr);
		  ?>                  	
                  	<textarea name="beiz" cols="85" rows="5"  id="beiz" onkeyUp="textLimitCheck(this, 500);"><?=stripslashes($spintr);?></textarea>
                    ���500���֣� 
 </td>
                </tr>
                <tr align="center"> 
                  <td colspan="5"   class="crm_submit"> 
                  	<input type="hidden" name="id"  id="clientid"  value="<?=$id;?>">
                  	<input type="submit" name="Submit" class="submit" value="-ȷ���޸�-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-����-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-����-" onClick="history.go(-1)" class="buttons"> 
                  </td>
                </tr>
              </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>˵����</strong><br>
            1��<font color="#000000">�̻���Ϣ����ϸ��д</font><font color="#FF0000"> *</font>Ϊ������д��<br>
            2��ѡ����ϵ����ʱ���ͻ���Ҳ���Զ���д��</td>
  </tr>
</table>