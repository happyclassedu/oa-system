<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once("../include/FCKeditor/fckeditor.php");
require_once("upfile.fun.php");
if(isset($_GET[name])&&!empty($_GET[pid])&&($_GET[name]=='province'||$_GET[name]=='city'||$_GET[name]=='county')){
$local=$_GET[name]=='province' ? 'province' : ($_GET[name]=='city' ? 'city' : 'county');
$sql="SELECT * FROM `{$dbpre}class_{$local}` WHERE `id`=$_GET[pid]";
$query=$db->query($sql);
$row=$db->fetch_array($query);
$local_info=array('id'=>$row[id],'name'=>$row[name]);

	if(isset($_POST[brief_submit])){
		if(!empty($_FILES[picdir][name])){
			if(!empty($_POST[pic])){
				$pic=$_POST[pic];
				@unlink("..".$pic);
			}
		check_upimage("picdir");
		$name_file = 'picdir';
		$xmfone_image=start_upload($name_file,"/local/");
		}else{
			$xmfone_image="$_POST[pic]";
		}

		$sql="SELECT * FROM `{$dbpre}local_brief` WHERE `{$local}`=$_GET[pid]";
		$query=$db->query($sql);
		$num=mysql_num_rows($query);
		if(!empty($num)){
			$sql="UPDATE `{$dbpre}local_brief` SET `post`='$_POST[post]', `code`='$_POST[code]',`brief`='$_POST[brief]',`pic`='".$xmfone_image."' WHERE `{$local}`='$_GET[pid]'";
		}else{
			$sql="INSERT INTO `{$dbpre}local_brief` (
`id` ,
`{$local}` ,
`post` ,
`code` ,
`brief` ,
`pic`
)
VALUES (
NULL ,  '$_GET[pid]', '$_POST[post]', '$_POST[code]', '$_POST[brief]', '".$xmfone_image."'
);
";
		}
	$db->query($sql);
//	ShowMsg('保存成功！',-1);
	}
?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
<script language="javascript" src="inc/vbm.js"></script>
</head>
<body>


<?php

$previmg="../admin/images/pview.gif";
		$sql="SELECT * FROM `{$dbpre}local_brief` WHERE `{$local}`='$_GET[pid]'";
		$query=$db->query($sql);
		$con=$db->fetch_array($query);
		if(!empty($con[pic])){
		$previmg="..".$con[pic];
		}else{
		$previmg="../admin/images/pview.gif";
		}

?>
<form method="post" name="form1" action="" enctype="multipart/form-data" >

<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
            <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">地区简介管理页面</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">城市名称：</td>
                <td width="92%">
                <?php echo $local_info[name]; ?><input name=pic type=hidden value="<?php echo $con[pic]; ?>"/></td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">邮政编码：</td>
                <td>
                <input name="post" type=text class="text"   value="<?php echo $con[post]; ?>"/>                </td>
              </tr>

			    <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">电话区号：</td>
                <td>
                <input name="code" type=text class="text"  value="<?php echo $con[code]; ?>"/>                </td>
              </tr>



              <tr bgcolor="#DEE5FA" >
                <td align="right" valign="top">城市缩略图：</td>
                <td><input type=file name=picdir size="45" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  支持上传的类型：png,jpg,gif,jpeg，图片尺寸： * </td>
              </tr>
              <tr bgcolor="#DEE5FA">
                <td align="right" valign="top">预览区：</td>
                <td><img src="<?php echo $previmg; ?>" width="150" id="picview" name="picview" /></td>
              </tr>


			   <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">地区简介：</td>
                <td>
<?php
$ed= new FCKeditor('brief');
$ed->BasePath=$sBasePath;
$ed->Value=$con[brief];
$ed->Create();

?>				</td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="提交保存" name="brief_submit"></center>
</form>
</BODY>
</HTML>
<?php
}
?>