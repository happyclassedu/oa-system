<?php
include_once ("global.php");
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}

$sql="SELECT * FROM {$dbpre}class_city ";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$select[]=array('id'=>$row[id],'name'=>$row[name]);
}



if(isset($_GET[id])&&!empty($_GET[id])){
 fun_str_ck($_GET[id]);
 $sql="SELECT * FROM `my_elin` WHERE `id`='$_GET[id]' LIMIT 1 ";
 $query=mysql_query($sql);
 $company=mysql_fetch_array($query);

$sql="SELECT * FROM `my_area` WHERE `areaid`='$company[areaid]'  LIMIT 1 ";
 $query=mysql_query($sql);
 $area=mysql_fetch_array($query);


$sql="SELECT * FROM `my_qyhy` WHERE `qyhyid`='$company[catid]'  LIMIT 1 ";
 $query=mysql_query($sql);
 $cat=mysql_fetch_array($query);







}else{
	header("Location: $xm_global[cfg_basehost]");
	exit();
}

$seo[title]=$company[tname]." -厦门市黄页，厦门企业黄页，厦门企业信息";
$seo[keywords]=$company[tname].",".$company[tname]."法人代表,".$company[nature].",".$cat[qyhyname].",厦门市".$area[areaname];
$seo[description]=$company[tname];
$emp=trim($company[introduce]);
if(!empty($emp)){
	$seo[description].=trim(substr($company[introduce],0,200));
}else{
	$seo[description].=trim(substr($company['object'],0,200));
}



	$sql="SELECT * FROM `my_elin` WHERE `catid`=$cat[qyhyid] ORDER BY `id` LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$rel[]=array('id'=>$row[id],'name'=>$row[tname]);
	}

$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=1 AND `ad_page`=3 AND `ad_able`=1";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
}


elin_smarty_assign(
array(
'xm_global',
'company',
'list_qy',
'area',
'qyhyarea',
'cat',
'seo',
'select',
'ad',
'rel',
),
array(
$xm_global,
$company,
$list_qy,
$area,
$qyhyarea,
$cat,
$seo,
$select,
$ad,
$rel,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("qyinfo.htm");
?>
