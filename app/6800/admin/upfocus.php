<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
require_once("upfile.fun.php");
if(isset($_GET[del])){
if($_GET[del]==data){
$ID_Dele= implode(",",$_POST['xm']);
$db->query("DELETE FROM `{$dbpre}focus` WHERE `id` in (".$ID_Dele.")");
ShowMsg("焦点图片删除成功","-1");
}else{
$db->query("DELETE FROM `{$dbpre}focus` WHERE `id` = $_GET[del]");
ShowMsg("焦点图片删除成功","-1");
}
}

if(isset($_POST[focus_submit])){
if(!empty($_FILES[picdir][name])){
if(!empty($_POST[pic])){
$pic=$_POST[pic];
@unlink("..".$pic);
}
check_upimage("picdir");
$name_file = 'picdir';
$xmfone_image=start_upload($name_file,"/focus/");
	}else{
$xmfone_image="";
	}
if(isset($_GET[edit])){
if(empty($xmfone_image)){

 $sql="UPDATE `{$dbpre}focus` SET `order` = '".$_POST[order]."',
`introduce` = '".$_POST[introduce]."',
`targeturl` = '".$_POST[targeturl]."'
WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";

}else{
 $sql="UPDATE `{$dbpre}focus` SET `order` = '".$_POST[order]."',
`introduce` = '".$_POST[introduce]."',
`targeturl` = '".$_POST[targeturl]."',
`picdir` = '$xmfone_image' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";
}
$db->query($sql);
ShowMsg("成功修改焦点图片！","upfocus.php");
}else{
if(empty($xmfone_image)){
	ShowMsg("请选择你要上转的焦点图片！","-1");
}
$sql="INSERT INTO `{$dbpre}focus` (
`id` ,
`order` ,
`introduce` ,
`targeturl` ,
`picdir` ,
`pubdate`
)
VALUES (
NULL , '".$_POST[order]."', '".$_POST[introduce]."', '".$_POST[targeturl]."', '$xmfone_image', '".mktime()."'
);
";
$db->query($sql);
ShowMsg("成功添加焦点图片！","upfocus.php");

	}

}

?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
<script language="javascript" src="inc/vbm.js"></script>
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
function CheckSubmit()
  {
     if(document.form1.order.value==""){
	     alert("焦点图顺序不能为空！");
	     document.form1.order.focus();
	     return false;
     }
     if(document.form1.introduce.value==""){
	     alert("图片说明不能为空！");
	     document.form1.introduce.focus();
	     return false;
     }
     if(document.form1.targeturl.value==""){
	     alert("跳转网址不能为空！");
	     document.form1.targeturl.focus();
	     return false;
     }

     return true;
 }

</SCRIPT>
</head>
<body>
<form name="form" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=7 style="height: 23px">网站首页图片广告列表</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="7" align="left" class=txlrow><a href="?focus=add">【点击添加图片广告】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="3%" align="center" class="txlHeaderBackgroundAlternate">排序</td>
        <td width="24%" align="center" class=txlHeaderBackgroundAlternate>图片路径</td>
        <td width="24%" align="center" class=txlHeaderBackgroundAlternate>目标网站</td>
        <td width="26%" align="center" class=txlHeaderBackgroundAlternate>文字说明</td>
        <td width="10%" align="center" class=txlHeaderBackgroundAlternate>添加时间</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate>操作</td>
        <td width="7%" align="center" class=txlHeaderBackgroundAlternate><input id=chkAll
                  onClick=CheckAll(this.form) type=checkbox
                  value=checkbox name=chkAll></td>
      </tr>

<?php
$sql="SELECT * FROM `{$dbpre}focus` order by `order`";
$query=$db->query($sql);
while($row=$db->fetch_array($query)){
?>
<tr bgcolor="#DEE5FA">
        <td height="27" align="center" class="txlrow"><?php echo $row[order]?></td>
        <td align="left" class=txlrow><?php echo $row[picdir]?></td>
        <td align="left" class=txlrow><?php echo "<a href='".$row[targeturl]."'>$row[targeturl]</a>";?></td>
        <td align="left" class=txlrow><?php echo $row[introduce]?></td>
        <td align="center" class=txlrow><?php echo date("Y-m-d","$row[pubdate]")?></td>
        <td align="center" class=txlrow><a href="?edit=<?php echo $row[id] ?>">编辑</a> <a href="?del=<?php echo $row[id] ?>">删除</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?> name="xm[]" onClick=Checked(form)></td>
</tr>
<?php
}
?>

    <tr bgcolor="#DEE5FA">
        <td colspan="6"  align=center bgcolor="#DEE5FA" class=txlrow>&nbsp;</td>
        <td align=center bgcolor="#DEE5FA" class=txlrow>
     <INPUT type=button title=删除 onclick=DelAll()  value=删除 name=Submit>		</td>
      </tr>


      <tr bgcolor="#DEE5FA">
        <td colspan=7 align=center class=txlrow></td>
      </tr>
    </tbody>
</table>
</form>

<?php
if(isset($_GET[focus])||isset($_GET[edit])){
$previmg="../admin/images/pview.gif";
if(!empty($_GET[edit])){
		$sql="SELECT * FROM `{$dbpre}focus` WHERE `id`='$_GET[edit]'";
		$query=$db->query($sql);
		$row=$db->fetch_array($query);
		if(!empty($row[picdir])){
		$previmg="..".$row[picdir];
		}else{
		$previmg="../admin/images/pview.gif";
		}
}
?>
<form method="post" name="form1" action="" enctype="multipart/form-data" onSubmit="return CheckSubmit();">

<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
            <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">上传网站焦点图片</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">图片顺序：</td>
                <td>
                <input name=order type=text class="text" value="<?php echo $row[order]; ?>"/>
                <input name=pic type=hidden value="<?php echo $row[picdir]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">图片说明：</td>
                <td>
                <input name=introduce type=text class="text"  value="<?php echo $row[introduce]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">跳转网址：</td>
                <td>
                <input name=targeturl type=text class="text" value="<?php echo $row[targeturl]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td align="right" valign="top">选择上传的图片：</td>
                <td><input type=file name=picdir size="45" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  支持上传的类型：png,jpg,gif,jpeg，图片尺寸： * </td>
              </tr>
              <tr bgcolor="#DEE5FA">
                <td align="right" valign="top">预览区：</td>
                <td><img src="<?php echo $previmg; ?>" width="150" id="picview" name="picview" /></td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="上 传" name="focus_submit"></center>
</form>

<?php
}

?>





</BODY>
</HTML>