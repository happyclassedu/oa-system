<?php
include_once('admin_global.php');
if($_GET[action]=="out"){
	unset($_SESSION[uid]);
	session_destroy();
	ShowMsg("�㼺�ɹ��˳�����ϵͳ","index.php");
}

if(isset($_POST[IbtnEnter])){
    if($_POST[TxtUserName]==""||$_POST[TxtPassword]==""){
    	ShowMsg("�û��������벻��Ϊ�գ��뷴����д","login.html");
     }
     preg_match("/^[0-9a-z_]*$/i",trim($_POST['TxtUserName']),$arr);
    if(!$arr){
     ShowMsg("�û���ֻ������ĸ������","login.html");
     }
    $userid=trim($_POST['TxtUserName']);
    $passwd=trim($_POST['TxtPassword']);
	fun_str_ck($_POST['TxtUserName']);
	fun_str_ck($_POST['TxtPassword']);
    $sql="SELECT * FROM `{$dbpre}admin` WHERE `userid`='$userid' and `passwd`='".md5($passwd."xmf1")."'";
    $query=$db->query($sql);
    $row=$db->fetch_array($query);
    if($row){
    $_SESSION[uid]=$row[id];
    $_SESSION[user_shell]=md5($row[userid].$row[passwd]."xmf1");


	ShowMsg("��¼�ɹ�","Default.php","","3000");
    }else{
    ShowMsg("�û������������","login.html");
    }

}else{
	checklocation();
}
function checklocation(){
if($_SESSION[uid]){
	echo "<script>location.href='Default.php'</script>";
}else{
	echo "<script>location.href='login.html'</script>";
}

}



?>
