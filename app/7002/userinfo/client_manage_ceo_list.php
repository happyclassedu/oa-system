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
               echo "����1����";
               break;

           case 2://minutes
               echo "1����-5����";
               break;

           case 3://minutes
               echo "5����-1ǧ��";
               break;

           case 4://minutes
               echo "1ǧ��-3ǧ��";
               break;

           case 5://minutes
               echo "3ǧ��-5ǧ��";
               break;

           case 6://minutes
               echo "5ǧ��-1����";
               break;
           case 7://minutes
               echo "1����-5����";
               break;
           case 8://minutes
               echo "5����-10����";
               break;
           case 9://minutes
               echo "10����-50����";
               break;
           case 10://minutes
               echo "100��������";
               break;      
           default:
           	   echo "δ��д";
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
   if(confirm("ȷ��Ҫɾ����һ��ɾ�������ָܻ���"))
     return true;
   else
     return false;

}
</script> 

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;�ͻ���Դ����->�쵼��ѯ</td>
  </tr>
</table>

<form name="myform" method="post" action="client_manage_ceo_list.php" onsubmit="return FormCheck();">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="bianmamanage">
    <tr> 
      <td width="10%" height="27" align="center" bgcolor="DBDEF4" class="select_class"> 
        �ͻ�����</td>
      <td width="36%" bgcolor="DBDEF4" class="select_class"><input name="clientname"  value="<?=$clientname;?>" type="text"  id="clientname" size="20"  maxlength="30"> 
        &nbsp; <input type="submit" name="Submit" class="submit" value="-����-"></td>
      <td width="26%" bgcolor="DBDEF4" class="select_class">&nbsp;</td>
      <td width="11%" bgcolor="DBDEF4" class="select_class"></td>
      <td width="17%" bgcolor="DBDEF4" class="select_class"></td>
    </tr>
  </table>
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="bianmamanage">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="7">&nbsp;�쵼�ɲ�ѯ�ͻ���Ϣ</td>
  </tr>
				<tr bgcolor="#E8E8E8" height=20>
				<td  width=4% align="center"  class="bianmagxh">���</td>
				<td  width=25%  class="usermanage_1">�ͻ�����</td>
				<td  width=11%  class="usermanage_1">������ҵ</td>
				<td  width=10%  class="usermanage_1">��Ӫҵ��RMB</td>
				<td  width=8%  class="usermanage_1">Ա������</td>
				<td  width=34%  class="usermanage_1">��ϵ�绰������</td>
				<td  width=8%  class="bianmacz">������</td>
				</tr>


<?
if ($ggallrows==0)
{
	echo "<tr><td align='center' height='25' bgcolor='#FFFFFF' colspan='7'>������Ҫ��ѯ�����ݣ�</td></tr>";
	}

				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$str_clientname=trim($arrrow[$i]['clientname']);
					$calling=trim($arrrow[$i]['calling']);
					$yye=trim($arrrow[$i]['yye']);
					$ygrs=trim($arrrow[$i]['ygrs'])."<font color=999999>������</font>";
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
				<td  width=25%  class="usermanage_2" nowrap><a href="client_detail.php?id=<?=$id;?>" target="_blank" title="�鿴[<?=$str_clientname;?>]��ϸ��Ϣ��"><?=$str_clientname;?></a></td>
				<td  width=11%  class="usermanage_2"><?=$calling;?></td>
				<td  width=10%  class="usermanage_2" nowrap><?=nyye($yye);?></td>
				<td  width=8%  class="usermanage_2"><?=$ygrs;?></td>
				<td  width=34%  class="usermanage_2"><?=$str_tel.$str_fax;?></td>
				<td  width=8%  style="padding:1px;height:20px;line-height:20px;border-left:1px solid #D8D8D8;border-bottom:1px solid #D8D8D8;">&nbsp;<?=$username;?>
					<?
//					if ($adduser==trim($_SESSION["userdlname"]) or "admin"==trim($_SESSION["userdlname"])) echo "<a href='client_edit_list.php?id=".$id."' title=�༭������>�༭</a> <a href='client_del.php?id=".$id."' onclick='return ConfirmDel();' title='��ͻ��´�����ϵ�ˣ�������ɾ����'>ɾ��</a>";
//					else echo "<font color='BCBCBC' title='�ǹ���Ա���ܶԱ�������κβ�����'>�༭ ɾ��</font>";
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
	$sumrows=$allrows;//������
	$pagelistnum=$dbzz_bianma_pagenum;//ÿҳ��ʾ����
	$link="client_manage_ceo_list.php?clientname=".$clientname;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>
<br> 