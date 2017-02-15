<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$userid=$_GET['userid'];

	$sql="select * from userinfo where userid='".$userid."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$userpwd=trim($rs->userpwd);
	$username=trim($rs->username);
	$xingb=trim($rs->xingb);
	$usertel=trim($rs->usertel);
	$usermail=trim($rs->usermail);
	$department_id=trim($rs->departmentid);
	$fuze=trim($rs->fuze);
//	echo $department_id;
	if ($username=="")
	{
			echo "<script language=javascript>alert('用户数据错误3');document.location.href=('user_manage.php');</script>";
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

  if (myform.userid.value=="")
  {
    alert("请您填写用户ID！");
    document.myform.userid.focus();
    return false;
  }
  
var filter=/^\s*[A-Za-z0-9_-]{4,20}\s*$/;
if (!filter.test(document.myform.userid.value)) { 
alert("用户名填写不正确,请重新填写！可使用的字符为（A-Z a-z 0-9 下划线 减号）长度不小于4个字符，不超过20个字符，注意不要使用空格。"); 
document.myform.username.focus();
//document.myform.username.select();
return false; 
}   
  
  if (myform.userpwd.value=="")
  {
    alert("请您填写密码！");
    document.myform.userpwd.focus();
    return false;
  }  
  
var filter=/^\s*[A-Za-z0-9_-]{4,20}\s*$/;
if (!filter.test(document.myform.userpwd.value)) { 
alert("密码填写不正确,请重新填写！可使用的字符为（A-Z a-z 0-9 下划线 减号）长度不小于4个字符，不超过20个字符，注意不要使用空格。"); 
document.myform.userpwd.focus();
document.myform.userpwd.select();
return false; 
}   
  
  if (myform.userpwdconfirm.value=="")
  {
    alert("请您填写确认密码！");
    document.myform.userpwdconfirm.focus();
    return false;
  }    

if (document.myform.userpwd.value!=document.myform.userpwdconfirm.value ){
alert("两次填写的密码不一致，请重新填写！"); 
document.myform.userpwd.focus();
document.myform.userpwd.select();
return false; 
}   
	
  if (myform.username.value=="")
  {
    alert("请您填写姓名！");
    document.myform.username.focus();
    return false;
  } 
  if (myform.xingb.value=="")
  {
    alert("请您选择性别！");
    document.myform.xingb.focus();
    return false;
  }
  if (myform.department.value=="")
  {
    alert("请您选择所属部门！");
    document.myform.department.focus();
    return false;
  }  
           
  if (myform.usertel.value=="")
  {
    alert("请您填写电话！");
    document.myform.usertel.focus();
    return false;
  } 


  if (myform.usermail.value=="")
  {
    alert("请您填写电子邮件！");
    document.myform.usermail.focus();
    return false;
  }   
  
var str1 = document.myform.usermail.value
if(str1.indexOf("@") == -1 || str1.indexOf(".") == -1){ 
alert("E-mail格式不正确,请重新填写！"); 
document.myform.usermail.focus();
document.myform.usermail.select();
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
    <td>&nbsp;用户管理->增加用户</td>
  </tr>
</table>
<br>

<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="inputtable" style="padding:0px;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;增加用户(以下全部为必填项)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="user_editto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">用户ID：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">
              <?=$userid;?>
              <input type="hidden" name="userid" value="<?echo $userid;?>"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">例:张三丰，用户ID建议为zhangsf(4-20位)</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">密码：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"> 
              <input name="userpwd" type="text" value="<?=$userpwd;?>" id="userpwd" size="10" maxlength="20"></td>
            <td rowspan="2"   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">可使用的字符为（A-Z 
              a-z 0-9 下划线 减号）长度不小于4个字符，不超过20个字符</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">确认密码：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="userpwdconfirm" type="text" value="<?=$userpwd;?>" id="userpwdconfirm" size="10" maxlength="20"></td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">用户姓名：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="username" type="text" id="username" value="<?=$username;?>" size="10" maxlength="10"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">汉字或常用称呼</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">性别：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"> 
              <?
							$xingb=trim(str_replace("男","nan",$xingb));
							$xingb=trim(str_replace("女","nv",$xingb));

							?>
              <SELECT   name=xingb size=1 id="select" style="background-color:#F0F0F0;">
                <OPTION value="" >-请选择性别-</OPTION>
                <OPTION value="男" <?if (strcmp($xingb,"nan")==0) echo"selected";?>>男</OPTION>
                <OPTION value="女" <?if (strcmp($xingb,"nv")==0) echo"selected";?>>女</OPTION>
              </SELECT></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">&nbsp;</td>
          </tr>
          <tr>
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">所属部门：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"> 
              <SELECT   name=department size=1 id="department" style="background-color:#F0F0F0;">
                <OPTION value="" selected>-请选择部门-</OPTION>
                <?
          $fenleisql="select * from department";
				  $queryresult=$obj->exec($fenleisql);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);            
				for ($i=0;$i<$ggallrows;$i++)	
				{  
					$departmentname=trim($arrrow[$i]['departmentname']);
					$departmentid=trim($arrrow[$i]['departmentid']);
					if ($departmentid==$department_id) $partid="selected";
					else $partid="";
					echo "<OPTION value=".$departmentid."|".$departmentname." ".$partid.">-".$departmentname."|".$departmentid."-</OPTION>";
					
					}          
            ?>
              </SELECT>
              <input name="fuze" type="checkbox" id="fuze" value="1" <?if ($fuze==1) echo "checked";?>> <label for="fuze">是/否部门负责人</label></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">&nbsp;</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">电话：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="usertel" type="text" value="<?=$usertel;?>" id="usertel" size="30" maxlength="40"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">任何电话号码，多个号码以半角逗号&quot;,&quot;分隔</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">邮件：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="usermail" type="text" value="<?=$usermail;?>" id="usermail" size="30" maxlength="40"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">常用电子邮件</td>
          </tr>
          <tr align="center"> 
            <td colspan="3"   style="text-align:center;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input type="submit" name="Submit" class="submit" value="-修改-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
            </td>
          </tr>
        </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、管理员ID:admin不允许添加与删除。<br>
      2、用户ID一旦增加，并且使用此用户增加过任何数据后，此ID即不能删除。<br>
      3、工作失误责任以用户ID为准(如出入库统计等)，所以请妥善保管您的ID，登录后自行修改密码。</td>
  </tr>
</table>