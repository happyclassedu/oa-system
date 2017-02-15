<?
require_once('../lib07/config.inc.php');
$Conn=mssql_connect($global_databaseip,$global_databaseuser,$global_databasepwd); 
mssql_select_db($global_databasename); 
require_once('../lib07/limitless.php');


		//根据pid到id中循环查找，直到pdi=0时结束，查找级别code
		$find_sql="select * from small_class order by id asc";
//		echo $find_sql."<br>";
		$find_rs=mssql_query($find_sql,$Conn);
		$f=0;
		while($rs=mssql_fetch_array($find_rs))
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
			echo $c_id[$i]." classname=".$c_classname[$i]."-classcode=".$c_classcode[$i]." bid=".$c_bid[$i]."<br>";
			$Tree->setNode($c_id[$i], $c_bid[$i], '<OPTION value='.$c_code[$i].'>'.$c_classname[$i].'/'.$c_code[$i].'/'.$c_id[$i].'</OPTION>'); 
			}
//setNode(目录ID,上级ID，目录名字); 
//$Tree->setNode(1, 0, '<a href=#>目录1</a>'); 
//$Tree->setNode(2, 0, '目录2'); 
//$Tree->setNode(3, 0, '目录3'); 
//$Tree->setNode(4, 3, '目录3.1'); 
//$Tree->setNode(5, 3, '目录3.2'); 
//$Tree->setNode(6, 3, '目录3.3'); 
//$Tree->setNode(7, 2, '目录2.1'); 
//$Tree->setNode(8, 2, '目录2.2'); 
//$Tree->setNode(9, 2, '目录2.3'); 
//$Tree->setNode(10, 6, '目录3.3.1'); 
//$Tree->setNode(11, 6, '目录3.3.2'); 
//$Tree->setNode(12, 6, '目录3.3.3'); 
//getChilds(指定目录ID); 
//取得指定目录下级目录.如果没有指定目录就由根目录开始 
$category = $Tree->getChilds(); 
//遍历输出 

?>
<select   name=provide size=1 id="select3" style="background-color:#F0F0F0;">
	<?
	for ($i=0;$i<$f;$i++)
	{

  	}
    ?>
              </select>
              <?
//              echo "<br>";
//	for ($i=0;$i<$f;$i++)
//	{
//		$str_option="";
//		if ($c_bid[$i]==0) 
//		{
//				$str_option="├".$c_classname[$i];
//				$upid=$c_id[$i];
//				for ($j=$i+1;$j<$f;$j++)
//				{
//					
//					if ($upid==$c_bid[$j])
//					{
//						$str_option=$str_option."├".$c_classname[$j];
//						$upid=$c_id[$j];
//						}
//					}
//				}
//			echo $str_option."<br>";
//  	}

foreach ($category as $key=>$id) 
{ 
echo $id;
echo $Tree->getLayer($id, '<img src=../myimages/1/20px_2.gif>').$Tree->getValue($id)."<br>\n"; 
} 
?>
