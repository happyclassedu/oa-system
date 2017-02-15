<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once("../include/FCKeditor/fckeditor.php");
require_once("upfile.fun.php");
if(isset($_POST[view_submit])){
if(!empty($_FILES[picdir][name])){
if(!empty($_POST[pic])){
$pic=$_POST[pic];
@unlink("..".$pic);
}
check_upimage("picdir");
$name_file = 'picdir';
$xmfone_image=start_upload($name_file,"/view/");
	}else{
$xmfone_image="";
	}
if(isset($_GET[edit])){
if(empty($xmfone_image)){

 $sql="UPDATE `{$dbpre}view` SET `vname` = '$_POST[vname]',
`vprice` = '$_POST[vprice]',
`vtraffic` = '$_POST[vtraffic]',
`vbrief` = '$_POST[vbrief]',
`vprovince` = '1',
`vcity` = '$_POST[province]',
`vcounty` = '$_POST[city]' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";

}else{
 $sql="UPDATE `{$dbpre}view` SET `vname` = '$_POST[vname]',
`vprice` = '$_POST[vprice]',
`vtraffic` = '$_POST[vtraffic]',
`vbrief` = '$_POST[vbrief]',
`vprovince` = '1',
`vcity` = '$_POST[province]',
`vcounty` = '$_POST[city]',
`vpic` = '$xmfone_image' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";
}
$db->query($sql);
ShowMsg("成功修改景区信息！","-1");
}else{
if(empty($xmfone_image)){
	ShowMsg("必须上传景点图片！","-1");
}
$sql="INSERT INTO `{$dbpre}view` (
`id` ,
`vname` ,
`vprice` ,
`vtraffic` ,
`vbrief` ,
`vprovince` ,
`vcity` ,
`vcounty` ,
`vpic`
)
VALUES (
NULL , '$_POST[vname]', '$_POST[vprice]', '$_POST[vtraffic]', '$_POST[vbrief]', '1', '$_POST[province]', '$_POST[city]', '".$xmfone_image."'
);
";
$db->query($sql);
ShowMsg("成功添加一条景区信息！","add_view.php");

	}

}

?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
<script language="javascript" src="inc/vbm.js"></script>
<script type="text/javascript" language="JavaScript">
<!--
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
   var htmltxt = '<select name="city" id="city">' + returntxt + '</select>';
    document.getElementById("citybox").innerHTML=htmltxt;
        }
    }
}
//-->
</script>
</head>
<body>


<?php

$previmg="../admin/images/pview.gif";
if(!empty($_GET[edit])){
		$sql="SELECT * FROM `{$dbpre}view` WHERE `id`='$_GET[edit]'";
		$query=$db->query($sql);
		$con=$db->fetch_array($query);
		if(!empty($con[vpic])){
		$previmg="..".$con[vpic];
		}else{
		$previmg="../admin/images/pview.gif";
		}


}
?>
<form method="post" name="form1" action="" enctype="multipart/form-data" >

<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
            <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">陕西景点添加页面</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">所在地区：</td>
                <td width="92%">
                <div style="float:left">
                    <select name="province" size="1" id="province" onChange="addSelect(this.options[this.selectedIndex].value,'city');">
                        <option value="0">选择城市...</option>
                        <?php
                 $result = $db->query("select * from `{$dbpre}class_city`");
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
                <div id="citybox" style="float:left; padding-left:5px;">
                <?php

                if(!empty($con[vcounty])){
                	echo "<select name=\"city\"  id=\"city\" >";
                	$result = $db->query("select * from `{$dbpre}class_county` WHERE `pid`=$con[vcity]");
                	while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[vcounty]){
                 	 echo "<option value=\"".$row['id']."\" selected=\"selected\">".$row['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                 	 }
                 	}
                 	echo "</select>";
                }
                ?>

                </div>
                <input name=pic type=hidden value="<?php echo $con[vpic]; ?>"/>                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">景点名称：</td>
                <td>
                <input name="vname" type=text class="text" size="50"  value="<?php echo $con[vname]; ?>"/>                </td>
              </tr>

			    <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">景点收费：</td>
                <td>
                <input name="vprice" type=text class="text"  value="<?php echo $con[vprice]; ?>"/>                </td>
              </tr>

			    <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">景点交通：</td>
                <td><textarea name="vtraffic" cols="50" rows="5"><?php echo $con[vtraffic]; ?></textarea></td>
              </tr>

              <tr bgcolor="#DEE5FA" >
                <td align="right" valign="top">景点缩略图：</td>
                <td><input type=file name=picdir size="45" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  支持上传的类型：png,jpg,gif,jpeg，图片尺寸： * </td>
              </tr>
              <tr bgcolor="#DEE5FA">
                <td align="right" valign="top">预览区：</td>
                <td><img src="<?php echo $previmg; ?>" width="150" id="picview" name="picview" /></td>
              </tr>


			   <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">景点简介：</td>
                <td>
<?php
$ed= new FCKeditor('vbrief');
$ed->BasePath=$sBasePath;
$ed->Value=$con[vbrief];
$ed->Create();

?>
				</td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="提交保存" name="view_submit"></center>
</form>
</BODY>
</HTML>