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
  ShowMsg("�ɹ�ɾ����Ա�˺š�","-1");

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

ShowMsg("��Ա�˺��޸ĳɹ�", "member.php");
}else{
$newps=md5($_POST[userpwd].'elinstudio');
$sql="INSERT INTO `{$dbpre}member` (`id`, `userid`, `userpwd`, `email`,`jointime`) " .
		"VALUES ('NULL', '$_POST[userid]', '$newps', '$_POST[email]','".mktime()."');";
$db->query($sql);
ShowMsg("��Ա�˺���ӳɹ�", "member.php");
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
		alert("������ѡ��1����Ϣ!");
	}
	else{
		if(confirm("ȷ��Ҫɾ��ѡ�����Ϣ��\n�˲��������Իָ���")){
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
        <th align=center colspan=9 style="height: 23px">��Ա�˺Ź���</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="9" align="left" class=txlrow><a href="?member=add">�������ӻ�Ա��</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="8%" align="center" class="txlHeaderBackgroundAlternate">��ԱID</td>
        <td width="8%" align="center" class="txlHeaderBackgroundAlternate">��Ա����</td>
		<td width="21%" align="center" class="txlHeaderBackgroundAlternate">��Ա�˺�</td>
		<td width="12%" align="center" class="txlHeaderBackgroundAlternate">ע��ʱ��</td>
		<td width="12%" align="center" class="txlHeaderBackgroundAlternate">ע��IP</td>
        <td width="11%" align="center" class="txlHeaderBackgroundAlternate">����¼ʱ��</td>
		<td width="11%" align="center" class="txlHeaderBackgroundAlternate">����¼IP</td>
        <td width="11%" align="center" class=txlHeaderBackgroundAlternate>����</td>
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
        <td align="center" class="txlrow">��ͨ��Ա</td>
		<td align="center" class="txlrow"><?php echo $row[userid]; ?></td>
		<td align="center" class="txlrow"><?php echo date("Y-m-d",$row[jointime]); ?></td>
		<td align="center" class="txlrow"><?php echo $row[joinip]; ?></td>
        <td align="center" class="txlrow"><?php echo date("Y-m-d",$row[logintime]);  ?></td>
		<td align="center" class="txlrow"><?php echo $row[loginip]; ?></td>
        <td align="center" class=txlrow><a href="?id=<?php echo $row[id]; ?>">�༭</a> <a href="?del=<?php echo $row[id]; ?>">ɾ��</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?>  name="xm[]" onClick=Checked(form)></td>
</tr>

<?php
}
?>
<tr bgcolor="#DEE5FA">
  <td align="center" class="txlrow"><font color="red"><b><?php echo $counts; ?></b></font></td>
        <td colspan="7" align="center" class="txlrow"><?php echo $getpageinfo['pagecode'];?></td>
		<td align="center" class=txlrow><input type=button title=ɾ�� onClick=DelAll()  value=ɾ�� name=Submit></td>
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
ShowMsg("��Ҫ�޸ĵĻ�Ա�˺Ų������뷵��","-1");
}
}
?>
<FORM name=formadd method=post>
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder><tbody><tr align="left" bgcolor="#DEE5FA"><td class="txlrow" width="91%" height=""><table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th height="23" colspan="2" align="left" >����Ա������޸�</th>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">��Ա�˺ţ�</td>
        <td class="txlrow" width="91%" height=""><input name="userid" type="text" class="input"  value="<?php echo $row_edit[userid];?>" size="40" /></td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">��Ա���룺</td>
        <td class="txlrow" width="91%" height=""><input name="userpwd" type="text" class="input" value="" size="40" />
          ��������Ϊ���޸�</td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">��Ա���䣺</td>
        <td class="txlrow" width="91%" height=""><input name="email" type="text" class="input" value="<?php echo $row_edit[email];?>" size="40" /></td>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" height="26" colspan="2"><input type="submit" name="membersubmit" value="�ύ"/></td>
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