<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once('include/pinyin.inc.php');
if(isset($_POST[create])&&($_GET[name]=='province'||$_GET[name]=='city'||$_GET[name]=='county')){
$cityname=trim($_POST[name]);
$cityname=explode("\r\n",$cityname);
$cityname=array_filter($cityname);
if(empty($cityname)){
	ShowMsg('������ȷд����',"areaconfig.php?name=$_GET[name]");
}

$pid=isset($_POST[pid]) ? $_POST[pid] : 0;
if($pid==0&&$_GET[name]!='province'){
	ShowMsg('��ѡ����������',"areaconfig.php?name=$_GET[name]");
}

foreach($cityname as $val){
	$zm=GetPinyin($val);
	$dirname=GetPinyin($val,1);
	$sql="INSERT INTO `{$dbpre}class_{$_GET[name]}` (`id`,`pid`,`name`,`dirname`,`zm`,`sort`) VALUES (NULL,'".$pid."','".$val."','".$dirname."','".$zm."','')";
	$db->query($sql);
}
}

if(isset($_POST[sort])){
	$sort=$_POST[insort];
	foreach($sort as $key=>$val){
		$sql="UPDATE `{$dbpre}class_{$_GET[name]}` SET `sort`='".$val."' WHERE `id`='".$key."'";
		$db->query($sql);

	}
	ShowMsg('�����޸ĳɹ�',"areaconfig.php?name=$_GET[name]");
}

//========����Ϊ��ӵ�������=====
if(isset($_GET[del])&&$_GET[del]){
	if($_GET[del]=='county'){
		$sql="DELETE FROM `{$dbpre}class_county` WHERE `id`='".$_GET[id]."'";
	}elseif($_GET[del]=='city'){
		$sql="SELECT * FROM `{$dbpre}class_county` WHERE `pid`='".$_GET[id]."'";
		$query=$db->query($sql);
		if(mysql_num_rows($query)){
			ShowMsg("��ѡɾ���˳����µ������ؼ�����","-1");
		}else{
			$sql="DELETE FROM `{$dbpre}class_city` WHERE `id`='".$_GET[id]."'";
		}

	}elseif($_GET[del]=='province'){
		$sql="SELECT * FROM `{$dbpre}class_city` WHERE `pid`='".$_GET[id]."'";
		$query=$db->query($sql);
		if(mysql_num_rows($query)){
			ShowMsg("��ѡɾ����ʡ���µ����г���","-1");
		}else{
			$sql="DELETE FROM `{$dbpre}class_province` WHERE `id`='".$_GET[id]."'";
		}

	}else{
		ShowMsg("�Ƿ��ύ","-1");
	}
$db->query($sql);
ShowMsg("�ɹ����","-1");

}
//=========����Ϊɾ������=============
if(isset($_POST[mod])&&$_GET[mod]&&$_GET[id]){
$cityname=trim($_POST[name]);
if(empty($cityname)){
	ShowMsg('������ȷд����',"-1");
}
$pid=isset($_POST[pid]) ? $_POST[pid] : 0;
if($pid==0&&$_GET[name]!='province'){
	ShowMsg('��ѡ����������',"-1");
}
$zm=GetPinyin($cityname);
$dirname=GetPinyin($cityname,1);
$sql="UPDATE `{$dbpre}class_{$_GET[mod]}` SET `pid`='".$pid."',`name`='".$cityname."',`zm`='".$zm."',`dirname`='".$dirname."' WHERE `id`='$_GET[id]'";
$db->query($sql);
ShowMsg('�޸ĳɹ�',"-1");
}
?>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
</head>
<html>
<body>
  <table width="1052" border=0 align=center cellpadding=0 cellspacing=0>

      <tr bgcolor="#DEE5FA">
      <td class=txlrow>
      <ul style="list-style:none;margin:0; padding:0">
      <li style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=province">ʡ�ݹ���</a></li>
      <li  style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=city">�м�����</a></li>
      <li  style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=county">�ؼ�����</a></li>
      </ul>
	  </td></tr></table>

<?php
	switch($_GET[name]){
	case "province":
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">����ʡ��</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����</td>
        <td height="22" align=left class=txlrow><input type="text" name="name" /></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="create" value="����" /></td>
      </tr>
    </tbody>
  </table>
</form>
<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="7" align="left" class="txlHeaderBackgroundAlternate">ʡ���б�</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="19%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="10%" align="center" class="txlHeaderBackgroundAlternate">������Ŀ</td>
        <td width="17%" align="center" class="txlHeaderBackgroundAlternate">���й���</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">ɾ��</td>
      </tr>
<?php
$sql="SELECT * FROM `{$dbpre}class_province` ORDER BY `sort` ASC, `id` ASC";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$sqlson="SELECT * FROM `{$dbpre}class_city` WHERE `pid`='$row[id]'";
	$queryson=$db->query($sqlson);
	$num=mysql_num_rows($queryson);
?>

        <tr align="center" bgcolor="#DEE5FA">
        <td width="7%" align="center" class=txlrow><?php echo $row[id];?></td>
        <td width="31%" align="left" class=txlrow><a href="local_brief.php?name=province&amp;pid=<?php echo $row[id];?>">��<?php echo $row[name];?>��</a></td>
        <td width="19%" align="center" class=txlrow>
        <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />
        </td>
        <td width="10%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="17%" align="center" class=txlrow><a href="areaconfig.php?name=city&amp;pid=<?php echo $row[pid];?>">�������������</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=province&amp;id=<?php echo $row[id];?>">[�޸�]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=province&amp;id=<?php echo $row[id];?>">[ɾ��]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="7" align="center"class=txlrow><input type="submit" name="sort" value="�޸�����" /></td>
    </tr>
    </tbody>
  </table>
</form>



<?php
	break;
	case "city":
?>
<form name="form1" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">�����м�</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����</td>
        <td height="22" align=left class=txlrow><textarea name="name" cols="50" rows="6"></textarea>
        ע:��Ҫͬʱ��Ӷ������,ÿ����������һ��.</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����</td>
        <td height="25" align=left class=txlrow>
          <select  id="select" name="pid">
          <option value="0">��ѡ��</option>
          <?php
		  $sql="SELECT * FROM `{$dbpre}class_province` ORDER BY `sort`";
		  $query=$db->query($sql);
		  while($row=$db->fetch_array($query)){
		  	if($row[id]==$_GET[pid]){
		  	echo "<option value=$row[id] selected='selected'>$row[name]</option>";
		  	}else{
		  	echo "<option value=$row[id]>$row[name]</option>";
		  	}
		  }

		  ?>
          </select>
        </td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="28" align=left class=txlrow>
        <input type="submit" value="����" name="create"/></td>
      </tr>
    </tbody>
  </table>
</form>


<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="8" align="left" class="txlHeaderBackgroundAlternate">�����б�</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="6%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="14%" align="center" class="txlHeaderBackgroundAlternate">����ʡ��</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">������Ŀ</td>
        <td width="15%" align="center" class="txlHeaderBackgroundAlternate">���й���</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">ɾ��</td>
      </tr>
<?php
$sql="SELECT * FROM `{$dbpre}class_city` ORDER BY `sort` ASC, `id` ASC";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$sqlson="SELECT * FROM `{$dbpre}class_county` WHERE `pid`='$row[id]'";
	$queryson=$db->query($sqlson);
	$num=mysql_num_rows($queryson);

	$sqlpname="SELECT * FROM `{$dbpre}class_province` WHERE `id`='$row[pid]'";
	$querypname=$db->query($sqlpname);
	$pname=$db->fetch_array($querypname);

?>

        <tr align="center" bgcolor="#DEE5FA">
        <td width="6%" align="center" class=txlrow><?php echo $row[id];?></td>
        <td width="31%" align="left" class=txlrow><a href="local_brief.php?name=city&amp;pid=<?php echo $row[id];?>">��<?php echo $row[name];?>��</a></td>
        <td width="14%" align="center" class=txlrow><?php echo $pname[name];?></td>
        <td width="9%" align="center" class=txlrow>
        <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />        </td>
        <td width="9%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="15%" align="center" class=txlrow><a href="areaconfig.php?name=county&amp;pid=<?php echo $row[id];?>">�������������</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=city&amp;id=<?php echo $row[id];?>">[�޸�]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=city&amp;id=<?php echo $row[id];?>">[ɾ��]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="8" align="center"class=txlrow><input type="submit" name="sort" value="�޸�����" /></td>
    </tr>
    </tbody>
  </table>
</form>




<?php
	break;
	case 'county':
?>
<form name="form1" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">�����ؼ�</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����</td>
        <td height="22" align=left class=txlrow><textarea name="name" cols="50" rows="6"></textarea>
        ע:��Ҫͬʱ��Ӷ������,ÿ����������һ��.</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����</td>
        <td height="25" align=left class=txlrow>
          <select  id="select" name="pid">
          <option value="0">��ѡ��</option>
          <?php
		  $sql="SELECT * FROM `{$dbpre}class_city` ORDER BY `sort`";
		  $query=$db->query($sql);
		  while($row=$db->fetch_array($query)){
		  	if($row[id]==$_GET[pid]){
		  	echo "<option value=$row[id] selected='selected'>$row[name]</option>";
		  	}else{
		  	echo "<option value=$row[id]>$row[name]</option>";
		  	}
		  }

		  ?>
          </select>
        </td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="28" align=left class=txlrow>
        <input type="submit" value="����" name="create"/></td>
      </tr>
    </tbody>
  </table>
</form>


<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="8" align="left" class="txlHeaderBackgroundAlternate">�����б�</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="6%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="14%" align="center" class="txlHeaderBackgroundAlternate">��������</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">������Ŀ</td>
        <td width="15%" align="center" class="txlHeaderBackgroundAlternate">��Ӽ��</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">ɾ��</td>
      </tr>
<?php
$sql="SELECT * FROM `{$dbpre}class_county` ORDER BY `sort` ASC, `id` ASC";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$sqlson="SELECT * FROM `{$dbpre}class_city` WHERE `pid`='$row[id]'";
	$queryson=$db->query($sqlson);
	$num=mysql_num_rows($queryson);

	$sqlpname="SELECT * FROM `{$dbpre}class_city` WHERE `id`='$row[pid]'";
	$querypname=$db->query($sqlpname);
	$pname=$db->fetch_array($querypname);
?>

        <tr align="center" bgcolor="#DEE5FA">
        <td width="6%" align="center" class=txlrow><?php echo $row[id];?></td>
        <td width="31%" align="left" class=txlrow>��<?php echo $row[name];?>��</td>
        <td width="14%" align="center" class=txlrow><?php echo $pname[name];?></td>
        <td width="9%" align="center" class=txlrow><span class="txlHeaderBackgroundAlternate">
          <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />
        </span></td>
        <td width="9%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="15%" align="center" class=txlrow><a href="local_brief.php?name=county&amp;pid=<?php echo $row[id];?>">�������޸ĵ������</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=county&amp;id=<?php echo $row[id];?>">[�޸�]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=county&amp;id=<?php echo $row[id];?>">[ɾ��]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="8" align="center"class=txlrow><input type="submit" name="sort" value="�޸�����" /></td>
    </tr>
    </tbody>
  </table>
</form>
<?php
	break;
}

switch ($_GET[mod]){
	case 'province':
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">ʡ�ݸ���</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����ʡ��</td>
        <td height="22" align=left class=txlrow>
        <select name="pid"  onchange="window.location=('?mod=province&amp;id='+this.options[this.selectedIndex].value+'')">
        <option value='0'>��ѡ��</option>
        <?php
		$sql="SELECT * FROM `{$dbpre}class_province`";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			if($row[id]=="$_GET[id]"){
				$inname=$row[name];
			echo "<option value='".$row[id]."' selected='selected'>$row[name]</option>";
			}else{
			echo "<option value='".$row[id]."'>$row[name]</option>";
			}
		}
		?>
        </select>
        </td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>�޸ĳ�</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $inname; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="�޸�" /></td>
      </tr>
    </tbody>
  </table>
</form>




<?php
break;
case 'city':
$sql="SELECT * FROM `{$dbpre}class_city` WHERE `id`='$_GET[id]'";
$query=$db->query($sql);
$cpid=$db->fetch_array($query);
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder><tbody><tr bgcolor="#DEE5FA"><td height="22" align=left class=txlrow><table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">���и���</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>����ʡ��</td>
        <td height="22" align=left class=txlrow>
        <select name="pid">
            <option value='0'>��ѡ��</option>
            <?php
		$sql="SELECT * FROM `{$dbpre}class_province`";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			if($row[id]==$cpid[pid]){
				$inname=$row[name];
			echo "<option value='".$row[id]."' selected='selected'>$row[name]</option>";
			}else{
			echo "<option value='".$row[id]."'>$row[name]</option>";
			}
		}
		?>
          </select>        </td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>�޸ĳ�</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $cpid[name]; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="�޸�" /></td>
      </tr>
    </tbody>
  </table></td>
      </tr>
</tbody>
</table>
</form>


<?php
break;
case 'county':
$sql="SELECT * FROM `{$dbpre}class_county` WHERE `id`='$_GET[id]'";
$query=$db->query($sql);
$cpid=$db->fetch_array($query);
?>
<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr align="center" bgcolor="#799AE1">
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">�ؼ�����</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>��������</td>
        <td height="22" align=left class=txlrow>
        <select name="pid">
        <option value='0'>��ѡ��</option>
        <?php
		$sql="SELECT * FROM `{$dbpre}class_city`";
		$query=$db->query($sql);
		while($row=$db->fetch_array($query)){
			if($row[id]==$cpid[pid]){
				$inname=$row[name];
			echo "<option value='".$row[id]."' selected='selected'>$row[name]</option>";
			}else{
			echo "<option value='".$row[id]."'>$row[name]</option>";
			}
		}
		?>
        </select>
        </td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>�޸ĳ�</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $cpid[name]; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="�޸�" /></td>
      </tr>
    </tbody>
  </table>
</form>



<?php
break;
}
?>







</body>
</html>