<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$marketname=chkstring(addslashes(trim($_POST['marketname'])));
$userid=$_SESSION["userdlname"];
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								$marketname=chkstring(addslashes(trim($_POST['marketname'])));
//								$gqquery ="SELECT  *  from market ORDER BY classcode desc,code"; 
								if ($marketname<>"")
								{
									$gqquery ="SELECT  *  from market where userid='".$userid."' and marketname like '%".$marketname."%' ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
									}
									else
									{
										$gqquery ="SELECT  *  from market where userid='".$userid."'  ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
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
								$nowpage=($page-1)*$dbzz_bianma_pagenum;
								$marketname=chkstring(addslashes(trim($_GET['marketname'])));
//				  			$gqquery ="SELECT  *  from market WHERE id NOT IN (SELECT TOP ".$nowpage." id from market ORDER BY classcode desc,code) ORDER BY classcode desc,code";  
								if ($marketname<>"")
								{				  			
				  				$gqquery ="SELECT  *  from market WHERE userid='".$userid."' and marketname like '%".$marketname."%' ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
									}
									else
									{
				  					$gqquery ="SELECT  *  from market WHERE userid='".$userid."' ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
										}
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
							
					if ($marketname<>"")
					{	
						$query0 ="SELECT id from market where marketname like '%".$marketname."%' and  userid='".$userid."'";
						}
						else
						{
							$query0 ="SELECT id from market where userid='".$userid."'";
							}
//							echo $gqquery;
//							exit;
	  			$totalresult=$obj->exec($query0);
				  $allrows=$obj->num_rows($totalresult);


				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);
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
    <td>&nbsp;客户资源管理->管理市场活动</td>
  </tr>
</table>

<form name="myform" method="post" action="market_manage_list.php"   style="padding:0px;margin:0px 0px 0px 0px;">	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
  <tr> 
            <td width="10%" height="27" align="center" bgcolor="DBDEF4" class="select_class">
市场活动名称</td>
    <td width="36%" bgcolor="DBDEF4" class="select_class"><input name="marketname"  value="<?=$marketname;?>" type="text"  id="marketname" size="20"  maxlength="30">
              &nbsp;
              <input type="submit" name="Submit" class="submit" value="-查找-"></td>
            <td width="26%" bgcolor="DBDEF4" class="select_class">&nbsp;</td>
    <td width="11%" bgcolor="DBDEF4" class="select_class"></td>
    <td width="17%" bgcolor="DBDEF4" class="select_class"></td>
  </tr>
</table>
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="bianmamanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="7">&nbsp;管理市场活动</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">序号</td>
				<td  width=11%  class="usermanage_1">类型</td>
				<td  width=25%  class="usermanage_1">市场活动名称</td>
				<td  width=10%  class="usermanage_1">预算成本</td>
				<td  width=8%  class="usermanage_1">期望成功率</td>
				<td  width=34%  class="usermanage_1">开始及结束日期</td>
				<td  width=8%  class="bianmacz">操作</td>
				</tr>


<?
if ($ggallrows==0)
{
	echo "<tr><td align='center' bgcolor='#FFFFFF' height='25' colspan='7'>暂无您要查询的数据！</td></tr>";
	}


				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$market_name=trim($arrrow[$i]['marketname']);
					$username=trim($arrrow[$i]['username']);
					$yuscb=trim($arrrow[$i]['yuscb']);
					$qiwcgl=trim($arrrow[$i]['qiwcgl']);
					$starttime=trim($arrrow[$i]['starttime']);
					$endtime=trim($arrrow[$i]['endtime']);
					$leix=trim($arrrow[$i]['leix']);

					
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=4% align="center"  style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;"><?=$tempi;?></td>
				<td  width=11%  class="usermanage_2" nowrap> <?=$leix;?> </td>
				<td  width=25%  class="usermanage_2"><a href="client_detail.php?id=<?=$id;?>" target="_blank" title="查看[<?=$market_name;?>] 市场活动详细信息！"><?=$market_name;?></a></td>
				<td  width=10%  class="usermanage_2" nowrap><?=$yuscb;?></td>
				<td  width=8%  class="usermanage_2"><?=$qiwcgl."%";?></td>
				<td  width=34%  class="usermanage_2"><?=$starttime."至".$endtime;?></td>
				<td  width=8%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">
					<?
					if ($adduser==trim($_SESSION["userdlname"]) or "admin"==trim($_SESSION["userdlname"])) echo "<a href='market_edit_list.php?id=".$id."' title=编辑此数据>编辑</a> <a href='market_del.php?id=".$id."' onclick='return ConfirmDel();' title='如客户下存在联系人，则不允许删除。'>删除</a>";
					else echo "<font color='BCBCBC' title='非管理员不能对编码进行任何操作！'>编辑 删除</font>";
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
	$pagelistnum=$dbzz_bianma_pagenum;//每页显示数量
	$link="market_manage_list.php?marketname=".rawurlencode($marketname);
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>