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
//====================基础内容========================\\
fun_str_ck($_GET[catid]);
fun_str_ck($_GET[areaid]);
fun_str_ck($_GET['page']);
$catid  	= isset($_GET[catid])  	? intval($_GET[catid])  : '';
$areaid 	= isset($_GET[areaid]) 	? intval($_GET[areaid]) : '';
$keywords	= '';

$cate_limit 	= !empty($catid) 	? " AND a.catid = '$catid' " 	: "";
$area_limit 	= !empty($areaid) 	? " AND a.areaid = '$areaid' "	: "";
$keywords_limit = !empty($keywords) ? " AND (a.tname LIKE '%".$keywords."%' OR a.introduce LIKE '%".$keywords."%')" 	: "";


$count_sql	= empty($cate_limit) ? "SELECT COUNT(a.id) FROM `my_elin` AS a WHERE 1 {$area_limit}{$keywords_limit}" : "SELECT COUNT(a.id) FROM `my_elin` AS a  WHERE 1  {$cate_limit}{$area_limit}{$keywords_limit}";
$member_sql = empty($cate_limit) ? "SELECT a.* FROM `my_elin` AS a WHERE 1 {$cate_limit}{$area_limit}{$keywords_limit} ORDER BY a.id DESC" : "SELECT a.* FROM `my_elin` AS a WHERE 1 {$cate_limit}{$area_limit}{$keywords_limit} ORDER BY a.id DESC";
$total=getOne($count_sql);
$page=isset($_GET['page'])?$_GET['page']:1;
$getpageinfo=page($page,$total,14);
$sql=$member_sql.$getpageinfo['sqllimit'];
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$list_qy[]=array('id'=>$row[id],'tname'=>$row[tname],'object'=>$row['object'],'capital'=>$row[capital],'add'=>$row[address],'setup'=>$row[setup],'nature'=>$row[nature]);

}


function getOne($sql, $limited = false){
        if ($limited == true){
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = mysql_query($sql);
        if ($res !== false){
            $row = mysql_fetch_row($res);

            if ($row !== false){
                return $row[0];
            }else{
                return '';
            }
        }else{
            return false;
        }
    }


$sql="select * from my_qyhy";
$query=mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$qyhycat[]=array('qyhyid'=>$row[qyhyid],'qyhyname'=>$row[qyhyname],'qyhyorder'=>$row[qyhyorder]);
}

$sql="select * from my_area";
$query=mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$qyhyarea[]=array('areaid'=>$row[areaid],'areaname'=>$row[areaname]);
}





if(empty($_GET[catid])){
$title="三秦品牌网";
}else{


$title="三秦品牌网 -".$qyhycat[$_GET[catid]-1][qyhyname]."品牌网";
}
$seo[title]=$title;
if(!empty($list_qy)){
foreach($list_qy as $val){
	$seo[keywords].=$val[tname].",";
	}
}
$seo[description]="三秦品牌网。）";
$pgcode=$getpageinfo['pagecode'];



$sql="SELECT * FROM `{$dbpre}ad` WHERE `ad_local`=1 AND `ad_page`=2 AND `ad_able`=1";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$ad[]=array('id'=>$row[id],'code'=>$row[ad_code],'ad_id'=>$row[ad_id]);
}

elin_smarty_assign(
array(
'xm_global',
'pgcode',
'list_qy',
'left_cate',
'qyhyarea',
'qyhycat',
'seo',
'select',
'ad',
),
array(
$xm_global,
$pgcode,
$list_qy,
$left_cate,
$qyhyarea,
$qyhycat,
$seo,
$select,
$ad,
)
);



function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("qyhy.htm");

?>
