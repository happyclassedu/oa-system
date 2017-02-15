<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
<!--
function FormCheck() 
{

  if (myform.rctitle.value=="")
  {
    alert("请填写日程标题！");
    document.myform.rctitle.focus();
    return false;
  }
 

         
    
  return true;  
}

 
  function   select_linkmans(){   
    window.open("calendar_select_linkman.php","mywin",   "menubar=no,width=410,height=480,resizeable=yes");   
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
          <td>&nbsp;日程管理->新建日程</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;新建日程(<font color="#FF0000">*</font>必填写)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="calendar_addto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td   class="crm_td">负责人：</td>
            <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly>
              </td>
            <td align="right"   class="crm_td">日程类型：</td>
            <td   class="crm_tdright"> <select name="activitytype" class="crm_select" >
                <option value="电话拜访">电话拜访</option>
                <option value="会议">会议</option>
                <option value="电子邮件">电子邮件</option>
                <option value="上门拜访">上门拜访</option>
                <option value="邮寄">邮寄</option>
                <option value="传真">传真</option>
                <option value="短信">短信</option>
				<option value="其他">其他</option>
              </select>
              <font color="#FF0000">&nbsp; </font></td>
          </tr>
          <tr> 
            <td width="15%"   class="crm_td"><font color="#FF0000">*</font>日程主题： 
            </td>
            <td width="45%"   class="crm_input"><input name="rctitle" type="text" id="rctitle" size="30" maxlength="50" > 
            </td>
            <td width="40%" align="right"   class="crm_td"><font color="#FF0000">&nbsp; 
              </font>拜访客户：</td>
            <td width="40%"   class="crm_tdright"><input name="clientname" type="text" id="clientname" size="30" maxlength="40" readonly> 
              <input type="hidden" name="clientid"  id="clientid"> <input name="select_linkman" type="button"   class="submit" id="select_linkman"   onClick="select_linkmans();"   value="选择" title="选择客户时，联系人也会自动填写！"> 
          </tr>
          <tr> 
            <td   class="crm_td"><font color="#FF0000">&nbsp; </font>联系人名：</td>
            <td   class="crm_input"> <input name="linkname" type="text" id="linkname" readonly size="10" maxlength="20" > 
              <input type="hidden" name="linknameid"  id="linknameid"> </td>
            <td align="right"   class="crm_td"><font color="#FF0000">&nbsp; </font>阶段：</td>
            <td   class="crm_tdright"> <select name="eventstatus" id="eventstatus" class=crm_select  >
                <option value="已计划" selected>已计划</option>
                <option value="处理中">处理中</option>
                <option value="未开始">未开始</option>
                <option value="未完成">未完成</option>
                <option value="延期">延期</option>
                <option value="已完成">已完成</option>
              </select> </td>
          </tr>
          <tr id=chinaaddress1> 
            <td   class="crm_td"><font color="#FF0000">&nbsp; </font>计划时间：</td>
            <td   class="crm_input"><script type="text/javascript" src="../js/date_select.js"></script> 
			<?
			$zcdate=date('Y-n-d', time());
			?>
              <input name="jhtime"  onClick="return Calendar('jhtime');" type="text"  value="<?=$zcdate;?>" id="jhtime" size="20"  maxlength="20">
              <select name="jhm" id="jhm" class=crm_select  >
                <option value="上午" selected>上午</option>
                <option value="下午">下午</option>
 
              </select> </td>
            <td align="right"   class="crm_td">地点：</td>
            <td   class="crm_input"><input name="str_address" type="text" id="str_address" size="30" maxlength="50" ></td>
          </tr>
          <tr> 
            <td   class="crm_td">描述：</td>
            <td colspan="3"   class="crm_input"><textarea name="beiz" cols="85" rows="6"  id="beiz" onkeyUp="textLimitCheck(this, 500);"></textarea>
              最多500汉字； 
              <input type="hidden" name="address"  id="address"> <input type="hidden" name="postcode"  id="postcode"></td>
          </tr>
          <tr align="center"> 
            <td colspan="5"   class="crm_submit"> <input type="submit" name="submit" class="submit" value="-保存-" title="保存后并返回管理日程"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="submit" class="submit" value="-保存并新建-" title="保存后并返回当前界面"> 
			  &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
            </td>
          </tr>
        </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、<font color="#000000">新建日程信息请仔细填写</font><font color="#FF0000"> *</font>为必须填写。<br>
      2、选择客户名称时，联系人名、地址均会自动填写，地址信息可手工修改。</td>
  </tr>
</table>