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

  if (myform.old_pwd.value=="")
  {
    alert("原密码必须填写！");
    document.myform.old_pwd.focus();
    return false;
  }
  
  if (myform.userpwd.value=="")
  {
    alert("请您填写新密码！");
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
   return true;   
}


function ConfirmDel()
{
   if(confirm("确定要删除吗？一旦删除将不能恢复！"))
     return true;
   else
     return false;

}


//-->
</script>

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;个人设置->修改密码</td>
  </tr>
</table>
<br>

 
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="inputtable">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;修改密码</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
      <form name="myform" method="post" action="user_modypwdto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">原密码：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="old_pwd" type="password" id="old_pwd" size="20" maxlength="30">
            </td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">注意全部为半角符号</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">新密码：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="userpwd" type="password" id="old_pwd3" size="20" maxlength="30"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">注意全部为半角符号</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">确认密码：</td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input name="userpwdconfirm" type="password" id="new_pwd" size="20" maxlength="30"> 
            </td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">注意全部为半角符号</td>
          </tr>
          <tr> 
            <td   style="text-align:right;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">&nbsp; 
            </td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:45%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"> 
              <input type="submit" name="Submit" class="submit" value="-确认修改-"></td>
            <td   style="text-align:left;height:25px;line-height:25px;padding:2px;width:40%;border-bottom:1px solid #e8e8e8;">&nbsp;</td>
          </tr>
          <tr align="left"> 
            <td colspan="3"   style="text-align:left;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;"> 
              <strong>说明：</strong><br>
              1、原密码必须填写。&nbsp;&nbsp;&nbsp;&nbsp; </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<br>
