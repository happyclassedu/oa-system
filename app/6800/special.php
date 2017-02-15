<?php
include_once("global.php");
include_once 'taobaoapi/Taoapi.php';
$Taoapi_Config = Taoapi_Config::Init();
$Taoapi_Config->setCharset('GBK');
$Taoapi = new Taoapi;

if(isset($_GET[city])&&$_GET[city]){
	$cityid=intval($_GET[city]);
	$sql="SELECT `name` FROM `{$dbpre}class_city` WHERE `id`='".$cityid."'";
	$query=$db->query($sql);
	$row=mysql_fetch_array($query);
	$cityname12=str_replace("市","",$row[name])." 特产";

}else{
	$cityname12= "陕西 特产";
}
$cityname=str_replace(" ","",$cityname12);
//echo $cityname12;

fun_str_ck($_GET['page']);
$_GET['page']=htmlspecialchars($_GET['page']);
$_GET['page']=intval($_GET['page']);
$page=isset($_GET['page'])?$_GET['page']:1;
$page_size="16";
//得到单个商品信息(taobao.item.get)
$Taoapi->method = 'taobao.taobaoke.items.get';
$Taoapi->fields = 'iid,num_iid,title,pic_url,price';
$Taoapi->nick = 'elinstudio';
$Taoapi->sort = "commissionNum_desc";
$Taoapi->keyword = $cityname12;
$Taoapi->page_size=$page_size;
$Taoapi->page_no=$page;

//需要更多的字段可以登陆 taoapi.com 进行配置生成
$TaobaokeData = $Taoapi->Send('get','xml')->getArrayData();

$good_list=$TaobaokeData[taobaoke_items][taobaoke_item];


$counts= $TaobaokeData[total_results]>100*$page_size ? 100*$page_size : $TaobaokeData[total_results];
$getpageinfo=page($page,$counts,16);
$pgcode=$getpageinfo['pagecode'];
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}

$sql="SELECT * FROM `{$dbpre}class_city`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$select[]=array('id'=>$row[id],'name'=>$row[name]);
}
for($i=0;$i<8; $i++ ){
$seo[description].=strip_tags($good_list[$i][title]).",";
}
$seo[description]=$cityname."主要有".$seo[description]."特。欢迎大家选购！";

if($cityname!="陕西特产"){
 $seo[title]=$cityname.",陕西特产,八闽特产,陕西厦门特产";
}else{
 $seo[title]="陕西特产,八闽特产,陕西厦门特产";
}

$seo[keywords]="陕西特产,八闽特产,福州特产,厦门特产,泉州特产,莆田特产,三明特产,漳州特产,南平特产,龙岩特产,宁德特产";

$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=2 AND `ad_page`=1 AND `ad_able`=1";
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
'special_list',
'sell',
'pgcode',
'counts',
'cityname',
'good_list',
),
array(
$xm_global,
$select,
$seo,
$ad,
$special_list,
$sell,
$pgcode,
$counts,
$cityname,
$good_list,
)
);

function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("special.htm");
?>
