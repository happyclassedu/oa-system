<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
if(isset($_GET[del])){
$sql="SELECT * FROM `{$dbpre}admin` WHERE `id`='$_GET[del]'";
$query=$db->query($sql);
$row=$db->fetch_array($query);
if($row&&$row[m_id]!=1){
if($row[id]==1)ShowMsg("系统管理员账号不能删除", "account.php");
$sql="DELETE FROM `xm_admin` WHERE  `id`='$_GET[del]'";
$db->query($sql);
ShowMsg("成功删除管理账号", "account.php");
}else{
ShowMsg("你要册除的记录不存在或没有权限删除", "account.php");
}
}

if(isset($_POST[adminsubmit])){
switch ($_POST[m_id]){
	case 1:
	$title="超级管理员";
	break;
	case 2:
	$title="普通管理员";
	break;
}
if($_GET[id]){
if(empty($_POST[passwd])){
$sql="UPDATE `{$dbpre}admin` SET `m_id` = '$_POST[m_id]',`userid` = '$_POST[userid]'," .
		"`remark` = '$_POST[remark]',`title` = '$title'  WHERE  `id` ='$_GET[id]';";
$db->query($sql);
	}else{
$newps=md5($_POST[passwd]."xmf1");
$sql="UPDATE `{$dbpre}admin` SET `m_id` = '$_POST[m_id]',`userid` = '$_POST[userid]',`passwd` = '$newps'," .
		"`remark` = '$_POST[remark]',`title` = '$title' WHERE  `id` ='$_GET[id]';";
$db->query($sql);
	}

ShowMsg("管理员账号修改成功", "account.php");
}else{
$newps=md5($_POST[passwd]."xmf1");
$sql="INSERT INTO `{$dbpre}admin` (`id`, `m_id`, `userid`, `passwd`, `remark`,`title`) " .
		"VALUES ('NULL', '$_POST[m_id]', '$_POST[userid]', '$newps', '$_POST[remark]','$title');";
$db->query($sql);
ShowMsg("管理员账号添加成功", "account.php");
}
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
        <th align=center colspan=5 style="height: 23px">后台账户管理</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="5" align="left" class=txlrow><a href="?admin=add">【点击添加管理员】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="9%" align="left" class="txlHeaderBackgroundAlternate">管理员级别</td>
		<td width="23%" align="left" class="txlHeaderBackgroundAlternate">管理员账号</td>
		<td width="29%" align="left" class="txlHeaderBackgroundAlternate">管理员密码</td>
		<td width="28%" align="left" class="txlHeaderBackgroundAlternate">账号备注</td>
        <td width="11%" align="left" class=txlHeaderBackgroundAlternate>操作</td>
      </tr>
<?php
$sql="SELECT * FROM `{$dbpre}admin`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){

?>

<tr bgcolor="#DEE5FA">
        <td align="left" class="txlrow"><?php echo $row[title]; ?></td>
		<td align="left" class="txlrow"><?php echo $row[userid]; ?></td>
		<td align="left" class="txlrow"><?php echo md5(microtime(true).$row[userid]); ?></td>
		<td align="left" class="txlrow"><?php echo $row[remark]; ?></td>
      <td align="left" class=txlrow><a href="?id=<?php echo $row[id]; ?>">编辑</a> <a href="?del=<?php echo $row[id]; ?>">删除</a> </td>
</tr>

<?php
}
?>


      <tr bgcolor="#DEE5FA">
        <td colspan=5 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>



<?php
if(isset($_GET[admin])||isset($_GET[id])){
if(isset($_GET[id])&&!empty($_GET[id])){
$sql_edit="SELECT * FROM `{$dbpre}admin` WHERE `id`='$_GET[id]'";
$total_edit=mysql_num_rows($db->query($sql_edit));
$query_edit=$db->query($sql_edit);
if($total_edit!=0){
$row_edit=$db->fetch_array($query_edit);
}
else{
ShowMsg("你要修改的管理员账号不存在请返回","-1");
}
}
?>
<FORM name=formadd method=post>
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th height="23" colspan="2" align="left" >管理员添加与修改</th>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">管理员账户：</td>
        <td class="txlrow" width="91%" height=""><input name="userid" type="text" class="input"  value="<?php echo $row_edit[userid];?>" size="40" /></td>
      </tr>

	  <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">管理员密码：</td>
        <td class="txlrow" width="91%" height=""><input name="passwd" type="text" class="input" value="" size="40" />密码留空为不修改</td>
      </tr>

	  <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">管理员级别：</td>
        <td class="txlrow" width="91%" height="">
		<select name="m_id">
		<?php
        if($row_edit[m_id]=="1"){
				echo "<option value =\"1\" selected=\"selected\">超级管理员</option><option value =\"2\" >普通管理员</option>\n";
			}else{
				echo "<option value =\"1\">超级管理员</option><option value =\"2\"  selected=\"selected\" >普通管理员</option>\n";
			}
			?>

        </select>
      </td>
      </tr>

      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">账号&nbsp;&nbsp;备注：</td>
        <td class="txlrow" width="91%" height="">
		<textarea  cols='50' rows='6' name="remark"><?php echo $row_edit[remark];?></textarea>
	    </td>
      </tr>

      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" height="26" colspan="2"><input type="submit" name="adminsubmit" value="提交"/></td>

      </tr>



    </tbody>
  </table>


</FORM>


<?php
}

?>

</BODY>
  </HTML>