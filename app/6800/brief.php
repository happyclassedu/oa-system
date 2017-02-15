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







if(isset($_GET[county])||isset($_GET[city])){
	fun_str_ck($_GET[county]);
	fun_str_ck($_GET[city]);
	$str= $_GET[county] ? "`county`='".$_GET[county]."'" : "`city`='".$_GET[city]."'" ;
	$strv= $_GET[county] ? "`vcounty`='".$_GET[county]."'" : "`vcity`='".$_GET[city]."'" ;
	$str_db= $_GET[county] ? "county" : "city";
	$sql="SELECT * FROM `{$dbpre}local_brief` WHERE $str";
	$query=$db->query($sql);
	$brief=mysql_fetch_array($query);


	$sql="SELECT * FROM `{$dbpre}class_{$str_db}` WHERE `id`=$_GET[$str_db]";
	$query=$db->query($sql);
	$local_name=$db->fetch_array($query);


	$sql="SELECT `id`,`vname`,`vclick` FROM `{$dbpre}view` WHERE $strv ORDER BY `vclick` DESC LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$view[]=array('id'=>$row[id],'vname'=>$row[vname],'vclick'=>$row[vclick]);
	}


	$str=str_replace("county","local",$str);
	$sql="SELECT `id`,`cname`,`ctel` FROM `{$dbpre}company` WHERE $str AND `industry`=4 LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$hotel[]=array('id'=>$row[id],'cname'=>$row[cname],'ctel'=>$row[ctel]);
	}

	$seo[title]=$local_name[name]."¼ò½é,".$xm_global[cfg_webname];
	$seo[keywords]=$local_name[name]."¼ò½é,".$local_name[name]."¾°µã,".$local_name[name]."¾Æµê,".$local_name[name]."ÂÃÐÐÉç,".$xm_global[cfg_keywords];
	$content=trim(strip_tags($brief[brief]));
	$content=str_replace("&nbsp;","",$content);
	$seo[description]=str_cut($content,250);


	$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=4 AND `ad_page`=1 AND `ad_able`=1";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
	}

	$tq=substr($brief[code],3);


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
'brief',
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
$brief,
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
$smarty->display("brief.htm");
?>
