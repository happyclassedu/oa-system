<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

	$sql="select * from calendar where id='".$id."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$id=trim($rs->id);
	$rctitle=trim($rs->rctitle);
	$activitytype=trim($rs->activitytype);
 
	$clientname=trim($rs->clientname);
	$clientid=trim($rs->clientid);
	
	$linkname=trim($rs->linkname);
	$linknameid=trim($rs->linknameid);
	$eventstatus=trim($rs->eventstatus);
	$jhtime=trim($rs->jhtime);
	$jhm=trim($rs->jhm);
	$str_address=trim($rs->str_address);
	$remark=trim($rs->remark);
 
 
	if ($rctitle=="")
	{
			echo "<script language=javascript>alert('ERROR数据错误3');document.location.href=('calendar_manage.php');</script>";
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
	<form name="myform" method="post" action="calendar_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td   class="crm_td">负责人：</td>
            <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
            <td align="right"   class="crm_td">日程类型：</td>
            <td   class="crm_tdright"> <select name="activitytype" class="crm_select" >
                <option value="电话拜访" <?if ($activitytype=="电话拜访") echo "selected";?>>电话拜访</option>
                <option value="会议" <?if ($activitytype=="会议") echo "selected";?>>会议</option>
                <option value="电子邮件" <?if ($activitytype=="电子邮件") echo "selected";?>>电子邮件</option>
                <option value="上门拜访" <?if ($activitytype=="上门拜访") echo "selected";?>>上门拜访</option>
                <option value="邮寄" <?if ($activitytype=="邮寄") echo "selected";?>>邮寄</option>
                <option value="传真" <?if ($activitytype=="传真") echo "selected";?>>传真</option>
                <option value="短信" <?if ($activitytype=="短信") echo "selected";?>>短信</option>
				<option value="其他" <?if ($activitytype=="其他") echo "selected";?>>其他</option>
              </select>
              <font color="#FF0000">&nbsp; </font></td>
          </tr>
          <tr> 
            <td width="15%"   class="crm_td"><font color="#FF0000">*</font>日程主题： 
            </td>
            <td width="45%"   class="crm_input"><input name="rctitle" value="<?=$rctitle;?>" type="text" id="rctitle" size="30" maxlength="50" > 
            </td>
            <td width="40%" align="right"   class="crm_td"><font color="#FF0000">&nbsp; 
              </font>拜访客户：</td>
            <td width="40%"   class="crm_tdright"><input name="clientname" type="text" value="<?=$clientname;?>"  id="clientname" size="30" maxlength="40" readonly> 
              <input type="hidden" name="clientid"  id="clientid" value="<?=$clientid;?>"> <input name="select_linkman" type="button"   class="submit" id="select_linkman"   onClick="select_linkmans();"   value="选择" title="选择客户时，联系人也会自动填写！"> 
          </tr>
          <tr> 
            <td   class="crm_td"><font color="#FF0000">&nbsp; </font>联系人名：</td>
            <td   class="crm_input"> <input name="linkname" type="text" value="<?=$linkname;?>" id="linkname" readonly size="10" maxlength="20" > 
              <input type="hidden" name="linknameid"  id="linknameid" value="<?=$linknameid;?>"> </td>
            <td align="right"   class="crm_td"><font color="#FF0000">&nbsp; </font>阶段：</td>
            <td   class="crm_tdright"> <select name="eventstatus" id="eventstatus" class=crm_select  >
                <option value="已计划" <?if ($eventstatus=="已计划") echo "selected";?>>已计划</option>
                <option value="处理中" <?if ($eventstatus=="处理中") echo "selected";?>>处理中</option>
                <option value="未开始" <?if ($eventstatus=="未开始") echo "selected";?>>未开始</option>
                <option value="未完成" <?if ($eventstatus=="未完成") echo "selected";?>>未完成</option>
                <option value="延期" <?if ($eventstatus=="延期") echo "selected";?>>延期</option>
                <option value="已完成" <?if ($eventstatus=="已完成") echo "selected";?>>已完成</option>
              </select> </td>
          </tr>
          <tr id=chinaaddress1> 
            <td   class="crm_td"><font color="#FF0000">&nbsp; </font>计划时间：</td>
            <td   class="crm_input"><script type="text/javascript" src="../js/date_select.js"></script> 
			<?
			$zcdate=date('Y-n-d', time());
			?>
              <input name="jhtime"  value="<?=$jhtime;?>" onClick="return Calendar('jhtime');" type="text"  value="<?=$zcdate;?>" id="jhtime" size="20"  maxlength="20">
              <select name="jhm" id="jhm"  class=crm_select  >
                <option value="上午" <?if ($eventstatus=="上午") echo "selected";?>>上午</option>
                <option value="下午" <?if ($eventstatus=="下午") echo "selected";?>>下午</option>
 
              </select> </td>
            <td align="right"   class="crm_td">地点：</td>
            <td   class="crm_input"><input name="str_address" value="<?=$str_address;?>"  type="text" id="str_address" size="30" maxlength="50" ></td>
          </tr>
          <tr> 
            <td   class="crm_td">描述：</td>
            <td colspan="3"   class="crm_input">
<?
		  					$spintr=trim($remark);

					$spintr=str_replace("<br />","", $spintr);

                    	$spintr=str_replace("&nbsp;", " ", $spintr);
		  ?>            	
            	<textarea name="beiz" cols="85" rows="6"  id="beiz" onkeyUp="textLimitCheck(this, 500);"><?=stripslashes($spintr);?></textarea>
              最多500汉字； 
              <input type="hidden" name="id"  id="id" value="<?=$id;;?>">
              
              </td>
          </tr>
          <tr align="center"> 
            <td colspan="5"   class="crm_submit"> <input type="submit" name="submit" class="submit" value="-确定编辑-" title="编辑后并返回管理日程"> 
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