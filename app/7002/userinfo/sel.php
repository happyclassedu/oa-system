<?php
//require_once('../lib07/config.inc.php');
$Conn=mssql_connect($global_databaseip,$global_databaseuser,$global_databasepwd); 
mssql_select_db($global_databasename); 


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
					$str_name=$c_classname[$f]."/".$c_code[$f];
					$array[$f] = array("id"=>$c_id[$f],"pid"=>$c_bid[$f],"name"=>"$str_name","code"=>$c_code[$f]);
//					echo $c_id[$f]." classname=".$c_classname[$f]."-classcode=".$c_classcode[$f]." bid=".$c_bid[$f]."<br>";
			$f++;
			}
					if(is_array($c_id)==false)
					{
						echo "<script language=javascript>alert('分类错误，请按教程一步步设置基础数据!');history.go(-1)</script>";
						exit;						
						}	
//以下是接收的数据格式
//$array[0] = array("id"=>1,"pid"=>0,"name"=>"诛求");


draw($array);//执行，已经改成下拉菜单形式
function draw($array){
//tree array — copy some codes from joomla
$tree = array();
if( $array ){
        foreach ( $array as $v ){
            $pt     = $v['pid'];
            $list = @$tree[$pt] ? $tree[$pt] : array();
            array_push( $list, $v );
            $tree[$pt] = $list;
        }
}

 
//foreach root node
	echo $sel="<select name='sel_class'><option value=''>请选择类别</option>";
	foreach($tree[0] as $k=>$v)
	{
	    echo "<option value=$v[code]>$v[name]</option>";
	    if($tree[$v['id']]) drawTree($tree[$v['id']],$tree,0);
	   
	}
	echo "</select>";
}
//foreach child node
function drawTree($arr,$tree,$level)
{
    $level++;
    $prefix = str_pad("|-",$level+1,'-',STR_PAD_RIGHT);
    foreach($arr as $k2=>$v2)
    {
          echo "<option value=$v2[code]>$prefix$v2[name]</option><br/>";
          if($tree[$v2["id"]]) drawTree($tree[$v2["id"]],$tree,$level);
           
    }
}
?>
 
