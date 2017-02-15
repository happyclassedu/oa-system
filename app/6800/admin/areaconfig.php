<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once('include/pinyin.inc.php');
if(isset($_POST[create])&&($_GET[name]=='province'||$_GET[name]=='city'||$_GET[name]=='county')){
$cityname=trim($_POST[name]);
$cityname=explode("\r\n",$cityname);
$cityname=array_filter($cityname);
if(empty($cityname)){
	ShowMsg('请填正确写名称',"areaconfig.php?name=$_GET[name]");
}

$pid=isset($_POST[pid]) ? $_POST[pid] : 0;
if($pid==0&&$_GET[name]!='province'){
	ShowMsg('请选择所属城市',"areaconfig.php?name=$_GET[name]");
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
	ShowMsg('排序修改成功',"areaconfig.php?name=$_GET[name]");
}

//========上面为添加地区代码=====
if(isset($_GET[del])&&$_GET[del]){
	if($_GET[del]=='county'){
		$sql="DELETE FROM `{$dbpre}class_county` WHERE `id`='".$_GET[id]."'";
	}elseif($_GET[del]=='city'){
		$sql="SELECT * FROM `{$dbpre}class_county` WHERE `pid`='".$_GET[id]."'";
		$query=$db->query($sql);
		if(mysql_num_rows($query)){
			ShowMsg("请选删除此城市下的所有县级城市","-1");
		}else{
			$sql="DELETE FROM `{$dbpre}class_city` WHERE `id`='".$_GET[id]."'";
		}

	}elseif($_GET[del]=='province'){
		$sql="SELECT * FROM `{$dbpre}class_city` WHERE `pid`='".$_GET[id]."'";
		$query=$db->query($sql);
		if(mysql_num_rows($query)){
			ShowMsg("请选删除此省份下的所有城市","-1");
		}else{
			$sql="DELETE FROM `{$dbpre}class_province` WHERE `id`='".$_GET[id]."'";
		}

	}else{
		ShowMsg("非法提交","-1");
	}
$db->query($sql);
ShowMsg("成功册除","-1");

}
//=========上面为删除代码=============
if(isset($_POST[mod])&&$_GET[mod]&&$_GET[id]){
$cityname=trim($_POST[name]);
if(empty($cityname)){
	ShowMsg('请填正确写名称',"-1");
}
$pid=isset($_POST[pid]) ? $_POST[pid] : 0;
if($pid==0&&$_GET[name]!='province'){
	ShowMsg('请选择所属城市',"-1");
}
$zm=GetPinyin($cityname);
$dirname=GetPinyin($cityname,1);
$sql="UPDATE `{$dbpre}class_{$_GET[mod]}` SET `pid`='".$pid."',`name`='".$cityname."',`zm`='".$zm."',`dirname`='".$dirname."' WHERE `id`='$_GET[id]'";
$db->query($sql);
ShowMsg('修改成功',"-1");
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
      <li style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=province">省份管理</a></li>
      <li  style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=city">市级管理</a></li>
      <li  style="float:left; height:28px; width:100px; background:#799AE1; text-align:center; line-height:28px; margin-right:10px" ><a href="areaconfig.php?name=county">县级管理</a></li>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">创建省份</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>名称</td>
        <td height="22" align=left class=txlrow><input type="text" name="name" /></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="create" value="创建" /></td>
      </tr>
    </tbody>
  </table>
</form>
<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="7" align="left" class="txlHeaderBackgroundAlternate">省份列表</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">名称</td>
        <td width="19%" align="center" class="txlHeaderBackgroundAlternate">排序</td>
        <td width="10%" align="center" class="txlHeaderBackgroundAlternate">城市数目</td>
        <td width="17%" align="center" class="txlHeaderBackgroundAlternate">城市管理</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">设置</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">删除</td>
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
        <td width="31%" align="left" class=txlrow><a href="local_brief.php?name=province&amp;pid=<?php echo $row[id];?>">【<?php echo $row[name];?>】</a></td>
        <td width="19%" align="center" class=txlrow>
        <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />
        </td>
        <td width="10%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="17%" align="center" class=txlrow><a href="areaconfig.php?name=city&amp;pid=<?php echo $row[pid];?>">创建及管理城市</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=province&amp;id=<?php echo $row[id];?>">[修改]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=province&amp;id=<?php echo $row[id];?>">[删除]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="7" align="center"class=txlrow><input type="submit" name="sort" value="修改排序" /></td>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">创建市级</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>名称</td>
        <td height="22" align=left class=txlrow><textarea name="name" cols="50" rows="6"></textarea>
        注:如要同时添加多个城市,每个城市名换一行.</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>所属</td>
        <td height="25" align=left class=txlrow>
          <select  id="select" name="pid">
          <option value="0">请选择</option>
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
        <input type="submit" value="创建" name="create"/></td>
      </tr>
    </tbody>
  </table>
</form>


<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="8" align="left" class="txlHeaderBackgroundAlternate">城市列表</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="6%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">名称</td>
        <td width="14%" align="center" class="txlHeaderBackgroundAlternate">所属省份</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">排序</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">城市数目</td>
        <td width="15%" align="center" class="txlHeaderBackgroundAlternate">城市管理</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">设置</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">删除</td>
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
        <td width="31%" align="left" class=txlrow><a href="local_brief.php?name=city&amp;pid=<?php echo $row[id];?>">【<?php echo $row[name];?>】</a></td>
        <td width="14%" align="center" class=txlrow><?php echo $pname[name];?></td>
        <td width="9%" align="center" class=txlrow>
        <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />        </td>
        <td width="9%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="15%" align="center" class=txlrow><a href="areaconfig.php?name=county&amp;pid=<?php echo $row[id];?>">创建及管理城市</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=city&amp;id=<?php echo $row[id];?>">[修改]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=city&amp;id=<?php echo $row[id];?>">[删除]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="8" align="center"class=txlrow><input type="submit" name="sort" value="修改排序" /></td>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">创建县级</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>名称</td>
        <td height="22" align=left class=txlrow><textarea name="name" cols="50" rows="6"></textarea>
        注:如要同时添加多个城市,每个城市名换一行.</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>所属</td>
        <td height="25" align=left class=txlrow>
          <select  id="select" name="pid">
          <option value="0">请选择</option>
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
        <input type="submit" value="创建" name="create"/></td>
      </tr>
    </tbody>
  </table>
</form>


<form name="form2" method="post" action="">
<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>


      <tr align="center" bgcolor="#799AE1">
        <td colspan="8" align="left" class="txlHeaderBackgroundAlternate">县市列表</td>
      </tr>
        <tr align="center" bgcolor="#799AE1">
        <td width="6%" align="center" class="txlHeaderBackgroundAlternate">ID</td>
        <td width="31%" align="center" class="txlHeaderBackgroundAlternate">名称</td>
        <td width="14%" align="center" class="txlHeaderBackgroundAlternate">所属城市</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">排序</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">城市数目</td>
        <td width="15%" align="center" class="txlHeaderBackgroundAlternate">添加简介</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">设置</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">删除</td>
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
        <td width="31%" align="left" class=txlrow>【<?php echo $row[name];?>】</td>
        <td width="14%" align="center" class=txlrow><?php echo $pname[name];?></td>
        <td width="9%" align="center" class=txlrow><span class="txlHeaderBackgroundAlternate">
          <input type="text" name="insort[<?php echo $row[id];?>]" value="<?php echo $row[sort];?>" size="5" />
        </span></td>
        <td width="9%" align="center" class=txlrow><?php echo $num ?></td>
        <td width="15%" align="center" class=txlrow><a href="local_brief.php?name=county&amp;pid=<?php echo $row[id];?>">创建、修改地区简介</a></td>
        <td width="7%" align="center" class=txlrow><a href="areaconfig.php?mod=county&amp;id=<?php echo $row[id];?>">[修改]</a></td>
        <td width="9%" align="center" class=txlrow><a href="areaconfig.php?del=county&amp;id=<?php echo $row[id];?>">[删除]</a></td>
      </tr>
<?php
}
?>
    <tr align="center" bgcolor="#DEE5FA">
        <td colspan="8" align="center"class=txlrow><input type="submit" name="sort" value="修改排序" /></td>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">省份改修</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>现有省份</td>
        <td height="22" align=left class=txlrow>
        <select name="pid"  onchange="window.location=('?mod=province&amp;id='+this.options[this.selectedIndex].value+'')">
        <option value='0'>请选择</option>
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
        <td align=center class=txlrow>修改成</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $inname; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="修改" /></td>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">城市改修</td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>所属省份</td>
        <td height="22" align=left class=txlrow>
        <select name="pid">
            <option value='0'>请选择</option>
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
        <td align=center class=txlrow>修改成</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $cpid[name]; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="修改" /></td>
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
        <td colspan="2" align="left" class="txlHeaderBackgroundAlternate">县级改修</td>
      </tr>

      <tr bgcolor="#DEE5FA">
        <td align=center class=txlrow>所属城市</td>
        <td height="22" align=left class=txlrow>
        <select name="pid">
        <option value='0'>请选择</option>
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
        <td align=center class=txlrow>修改成</td>
        <td height="22" align=left class=txlrow><input type="text" name="name"  value="<?php echo $cpid[name]; ?>"/></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td width="71" align=center class=txlrow></td>
        <td width="968" height="20" align=left class=txlrow><input type="submit" name="mod" value="修改" /></td>
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