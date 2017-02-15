<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);

if(isset($_GET[del])&&!empty($_GET[del])){
	if($_GET[del]=="data"){
		$id=implode(",",$_POST[xm]);
		$sql="DELETE FROM `{$dbpre}inner_keywords` WHERE `id` in ($id)";
	}else{
        $sql="DELETE FROM `{$dbpre}inner_keywords` WHERE `id`= '$_GET[del]'";
	}
  $db->query($sql);
  ShowMsg("成功删除关键词记录。","-1");

}



//=====================分类先择函数==========
$sql="SELECT * FROM `{$dbpre}class_city`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$city[$row[id]]=$row[name];
}
//======================================================
$sql="SELECT * FROM `{$dbpre}class_county`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$county[$row[id]]=$row[name];
}

?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
<META http-equiv=Content-Type content="text/html; charset=gb2312">
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
        <th align=center colspan=6 style="height: 23px">站内关键词记录列表</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="6" align="left" class=txlrow><span style="float:left">类别筛选：</span>
            <div style="float:left">
              <select name="province" size="1" id="province" onChange="window.location.href=this.options[this.selectedIndex].value">
                <option value="list_keywords.php?record=0" <?php if($_GET[record]==0)echo "selected=selected" ?> >选择城市...</option>
                <option value="list_keywords.php?record=1" <?php if($_GET[record]==1)echo "selected=selected" ?>>有搜索结果</option>
                <option value="list_keywords.php?record=2" <?php if($_GET[record]==2)echo "selected=selected" ?>>无搜索结果</option>
              </select>
            </div>
          <div id="citybox" style="float:left; padding-left:5px;"> </div></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="3%" align="center" class="txlHeaderBackgroundAlternate">编号</td>
        <td width="70%" align="left" class="txlHeaderBackgroundAlternate">搜索关键词</td>
        <td width="10%" align="center" class="txlHeaderBackgroundAlternate">来源IP</td>
        <td width="8%" align="center" class="txlHeaderBackgroundAlternate">搜索记录数</td>
        <td width="4%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="5%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>
      <?php
if(isset($_GET[record])&&!empty($_GET[record])){
switch ($_GET[record]){
	case 1:
	$str="`record`<>'0'";
	break;
	case 2:
	$str="`record`='0'";
}
}
$catlimit=$_GET[record]==0 ? "ORDER BY `id` DESC" : " WHERE $str ORDER BY `id` DESC";
$page=isset($_GET['page'])?$_GET['page']:1;
$counts=mysql_num_rows(mysql_query("SELECT * FROM `{$dbpre}inner_keywords` $catlimit"));
$getpageinfo=page($page,$counts,25);
$sql="SELECT * FROM `{$dbpre}inner_keywords` $catlimit $getpageinfo[sqllimit]";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
?>
      <tr bgcolor="#DEE5FA">
        <td align="center" class="txlrow"><?php echo $row[id]; ?></td>
        <td align="left" class="txlrow"><?php echo $row[keywords]; ?></td>
        <td align="center" class="txlrow"><?php echo $row[searchip]; ?></td>
        <td align="center" class="txlrow"><?php echo $row[record]; ?></td>
        <td align="center" class=txlrow><a href="?del=<?php echo $row[id]; ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?>  name="xm[]" onClick=Checked(form)></td>
      </tr>
      <?php
}
?>
      <tr bgcolor="#DEE5FA">
        <td align="center"><font color="red"><b><?php echo $counts; ?></b></font></td>
        <td colspan="4" align="center" class=txlrow><?php echo $getpageinfo['pagecode'];?></td>
        <td align="center"><input type=button title=删除 onClick=DelAll()  value=删除 name=Submit></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=6 align=center class=txlrow></td>
      </tr>
    </tbody>
  </table>
  <div id=box></div>
</form>

</BODY>
</HTML>