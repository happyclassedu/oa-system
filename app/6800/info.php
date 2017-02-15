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
if(isset($_GET[id])&&$_GET[id]&&is_numeric($_GET[id])){
	fun_str_ck($_GET[id]);

	$sql="SELECT * FROM `{$dbpre}company` WHERE `id`=$_GET[id]";
	$query=mysql_query($sql);
	$company=mysql_fetch_array($query);
	if(empty($company[cweb])){
		$company[cweb]="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	}
	if(empty($company)){
		ShowMsg("你要查看的信息不存在！","-1");
	}
	$sql="SELECT * FROM `{$dbpre}industry` WHERE `id`=$company[industry]";
	$query=mysql_query($sql);
	$industry=mysql_fetch_array($query);
	$sql="SELECT `id`,`name` FROM `{$dbpre}class_city` WHERE `id`=$company[city]";
	$query=mysql_query($sql);
	$loc_city=mysql_fetch_array($query);
	$sql="SELECT `id`,`name` FROM `{$dbpre}class_county` WHERE `id`=$company[local]";
	$query=mysql_query($sql);
	$loc_county=mysql_fetch_array($query);

	$sql="SELECT * FROM `{$dbpre}company` WHERE `industry`=$industry[id] AND `local`=$loc_county[id] ORDER BY `update` LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$rel[]=array('id'=>$row[id],'name'=>$row[cname]);
	}
	$Recently=RecentlyGoods($_GET[id],10);
	if(!empty($Recently)){
		$sql="SELECT * FROM `{$dbpre}company` WHERE `id` in ($Recently)";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
		$rec[]=array('id'=>$row[id],'name'=>$row[cname]);
	}
	}
}else{
	header("Location: $xm_global[cfg_basehost]");
 	exit();
}
$des=str_replace(array("&ldquo;","&rdquo;","\r\n"," "),array("“","”","",""),$company[brief]);


$seo[title]=$company[cname]."|".$loc_city[name]."黄页|".$loc_county[name]."黄页|".$xm_global[cfg_webname];
$seo[keywords]=$company[cname].",公司简介,公司地址,公司电话,公司联系方式,公司法人";
$seo[description]=$company[cname]." 联系方式  电话:".$company[ctel]." 地址:".$company[cadd]." 所属行业:".$industry[name]." 公司性质:".$company[nature];
if(!empty($company[keyword])){
	$seo[keywords]=$seo[keywords].",".$company[keyword];
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
'industry',
'loc_city',
'loc_county',
'select',
'seo',
'ad',
'rel',
'rec'
),
array(
$xm_global,
$company,
$industry,
$loc_city,
$loc_county,
$select,
$seo,
$ad,
$rel,
$rec,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}

$smarty->display("info.htm");
?>
