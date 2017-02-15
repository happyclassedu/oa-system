<?php
$sql="SELECT * FROM {$dbpre}class_city ";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$select[]=array('id'=>$row[id],'name'=>$row[name]);
}

$result = $db->query("select * from `{$dbpre}industry` WHERE `pid`='0'");
while($row = $db->fetch_array($result)){
     $industry[]=array('id'=>$row[id],'name'=>$row[name]);
}
if(isset($_GET[edit])&&!empty($_GET[edit])){
	fun_str_ck($_GET[edit]);
	$sql="select * from `{$dbpre}user_add_company` WHERE `id`='".$_GET[edit]."' AND `uid`='".$userinfo[id]."'";
	$query=$db->query($sql);
	$company=mysql_fetch_array($query);
	$sql="select * from `{$dbpre}industry` WHERE `id`='".$company[industry]."'";
	$query=$db->query($sql);
	$p_industry=mysql_fetch_array($query);

	$sql="select * from `{$dbpre}class_county` WHERE `pid`='".$company[city]."'";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$county[]=array('id'=>$row[id],'name'=>$row[name]);
	}

	$sql="select * from `{$dbpre}industry` WHERE `pid`='".$p_industry[pid]."'";
	$query=$db->query($sql);
	while($row=mysql_fetch_array($query)){
		$sub_industry[]=array('id'=>$row[id],'name'=>$row[name]);
	}


}






if(isset($_POST[xmf1])&&$_POST[xmf1]=="xmf1.com"){
	foreach($_POST as $val){
			fun_str_ck($val);
		}
	foreach($_GET as $val){
			fun_str_ck($val);
		}

	if(!empty($_POST[name])&&!empty($_POST[province])&&!empty($_POST[address])&&!empty($_POST[industry])&&!empty($_POST[nature])&&!empty($_POST[tel])&&!empty($_POST[description])){
			if(isset($_GET[edit])&&!empty($_GET[edit])){
		$sql="UPDATE `{$dbpre}user_add_company` SET `cname` = '$_POST[name]',
`cadd` = '$_POST[address]',
`ctel` = '$_POST[tel]',
`cmail` = '$_POST[email]',
`cweb` = '$_POST[web]',
`industry` = '$_POST[sub_industry]',
`nature` = '$_POST[nature]',
`cnumber` = '',
`capital` = '$_POST[capital]',
`setup` = '$_POST[setup]',
`brief` = '$_POST[description]',
`products` = '$_POST[business]',
`province` = '1',
`city` = '$_POST[province]',
`local` = '$_POST[city]',
`click` = '1',
`update` = '".mktime()."',
`keyword` = '',
`description` = '',
`injointime` = '".mktime()."' WHERE `id` ='$_GET[edit]' AND `uid`='".$userinfo[id]."' LIMIT 1 ;
";
$db->query($sql);
ShowMsg("企业信息修改成功！","?action=company_list");
		}else{
		$sql="SELECT * FROM `{$dbpre}user_add_company`WHERE `cname`='$_POST[name]'";
		$query=$db->query($sql);
		$row=$db->fetch_array($query);
		if($row){
		ShowMsg("你要添加的公司信息己存在，谢谢！","?action=company_list");
		}
		$sql="INSERT INTO `{$dbpre}user_add_company` (
`id` ,
`uid` ,
`cname` ,
`cadd` ,
`ctel` ,
`cmail` ,
`cweb` ,
`industry` ,
`nature` ,
`cnumber` ,
`capital` ,
`setup` ,
`brief` ,
`products` ,
`province` ,
`city` ,
`local` ,
`click` ,
`update` ,
`keyword` ,
`description`,
`injointime`
)
VALUES (
NULL , '$userinfo[id]', '$_POST[name]', '$_POST[address]', '$_POST[tel]', '$_POST[email]', '$_POST[web]', '$_POST[sub_industry]', '$_POST[nature]', '', '$_POST[capital]', '$_POST[setup]', '$_POST[description]', '$_POST[business]', '1', '$_POST[province]', '$_POST[city]', '1', '".mktime()."', '', '', '".mktime()."'
);
";
$db->query($sql);
ShowMsg("成功添加一条企业信息！","?action=company_list");
		}


	}else{
	ShowMsg("为*号的选项为必填项！请反回正确填写。","?action=company_add");
	}
}






elin_smarty_assign(
array(
'xm_global',
'userinfo',
'select',
'industry',
'company',
'p_industry',
'county',
'sub_industry',
),
array(
$xm_global,
$userinfo,
$select,
$industry,
$company,
$p_industry,
$county,
$sub_industry,
)
);
?>
