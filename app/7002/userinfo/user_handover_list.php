<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
	if(trim($_SESSION["userdlname"])<>"admin")
		{
			echo "<script language=javascript>alert('非管理员不能进行工作移交!');document.location.href=('user_mody_pwd_list.php');</script>";
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

  if (myform.olduser.value=="")
  {
    alert("原用户必须选择！");
    document.myform.olduser.focus();
    return false;
  }
  
  if (myform.newuser.value=="")
  {
    alert("移交到用户必须选择！");
    document.myform.newuser.focus();
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
    <td>&nbsp;基础管理>工作移交</td>
  </tr>
</table>
<br>

 
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="inputtable">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;工作移交</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
      <form name="myform" method="post" action="user_handoverto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="15%" class="handover">原用户：</td>
            <td width="35%" align="left" class="handover_left"><SELECT   name=olduser size=15 multiple id="olduser" style="background-color:#F0F0F0;">
                <OPTION value="" selected>-请选择原用户-</OPTION>
                <?
          $fenleisql="select * from userinfo";
				  $queryresult=$obj->exec($fenleisql);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);            
				for ($i=0;$i<$ggallrows;$i++)	
				{  
					$userid=trim($arrrow[$i]['userid']);
					$username=trim($arrrow[$i]['username']);
					$stri=$i+1;
					echo "<OPTION value=".$userid."|".$username.">".$stri."、".$username."</OPTION>";
					
					}          
            ?>
              </SELECT></td>
            <td width="15%" class="handover">工作移交给：</td>
            <td width="35%" align="left" class="handover_left"><SELECT   name=newuser size=15 multiple id="select2" style="background-color:#F0F0F0;">
                <OPTION value="" selected>-请选择移交到用户-</OPTION>
                <?
          $fenleisql="select * from userinfo";
				  $queryresult=$obj->exec($fenleisql);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);            
				for ($i=0;$i<$ggallrows;$i++)	
				{  
					$userid=trim($arrrow[$i]['userid']);
					$username=trim($arrrow[$i]['username']);
					$stri=$i+1;
					echo "<OPTION value=".$userid."|".$username.">".$stri."、".$username."</OPTION>";
					
					}          
            ?>
              </SELECT></td>
          </tr>
          <tr> 
            <td width="15%" class="handover">&nbsp;</td>
            <td width="35%" class="handover"><input type="submit" name="Submit" class="submit" value="-确认移交-"></td>
            <td width="15%" class="handover">&nbsp;</td>
            <td width="35%" class="handover">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="4" class="handover_left"><strong>说明：</strong><br>
              1、用户工作移交会涉及系统全部数据，包括客户、联系人、市场活动、商机、日程、销售分析、桌面日记等，如果系统数据量较大，用户较多，速度就会较慢，请慎重使用。&nbsp;&nbsp;&nbsp;&nbsp; 
            </td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<br>
