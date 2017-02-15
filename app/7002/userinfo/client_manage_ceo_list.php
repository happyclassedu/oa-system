<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
function nyye($jylx)
{
         switch($jylx)
          {
           case 1://seconds
               echo "少于1百万";
               break;

           case 2://minutes
               echo "1百万-5百万";
               break;

           case 3://minutes
               echo "5百万-1千万";
               break;

           case 4://minutes
               echo "1千万-3千万";
               break;

           case 5://minutes
               echo "3千万-5千万";
               break;

           case 6://minutes
               echo "5千万-1个亿";
               break;
           case 7://minutes
               echo "1个亿-5个亿";
               break;
           case 8://minutes
               echo "5个亿-10个亿";
               break;
           case 9://minutes
               echo "10个亿-50个亿";
               break;
           case 10://minutes
               echo "100个亿以上";
               break;      
           default:
           	   echo "未填写";
           	   break;         
         }	
	} 
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								$clientname=chkstring(addslashes(trim($_POST['clientname'])));
								if ($clientname<>"")
								$gqquery ="SELECT  *  from client where clientname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
								else
								$gqquery ="SELECT  *  from client ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
								 

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
								$clientname=chkstring(addslashes(trim($_GET['clientname'])));
								$nowpage=($page-1)*$dbzz_bianma_pagenum;
								if ($clientname<>"")
				  			$gqquery ="SELECT  *  from client WHERE clientname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
								else
								$gqquery ="SELECT  *  from client ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
					if ($clientname<>"")
					$query0 ="SELECT id from client WHERE clientname like '%".$clientname."%'";
					else
	  			$query0 ="SELECT id from client";
	  			
//	  			echo $clientname;
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
    <td>&nbsp;客户资源管理->领导查询</td>
  </tr>
</table>

<form name="myform" method="post" action="client_manage_ceo_list.php" onsubmit="return FormCheck();">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
    <tr> 
      <td width="10%" height="27" align="center" bgcolor="DBDEF4" class="select_class"> 
        客户名称</td>
      <td width="36%" bgcolor="DBDEF4" class="select_class"><input name="clientname"  value="<?=$clientname;?>" type="text"  id="clientname" size="20"  maxlength="30"> 
        &nbsp; <input type="submit" name="Submit" class="submit" value="-查找-"></td>
      <td width="26%" bgcolor="DBDEF4" class="select_class">&nbsp;</td>
      <td width="11%" bgcolor="DBDEF4" class="select_class"></td>
      <td width="17%" bgcolor="DBDEF4" class="select_class"></td>
    </tr>
  </table>
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="bianmamanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="7">&nbsp;领导可查询客户信息</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">序号</td>
				<td  width=25%  class="usermanage_1">客户名称</td>
				<td  width=11%  class="usermanage_1">所属行业</td>
				<td  width=10%  class="usermanage_1">年营业额RMB</td>
				<td  width=8%  class="usermanage_1">员工人数</td>
				<td  width=34%  class="usermanage_1">联系电话及传真</td>
				<td  width=8%  class="bianmacz">所有者</td>
				</tr>


<?
if ($ggallrows==0)
{
	echo "<tr><td align='center' height='25' bgcolor='#FFFFFF' colspan='7'>暂无您要查询的数据！</td></tr>";
	}

				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$str_clientname=trim($arrrow[$i]['clientname']);
					$calling=trim($arrrow[$i]['calling']);
					$yye=trim($arrrow[$i]['yye']);
					$ygrs=trim($arrrow[$i]['ygrs'])."<font color=999999>人左右</font>";
					$tel=trim($arrrow[$i]['tel']);
					$telcountrycode=trim($arrrow[$i]['telcountrycode']);
					$telareacode=trim($arrrow[$i]['telareacode']);
					$faxcountrycode=trim($arrrow[$i]['faxcountrycode']);
					$faxareacode=trim($arrrow[$i]['faxareacode']);
					$fax=trim($arrrow[$i]['fax']);
					$username=trim($arrrow[$i]['username']);
					$str_tel="<font color=#2B3580>Tel:".$telcountrycode."-".$telareacode."-".$tel."</font>";
					$str_fax=" Fax:".$faxcountrycode."-".$faxareacode."-".$fax;
					
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=4% align="center"  style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;"><?=$tempi;?></td>
				<td  width=25%  class="usermanage_2" nowrap><a href="client_detail.php?id=<?=$id;?>" target="_blank" title="查看[<?=$str_clientname;?>]详细信息！"><?=$str_clientname;?></a></td>
				<td  width=11%  class="usermanage_2"><?=$calling;?></td>
				<td  width=10%  class="usermanage_2" nowrap><?=nyye($yye);?></td>
				<td  width=8%  class="usermanage_2"><?=$ygrs;?></td>
				<td  width=34%  class="usermanage_2"><?=$str_tel.$str_fax;?></td>
				<td  width=8%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">&nbsp;<?=$username;?>
					<?
//					if ($adduser==trim($_SESSION["userdlname"]) or "admin"==trim($_SESSION["userdlname"])) echo "<a href='client_edit_list.php?id=".$id."' title=编辑此数据>编辑</a> <a href='client_del.php?id=".$id."' onclick='return ConfirmDel();' title='如客户下存在联系人，则不允许删除。'>删除</a>";
//					else echo "<font color='BCBCBC' title='非管理员不能对编码进行任何操作！'>编辑 删除</font>";
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
	$link="client_manage_ceo_list.php?clientname=".$clientname;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>
<br> 