<?php

if(isset($_GET[del])&&!empty($_GET[del])){
	if($_GET[del]=="data"){
		$id=implode(",",$_POST[xm]);
		$sql="DELETE FROM `{$dbpre}user_add_company` WHERE `id` in ($id) AND `uid`='".$userinfo[id]."'";
	}else{
        $sql="DELETE FROM `{$dbpre}user_add_company` WHERE `id`= '$_GET[del]' AND `uid`='".$userinfo[id]."'";
	}
  $db->query($sql);
  ShowMsg("成功删除企业信息。","?action=company_list");

}

$sql="SELECT * FROM `{$dbpre}user_add_company` WHERE `uid`='".$userinfo[id]."'";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
	$company[]=array('id'=>$row[id],'cname'=>$row[cname],'nature'=>$row[nature],'injointime'=>date("Y-m-d",$row[injointime]));
}





elin_smarty_assign(
array(
'xm_global',
'userinfo',
'company',
),
array(
$xm_global,
$userinfo,
$company,
)
);

?>
