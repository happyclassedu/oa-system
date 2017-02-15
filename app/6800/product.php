<?php
include_once("global.php");
include_once("global.php");
include_once 'taobaoapi/Taoapi.php';
$Taoapi_Config = Taoapi_Config::Init();
$Taoapi_Config->setCharset('GBK');
$Taoapi = new Taoapi;
if(isset($_GET[id])&&!empty($_GET[id])){
fun_str_ck($_GET[id]);
$id=htmlspecialchars($_GET[id]);
if(!$_GET[id]||!is_numeric($_GET[id])) ShowMsg("你提交的参数不正确！","special.php");
//


$Taoapi->method = 'taobao.taobaoke.items.detail.get';
$Taoapi->fields = 'iid,detail_url,num_iid,title,pic_url,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_path,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,auto_repost,approve_status,postage_id,product_id,auction_point,property_alias,itemimg,propimg,sku,outer_id,is_virtural,is_taobao,is_ex,video,click_url,shop_click_url,seller_credit_score';
$Taoapi->num_iids = $id;
$Taoapi->nick = "elinstudio";
$TaobaokeData = $Taoapi->Send('get','xml')->getArrayData();
}else{
	header("Location: special.php");
 	exit();
}

$taobaokeItem = $TaobaokeData["taobaoke_item_details"]["taobaoke_item_detail"];
$info[click_url] = $taobaokeItem["click_url"];
$info[shop_click_url] = $taobaokeItem["shop_click_url"];
$info[seller_credit_score] = $taobaokeItem["seller_credit_score"];
$info[title] = $taobaokeItem["item"]["title"];
$info[nick] = $taobaokeItem["item"]["nick"];
$info[post_fee] = $taobaokeItem["item"]["post_fee"];
$info[express_fee] = $taobaokeItem["item"]["express_fee"];
$info[ems_fee] = $taobaokeItem["item"]["ems_fee"];
$info[desc] = $taobaokeItem["item"]["desc"];
$info[num] = $taobaokeItem["item"]["num"];
$info[price] = $taobaokeItem["item"]["price"];
$info[pic_url] = $taobaokeItem["item"]["pic_url"];
$info[state] = $taobaokeItem["item"]["location"]["state"];
$info[city]= $taobaokeItem["item"]["location"]["city"];
//print_r($TaobaokeData);

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

$seo[title]=$info[title];
$seo[description]=$info[title].",产地:".$info[state].$info[city].",价格：".$info[price]."元";
$seo[keywords]="陕西特产,西安特产,榆林特产,延安特产,安康特产,汉中特产,咸阳特产,渭南特产,宝鸡特产,铜川特产,商洛特产";










$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=2 AND `ad_page`=3 AND `ad_able`=1";
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
'info',
),
array(
$xm_global,
$select,
$seo,
$ad,
$info,
)
);

function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("product.htm");
?>
