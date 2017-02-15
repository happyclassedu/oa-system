<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$clientname=chkstring(addslashes(trim($_POST['clientname'])));
$userid=$_SESSION["userdlname"];	
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

?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<title>请选择您的客户</title>
<SCRIPT   LANGUAGE="JavaScript">   
  <!--   
  function  CloseSelf(clientname,address,postcode,clientid){  
// alert  (clientname);

    window.opener.document.myform.clientname.value=clientname; 
    window.opener.document.myform.address.value=address;
    window.opener.document.myform.postcode.value=postcode;
    window.opener.document.myform.clientid.value=clientid;
  
    window.close();   
  }   
  //-->   
</SCRIPT>	
<form name="myform" method="post" action="linkman_select_client.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="select_client">
  <tr> 
    <td width="14%" height="27" align="center" bgcolor="DBDEF4" class="select_class">客户名称 
    </td>
    <td width="41%" bgcolor="DBDEF4" class="select_class"><input name="clientname"  type="text"  id="clientname" size="20"  maxlength="30">
      &nbsp;</td>
    <td width="17%" bgcolor="DBDEF4" class="select_class"><input type="submit" name="Submit" class="submit" value="-查找-"></td>
    <td width="11%" bgcolor="DBDEF4" class="select_class"></td>
    <td width="17%" bgcolor="DBDEF4" class="select_class"></td>
  </tr>
</table>
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="select_client">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi" colspan="7">客户信息选择</td>

<?
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
//								$gqquery ="SELECT  *  from client ORDER BY classcode desc,code";
								if ($clientname<>"")
								{
									$gqquery ="SELECT  *  from client where userid='".$userid."' and clientname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
									}
									else
									{
										$gqquery ="SELECT  *  from client where userid='".$userid."'  ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
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
//				  			$gqquery ="SELECT  *  from client WHERE id NOT IN (SELECT TOP ".$nowpage." id from client ORDER BY classcode desc,code) ORDER BY classcode desc,code";  
								if ($clientname<>"")
								{				  			
				  				$gqquery ="SELECT  *  from client WHERE userid='".$userid."' and clientname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
									}
									else
									{
				  					$gqquery ="SELECT  *  from client WHERE userid='".$userid."' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
										}
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
							
					if ($clientname<>"")
					{	
						$query0 ="SELECT id from client where clientname like '%".$clientname."%'";
						}
						else
						{
							$query0 ="SELECT id from client";
							}
	  			$totalresult=$obj->exec($query0);
				  $allrows=$obj->num_rows($totalresult);


				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);	

				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$clientname=trim($arrrow[$i]['clientname']);
					$calling=trim($arrrow[$i]['calling']);

					$yye=trim($arrrow[$i]['yye']);
					$ygrs=trim($arrrow[$i]['ygrs'])."<font color=999999>人左右</font>";
					$tel=trim($arrrow[$i]['tel']);
					$telcountrycode=trim($arrrow[$i]['telcountrycode']);
					$telareacode=trim($arrrow[$i]['telareacode']);
					$faxcountrycode=trim($arrrow[$i]['faxcountrycode']);
					$faxareacode=trim($arrrow[$i]['faxareacode']);
					$fax=trim($arrrow[$i]['fax']);
					$address=trim($arrrow[$i]['address']);
					$postcode=trim($arrrow[$i]['postcode']);
					$str_tel="<font color=#2B3580>Tel:".$telcountrycode."-".$telareacode."-".$tel."</font>";
					$str_fax=" Fax:".$faxcountrycode."-".$faxareacode."-".$fax;
					
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
		
				<td  width=61%   style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;" nowrap >
<SCRIPT   LANGUAGE="JavaScript">   
  <!--   
//	var clientname=;
	var clientname<?=$id;?>=new String('<?=$clientname;?>'); 
	var address<?=$id;?>=new String('<?=$address;?>'); 
	var postcode<?=$id;?>=new String('<?=$postcode;?>'); 
  var clientid<?=$id;?>=new String('<?=$id;?>'); 
  //-->   
</SCRIPT>						
						
					<a href="" id="td<?=$id;?>"  onclick="CloseSelf(clientname<?=$id;?>,address<?=$id;?>,postcode<?=$id;?>,clientid<?=$id;?>);"><?=$clientname;?></a></td>
				<td  width=31%  class="usermanage_2"><?=$calling;?></td>
				<td  width=8%  class="usermanage_2"><a href="" id="td<?=$id;?>"  onclick="CloseSelf(clientname<?=$id;?>,address<?=$id;?>,postcode<?=$id;?>,clientid<?=$id;?>);">选择</a></td>

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
	$link="linkman_select_client.php?class=".$queryclass;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>
