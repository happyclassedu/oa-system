<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
$ad[type]=array(
'1'=>'120*240����',
'2'=>'120*600Ħ��¥',
'3'=>'125*125��ť',
'4'=>'160*600���Ħ��¥',
'5'=>'180*150С����',
'6'=>'200*200������',
'7'=>'234*60���',
'8'=>'250*250������',
'9'=>'300*120������',
'10'=>'300*250�еȾ���',
'11'=>'300*280�����',
'12'=>'336*280�����',
'13'=>'360*150������',
'14'=>'360*300�����',
'15'=>'460*60���',
'16'=>'468*60���',
'17'=>'480*160������',
'18'=>'500*200������',
'19'=>'580*90������',
'20'=>'640*60���',
'21'=>'728*90��ҳ���',
'22'=>'760*60���',
'23'=>'760*75���',
'24'=>'760*90��ҳ���',
'25'=>'960*60��ҳ���',
'26'=>'960*75��ҳ���',
'27'=>'960*90��ҳ���',
'28'=>'1024*60��ҳ���',
);
$ad[local]=array(
'1'=>'������ҳ',
'2'=>'�����ز�',
'3'=>'��������',
'4'=>'�������',
);
$ad[page]=array(
'1'=>'��վ��ҳ',
'2'=>'�б�ҳ',
'3'=>'����ҳ',
);
$ad[able]=array(
'0'=>'��',
'1'=>'��',
);

$ad[ad]=array(
'1'=>'�м�',
'2'=>'�ұ�',
);


if(isset($_GET[del])){
if($_GET[del]==data){
$ID_Dele= implode(",",$_POST['xm']);
$db->query("DELETE FROM `{$dbpre}ad` WHERE `id` in (".$ID_Dele.")");
ShowMsg("����ɾ���ɹ�","-1");
}else{
$db->query("DELETE FROM `{$dbpre}ad` WHERE `id` = $_GET[del]");
ShowMsg("����ɾ���ɹ�","-1");
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
ShowMsg("�����޸ĳɹ���","ad.php");

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
ShowMsg("������ӳɹ���","ad.php");

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
		alert("������ѡ��1����Ϣ!");
	}
	else{
		if(confirm("ȷ��Ҫɾ��ѡ�����Ϣ��\n�˲��������Իָ���")){
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
        <th align=center colspan=8 style="height: 23px">��վ������</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="8" align="left" class=txlrow><a href="?add=">�������ӹ�桿</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="5%" align="center" class="txlHeaderBackgroundAlternate">���</td>
        <td width="10%" align="center" class=txlHeaderBackgroundAlternate>�������</td>
        <td width="41%" align="center" class=txlHeaderBackgroundAlternate>�������</td>
        <td width="12%" align="center" class=txlHeaderBackgroundAlternate>������վ</td>
        <td width="9%" align="center" class=txlHeaderBackgroundAlternate>����ҳ��</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate>�Ƿ����</td>
        <td width="11%" align="center" class=txlHeaderBackgroundAlternate>����</td>
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
        <td align="center" class=txlrow><a href="?edit=<?php echo $row[id] ?>">�༭</a> <a href="?del=<?php echo $row[id] ?>">ɾ��</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?> name="xm[]" onClick=Checked(form)></td>
</tr>
<?php
}
?>

    <tr bgcolor="#DEE5FA">
        <td colspan="7"  align=center bgcolor="#DEE5FA" class=txlrow>&nbsp;</td>
        <td align=center bgcolor="#DEE5FA" class=txlrow>
     <INPUT type=button title=ɾ�� onclick=DelAll()  value=ɾ�� name=Submit>		</td>
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
        <th align="left" colspan=2 style="height: 23px">��Ӽ��޸Ĺ��</th>
      </tr>




<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">�������:</td>
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
        <td width="76" align="left" class="txlrow">������ƣ�</td>
        <td width="965" align="left" class=txlrow><input name="name"  type="text"  size="50" value="<?php echo $row[name]?>" /></td>
</tr>



<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">�����룺</td>
        <td width="965" align="left" class=txlrow><textarea name="ad_code" cols="50" rows="5"><?php echo $row[ad_code]?></textarea></td>
</tr>

<tr bgcolor="#DEE5FA">
        <td width="76" align="left" class="txlrow">������վ��</td>
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
        <td width="76" align="left" class="txlrow">����ҳ�棺</td>
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
        <td width="76" align="left" class="txlrow">�Ƿ���ã�</td>
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
<input type="submit" name="addflink" value="��������" class="but"></td>
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