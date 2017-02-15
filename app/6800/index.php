<?php
include_once("global.php");
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)) {
    $xm_global[$row[varname]]=$row[value];
}

$sql="SELECT * FROM {$dbpre}class_city ";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)) {
    $select[]=array('id'=>$row[id],'name'=>$row[name]);
}

$city=$select;

foreach($city as $key=>$val) {
    $sql="SELECT * FROM {$dbpre}class_county WHERE `pid`=".$val[id]."";
    $query=$db->query($sql);
    while($row=mysql_fetch_array($query)) {
        $city[$key][sub][]=array('id'=>$row[id],'name'=>$row[name]);
    }
}
$index_ad=GetFocus($val='');

$link=GetFlink(0);
$seo[title]="三秦品牌网??陕西第一品牌网";
foreach($select as $val) {
    $seo[keywords].=$val[name]."黄页,";
}
$seo[keywords].$xm_global[cfg_keywords];
$seo[description]="三秦品牌网??陕西第一品牌网";


$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=1 AND `ad_page`=1 AND `ad_able`=1";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)) {
    $ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
}

$sql="SELECT `id`,`cname` FROM `{$dbpre}company` ORDER BY `injointime` DESC LIMIT 15";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)) {
    $newjoin[]=array('id'=>$row[id],'cname'=>$row[cname]);
}

$sql="SELECT `id`,`cname` FROM `{$dbpre}company` ORDER BY `update` DESC LIMIT 15";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)) {
    $newupdate[]=array('id'=>$row[id],'cname'=>$row[cname]);
}

elin_smarty_assign(
        array(
        'xm_global',
        'city',
        'select',
        'link',
        'index_ad',
        'seo',
        'ad',
        'newjoin',
        'newupdate',
        ),
        array(
        $xm_global,
        $city,
        $select,
        $link,
        $index_ad,
        $seo,
        $ad,
        $newjoin,
        $newupdate,
        )
);



function elin_smarty_assign($arr="",$ass="") {
    global $smarty;
    foreach($arr as $key=>$val) {
        $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("index.htm");
?>
