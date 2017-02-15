<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);

if(isset($_GET[del])&&!empty($_GET[del])){
	if($_GET[del]=="data"){
		$id=implode(",",$_POST[xm]);
		$sql="DELETE FROM `{$dbpre}user_add_company` WHERE `id` in ($id)";
	}else{
        $sql="DELETE FROM `{$dbpre}user_add_company` WHERE `id`= '$_GET[del]'";
	}
  $db->query($sql);
  ShowMsg("成功删除企业信息。","-1");

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
var xmlHttp;
function createXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}

function addSelect(sid,elementID) {
 oElement=document.getElementById(elementID);
     createXMLHttpRequest();
var url = "include/select.php?sid=" + sid;
xmlHttp.onreadystatechange = function(){onStateChange(oElement)};
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}
function onStateChange(oElement){
    if(xmlHttp.readyState == 4){
        if(xmlHttp.status == 200){
   var returntxt=unescape(xmlHttp.responseText);
   var htmltxt = '<select name="city" id="city" onChange="getlist(this.options[this.selectedIndex].value);">' + returntxt + '</select>';
    document.getElementById("citybox").innerHTML=htmltxt;
        }
    }
}



function getlist(sid,elementID) {
    oElement=document.getElementById(elementID);
     createXMLHttpRequest();
var url = "include/select1.php?sid=" + sid;
xmlHttp.onreadystatechange = function(){onState(oElement)};
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}
function onState(oElement){
    if(xmlHttp.readyState == 4){
        if(xmlHttp.status == 200){
   var returntxt=unescape(xmlHttp.responseText);
   var htmltxt = returntxt;
    document.getElementById("box").innerHTML=htmltxt;
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
        <th align=center colspan=8 style="height: 23px">会员添加企业表列</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="8" align="left" class=txlrow><span style="float:left">类别筛选：</span>
            <div style="float:left">
              <select name="province" size="1" id="province" onChange="addSelect(this.options[this.selectedIndex].value,'city');">
                <option value="0">选择城市...</option>
                <?php
                 $result = $db->query("select * from `xm_class_city`");
                 while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[vcity]){
                 	 echo "<option value=\"".$row['id']."\" selected=\"selected\">".$row['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                 	 }
                 }
            ?>
              </select>
            </div>
          <div id="citybox" style="float:left; padding-left:5px;"> </div></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="4%" align="center" class="txlHeaderBackgroundAlternate">编号</td>
        <td width="32%" align="left" class="txlHeaderBackgroundAlternate">公司名称</td>
        <td width="17%" align="center" class="txlHeaderBackgroundAlternate">公司电话</td>
        <td width="20%" align="center" class="txlHeaderBackgroundAlternate">公司网址</td>
        <td width="9%" align="center" class="txlHeaderBackgroundAlternate">所属会员</td>
        <td width="7%" align="center" class="txlHeaderBackgroundAlternate">添加时间</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="5%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>
      <?php
$sql="SELECT * FROM `{$dbpre}member`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
  $user[$row[id]]=$row[userid];
}
$page=isset($_GET['page'])?$_GET['page']:1;
$counts=mysql_num_rows(mysql_query("SELECT * FROM `{$dbpre}user_add_company`"));
$getpageinfo=page($page,$counts,25);
$sql="SELECT * FROM `{$dbpre}user_add_company`  $getpageinfo[sqllimit]";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
?>
      <tr bgcolor="#DEE5FA">
        <td align="center" class="txlrow"><?php echo $row[id]; ?></td>
        <td align="left" class="txlrow"><?php echo $row[cname]; ?></td>
        <td align="left" class="txlrow"><?php echo $row[ctel]; ?></td>
        <td align="left" class="txlrow"><?php echo $row[cweb]; ?></td>
        <td align="center" class="txlrow"><?php echo $user[$row[uid]]; ?></td>
        <td align="center" class="txlrow"><?php echo date("Y-m-d",$row[injointime]); ?></td>
        <td align="center" class=txlrow><a href="qyhy_verify.php?edit=<?php echo $row[id]; ?>">申核</a> <a href="?del=<?php echo $row[id]; ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?>  name="xm[]" onClick=Checked(form)></td>
      </tr>
      <?php
}
?>
      <tr bgcolor="#DEE5FA">
        <td align="center"><font color="red"><b><?php echo $counts; ?></b></font></td>
        <td colspan="6" align="center" class=txlrow><?php echo $getpageinfo['pagecode'];?></td>
        <td align="center"><input type=button title=删除 onClick=DelAll()  value=删除 name=Submit></td>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=8 align=center class=txlrow></td>
      </tr>
    </tbody>
  </table>
  <div id=box></div>
</form>

</BODY>
</HTML>