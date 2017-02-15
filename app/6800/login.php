<?php
include_once("global.php");
checklocation();
$sql="SELECT * FROM `{$dbpre}sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}

if(isset($_POST[operation])&&$_POST[sURL]=="member"){
	if($_POST[username]==""||$_POST[password]==""){
    	ShowMsg("用户名和密码不能为空，请反回填写","login.php");
     }
     preg_match("/^[0-9a-z_]*$/i",trim($_POST['username']),$arr);
    if(!$arr){
     ShowMsg("用户名只能用字母或数字","login.php");
     }
    $userid=trim($_POST['username']);
    $passwd=trim($_POST['password']);
	fun_str_ck($_POST['username']);
	fun_str_ck($_POST['password']);

	$sql="SELECT * FROM `{$dbpre}member` WHERE `userid`='$userid' and `userpwd`='".md5($passwd."elinstudio")."'";
    $query=$db->query($sql);
    $row=$db->fetch_array($query);
    if($row){
    setcookie("fj_usersid",$row[id]);
    setcookie("fj_usershell",md5($row[userid].$row[userpwd]."XMF1"));
	ShowMsg("登录成功","user_center.php","","3000");
    }else{
    setcookie("fj_usersid","");
    setcookie("fj_usershell","");
    ShowMsg("用户名或密码错误","login.php");

    }

}


elin_smarty_assign(
array(
'xm_global',
),
array(
$xm_global,

)
);

function elin_smarty_assign($arr="",$ass=""){
	global $smarty;
    foreach($arr as $key=>$val){
    $smarty->assign($arr[$key],$ass[$key]);
    }
}
$smarty->display("member/login.htm");
function checklocation(){
if($_COOKIE[fj_usersid]){
	echo "<script>location.href='user_center.php'</script>";
}
}
?>
