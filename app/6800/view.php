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



if((isset($_GET[city])&&is_numeric($_GET[city]))||(isset($_GET[county])&&is_numeric($_GET[county]))){
	fun_str_ck($_GET[city]);
	fun_str_ck($_GET[country]);
	$str= $_GET[county] ? "`county`='".$_GET[county]."'" : "`city`='".$_GET[city]."'" ;
	if(isset($_GET[county])){
		$sql="SELECT `id`,`pid`,`name` FROM `{$dbpre}class_county` WHERE `id`=$_GET[county]";
		$query=$db->query($sql);
		$navigate[county]=mysql_fetch_array($query);
		$pid=$navigate[county][pid];
		$sql="SELECT * FROM `{$dbpre}class_city` WHERE `id`=$pid";
		$query=mysql_query($sql);
		$navigate[city]=mysql_fetch_array($query);
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_county` WHERE `pid`=$pid";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$local[]=array('id'=>$row[id],'name'=>$row[name]);
		}
	}else{
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_city` WHERE `id`=$_GET[city]";
		$query=mysql_query($sql);
		$navigate[city]=mysql_fetch_array($query);
		$sql="SELECT `id`,`name` FROM `{$dbpre}class_county` WHERE `pid`=$_GET[city]";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$local[]=array('id'=>$row[id],'name'=>$row[name]);
		}
	}


	fun_str_ck($_GET['page']);
	$page=isset($_GET['page'])?$_GET['page']:1;
	$vquery=$_GET[city] ? "vcity=$_GET[city]" :($_GET[county] ? "vcounty=$_GET[county]" : '');
    $sql="SELECT `id` FROM `{$dbpre}view` WHERE {$vquery}";
    $counts=mysql_num_rows(mysql_query($sql));
    $getpageinfo=page($page,$counts,12);
    $sql="SELECT `id`,`vname`,`vprice`,`vpic` FROM `{$dbpre}view` WHERE ".$vquery.$getpageinfo['sqllimit']."";
    $query=$db->query($sql);
    while($row=mysql_fetch_array($query)){
		$view_list[]=array('id'=>$row[id],'vname'=>$row[vname],'vprice'=>$row[vprice],'vpic'=>$row[vpic]);
	}
	$pgcode=$getpageinfo['pagecode'];


	$str=str_replace("county","local",$str);
	$sql="SELECT `id`,`cname`,`ctel` FROM `{$dbpre}company` WHERE $str AND `industry`=4 LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$hotel[]=array('id'=>$row[id],'cname'=>$row[cname],'ctel'=>$row[ctel]);
	}
	$sql="SELECT `id`,`vname`,`vclick` FROM `{$dbpre}view` WHERE $vquery ORDER BY `vclick` DESC  LIMIT 10";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$view[]=array('id'=>$row[id],'vname'=>$row[vname],'vclick'=>$row[vclick]);
	}

	$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=3 AND `ad_page`=2 AND `ad_able`=1";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
	}
	if(!empty($navigate[county])){
		$seo[title]=$navigate[county][name]."旅游景点,".$navigate[city][name]."旅游景点,";

	}else{
		$seo[title]=$navigate[city][name]."旅游景点,";
	}



	if(!empty($view_list)){
	foreach($view_list as $val){
		$seo[keywords].=$val[vname].",";
	}
	}

	$seo[description]=$seo[title]."主要包括".$seo[keywords]."等。为你的出游提供丰富的参考信息。";
	$seo[title].=$xm_global[cfg_webname];
	$seo[keywords].=$xm_global[cfg_keywords];
}else{
	header("Location: $xm_global[cfg_basehost]");
	exit();


}













elin_smarty_assign(
array(
'xm_global',
'select',
'navigate',
'local',
'seo',
'ad',
'pgcode',
'view_list',
'hotel',
'view',
),
array(
$xm_global,
$select,
$navigate,
$local,
$seo,
$ad,
$pgcode,
$view_list,
$hotel,
$view,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("view.htm");
?>
