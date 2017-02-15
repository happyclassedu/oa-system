<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
if(isset($_GET[del])){
if($_GET[del]==data){
$ID_Dele= implode(",",$_POST['xm']);
$db->query("DELETE FROM `{$dbpre}flink` WHERE `id` in (".$ID_Dele.")");
ShowMsg("链接删除成功","-1");
}else{
$db->query("DELETE FROM `{$dbpre}flink` WHERE `id` = $_GET[del]");
ShowMsg("链接删除成功","-1");
}
}

if(isset($_POST[addflink])){
	if(isset($_GET[edit])){
$sql="UPDATE `{$dbpre}flink` SET `webname` = '".$_POST[webname]."',
`weburl` = '".$_POST[weburl]."',
`weblogo` = '".$_POST[weblogo]."',
`qq` = '".$_POST[qq]."',
`mail` = '".$_POST[mail]."',
`introduce` = '".$_POST[introduce]."',
`linkorder` = '".$_POST[linkorder]."' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";
$db->query($sql);
ShowMsg("链接修改成功！","flink.php");

	}else{
$sql="INSERT INTO `{$dbpre}flink` (
`id` ,
`webname` ,
`weburl` ,
`weblogo` ,
`qq` ,
`mail` ,
`introduce` ,
`linkorder`
)
VALUES (
NULL , '".$_POST[webname]."', '".$_POST[weburl]."', '".$_POST[weblogo]."', '".$_POST[qq]."', '".$_POST[mail]."', '".$_POST[introduce]."', '".$_POST[linkorder]."'
);
";
$db->query($sql);
ShowMsg("链接添加成功！","flink.php");

	}

}

?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
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

</SCRIPT>
</head>
<body>
<form name="form" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=9 style="height: 23px">网站友情链接管理</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="9" align="left" class=txlrow><a href="?add=">【点击添加友情链接】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="4%" align="center" class="txlHeaderBackgroundAlternate">排序</td>
        <td width="9%" align="center" class=txlHeaderBackgroundAlternate>网站名称</td>
        <td width="19%" align="center" class=txlHeaderBackgroundAlternate>网站网址</td>
        <td width="10%" align="center" class=txlHeaderBackgroundAlternate>网站LOGO</td>
        <td width="8%" align="center" class=txlHeaderBackgroundAlternate>联系QQ</td>
        <td width="16%" align="center" class=txlHeaderBackgroundAlternate>联系邮箱</td>
        <td width="24%" align="center" class=txlHeaderBackgroundAlternate>网站简介</td>
        <td width="7%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="3%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>

<?php
$sql="SELECT * FROM `{$dbpre}flink` order by `linkorder`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
?>
<tr bgcolor="#DEE5FA">
        <td height="33" align="center" class="txlrow"><?php echo $row[linkorder]?></td>
        <td align="left" class=txlrow><a href='<?php echo $row[weburl]?>'><?php echo $row[webname]?></a></td>
        <td align="left" class=txlrow><?php echo $row[weburl]?></td>
        <td align="center" class=txlrow>
        <?php
        if(!empty($row[weblogo])){
		echo "<img src=".$row[weblogo]." width=80px height=30px />";
        }
        ?>
        </td>
        <td align="center" class=txlrow><?php echo $row[qq]?></td>
        <td align="left" class=txlrow><?php echo $row[mail]?></td>
        <td align="left" class=txlrow><?php echo $row[introduce]?></td>
        <td align="center" class=txlrow><a href="?edit=<?php echo $row[id] ?>">编辑</a> <a href="?del=<?php echo $row[id] ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?> name="xm[]" onClick=Checked(form)></td>
</tr>
<?php
}
?>

    <tr bgcolor="#DEE5FA">
        <td colspan="8"  align=center bgcolor="#DEE5FA" class=txlrow>&nbsp;</td>
        <td align=center bgcolor="#DEE5FA" class=txlrow>
     <INPUT type=button title=删除 onclick=DelAll()  value=删除 name=Submit>
		</td>
      </tr>


      <tr bgcolor="#DEE5FA">
        <td colspan=9 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>

<?php
if(isset($_GET[add])||isset($_GET[edit])){
if(!empty($_GET[edit])){
		$sql="SELECT * FROM `{$dbpre}flink` WHERE `id`='$_GET[edit]'";
		$query=$db->query($sql);
		$row=$db->fetch_array($query);
}
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align="left" colspan=2 style="height: 23px">添加及修改友情链接</th>
      </tr>
<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">网站名称：</td>
        <td width="965" align="left" class=txlrow><input name="webname"  type="text"  size="50" value="<?php echo $row[webname]?>" /></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">网站网址:</td>
        <td width="965" align="left" class=txlrow><input name="weburl" type="text" value="<?php echo $row[weburl]?>" size="50" /></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">网站LOGO:</td>
        <td width="965" align="left" class=txlrow><input name="weblogo" type="text" value="<?php echo $row[weblogo]?>" size="50" /></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">联系QQ：</td>
        <td width="965" align="left" class=txlrow><input name="qq" type="text" value="<?php echo $row[qq]?>" size="50" /></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">联系邮箱：</td>
        <td width="965" align="left" class=txlrow><input name="mail" type="text" value="<?php echo $row[mail]?>" size="50" /></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">网站简介：</td>
        <td width="965" align="left" class=txlrow><textarea name="introduce" cols="50" rows="5"><?php echo $row[introduce]?></textarea></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">显示排序：</td>
        <td width="965" align="left" class=txlrow><input name="linkorder" type="text" value="<?php echo $row[linkorder]?>" size="8" /></td>
</tr>



      <tr bgcolor="#DEE5FA">
        <td colspan="2" align="left" bgcolor="#DEE5FA" class=txlrow>
<input type="submit" name="addflink" value="保存设置" class="but"></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=2 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>


<?php
}

?>





</BODY>
</HTML>