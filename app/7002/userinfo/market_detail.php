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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$clientname;?>详细信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;增加市场活动(<font color="#FF0000">*</font>必填写)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr> 
                  <td   class="crm_td">市场活动所有者：</td>
                  <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
                  <td align="right"   class="crm_td">类型：</td>
                  <td   class="crm_tdright"> <select name=leix size=1 id="leix" class="crm_select">
                      <OPTION value="无" selected>-无-</OPTION>
                      <OPTION value="会议" >-会议-</OPTION>
                      <OPTION value="WEB研讨" >-WEB研讨-</OPTION>
                      <OPTION value="交易会" >-交易会-</OPTION>
                      <OPTION value="公开媒体" >-公开媒体-</OPTION>
                      <OPTION value="合作伙伴" >-合作伙伴-</OPTION>
                      <OPTION value="广告" >-广告-</OPTION>
                      <OPTION value="直接邮件" >-直接邮件-</OPTION>
                      <OPTION value="条幅广告" >-条幅广告-</OPTION>
                      
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>市场活动名称：</td>
                  <td width="45%"   class="crm_input"> <input name="marketname" type="text" id="marketname" size="30" maxlength="40" > 
                  </td>
                  <td width="40%" align="right"   class="crm_td">状态：</td>
                  <td width="40%"   class="crm_tdright"><select name=zhuangt size=1 id="zhuangt" class="crm_select">
                      <OPTION value="无" selected>-无-</OPTION>
                      <OPTION value="计划中" >-计划中-</OPTION>
                      <OPTION value="有效的" >-有效的-</OPTION>
                      <OPTION value="非活动的" >-非活动的-</OPTION>
                      <OPTION value="完成" >-完成-</OPTION>
                       
                    </select> </tr>
                <tr> 
                  <td   class="crm_td">开始日期：</td>
                  <td   class="crm_input"><input name="kaisrq"  onClick="return Calendar('kaisrq');" type="text"  id="kaisrq" size="20"  maxlength="20"> 
                  </td>
                  <td align="right"   class="crm_td">结束日期：</td>
                  <td   class="crm_tdright"><script type="text/javascript" src="../js/date_select.js"></script> 
                    <input name="jiesrq"  onClick="return Calendar('jiesrq');" type="text"  id="jiesrq" size="20"  maxlength="20"> 
                  </td>
                </tr>
                <tr id=chinaaddress1> 
                  <td   class="crm_td">期望收益：</td>
                  <td   class="crm_input"><input name="qiwsy" type="text"  id="qiwsy2" size="30" maxlength="50"> 
                  </td>
                  <td align="right"   class="crm_td"><font color="#FF0000">*</font>期望成功率：</td>
                  <td   class="crm_input"><SELECT 
      name=qiwcgl size=1 id="qiwcgl" class="crm_select">
                      <OPTION value="" selected>-请选择-</OPTION>
<OPTION value=100>100%</OPTION>
<OPTION value=90>90%</OPTION>
<OPTION value=80>80%</OPTION>
<OPTION value=70>70%</OPTION>
<OPTION value=60>60%</OPTION>
<OPTION value=50>50%</OPTION>
<OPTION value=40>40%</OPTION>

                    </SELECT> </td>
                </tr>
                <tr> 
                  <td   class="crm_td"> <font color="#FF0000">*</font>活动预算成本： 
                  </td>
                  <td  id=areacodetd class="crm_input"><input name="yuscb" type="text" id="yuscb" size="20" maxlength="30" >
                    元/人民币 </td>
                  <td align="right"   class="crm_td">活动实际成本：</td>
                  <td   class="crm_tdright"><input name="shijcb" type="text" id="shijcb" size="20" maxlength="30" >
                    元/人民币</td>
                </tr>
                <tr> 
                  <td   class="crm_td">发出数量：</td>
                  <td   class="crm_input"><input name="facsl" type="text" id="yuscb3" size="20" maxlength="30" > 
                  </td>
                  <td align="right"   class="crm_td">&nbsp;</td>
                  <td   class="crm_tdright">&nbsp; </td>
                </tr>
                <tr> 
                  <td   class="crm_td">备注：</td>
                  <td colspan="3"   class="crm_input"><textarea name="beiz" cols="85" rows="5"  id="beiz" onkeyUp="textLimitCheck(this, 500);"></textarea>
                    最多500汉字； 
                    
                     </td>
                </tr>
                <tr align="center"> 
                  <td colspan="5"   class="crm_submit"> <input type="submit" name="Submit" class="submit" value="-确定新建-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
                  </td>
                </tr>
              </table>

         </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
            1、市场活动信息请仔细填写<font color="#FF0000"> *</font>为必须填写。</td>
  </tr>
</table>
 			  

</body>
</html>
