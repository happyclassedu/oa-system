<?
require_once('../lib07/config.inc.php');
$Conn=mssql_connect($global_databaseip,$global_databaseuser,$global_databasepwd); 
mssql_select_db($global_databasename); 
require_once('../lib07/limitless.php');
		//根据pid到id中循环查找，直到pdi=0时结束，查找级别code
		$find_sql="select * from small_class order by id asc";
		$find_class=mssql_query($find_sql,$Conn);
		$f=0;
		while($rs=mssql_fetch_array($find_class))
		{
					$c_id[$f]=trim($rs["id"]);
					$c_classcode[$f]=trim($rs["classcode"]);
					$c_bid[$f]=trim($rs["bid"]);
					$c_code[$f]=trim($rs["code"]);
					$c_classname[$f]=trim($rs["classname"]);	
//					echo $c_id[$f]." classname=".$c_classname[$f]."-classcode=".$c_classcode[$f]." bid=".$c_bid[$f]."<br>";
			$f++;
			}
					if(is_array($c_id)==false)
					{
						echo "<script language=javascript>alert('分类错误，请按教程一步步设置基础数据!');history.go(-1)</script>";
						exit;						
						}		
						
//new Tree(根目录的名字); 
//根目录的ID自动分配为0 
$Tree = new Tree(''); 
		for ($i=0;$i<$f;$i++)
		{
			$Tree->setNode($c_id[$i], $c_bid[$i], '<OPTION value='.$c_code[$i].'>'.$c_classname[$i].'/'.$c_code[$i].'/'.$c_id[$i].'</OPTION>'); 
//			$Tree->setNode($c_id[$i], $c_bid[$i], '<a href=#>'.$c_classname[$i].'/'.$c_code[$i].'</a>'); 
			}
$category = $Tree->getChilds(); 
//遍历输出 
?>
<select   name=provide size=1 id="select3" style="background-color:#F0F0F0;">
	<?
//	for ($i=0;$i<$f;$i++)
//	{
		?>
		<OPTION value="<?=$c_code[$i];?>">
			<?
			foreach ($category as $key=>$id) 
				{ 
//					if ($c_id[$i]==$id)
				  		echo $Tree->getLayer($id, '├').$Tree->getValue($id)."<br>\n"; 
				} 
    	?>
			
			</OPTION>"
  <?
//  	}
    ?>