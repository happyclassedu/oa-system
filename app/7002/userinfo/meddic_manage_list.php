<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$chancename=chkstring(addslashes(trim($_POST['chancename'])));
$userid=$_SESSION["userdlname"];
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								$chancename=chkstring(addslashes(trim($_POST['chancename'])));
								$select_class=chkstring(addslashes(trim($_POST['select_class'])));
								if ($select_class=="") $select_class="企业名称"; 
								switch ($select_class) {
								    case "企业名称":
												if ($chancename<>"")
												{
													$gqquery ="SELECT  *  from meddic where userid='".$userid."' and chancename like '%".$chancename."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
													}
													else
													{
														$gqquery ="SELECT  *  from meddic where userid='".$userid."'  ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
														}
								        break;
								    case "日程标题":
												if ($chancename<>"")
												{
													$gqquery ="SELECT  *  from meddic where userid='".$userid."' and rctitle like '%".$chancename."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
													}
													else
													{
														$gqquery ="SELECT  *  from meddic where userid='".$userid."'  ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
														}
								        break;

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
								$chancename=chkstring(addslashes(trim($_GET['chancename'])));
								$select_class=chkstring(addslashes(trim($_GET['select_class'])));
								if ($select_class=="") $select_class="企业名称"; 
								switch ($select_class) {
								    case "企业名称":
												if ($chancename<>"")
												{				  			
								  				$gqquery ="SELECT  *  from meddic WHERE userid='".$userid."' and chancename like '%".$chancename."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
													}
													else
													{
								  					$gqquery ="SELECT  *  from meddic WHERE userid='".$userid."' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
														}
								        break;
								    case "日程标题":
												if ($chancename<>"")
												{				  			
								  				$gqquery ="SELECT  *  from meddic WHERE userid='".$userid."' and rctitle like '%".$chancename."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
													}
													else
													{
								  					$gqquery ="SELECT  *  from meddic WHERE userid='".$userid."' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
														}
								        break;

								}								

								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}


								switch ($select_class) {
								    case "企业名称":
												if ($chancename<>"")
												{	
													$query0 ="SELECT id from meddic where chancename like '%".$chancename."%' and  userid='".$userid."'";
													}
													else
													{
														$query0 ="SELECT id from meddic where userid='".$userid."'";
														}
								        break;
								    case "日程标题":
												if ($chancename<>"")
												{	
													$query0 ="SELECT id from meddic where rctitle like '%".$chancename."%' and  userid='".$userid."'";
													}
													else
													{
														$query0 ="SELECT id from meddic where userid='".$userid."'";
														}
								        break;

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
    <td>&nbsp;MEDDIC分析->管理我的分析</td>
  </tr>
</table>

<form name="myform" method="post" action="meddic_manage_list.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
  <tr> 
            <td width="10%" height="27" align="center" bgcolor="DBDEF4" class="select_class">商机名称
 </td>
    <td width="36%" bgcolor="DBDEF4" class="select_class"><input name="chancename"  type="text"  value="<?=$chancename;?>" id="chancename" size="20"  maxlength="30">
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
    <td bgcolor="#EBEBEB" class="tishi" colspan="10">&nbsp;MEDDIC信息管理</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">序号</td>
				<td  width=2%  class="usermanage_1">商机名称</td>
				<td  width=7%  class="usermanage_1" title="描述可量化的效益、投入产出比（请选择投入为1时的产出比，产出比越大说明对客户越有利）"> Metrics </td>
				<td  width=7%  class="usermanage_1" title="资金决策人（请选择与资金决策人关系） ">Economic</td>
				<td  width=7%  class="usermanage_1" title="了解客户标准的决策流程（包括是否了解客户的组织结构关系，能画出组织结构关系图）">Criteria</td>
				<td  width=7%  class="usermanage_1" title="本次机会的评估、实施、决策流程">Process</td>
				<td  width=7%  class="bianmacz" title="经客户确认的客户痛处（了解客户痛处，并可以解决客户痛处百分比）">Pain</td>
				<td  width=24%  class="bianmacz" title="在组织中有权利、有影响力、愿意为你销售的人，即你的拥护者，客户内部支持你的人">Champions</td>
				<td  width=7%  class="bianmacz">成功率</td>
				<td  width=10%  class="bianmacz">操作</td>
				</tr>


<?
if ($ggallrows==0)
{
	echo "<tr><td align='center' height='25' bgcolor='#FFFFFF' colspan='10'>暂无您要查询的数据！</td></tr>";
	}


				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$adduser=trim($arrrow[$i]['userid']);
					$client_name=trim($arrrow[$i]['chancename']);
					$chanceid=trim($arrrow[$i]['chanceid']);
					$metrics=trim($arrrow[$i]['metrics']);
					$economic=trim($arrrow[$i]['economic']);
					$criteria=trim($arrrow[$i]['criteria']);
 					$process=trim($arrrow[$i]['process']);
          $pain=trim($arrrow[$i]['pain']);
          $champions=trim($arrrow[$i]['champions']);
          if ($champions==30) $strcam="总裁(CEO/C*O)";
          if ($champions==20) $strcam="副总/总工/财务总监等";
          if ($champions==10) $strcam="部门级主管";
          if ($champions==1) $strcam="普通职员";
          $championszt=trim($arrrow[$i]['championszt']);
          $str_cham=$champions+$championszt;
          $str_success=$metrics+$economic+$criteria+$process+$pain+$str_cham;
          if ($str_success<=0) $str_success="没机会";
          else
					$str_success=$str_success."%左右";
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=4% align="center"  style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;"><?=$tempi;?></td>
				<td  width=20%  class="usermanage_2" nowrap><a href="meddic_detail.php?id=<?=$id;?>" target="_self" title="查看本项目详细分析"><?=$client_name;?></a></td>
				<td  width=7%  class="usermanage_2"> <?=$metrics;?>分 </td>
				<td  width=7%  class="usermanage_2" nowrap> <?=$economic;?>分 </td>
				<td  width=7%  class="usermanage_2"><?=$criteria;?>分</td>
				<td  width=7%  class="usermanage_2"><?=$process;?>分</td>
				<td  width=7%  class="usermanage_2"><?=$pain;?>分</td>
				<td  width=24%  class="usermanage_2"><?=$strcam." ".$str_cham;?>分</td>
				<td  width=7%  class="usermanage_2"><font color=red><?=$str_success;?></font></td>
				<td  width=10%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">	
					<?
					if ($adduser==trim($_SESSION["userdlname"]) or "admin"==trim($_SESSION["userdlname"])) echo "  <a href='meddic_del.php?id=".$id."' onclick='return ConfirmDel();' title='如客户下存在联系人，则不允许删除。'>删除</a>";
					else echo "<font color='BCBCBC' title='非管理员不能对编码进行任何操作！'>查看 删除</font>";
					?>					
					</td>
					</tr>
				<?
					$tempi++;
						
					}	
?>	
				<tr>
				<td  width=100% align="center" bgcolor="#FFFFFF" style="padding:2px;height:22px;line-height:22px;border-bottom:1px solid #e8e8e8;" colspan="10">
	          <?
	$sumrows=$allrows;//总行数
	$pagelistnum=$dbzz_bianma_pagenum;//每页显示数量
	$link="meddic_manage_list.php?chancename=".rawurlencode($chancename)."&select_class=".rawurlencode($select_class);
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>