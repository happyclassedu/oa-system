<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$global_websitename;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
window.status="欢迎使用<?=$global_websitename;?>！";
</script>

</head>

<body style="margin:0px 0px 0px 0px;" >
<?require_once('../inc/head.inc.php');?>

<table  class="allbody" border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" nowrap  id="frmTitle"  class="class_left" name="frmTitle">
   	 <?require_once('base_left.php');?>    	

    	
    </td>
    <td width="8" id="switchPoint" title="开启关闭左侧导航栏" class="class_bar"   onClick="switchSysBar()"><img src=../myimages/1/toggler_2.gif></td>
    <td align="center" valign="top"  class="class_right">

<script>

function ConfirmDel()
{
   if(confirm("删除后出入库记录并不更新，确定要删除吗？一旦删除将不能恢复！"))
     return true;
   else
     return false;

}
</script> 

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;基础数据->管理供应商</td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
  <tr>
    <td height="27" bgcolor="DBDEF4">&nbsp;</td>
  </tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="bianmamanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="9">&nbsp;供应商信息管理</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">序号</td>
				<td  width=31%  class="usermanage_1">供应商名称</td>
				<td  width=15%  class="usermanage_1">联系人</td>
				<td  width=37%  class="usermanage_1">电话/手机</td>

				<td  width=13%  class="bianmacz">操作</td>
				</tr>


<?
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								$gqquery ="SELECT TOP ".$dbzz_bianma_pagenum." *  FROM provide ORDER BY id desc";  

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
				  			$gqquery ="SELECT TOP ".$dbzz_bianma_pagenum." *  FROM provide WHERE id NOT IN (SELECT TOP ".$nowpage." id FROM provide ORDER BY id desc) ORDER BY id desc";  
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
	  			$query0 ="SELECT id FROM provide";
	  			$totalresult=$obj->exec($query0);
				  $allrows=$obj->num_rows($totalresult);


				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);	

				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
				$companyname=trim($arrrow[$i]['companyname']);
				$mobile=trim($arrrow[$i]['mobile']);
				$telcountrycode=trim($arrrow[$i]['telcountrycode']);
				$telareacode=trim($arrrow[$i]['telareacode']);
				$tel=trim($arrrow[$i]['tel']);
				$linkname=trim($arrrow[$i]['linkname']);
				$adduser=trim($arrrow[$i]['adduser']);

				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=4% align="center"  style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;"><?=$tempi;?></td>
				<td  width=31%  class="usermanage_2"><?=$companyname;?></td>
				<td  width=15%  class="usermanage_2"><?=$linkname;?></td>
				<td  width=37%  class="usermanage_2" nowrap><?=$telcountrycode."-".$telareacode."-".$tel;?></td>

				<td  width=13%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">
					<?
					if ($adduser==$_SESSION["userdlname"] or $_SESSION["userdlname"]=="admin") echo "<a href='provide_edit.php?id=".$id."' title=编辑此数据>编辑</a> <a href='provide_del.php?id=".$id."' onclick='return ConfirmDel();'>删除</a>";
					else echo "<font color='BCBCBC' title='非当前用户增加，不能操作'>编辑 删除</font>";
					?>
					
					</td>
					</tr>
				<?
					$tempi++;
						
					}	
?>	
				<tr>
				<td  width=100% align="center" bgcolor="#FFFFFF" style="padding:2px;height:22px;line-height:22px;border-bottom:1px solid #e8e8e8;" colspan="9">
	          <?
	$sumrows=$allrows;//总行数
	$pagelistnum=$dbzz_bianma_pagenum;//每页显示数量
	$link="provide_manage.php?class=".$queryclass;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>
 
    </td>
  </tr>
</table>

</body>
</html>