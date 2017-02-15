<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
$ad[type]=array(
'1'=>'120*240竖幅',
'2'=>'120*600摩天楼',
'3'=>'125*125按钮',
'4'=>'160*600宽幅摩天楼',
'5'=>'180*150小矩形',
'6'=>'200*200正方形',
'7'=>'234*60横幅',
'8'=>'250*250正方形',
'9'=>'300*120长方形',
'10'=>'300*250中等矩形',
'11'=>'300*280大矩形',
'12'=>'336*280大矩形',
'13'=>'360*150长方形',
'14'=>'360*300大矩形',
'15'=>'460*60横幅',
'16'=>'468*60横幅',
'17'=>'480*160长方形',
'18'=>'500*200长方形',
'19'=>'580*90长方形',
'20'=>'640*60横幅',
'21'=>'728*90首页横幅',
'22'=>'760*60横幅',
'23'=>'760*75横幅',
'24'=>'760*90首页横幅',
'25'=>'960*60首页横幅',
'26'=>'960*75首页横幅',
'27'=>'960*90首页横幅',
'28'=>'1024*60首页横幅',
);
$ad[local]=array(
'1'=>'陕西黄页',
'2'=>'陕西特产',
'3'=>'陕西景区',
'4'=>'地区简介',
);
$ad[page]=array(
'1'=>'网站首页',
'2'=>'列表页',
'3'=>'内容页',
);
$ad[able]=array(
'0'=>'否',
'1'=>'是',
);

$ad[ad]=array(
'1'=>'中间',
'2'=>'右边',
);


if(isset($_GET[del])){
if($_GET[del]==data){
$ID_Dele= implode(",",$_POST['xm']);
$db->query("DELETE FROM `{$dbpre}ad` WHERE `id` in (".$ID_Dele.")");
ShowMsg("链接删除成功","-1");
}else{
$db->query("DELETE FROM `{$dbpre}ad` WHERE `id` = $_GET[del]");
ShowMsg("链接删除成功","-1");
}
}

if(isset($_POST[addflink])){
	if(isset($_GET[edit])){
$sql="UPDATE `{$dbpre}ad` SET `ad_type` = '$_POST[ad_type]',`name` = '$_POST[name]',`ad_id` = '$_POST[ad_id]',`ad_code` = '".$_POST[ad_code]."',
`ad_local` = '$_POST[ad_local]',
`ad_page` = '$_POST[ad_page]',
`ad_able` = '$_POST[ad_able]'  WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";
$db->query($sql);
ShowMsg("链接修改成功！","ad.php");

	}else{
$sql="INSERT INTO `{$dbpre}ad` (
`id` ,
`ad_id`,
`name` ,
`ad_type` ,
`ad_code` ,
`ad_local` ,
`ad_page` ,
`ad_able`
)
VALUES (
NULL , '$_POST[ad_id]', '$_POST[name]', '$_POST[ad_type]', '".$_POST[ad_code]."', '$_POST[ad_local]', '$_POST[ad_page]', '$_POST[ad_able]'
);
";
$db->query($sql);
ShowMsg("链接添加成功！","ad.php");

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
        <th align=center colspan=8 style="height: 23px">网站广告管理</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="8" align="left" class=txlrow><a href="?add=">【点击添加广告】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="5%" align="center" class="txlHeaderBackgroundAlternate">编号</td>
        <td width="10%" align="center" class=txlHeaderBackgroundAlternate>广告类型</td>
        <td width="41%" align="center" class=txlHeaderBackgroundAlternate>广告名称</td>
        <td width="12%" align="center" class=txlHeaderBackgroundAlternate>所在网站</td>
        <td width="9%" align="center" class=txlHeaderBackgroundAlternate>所在页面</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate>是否可用</td>
        <td width="11%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>

<?php
$sql="SELECT * FROM `{$dbpre}ad`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
?>
<tr bgcolor="#DEE5FA">
        <td height="25" align="center" class="txlrow"><?php echo $row[id]?></td>
        <td align="left" class=txlrow><?php echo $ad[type][$row[ad_type]] ?></td>
        <td align="left" class=txlrow><?php echo $row[name]?></td>
        <td align="center" class=txlrow><?php echo $ad[local][$row[ad_local]]?></td>
        <td align="center" class=txlrow>
        <?php echo $ad[page][$row[ad_page]] ?>        </td>
        <td align="center" class=txlrow><?php echo $ad[able][$row[ad_able]] ?></td>
        <td align="center" class=txlrow><a href="?edit=<?php echo $row[id] ?>">编辑</a> <a href="?del=<?php echo $row[id] ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?> name="xm[]" onClick=Checked(form)></td>
</tr>
<?php
}
?>

    <tr bgcolor="#DEE5FA">
        <td colspan="7"  align=center bgcolor="#DEE5FA" class=txlrow>&nbsp;</td>
        <td align=center bgcolor="#DEE5FA" class=txlrow>
     <INPUT type=button title=删除 onclick=DelAll()  value=删除 name=Submit>		</td>
      </tr>


      <tr bgcolor="#DEE5FA">
        <td colspan=8 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>

<?php
if(isset($_GET[add])||isset($_GET[edit])){
if(!empty($_GET[edit])){
		$sql="SELECT * FROM `{$dbpre}ad` WHERE `id`='$_GET[edit]'";
		$query=$db->query($sql);
		$row=$db->fetch_array($query);
}
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align="left" colspan=2 style="height: 23px">添加及修改广告</th>
      </tr>




<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">广告类型:</td>
        <td width="965" align="left" class=txlrow>
		<select name="ad_type">
<?php
foreach($ad[type] as $key => $val){
	if($row[ad_type]==$key){
		echo "<option value=$key selected='selected'>$val</option>";
	}else{
		echo "<option value=$key >$val</option>";
	}
}

 ?>

		</select>		</td>
</tr>


<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">广告名称：</td>
        <td width="965" align="left" class=txlrow><input name="name"  type="text"  size="50" value="<?php echo $row[name]?>" /></td>
</tr>



<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">广告代码：</td>
        <td width="965" align="left" class=txlrow><textarea name="ad_code" cols="50" rows="5"><?php echo $row[ad_code]?></textarea></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">所在网站：</td>
        <td width="965" align="left" class=txlrow>
		<select name="ad_local" >
<?php
foreach($ad[local] as $key => $val){
	if($row[ad_local]==$key){
		echo "<option value=$key selected='selected'>$val</option>";
	}else{
		echo "<option value=$key >$val</option>";
	}
}

 ?>
		</select></td>
</tr>


<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">所在页面：</td>
        <td width="965" align="left" class=txlrow><select name="ad_page" >
<?php
foreach($ad[page] as $key => $val){
	if($row[ad_page]==$key){
		echo "<option value=$key selected='selected'>$val</option>";
	}else{
		echo "<option value=$key >$val</option>";
	}
}

 ?>
		</select>
		<select name="ad_id" >
<?php
foreach($ad[ad] as $key => $val){
	if($row[ad_id]==$key){
		echo "<option value=$key selected='selected'>$val</option>";
	}else{
		echo "<option value=$key >$val</option>";
	}
}

 ?>
		</select>



		</td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">是否可用：</td>
        <td width="965" align="left" class=txlrow>
		<select name="ad_able" >
<?php
foreach($ad[able] as $key => $val){
	if($row[ad_able]==$key){
		echo "<option value=$key selected='selected'>$val</option>";
	}else{
		echo "<option value=$key >$val</option>";
	}
}

 ?>
		</select>

		</td>
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