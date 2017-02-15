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
			echo "<script language=javascript>alert('商机数据错误3');document.location.href=('chance_manage.php');</script>";
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
    alert("商机名称不能为空！");
    document.myform.chancename.focus();
    return false;
  }
  if (myform.chengjrq.value=="")
  {
    alert("请选择预计成交日期");
    document.myform.chengjrq.focus();
    return false;
  }  
   if (myform.linkname.value=="")
  {
    alert("请您选择联系人名！");
    document.myform.linkname.focus();
    return false;
  } 
  if (myform.clientname.value=="")
  {
    alert("请您选择客户名称！");
    document.myform.clientname.focus();
    return false;
  }  
  
  if (myform.jied.value=="")
  {
    alert("请您选择阶段！");
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
      alert(maxLength + ' 个字限制. \r超出的将自动去除.');
      thisArea.value = thisArea.value.substring(0, maxLength);
      thisArea.focus();
    }
    /*回写span的值，当前填写文字的数量*/
   
  }


//-->
</script>

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
          <td>&nbsp;客户资源管理->编辑商机</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;编辑商机(<font color="#FF0000">*</font>必填写)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="chance_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr> 
                  <td   class="crm_td">商机所有者：</td>
                  <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
                  <td align="right"   class="crm_td">估计金额：</td>
                  <td   class="crm_tdright"> <input name="gujje"  type="text" value="<?=$itemmoney;?>" id="gujje" size="20"  maxlength="20">
                    <font color="#FF0000">元/人民币</font></td>
                </tr>
                <tr> 
                  <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>商机名称：</td>
                  <td width="45%"   class="crm_input"> <input name="chancename" type="text" id="chancename"  value="<?=$itemname;?>" size="30" maxlength="40" > 
                  </td>
                  <td width="40%" align="right"   class="crm_td"><font color="#FF0000">*</font>预计成交日期：</td>
                  <td width="40%"   class="crm_tdright"><script type="text/javascript" src="../js/date_select.js"></script> <input name="chengjrq" onClick="return Calendar('chengjrq');" type="text"  id="chengjrq" value="<?=$intendingday;?>"  size="20"  maxlength="20"> 
                </tr>
                <tr> 
                  <td   class="crm_td"><font color="#FF0000">*</font>联系人名：</td>
                  <td   class="crm_input"> <input name="linkname" type="text" id="linkname" value="<?=$linkname;?>"  readonly size="10" maxlength="20" > 
                    <input type="hidden" name="linknameid"  id="linknameid" value="<?=$linknameid;?>"> 
                    <INPUT name="select_linkman" TYPE="button"   class="submit" id="select_linkman"   onclick="select_linkmans();"   value="选择" title="选择联系人时，客户名也自动填写">
                  </td>
                  <td align="right"   class="crm_td"><font color="#FF0000">*</font>阶段：</td>
                  <td   class="crm_tdright"> <select name=jied size=1 id="jied" class="crm_select">
                      <OPTION value="" selected>-请选择阶段-</OPTION>
                      <OPTION value="资质审查" <?if ($phase=="资质审查") echo "selected";?>>-资质审查-</OPTION>
                      <OPTION value="需求分析" <?if ($phase=="需求分析") echo "selected";?>>-需求分析-</OPTION>
                      <OPTION value="价值建议" <?if ($phase=="价值建议") echo "selected";?>>-价值建议-</OPTION>
                      <OPTION value="确定决策者" <?if ($phase=="确定决策者") echo "selected";?>>-确定决策者-</OPTION>
                      <OPTION value="提案或报价" <?if ($phase=="提案或报价") echo "selected";?>>-提案或报价-</OPTION>
                      <OPTION value="谈判复审" <?if ($phase=="谈判复审") echo "selected";?>>-谈判复审-</OPTION>
                      <OPTION value="成交关闭" <?if ($phase=="成交关闭") echo "selected";?>>-成交关闭-</OPTION>
                      <OPTION value="丢失的线索" <?if ($phase=="丢失的线索") echo "selected";?>>-丢失的线索-</OPTION>
                      <OPTION value="因竞争丢失关闭" <?if ($phase=="因竞争丢失关闭") echo "selected";?>>-因竞争丢失关闭-</OPTION>
                    </select> </td>
                </tr>
                <tr id=chinaaddress1> 
                  <td   class="crm_td"><font color="#FF0000">*</font>客户名：</td>
                  <td   class="crm_input"><input name="clientname" type="text" id="clientname" value="<?=$clientname;?>" size="30" maxlength="40" readonly> 
                    <input type="hidden" name="clientid"  id="clientid"  value="<?=$clientid;?>"> </td>
                  <td align="right"   class="crm_td">可能性：</td>
                  <td   class="crm_input"><SELECT 
      name=possibility size=1 id="possibility" class="crm_select">
                      <OPTION value="" selected>-请选择可能性-</OPTION>
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
                  <td   class="crm_td">  下一步： </td>
                  <td  id=areacodetd class="crm_input"><input name="next" type="text" id="next" value="<?=$nextcontent;?>" size="30" maxlength="50" > 
                  </td>
                  <td align="right"   class="crm_td">期望收益：</td>
                  <td   class="crm_tdright"><input name="qiwsy" type="text"  id="qiwsy" size="30" value="<?=$expectationmoney;?>" maxlength="50"></td>
                </tr>
                <tr> 
                  <td   class="crm_td">线索来源：</td>
                  <td   class="crm_input"><select name=xiansuo size=1 id="xiansuo" class="crm_select">
                      <OPTION value="无" selected>-无-</OPTION>
                      <OPTION value="广告" <?if ($clew=="广告") echo "selected";?>>-广告-</OPTION>
                      <OPTION value="推销电话" <?if ($clew=="推销电话") echo "selected";?>>-推销电话-</OPTION>
                      <OPTION value="交易会" <?if ($clew=="交易会") echo "selected";?>>-交易会-</OPTION>
                      <OPTION value="合作伙伴" <?if ($clew=="合作伙伴") echo "selected";?>>-合作伙伴-</OPTION>
                      <OPTION value="外部介绍" <?if ($clew=="外部介绍") echo "selected";?>>-外部介绍-</OPTION>
                      <OPTION value="公开媒体" <?if ($clew=="公开媒体") echo "selected";?>>-公开媒体-</OPTION>
                      <OPTION value="销售邮件" <?if ($clew=="销售邮件") echo "selected";?>>-销售邮件-</OPTION>
                      <OPTION value="网络宣传" <?if ($clew=="网络宣传") echo "selected";?>>-网络宣传-</OPTION>
                      <OPTION value="其他" <?if ($clew=="其他") echo "selected";?>>-其他-</OPTION>
                    </select> </td>
                  <td align="right"   class="crm_td">市场活动源：</td>
                  <td   class="crm_tdright"><input name="shic" type="text"  value="<?=$shic;?>" id="shic" size="30" readonly maxlength="80">
                    <input type="hidden" name="shicid"  id="shicid"  value="<?=$shicid;?>">
                    <INPUT name="select_market" TYPE="button"   class="submit"   onclick="select_markets();"   value="选择"> 
                  </td>
                </tr>
                <tr> 
                  <td   class="crm_td">备注：</td>
                  <td colspan="3"   class="crm_input">
			<?
		  					$spintr=trim($remark);
								$spintr=str_replace("<br />","", $spintr);
                $spintr=str_replace("&nbsp;", " ", $spintr);
		  ?>                  	
                  	<textarea name="beiz" cols="85" rows="5"  id="beiz" onkeyUp="textLimitCheck(this, 500);"><?=stripslashes($spintr);?></textarea>
                    最多500汉字； 
 </td>
                </tr>
                <tr align="center"> 
                  <td colspan="5"   class="crm_submit"> 
                  	<input type="hidden" name="id"  id="clientid"  value="<?=$id;?>">
                  	<input type="submit" name="Submit" class="submit" value="-确定修改-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
                  </td>
                </tr>
              </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
            1、<font color="#000000">商机信息请仔细填写</font><font color="#FF0000"> *</font>为必须填写。<br>
            2、选择联系人名时，客户名也会自动填写。</td>
  </tr>
</table>