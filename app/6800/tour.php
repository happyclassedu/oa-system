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

$sql="SELECT * FROM `{$dbpre}class_city`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$city[$row[id]]=$row[name];
}
$sql="SELECT `id`,`city`,`pic` FROM `{$dbpre}local_brief` WHERE `city`<>''";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){

	$city_pic[]=array('id'=>$row[id],'city_id'=>$row[city],'pic'=>$row[pic],'city_name'=>$city[$row[city]]);
}


$seo[title]="陕西旅游,陕西景点,陕西风景名胜,".$xm_global[cfg_webname];

foreach($city as $val){
	$seo[keywords].=$val."旅游景点,";
}
$seo[keywords].=$xm_global[cfg_deywords];
$seo[description]="陕西旅游网为广大爱收集了陕西各县市的旅游景点及洒店旅社等信息，为你的出行提供了丰富的旅游信息资源。";

	$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=3 AND `ad_page`=1 AND `ad_able`=1";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
	}





elin_smarty_assign(
array(
'xm_global',
'select',
'seo',
'ad',
'city_pic',
),
array(
$xm_global,
$select,
$seo,
$ad,
$city_pic,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("tour.htm");
?>
