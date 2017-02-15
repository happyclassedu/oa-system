<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
if(isset($_POST[ok])){
	unset($_POST[ok]);
	foreach($_POST as $key=>$val){
	$sql="UPDATE `{$dbpre}sysconfig` SET `value` = '".$val."' WHERE `varname` ='".$key."' AND `groupid`=1 LIMIT 1 ;";
	$db->query($sql);
	}
	if($_POST[cfg_html]=="Yes"){
		$val=$_POST[cfg_html]."|".$_POST[htmldir];
	$sql="UPDATE `{$dbpre}sysconfig` SET `value` = '".$val."' WHERE `varname` ='cfg_html' AND `groupid`=1 LIMIT 1 ;";
	$db->query($sql);
	}
	ShowMsg("配置信息已保存","sysconfig.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
</head>
<body>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">网站基本配置</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="2" align="center" class=txlrow>&nbsp;</td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="32%" align="left" class="txlHeaderBackgroundAlternate">配置说明</td>
        <td width="68%" align="left" class=txlHeaderBackgroundAlternate>请正确填写相关的配置信息</td>
      </tr>
<?php
$sql="SELECT * FROM `{$dbpre}sysconfig` WHERE `groupid`='1'";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){

?>
<tr bgcolor="#DEE5FA">
        <td align="left" class="txlrow"><?php echo $row[info]; ?></td>
        <td align="left" class=txlrow>
<?php
 if($row[type]=="bstring"){
      echo "<textarea name=$row[varname] cols='50' rows='6'>$row[value]</textarea>";
     }elseif($row[type]=="select"){
     	if($row[value]=='No'){
      		echo "    <select name='$row[varname]' onchange=\"if(this.options[this.selectedIndex].value == 'Yes'){document.getElementById('htmldir').style.display = 'block'}else{document.getElementById('htmldir').style.display = 'none'}\">
        <option value='No' selected='selected'>否</option>
        <option value='Yes'>是</option>
    </select><input type='text' size='20' id='htmdir' name='htmldir' style='display:none'>";
     	}else{
     		$dir=explode('|',$row[value]);
     		echo "    <select name='$row[varname]' onchange=\"if(this.options[this.selectedIndex].value == 'Yes'){document.getElementById('htmldir').style.display = 'block'}else{document.getElementById('htmldir').style.display = 'none'}\">
        <option value='No' >否</option>
        <option value='Yes' selected='selected'>是</option>
    </select><input type='text' size='20' id='htmldir' name='htmldir' value='".$dir[1]."'  style='display:block'>";
     	}
     }else{
      echo "<input size='50' name='$row[varname]' value=$row[value] />";
     }
?>

        </td>
</tr>




<?php
}
?>


      <tr bgcolor="#DEE5FA">
        <td colspan="2" align=center bgcolor="#DEE5FA" class=txlrow>
<input type="submit" name="ok" value="保存设置" class="but"></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=2 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>


</BODY>
  </HTML>