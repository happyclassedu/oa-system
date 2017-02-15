<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$clientname=chkstring(addslashes(trim($_POST['clientname'])));
$userid=$_SESSION["userdlname"];	
 
						$tempi=1;
						if(empty($_REQUEST['page'])) 
						{ 
								$page = 1; 
								$nowpage=0;
								$clientname=chkstring(addslashes(trim($_POST['clientname'])));
//								$gqquery ="SELECT  *  from chance ORDER BY classcode desc,code";
								if ($clientname<>"")
								{
									$gqquery ="SELECT  *  from chance where userid='".$userid."' and itemname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";
									}
									else
									{
										$gqquery ="SELECT  *  from chance where userid='".$userid."'  ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
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
								$clientname=chkstring(addslashes(trim($_GET['clientname'])));
								if ($clientname<>"")
								{				  			
				  				$gqquery ="SELECT  *  from chance WHERE userid='".$userid."' and itemname like '%".$clientname."%' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum";  
									}
									else
									{
				  					$gqquery ="SELECT  *  from chance WHERE userid='".$userid."' ORDER BY id desc LIMIT ".$nowpage.","."$dbzz_bianma_pagenum"; 
										}
								$tempi=$page*$dbzz_bianma_pagenum-($dbzz_bianma_pagenum-1);
								}
							}
							
					if ($clientname<>"")
					{	
						$query0 ="SELECT id from chance where itemname like '%".$clientname."%'";
						}
						else
						{
							$query0 ="SELECT id from chance";
							}
	  			$totalresult=$obj->exec($query0);
				  $allrows=$obj->num_rows($totalresult);


				  $queryresult=$obj->exec($gqquery);
				  $ggallrows=$obj->num_rows($queryresult);
				  $arrrow=$obj->fetch($queryresult);	
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<title>请选择您的客户</title>
<SCRIPT   LANGUAGE="JavaScript">   
  <!--   
  function  CloseSelf(linkname,linknameid){  
// alert  (clientname);
//alert (linknameid);
    window.opener.document.myform.shic.value=linkname; 
    window.opener.document.myform.shicid.value=linknameid;

  
    window.close();   
  }   
  //-->   
</SCRIPT>	
<form name="myform" method="post" action="chance_select_linkman.php"   style="padding:0px;margin:0px 0px 0px 0px;">	
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


				for ($i=0;$i<$ggallrows;$i++)	
				{
					$id=trim($arrrow[$i]['id']);
					$itemname=trim($arrrow[$i]['itemname']);
					$client_name=trim($arrrow[$i]['clientname']);
					$clientid=trim($arrrow[$i]['clientid']);
					
				?>
				<tr onMouseOver="this.bgColor = '<?=$overbackcolor;?>'" onMouseOut="this.bgColor = 'FFFFFF'" bgcolor="#FFFFFF">
		
				<td  width=31%   style="padding:1px;height:20px;line-height:20px;border-bottom:1px solid #D8D8D8;" nowrap >
<SCRIPT   LANGUAGE="JavaScript">   
  <!--   
//	var clientname=;
	var itemname<?=$id;?>=new String('<?=$itemname;?>'); 
  var itemid<?=$id;?>=new String('<?=$id;?>');

  //-->   
</SCRIPT>						
						
					<a href="" id="td<?=$id;?>"  onclick="CloseSelf(itemname<?=$id;?>,itemid<?=$id;?>);"><?=$itemname;?></a></td>
				<td  width=61%  class="usermanage_2"><?=$client_name;?></td>
				<td  width=8%  class="usermanage_2"><a href="" id="td<?=$id;?>"  onclick="CloseSelf(itemname<?=$id;?>,itemid<?=$id;?>);">选择</a></td>

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
	$link="chance_select_market.php?clientname=".$clientname;
	echo getpage($sumrows,$page,$link,$pagelistnum);
	
	?>					
				</td>
 				</tr>
</table>
