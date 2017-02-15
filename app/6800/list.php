<?php
include_once("global.php");
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




$sql="SELECT * FROM `{$dbpre}industry` WHERE `pid`=0";
$query=mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$left_cate[]=array('id'=>$row[id],'name'=>$row[name]);
}

foreach($left_cate as $key=>$val){
	if(is_array($val)){
		$sql="SELECT * FROM `{$dbpre}industry` WHERE `pid`=$val[id]";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
		$left_cate[$key][sub][]=array('id'=>$row[id],'name'=>$row[name]);
		}
	}
}
if((isset($_GET[city])&&is_numeric($_GET[city]))||(isset($_GET[country])&&is_numeric($_GET[country]))){
	fun_str_ck($_GET[city]);
	fun_str_ck($_GET[country]);
	if(isset($_GET[city])){
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_city` WHERE `id`=$_GET[city]";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		$nav=array('id'=>$row[id],'name'=>$row[name]);
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_county` WHERE `pid`=$_GET[city]";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$local[]=array('id'=>$row[id],'name'=>$row[name]);
		}
	$seo[title]=$nav[name]."黄页,".$xm_global[cfg_webname];
	$seo[description]="陕西省".$nav[name]."黄页,是当地最全最准的黄业网，为商家提供优资、准确的商务信息查询以及免费的信息发布平台。".$xm_global[cfg_description];
	}else{
		$sql="SELECT * FROM `{$dbpre}class_county` WHERE `id`=$_GET[country]";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		$nav_local=array('id'=>$row[id],'name'=>$row[name]);
		$pid=$row[pid];
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_county` WHERE `pid`=$pid";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$local[]=array('id'=>$row[id],'name'=>$row[name]);
		}
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_city` WHERE `id`=$pid";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		$nav=array('id'=>$row[id],'name'=>$row[name]);
		$seo[title]=$nav_local[name]."黄页,".$nav[name]."黄页,".$xm_global[cfg_webname];
		$seo[description]="陕西省".$nav[name].$nav_local[name]."黄页,是当地最全最准的黄业网，为商家提供优资、准确的商务信息查询以及免费的信息发布平台。".$xm_global[cfg_description];
	}
	$catid	= isset($_GET[industry])  	? intval($_GET[industry])  : '';
	$cate_limit 	= !empty($catid) 	? " AND `industry` = '$catid' " 	: "";

if(!empty($catid)){
		$sql="SELECT `name` FROM `{$dbpre}industry` WHERE `id`=".$catid."";
		$query=$db->query($sql);
		$c=$db->fetch_array($query);
		$seo[description]="陕西省".$nav[name].$nav_local[name].$c[name]."类黄页,是当地最全最准的黄业网，为商家提供优资、准确的商务信息查询以及免费的信息发布平台。".$xm_global[cfg_description];
	}
	fun_str_ck($_GET['page']);
	$page=isset($_GET['page'])?$_GET['page']:1;
	$query=$_GET[city] ? "city=$_GET[city]" :($_GET[country] ? "local=$_GET[country]" : '');
    $sql="SELECT `id` FROM `{$dbpre}company` WHERE {$query}{$cate_limit}";
    $counts=mysql_num_rows(mysql_query($sql));
    $getpageinfo=page($page,$counts,10);
    $sql="SELECT `id`,`cname`,`ctel`,`cadd` FROM `{$dbpre}company` WHERE ".$query.$cate_limit.$getpageinfo['sqllimit']."";
    $query=$db->query($sql);
    while($row=mysql_fetch_array($query)){
		$list[]=array('id'=>$row[id],'cname'=>$row[cname],'ctel'=>$row[ctel],'cadd'=>$row[cadd]);
	}
	$pgcode=$getpageinfo['pagecode'];
	if(!empty($list)){
	foreach($list as $val){
	$seo[keywords].=$val[cname].",";
	}
	}
}else{
	header("Location: $xm_global[cfg_basehost]");
	exit();
}
$url= $_SERVER['REQUEST_URI'];
$url=ereg_replace("(^|&)industry=$_GET[industry]","",$url);
$url=ereg_replace("(^|&)page=$page","",$url);

$seo[keywords].=$xm_global[cfg_keywords];
$seo[description].=$xm_global[cfg_description];
$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=1 AND `ad_page`=2 AND `ad_able`=1";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
}
elin_smarty_assign(
array(
'xm_global',
'list',
'pgcode',
'local',
'nav',
'nav_local',
'left_cate',
'url',
'select',
'seo',
'ad',
),
array(
$xm_global,
$list,
$pgcode,
$local,
$nav,
$nav_local,
$left_cate,
$url,
$select,
$seo,
$ad,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("list.htm");
?>
