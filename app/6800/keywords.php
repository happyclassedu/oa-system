<?php
$city=$select;
foreach($city as $key=>$val){
	$sql="SELECT * FROM {$dbpre}class_county WHERE `pid`=".$val[id]."";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
	$city[$key][sub][]=$row[name];
	}
}
function echolist($kk){
	static $list;

	foreach ($kk as $key => $val){
	if(is_array($val)){
		echolist($val);
	}else{
		$val=str_replace("��","",$val);
		if(!is_numeric($val)){
		$list[]=$list[]="/".$val."/";;
		}

	}


	}
	return $list;


}

$bb=echolist($city);
$bb[]="/���޹�˾/";
$bb[]="/��˾/";
$bb[]="/�绰/";
$bb[]="/��ַ/";
$i=0;
while($i<count($bb)){
	$ss[]="";
	$i++;
}


?>
