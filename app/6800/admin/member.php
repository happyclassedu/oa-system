<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
if(isset($_GET[del])&&!empty($_GET[del])){
	if($_GET[del]=="data"){
		$id=implode(",",$_POST[xm]);
		$sql="DELETE FROM `{$dbpre}member` WHERE `id` in ($id)";
	}else{
        $sql="DELETE FROM `{$dbpre}member` WHERE `id`= '$_GET[del]'";
	}
  $db->query($sql);
  ShowMsg("成功删除会员账号。","-1");

}

if(isset($_POST[membersubmit])){
if($_GET[id]){
if(empty($_POST[userpwd])){
$sql="UPDATE `{$dbpre}member` SET `userid` = '$_POST[userid]',`email` = '$_POST[email]'  WHERE  `id` ='$_GET[id]';";
$db->query($sql);
	}else{
$newps=md5($_POST[userpwd].'elinstudio');
$sql="UPDATE `{$dbpre}member` SET `userid` = '$_POST[userid]',`email` = '$_POST[email]',`userpwd` = '$newps' WHERE  `id` ='$_GET[id]';";
$db->query($sql);
	}

ShowMsg("会员账号修改成功", "member.php");
}else{
$newps=md5($_POST[userpwd].'elinstudio');
$sql="INSERT INTO `{$dbpre}member` (`id`, `userid`, `userpwd`, `email`,`jointime`) " .
		"VALUES ('NULL', '$_POST[userid]', '$newps', '$_POST[email]','".mktime()."');";
$db->query($sql);
ShowMsg("会员账号添加成功", "member.php");
}
}
?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
<style type="text/css">
.page{padding:2px;font-weight:bolder;font-size:12px;}
.page a{border:1px solid #ccc;padding:0 5px 0 5px;margin:2px;text-decoration:none;color:#333;}
.page span{padding:0 5px 0 5px;margin:2px;background:#799AE1;color:#fff;border:1px solid #799AE1;}
</style>
<SCRIPT language=javascript>
function CheckAll(form)
{
  for (var ii=0;ii<form.elements.length;ii++)
    {
    var e = form.elements[ii];
    if (e.Name != "chkAll")
       e.checked = form.chkAll.checked;
    }
}
function Checked()
{
	var jj = 0
	for(ii=0;ii < document.form.elements.length;ii++){
		if(document.form.elements[ii].name == "xm[]"){
			if(document.form.elements[ii].checked){
				jj++;
			}
		}
	}
	return jj;
}

function DelAll()
{
	if(Checked()  <= 0){
		alert("您至少选择1条信息!");
	}
	else{
		if(confirm("确定要删除选择的信息吗？\n此操作不可以恢复！")){
			form.action="?del=data";
			form.submit();
		}
	}
}
//-->
</SCRIPT>
</head>
<body>
<form name="form" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=9 style="height: 23px">会员账号管理</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="9" align="left" class=txlrow><a href="?member=add">【点击添加会员】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="8%" align="center" class="txlHeaderBackgroundAlternate">会员ID</td>
        <td width="8%" align="center" class="txlHeaderBackgroundAlternate">会员级别</td>
		<td width="21%" align="center" class="txlHeaderBackgroundAlternate">会员账号</td>
		<td width="12%" align="center" class="txlHeaderBackgroundAlternate">注册时间</td>
		<td width="12%" align="center" class="txlHeaderBackgroundAlternate">注册IP</td>
        <td width="11%" align="center" class="txlHeaderBackgroundAlternate">最后登录时间</td>
		<td width="11%" align="center" class="txlHeaderBackgroundAlternate">最后登录IP</td>
        <td width="11%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>
<?php
$page=isset($_GET['page'])?$_GET['page']:1;
$counts=mysql_num_rows(mysql_query("SELECT * FROM `{$dbpre}member`"));
$getpageinfo=page($page,$counts,25);
$sql="SELECT * FROM `{$dbpre}member` $getpageinfo[sqllimit]";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){

?>

<tr bgcolor="#DEE5FA">
  <td align="center" class="txlrow"><?php echo $row[id]; ?></td>
        <td align="center" class="txlrow">普通会员</td>
		<td align="center" class="txlrow"><?php echo $row[userid]; ?></td>
		<td align="center" class="txlrow"><?php echo date("Y-m-d",$row[jointime]); ?></td>
		<td align="center" class="txlrow"><?php echo $row[joinip]; ?></td>
        <td align="center" class="txlrow"><?php echo date("Y-m-d",$row[logintime]);  ?></td>
		<td align="center" class="txlrow"><?php echo $row[loginip]; ?></td>
        <td align="center" class=txlrow><a href="?id=<?php echo $row[id]; ?>">编辑</a> <a href="?del=<?php echo $row[id]; ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?>  name="xm[]" onClick=Checked(form)></td>
</tr>

<?php
}
?>
<tr bgcolor="#DEE5FA">
  <td align="center" class="txlrow"><font color="red"><b><?php echo $counts; ?></b></font></td>
        <td colspan="7" align="center" class="txlrow"><?php echo $getpageinfo['pagecode'];?></td>
		<td align="center" class=txlrow><input type=button title=删除 onClick=DelAll()  value=删除 name=Submit></td>
</tr>

      <tr bgcolor="#DEE5FA">
        <td colspan=9 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>



<?php
if(isset($_GET[member])||isset($_GET[id])){
if(isset($_GET[id])&&!empty($_GET[id])){
$sql_edit="SELECT * FROM `{$dbpre}member` WHERE `id`='$_GET[id]'";
$total_edit=mysql_num_rows($db->query($sql_edit));
$query_edit=$db->query($sql_edit);
if($total_edit!=0){
$row_edit=$db->fetch_array($query_edit);
}
else{
ShowMsg("你要修改的会员账号不存在请返回","-1");
}
}
?>
<FORM name=formadd method=post>
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder><tbody><tr align="left" bgcolor="#DEE5FA"><td class="txlrow" width="91%" height=""><table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th height="23" colspan="2" align="left" >管理员添加与修改</th>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">会员账号：</td>
        <td class="txlrow" width="91%" height=""><input name="userid" type="text" class="input"  value="<?php echo $row_edit[userid];?>" size="40" /></td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">会员密码：</td>
        <td class="txlrow" width="91%" height=""><input name="userpwd" type="text" class="input" value="" size="40" />
          密码留空为不修改</td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">会员邮箱：</td>
        <td class="txlrow" width="91%" height=""><input name="email" type="text" class="input" value="<?php echo $row_edit[email];?>" size="40" /></td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" height="26" colspan="2"><input type="submit" name="membersubmit" value="提交"/></td>
      </tr>
    </tbody>
  </table></td>
      </tr>
</tbody>
</table>


</FORM>


<?php
}

?>

</BODY>
  </HTML>