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
	$sql="SELECT * FROM `{$dbpre}view` WHERE `id`=$_GET[id]";
	$query=$db->query($sql);
	$view_info=$db->fetch_array($query);
	if(empty($view_info)){
		ShowMsg("��Ҫ�鿴����Ϣ�����ڣ�","-1");
	}

	$sql="SELECT `code` FROM `{$dbpre}local_brief` WHERE `city`=$view_info[vcity]";
	$query=$db->query($sql);
	$code=$db->fetch_array($query);
	$tq=substr($code[code],3);




	$sql="SELECT `id`,`cname`,`ctel` FROM `{$dbpre}company` WHERE `local`=$view_info[vcounty] AND `industry`=4 LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$hotel[]=array('id'=>$row[id],'cname'=>$row[cname],'ctel'=>$row[ctel]);
	}

	$sql="SELECT `id`,`vname`,`vclick` FROM `{$dbpre}view` WHERE `vcounty`=$view_info[vcounty] ORDER BY `vclick` DESC  LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$view[]=array('id'=>$row[id],'vname'=>$row[vname],'vclick'=>$row[vclick]);
	}


	$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=3 AND `ad_page`=3 AND `ad_able`=1";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
	}


	$sql="SELECT * FROM `{$dbpre}class_county` WHERE `id`=$view_info[vcounty]";
	$query=$db->query($sql);
	$row=$db->fetch_array($query);
	$county_name=$row[name];

	$sql="SELECT * FROM `{$dbpre}class_city` WHERE `id`=$view_info[vcity]";
	$query=$db->query($sql);
	$row=$db->fetch_array($query);
	$city_name=$row[name];

	$seo[title]=$view_info[vname].",".$county_name."����,".$city_name."����,".$xm_global[cfg_webname];
	$seo[keywords]=$view_info[vname].",".$view_info[vname]."��Ʊ,".$view_info[vname]."���,".$county_name."���ξ���,".$city_name."���ξ���,".$xm_global[cfg_keywords];
	$seo[description]=str_cut($view_info[vbrief],250);


	$c=$view_info[vclick]+1;
	$sql="UPDATE `{$dbpre}view` SET `vclick`=$c WHERE `id`=$_GET[id]";
	$db->query($sql);

}else{
	header("Location: $xm_global[cfg_basehost]");
	exit();
}












elin_smarty_assign(
array(
'xm_global',
'select',
'seo',
'ad',
'view_info',
'local_name',
'view',
'hotel',
'tq',
),
array(
$xm_global,
$select,
$seo,
$ad,
$view_info,
$local_name,
$view,
$hotel,
$tq,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("scenic.htm");
?>
