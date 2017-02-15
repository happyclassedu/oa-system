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

if(isset($_GET[keywords])&&!empty($_GET[keywords])){
	$keywords=trim($_GET[keywords]);
	if(empty($keywords)){
	ShowMsg("请输入要搜索的关键词！","-1");
	}
    fun_str_ck($keywords);
    include('keywords.php');
    $str_str=preg_replace($bb,$ss,$keywords);
    $word=explode(" ",$str_str);
	$word_num=count($word);
	for($i=0;$i<$word_num;$i++)
	{
		$like_str .="`cname` LIKE '%$word[$i]%' ";
		if($i<$word_num-1)
		{
			$like_str .="and ";
		}
	}
    fun_str_ck($_GET[k_city]);
    $catid	= isset($_GET[industry])  	? intval($_GET[industry])  : '';
	$cate_limit 	= !empty($catid) 	? "`industry` = '$catid' " 	: "";
	if(!empty($cate_limit)){
	$c=$_GET[k_city] ? "AND `city`='$_GET[k_city]',{$cate_limit}" : "AND $cate_limit";
	}else{
    $c=$_GET[k_city] ? "AND `city`='$_GET[k_city]'" : "";
	}
    fun_str_ck($_GET['page']);
	$page=isset($_GET['page'])?$_GET['page']:1;
	$sql="SELECT `id` FROM `{$dbpre}company` WHERE $like_str $c";
	$counts=mysql_num_rows(mysql_query($sql));
//这里为记录站内搜索关键字
	$sql="SELECT * FROM `{$dbpre}inner_keywords` WHERE `keywords`='".$keywords."'";
	$query=$db->query($sql);
	$status=is_array($row=mysql_fetch_array($query));
	if(!$status){
		$sql="INSERT INTO `{$dbpre}inner_keywords` (
`id` ,
`keywords` ,
`record` ,
`searchip`
)
VALUES (
NULL , '$keywords', '$counts','".GetIP()."'
);
";
		$db->query($sql);
	}


//====================
    $getpageinfo=page($page,$counts,10);
    $sql="SELECT * FROM `{$dbpre}company` WHERE $like_str $c".$getpageinfo['sqllimit']."";
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
	ShowMsg("请输入要搜索的关键词！","-1");
}
$url= $_SERVER['REQUEST_URI'];
$url=ereg_replace("(^|&)industry=$_GET[industry]","",$url);
$url=ereg_replace("(^|&)page=$page","",$url);

$seo[title]="陕西黄页索搜,".$xm_global[cfg_webname];
$seo[description]="陕西省黄页,是当地最全最准的黄业网，为商家提供优资、准确的商务信息查询以及免费的信息发布平台。".$xm_global[cfg_description];

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
'left_cate',
'url',
'select',
'seo',
'ad',
'counts',
'keywords',
),
array(
$xm_global,
$list,
$pgcode,
$left_cate,
$url,
$select,
$seo,
$ad,
$counts,
$keywords,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("search.htm");
?>
