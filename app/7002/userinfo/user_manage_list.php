<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$userid=$_SESSION["userdlname"];
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script>

function ConfirmDel()
{
   if(confirm("确定要删除吗？一旦删除将不能恢复！"))
     return true;
   else
     return false;

}
</script>  

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;用户管理->用户信息管理</td>
  </tr>
</table>
<br>
<br>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="usermanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="7">&nbsp;用户信息管理</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=5% align="center"  class="bianmagxh">序号</td>
				<td  width=15%  class="usermanage_1">用户ID</td>
				<td  width=10%  class="usermanage_1">用户姓名</td>
				<td  width=5%  class="usermanage_1">性别</td>
				<td  width=25%  class="usermanage_1">电话</td>
				<td  width=25%  class="usermanage_1">邮件</td>
				<td  width=15%  class="bianmacz">操作</td>
				</tr>


<?
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								if ($userid=="admin"){
								$gqquery ="SELECT  *  FROM userinfo where userid<>'admin' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_class_pagenum"; 
									}else
									{
										$gqquery ="SELECT  *  FROM userinfo where userid='".$userid."' and userid<>'admin' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_class_pagenum";
										}

							}
							else 
							{ 
								$page = $_REQUEST['page']; 
							if($page<=0) 
								{ 
								$page = 1; 
								$nowpage=0;
								}else 
								{ 
								$nowpage=($page-1)*$dbzz_class_pagenum;
								if ($userid=="admin"){
				  			$gqquery ="SELECT  *  FROM userinfo where userid<>'admin' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_class_pagenum";  
									}else
									{
				  					$gqquery ="SELECT  *  FROM userinfo where userid<>'admin' and userid='".$userid."' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_class_pagenum";  
										}								
								$tempi=$page*$dbzz_class_pagenum-($dbzz_class_pagenum-1);
								}
							}
	  			$query0 ="SELECT id FROM userinfo where userid<>'admin'";
	  			$totalresult=$obj->exec($query0);
				  $allrows=$obj->num_rows($totalresult);


				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);	

				for ($i=0;$i<$ggallrows;$i++)	
				{
				$id=trim($arrrow[$i]['id']);
				$user_id=trim($arrrow[$i]['userid']);
				$username=trim($arrrow[$i]['username']);
				$xingb=trim($arrrow[$i]['xingb']);
				$usertel=trim($arrrow[$i]['usertel']);
				$usermail=trim($arrrow[$i]['usermail']);
				$departmentname=trim($arrrow[$i]['departmentname']);
				$fuze=trim($arrrow[$i]['fuze']);
				if ($fuze==1) $strfuze="<font color=red>[负责]</font>";
				else
				$strfuze="";
				?>
				<tr  onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=5% align="center"   style="padding:2px;height:20px;line-height:20px;border-bottom:1px solid #e0e0e0;"><?=$tempi;?></td>
				<td  width=15%  class="usermanage_2"><?=$user_id;?></td>
				<td  width=10%  class="usermanage_2"><?=$username;?></td>
				<td  width=5%  class="usermanage_2"><?=$xingb;?></td>
				<td  width=25%  class="usermanage_2"><?=$usertel."/".$departmentname.$strfuze;?></td>
				<td  width=25%  class="usermanage_2"><?=$usermail;?></td>
				<td  width=15%  style="padding:2px;height:20px;line-height:20px;border-left:1px solid #e0e0e0;border-bottom:1px solid #e0e0e0;">
					<?
					echo "<a href='user_edit_list.php?userid=".$user_id."'>编辑</a> <a href='user_del.php?id=".$id."' onclick='return ConfirmDel();'>删除</a>";
					?>
					
					</td>
					</tr>
				<?
					$tempi++;
						
					}	
?>	
				<tr>
				<td  width=100% align="center" bgcolor="#FFFFFF" style="padding:2px;height:22px;line-height:22px;border-bottom:1px solid #e8e8e8;" colspan="7">
	          <?
	$sumrows=$allrows;//总行数
	$pagelistnum=$dbzz_class_pagenum;//每页显示数量
	$link="user_manage_list.php?class=".$queryclass;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>