<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

	$sql="select * from market where id='".$id."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$id=trim($rs->id);
	$marketname=trim($rs->marketname);
	$leix=trim($rs->leix);
	$zhuangt=trim($rs->zhuangt);
	$starttime=trim($rs->starttime);
	$endtime=trim($rs->endtime);
	$qiwsy=trim($rs->qiwsy);
	$qiwcgl=trim($rs->qiwcgl);
	$yuscb=trim($rs->yuscb);
	$shijcb=trim($rs->shijcb);
	$facsl=trim($rs->facsl);
	$remark=trim($rs->remark);
 
	if ($marketname=="")
	{
			echo "<script language=javascript>alert('市场数据错误3');document.location.href=('market_manage.php');</script>";
			exit;			
		}
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
function FormCheck() 
{

  if (myform.marketname.value=="")
  {
    alert("市场活动名称不能为空！");
    document.myform.marketname.focus();
    return false;
  }
  if (myform.qiwcgl.value=="")
  {
    alert("请选择期望成功率！");
    document.myform.qiwcgl.focus();
    return false;
  }
  if (myform.yuscb.value=="")
  {
    alert("请填写活动预算成本！");
    document.myform.yuscb.focus();
    return false;
  }   
  return true;  
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
          <td>&nbsp;客户资源管理->编辑市场活动</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;编辑市场活动(<font color="#FF0000">*</font>必填写)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="market_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr> 
                  <td   class="crm_td">市场活动所有者：</td>
                  <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
                  <td align="right"   class="crm_td">类型：</td>
                  <td   class="crm_tdright"> <select name=leix size=1 id="leix" class="crm_select">
                      <OPTION value="无" selected>-无-</OPTION>
                      <OPTION value="会议" <?if ($leix=="会议") echo "selected";?>>-会议-</OPTION>
                      <OPTION value="WEB研讨" <?if ($leix=="WEB研讨") echo "selected";?>>-WEB研讨-</OPTION>
                      <OPTION value="交易会" <?if ($leix=="交易会") echo "selected";?>>-交易会-</OPTION>
                      <OPTION value="公开媒体" <?if ($leix=="公开媒体") echo "selected";?>>-公开媒体-</OPTION>
                      <OPTION value="合作伙伴" <?if ($leix=="合作伙伴") echo "selected";?>>-合作伙伴-</OPTION>
                      <OPTION value="广告" <?if ($leix=="广告") echo "selected";?>>-广告-</OPTION>
                      <OPTION value="直接邮件" <?if ($leix=="直接邮件") echo "selected";?>>-直接邮件-</OPTION>
                      <OPTION value="条幅广告" <?if ($leix=="条幅广告") echo "selected";?>>-条幅广告-</OPTION>
                      
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>市场活动名称：</td>
                  <td width="45%"   class="crm_input"> <input name="marketname" type="text" id="marketname" value="<?=$marketname;?>" size="30" maxlength="40" > 
                  </td>
                  <td width="40%" align="right"   class="crm_td">状态：</td>
                  <td width="40%"   class="crm_tdright"><select name=zhuangt size=1 id="zhuangt" class="crm_select">
                      <OPTION value="无" selected>-无-</OPTION>
                      <OPTION value="计划中" <?if ($zhuangt=="计划中") echo "selected";?>>-计划中-</OPTION>
                      <OPTION value="有效的" <?if ($zhuangt=="有效的") echo "selected";?>>-有效的-</OPTION>
                      <OPTION value="非活动的" <?if ($zhuangt=="非活动的") echo "selected";?>>-非活动的-</OPTION>
                      <OPTION value="完成" <?if ($zhuangt=="完成") echo "selected";?>>-完成-</OPTION>
                       
                    </select> </tr>
                <tr> 
                  <td   class="crm_td">开始日期：</td>
                  <td   class="crm_input"><input name="kaisrq"  onClick="return Calendar('kaisrq');" type="text" value="<?=$starttime;?>" id="kaisrq" size="20"  maxlength="20"> 
                  </td>
                  <td align="right"   class="crm_td">结束日期：</td>
                  <td   class="crm_tdright"><script type="text/javascript" src="../js/date_select.js"></script> 
                    <input name="jiesrq"  onClick="return Calendar('jiesrq');" type="text"  id="jiesrq" size="20" value="<?=$endtime;?>" maxlength="20"> 
                  </td>
                </tr>
                <tr id=chinaaddress1> 
                  <td   class="crm_td">期望收益：</td>
                  <td   class="crm_input"><input name="qiwsy" type="text" value="<?=$qiwsy;?>" id="qiwsy" size="30" maxlength="50"> 
                  </td>
                  <td align="right"   class="crm_td"><font color="#FF0000">*</font>期望成功率：</td>
                  <td   class="crm_input"><SELECT 
      name=qiwcgl size=1 id="qiwcgl" class="crm_select">
                      <OPTION value="" selected>-请选择-</OPTION>
<OPTION value=100 <?if ($qiwcgl=="100") echo "selected";?>>100%</OPTION>
<OPTION value=90 <?if ($qiwcgl=="90") echo "selected";?>>90%</OPTION>
<OPTION value=80 <?if ($qiwcgl=="80") echo "selected";?>>80%</OPTION>
<OPTION value=70 <?if ($qiwcgl=="70") echo "selected";?>>70%</OPTION>
<OPTION value=60 <?if ($qiwcgl=="60") echo "selected";?>>60%</OPTION>
<OPTION value=50 <?if ($qiwcgl=="50") echo "selected";?>>50%</OPTION>
<OPTION value=40 <?if ($qiwcgl=="40") echo "selected";?>>40%</OPTION>

                    </SELECT> </td>
                </tr>
                <tr> 
                  <td   class="crm_td"> <font color="#FF0000">*</font>活动预算成本： 
                  </td>
                  <td  id=areacodetd class="crm_input"><input name="yuscb"  value="<?=$yuscb;?>" type="text" id="yuscb" size="20" maxlength="30" >
                    元/人民币 </td>
                  <td align="right"   class="crm_td">活动实际成本：</td>
                  <td   class="crm_tdright"><input name="shijcb" type="text" value="<?=$shijcb;?>" id="shijcb" size="20" maxlength="30" >
                    元/人民币</td>
                </tr>
                <tr> 
                  <td   class="crm_td">发出数量：</td>
                  <td   class="crm_input"><input name="facsl" type="text" value="<?=$facsl;?>" id="yuscb3" size="20" maxlength="30" > 
                  </td>
                  <td align="right"   class="crm_td">&nbsp;</td>
                  <td   class="crm_tdright">&nbsp; </td>
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
                    <input type="hidden" name="id"  id="id" value="<?=$id;?>">
                     </td>
                </tr>
                <tr align="center"> 
                  <td colspan="5"   class="crm_submit"> <input type="submit" name="Submit" class="submit" value="-确定修改-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
                  </td>
                </tr>
              </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
            1、市场活动信息请仔细填写<font color="#FF0000"> *</font>为必须填写。</td>
  </tr>
</table>