<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
if(isset($_GET[del])){
$sql="SELECT * FROM `{$dbpre}admin` WHERE `id`='$_GET[del]'";
$query=$db->query($sql);
$row=$db->fetch_array($query);
if($row&&$row[m_id]!=1){
if($row[id]==1)ShowMsg("ϵͳ����Ա�˺Ų���ɾ��", "account.php");
$sql="DELETE FROM `xm_admin` WHERE  `id`='$_GET[del]'";
$db->query($sql);
ShowMsg("�ɹ�ɾ�������˺�", "account.php");
}else{
ShowMsg("��Ҫ����ļ�¼�����ڻ�û��Ȩ��ɾ��", "account.php");
}
}

if(isset($_POST[adminsubmit])){
switch ($_POST[m_id]){
	case 1:
	$title="��������Ա";
	break;
	case 2:
	$title="��ͨ����Ա";
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

ShowMsg("����Ա�˺��޸ĳɹ�", "account.php");
}else{
$newps=md5($_POST[passwd]."xmf1");
$sql="INSERT INTO `{$dbpre}admin` (`id`, `m_id`, `userid`, `passwd`, `remark`,`title`) " .
		"VALUES ('NULL', '$_POST[m_id]', '$_POST[userid]', '$newps', '$_POST[remark]','$title');";
$db->query($sql);
ShowMsg("����Ա�˺���ӳɹ�", "account.php");
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
        <th align=center colspan=5 style="height: 23px">��̨�˻�����</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="5" align="left" class=txlrow><a href="?admin=add">�������ӹ���Ա��</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="9%" align="left" class="txlHeaderBackgroundAlternate">����Ա����</td>
		<td width="23%" align="left" class="txlHeaderBackgroundAlternate">����Ա�˺�</td>
		<td width="29%" align="left" class="txlHeaderBackgroundAlternate">����Ա����</td>
		<td width="28%" align="left" class="txlHeaderBackgroundAlternate">�˺ű�ע</td>
        <td width="11%" align="left" class=txlHeaderBackgroundAlternate>����</td>
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
      <td align="left" class=txlrow><a href="?id=<?php echo $row[id]; ?>">�༭</a> <a href="?del=<?php echo $row[id]; ?>">ɾ��</a> </td>
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
ShowMsg("��Ҫ�޸ĵĹ���Ա�˺Ų������뷵��","-1");
}
}
?>
<FORM name=formadd method=post>
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th height="23" colspan="2" align="left" >����Ա������޸�</th>
      </tr>
      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">����Ա�˻���</td>
        <td class="txlrow" width="91%" height=""><input name="userid" type="text" class="input"  value="<?php echo $row_edit[userid];?>" size="40" /></td>
      </tr>

	  <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">����Ա���룺</td>
        <td class="txlrow" width="91%" height=""><input name="passwd" type="text" class="input" value="" size="40" />��������Ϊ���޸�</td>
      </tr>

	  <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">����Ա����</td>
        <td class="txlrow" width="91%" height="">
		<select name="m_id">
		<?php
        if($row_edit[m_id]=="1"){
				echo "<option value =\"1\" selected=\"selected\">��������Ա</option><option value =\"2\" >��ͨ����Ա</option>\n";
			}else{
				echo "<option value =\"1\">��������Ա</option><option value =\"2\"  selected=\"selected\" >��ͨ����Ա</option>\n";
			}
			?>

        </select>
      </td>
      </tr>

      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" width="9%" height="26">�˺�&nbsp;&nbsp;��ע��</td>
        <td class="txlrow" width="91%" height="">
		<textarea  cols='50' rows='6' name="remark"><?php echo $row_edit[remark];?></textarea>
	    </td>
      </tr>

      <tr align="left" bgcolor="#DEE5FA">
        <td class="txlrow" height="26" colspan="2"><input type="submit" name="adminsubmit" value="�ύ"/></td>

      </tr>



    </tbody>
  </table>


</FORM>


<?php
}

?>

</BODY>
  </HTML>