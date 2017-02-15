<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

	$sql="select * from linkname where id='".$id."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$id=trim($rs->id);
	$username=trim($rs->username);
	$clew=trim($rs->clew);
	$sex=trim($rs->sex);
	$name=trim($rs->name);
	$zhiwu=trim($rs->zhiwu);
	$clientname=trim($rs->clientname);
	$clientid=trim($rs->clientid);
	$officetel=trim($rs->officetel);
	$hometel=trim($rs->hometel);
	$fax=trim($rs->fax);
	$department=trim($rs->department);
	$mobile=trim($rs->mobile);
	$birthday=trim($rs->birthday);
	$assistant=trim($rs->assistant);
	$assistanttel=trim($rs->assistanttel);
	$address=trim($rs->address);
	$postcode=trim($rs->postcode);
	$qq=trim($rs->qq);
	$email=trim($rs->email);
	$skypeid=trim($rs->skypeid);
	$remark=trim($rs->remark);
 
	if ($name=="")
	{
			echo "<script language=javascript>alert('联系人数据错误3');document.location.href=('linkman_manage.php');</script>";
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

  if (myform.xingming.value=="")
  {
    alert("客户姓名不能为空！");
    document.myform.xingming.focus();
    return false;
  }
  if (myform.officetel.value=="")
  {
    alert("请选填写办公固话");
    document.myform.officetel.focus();
    return false;
  }  
 
  if (myform.address.value=="")
  {
    alert("请您选填写联系人联系地址！");
    document.myform.address.focus();
    return false;
  }  
  

 
    
  return true;  
}

  function   openSubWindow(){   
    window.open("linkman_select_client.php","mywin",   "menubar=no,width=410,height=480,resizeable=yes");   
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
          <td>&nbsp;客户资源管理->增加联系人</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          <td bgcolor="#EBEBEB" class="tishi">&nbsp;增加联系人(<font color="#FF0000">*必填写</font>)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="linkman_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr> 
                  <td   class="crm_td">客户所有者：</td>
                  <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
                  <td align="right"   class="crm_td">线索来源：</td>
                  <td   class="crm_tdright"> <select name=xiansuo size=1 id="xiansuo" class="crm_select">
                      <OPTION value="无" selected >-无-</OPTION>
                      <OPTION value="广告" <? if ($clew=="广告") echo "selected";?>>-广告-</OPTION>
                      <OPTION value="推销电话" <? if ($clew=="推销电话") echo "selected";?>>-推销电话-</OPTION>
                      <OPTION value="交易会" <? if ($clew=="交易会") echo "selected";?>>-交易会-</OPTION>
                      <OPTION value="合作伙伴" <? if ($clew=="合作伙伴") echo "selected";?>>-合作伙伴-</OPTION>
                      <OPTION value="外部介绍" <? if ($clew=="外部介绍") echo "selected";?>>-外部介绍-</OPTION>
                      <OPTION value="公开媒体" <? if ($clew=="公开媒体") echo "selected";?>>-公开媒体-</OPTION>
                      <OPTION value="销售邮件" <? if ($clew=="销售邮件") echo "selected";?>>-销售邮件-</OPTION>
                      <OPTION value="网络宣传" <? if ($clew=="网络宣传") echo "selected";?>>-网络宣传-</OPTION>
                      <OPTION value="其他" <? if ($clew=="其他") echo "selected";?>>-其他-</OPTION>
                    </select></td>
                </tr>
                <tr> 
                  <td width="15%"   class="crm_td"> <font color="#FF0000">*</font>姓名：</td>
                  <td width="45%"   class="crm_input"> 
                    <input name="xingming" type="text" id="xingming" value="<?=$name;?>" size="10" maxlength="10" >
                    <select name=sex size=1 id="sex" class="crm_select">
                      <option value="" selected>-性别-</option>
                      <option value="先生" <? if ($sex=="先生") echo "selected";?>>-先生-</option>
                      <option value="女士" <? if ($sex=="女士") echo "selected";?>>-女士-</option>
                    </select> </td>
                  <td width="40%" align="right"   class="crm_td">职务：</td>
                  <td width="40%"   class="crm_tdright"> <input name="zhiwu"  type="text"  id="zhiwu" value="<?=$zhiwu;?>" size="20"  maxlength="30"> 
                </tr>
                <tr> 
                  <td   class="crm_td">所属客户名称：</td>
                  <td   class="crm_input"><input name="clientname" type="text" id="clientname" value="<?=$clientname;?>" size="30" maxlength="40" >&nbsp;<INPUT   class="submit" TYPE="button"   onclick="openSubWindow();"   value="选择">
                    <input type="hidden" name="clientid"  id="clientid" value="<?=$clientid;?>"> </td>
                  <td align="right"   class="crm_td">部门：</td>
                  <td   class="crm_tdright"><input name="bumen"  type="text"  id="bumen" value="<?=$department;?>" size="20"  maxlength="30"></td>
                </tr>
                <tr> 
                  <td   class="crm_td">邮件：</td>
                  <td   class="crm_input"><input name="email" type="text"  id="email" value="<?=$email;?>" size="30" maxlength="40" > 
                  </td>
                  <td align="right"   class="crm_td">住宅电话：</td>
                  <td   class="crm_tdright"><input name="hometel"  type="text" value="<?=$hometel;?>" id="hometel" size="20"  maxlength="30"> 
                  </td>
                </tr>
                <tr id=chinaaddress1> 
                  <td   class="crm_td"><font color="#FF0000">*</font>办公固话：</td>
                  <td   class="crm_input"><input name="officetel"  type="text"  value="<?=$officetel;?>" id="officetel" size="20"  maxlength="30"> 
                  </td>
                  <td align="right"   class="crm_td">手机：</td>
                  <td   class="crm_input"><input name="mobile"  type="text"  id="mobile" size="30" value="<?=$mobile;?>"  maxlength="50"> 
                  </td>
                </tr>
                <tr> 
                  <td   class="crm_td">传真：</td>
                  <td  id=areacodetd class="crm_input"><input name="fax" value="<?=$fax;?>"  type="text"  id="hometel4" size="20"  maxlength="30"></td>
                  <td align="right"   class="crm_td">生日：</td>
                  <td   class="crm_tdright"><script type="text/javascript" src="../js/date_select.js"></script> 
                    <input name="birthday" type="text"  id="birthday" size="20" value="<?=$birthday;?>" onClick="return Calendar('birthday');" maxlength="30"></td>
                </tr>
                <tr> 
                  <td   class="crm_td">QQ：</td>
                  <td   class="crm_input"><input name="qq"  type="text"  id="qq" value="<?=$qq;?>" size="20"  maxlength="30"></td>
                  <td align="right"   class="crm_td">Skype ID：</td>
                  <td   class="crm_tdright"><input name="skypeid"  type="text"  id="skypeid" value="<?=$skypeid;?>" size="20"  maxlength="30"></td>
                </tr>
                <tr> 
                  <td   class="crm_td">助理：</td>
                  <td   class="crm_input"><input name="zhuli"  type="text"  value="<?=$assistant;?>" id="zhuli" size="20"  maxlength="30"></td>
                  <td align="right"   class="crm_td">助理电话：</td>
                  <td   class="crm_tdright"> <input name="zhulitel"  type="text" value="<?=$assistanttel;?>" id="zhulitel" size="20"  maxlength="30"></td>
                </tr>
                <tr> 
                  <td   class="crm_td"><font color="#FF0000">*</font>详细地址：</td>
                  <td   class="crm_input"><input name="address" type="text" id="address" value="<?=$address;?>" size="35" maxlength="40" ></td>
                  <td align="right"   class="crm_td">邮编：</td>
                  <td   class="crm_tdright"><input name="postcode"  type="text"  id="postcode" value="<?=$postcode;?>" size="10"  maxlength="10"></td>
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
                    <br>
                    客户兴趣、爱好、及目前关系等最多500汉字； </td>
                </tr>
                <tr align="center"> 
                  <td colspan="5"   class="crm_submit"> <input type="submit" name="Submit" class="submit" value="-确定新建-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
                    &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons">
                    <input type="hidden" name="id"  id="id" value="<?=$id;?>"> 
                  </td>
                </tr>
              </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、您客户的联系方式，请尽量详细填写 <font color="#FF0000">*</font>为必须填写。<br>
      2、详细地址默认为企业通信地址，如为家庭地址请修改。</td>
  </tr>
</table>