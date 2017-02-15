<?php
$sql="SELECT `id`,`cname` FROM `{$dbpre}company` ORDER BY `injointime` DESC LIMIT 20";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$newjoin[]=array('id'=>$row[id],'cname'=>$row[cname]);
}

$sql="SELECT `id`,`cname` FROM `{$dbpre}company` ORDER BY `update` DESC LIMIT 20";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$update[]=array('id'=>$row[id],'cname'=>$row[cname]);
}

$sql="SELECT `id`,`cname` FROM `{$dbpre}company` WHERE `uid`='$userinfo[id]' ORDER BY `injointime` DESC LIMIT 6";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$verify[]=array('id'=>$row[id],'cname'=>$row[cname]);
}

elin_smarty_assign(
array(
'xm_global',
'userinfo',
'newjoin',
'update',
'verify',
),
array(
$xm_global,
$userinfo,
$newjoin,
$update,
$verify,
)
);
?>
