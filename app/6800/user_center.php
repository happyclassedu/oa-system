<?php
include_once("global.php");
if($_GET[action]=="logout"){
	setcookie("fj_usersid","",time()-3600);
    setcookie("fj_usershell","",time()-3600);
	ShowMsg("你己成功退出管理系统","login.php");
}
$action = empty($_GET[action])? "index" : $_GET[action];
$userinfo=chk_user_login($_COOKIE[fj_usersid],$_COOKIE[fj_usershell]);
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}
if(@!include "action/".$action.".php") exit();
function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("member/".$action.".htm");
?>
