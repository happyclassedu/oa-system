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
									$gqquery ="SELECT  *  from market where  marketname like '%".$marketname."%' ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
									}
									else
									{
										$gqquery ="SELECT  *  from market  ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
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
				  				$gqquery ="SELECT  *  from market WHERE  marketname like '%".$marketname."%' ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
									}
									else
									{
				  					$gqquery ="SELECT  *  from market ORDER BY addtime desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
										}
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
							
					if ($marketname<>"")
					{	
						$query0 ="SELECT id from market where marketname like '%".$marketname."%'";
						}
						else
						{
							$query0 ="SELECT id from market ";
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
   if(confirm("ȷ��Ҫɾ����һ��ɾ�������ָܻ���"))
     return true;
   else
     return false;

}
</script> 

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;�ͻ���Դ����->�����г��</td>
  </tr>
</table>

<form name="myform" method="post" action="market_manage_ceo_list.php"   style="padding:0px;margin:0px 0px 0px 0px;">	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
  <tr> 
            <td width="10%" height="27" align="center" bgcolor="DBDEF4" class="select_class">
�г������</td>
    <td width="36%" bgcolor="DBDEF4" class="select_class"><input name="marketname"  value="<?=$marketname;?>" type="text"  id="marketname" size="20"  maxlength="30">
              &nbsp;
              <input type="submit" name="Submit" class="submit" value="-����-"></td>
            <td width="26%" bgcolor="DBDEF4" class="select_class">&nbsp;</td>
    <td width="11%" bgcolor="DBDEF4" class="select_class"></td>
    <td width="17%" bgcolor="DBDEF4" class="select_class"></td>
  </tr>
</table>
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="bianmamanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="8">&nbsp;�����г��</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">���</td>
				<td  width=11%  class="usermanage_1">����</td>
				<td  width=25%  class="usermanage_1">�г������</td>
				<td  width=10%  class="usermanage_1">Ԥ��ɱ�</td>
				<td  width=8%  class="usermanage_1">�����ɹ���</td>
				<td  width=10%  class="usermanage_1">������</td>
				<td  width=24%  class="usermanage_1">��ʼ����������</td>
				<td  width=8%  class="bianmacz">������</td>
				</tr>


<?
if ($ggallrows==0)
{
	echo "<tr><td align='center' bgcolor='#FFFFFF' height='25' colspan='7'>������Ҫ��ѯ�����ݣ�</td></tr>";
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
					$username=trim($arrrow[$i]['username']);

					
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
				<td  width=4% align="center"  style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;"><?=$tempi;?></td>
				<td  width=11%  class="usermanage_2" nowrap> <?=$leix;?> </td>
				<td  width=25%  class="usermanage_2"><a href="client_detail.php?id=<?=$id;?>" target="_blank" title="�鿴[<?=$market_name;?>] �г����ϸ��Ϣ��"><?=$market_name;?></a></td>
				<td  width=10%  class="usermanage_2" nowrap><?=$yuscb;?></td>
				<td  width=8%  class="usermanage_2"><?=$qiwcgl."%";?></td>
				<td  width=10%  class="usermanage_2"><?=$username;?></td>
				<td  width=24%  class="usermanage_2"><?=$starttime."��".$endtime;?></td>
				<td  width=8%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">&nbsp;
					<?=$username;?>
					
					</td>
					</tr>
				<?
					$tempi++;
						
					}	
?>	
				<tr>
				<td  width=100% align="center" bgcolor="#FFFFFF" style="padding:2px;height:22px;line-height:22px;border-bottom:1px solid #e8e8e8;" colspan="8">
	          <?
	$sumrows=$allrows;//������
	$pagelistnum=$dbzz_bianma_pagenum;//ÿҳ��ʾ����
	$link="market_manage_ceo_list.php?marketname=".rawurlencode($marketname);
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>