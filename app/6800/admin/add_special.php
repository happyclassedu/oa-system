<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once("../include/FCKeditor/fckeditor.php");
require_once("upfile.fun.php");
if(isset($_POST[special_submit])){
if(!empty($_FILES[picdir][name])){
if(!empty($_POST[pic])){
$pic=$_POST[pic];
@unlink("..".$pic);
}
check_upimage("picdir");
$name_file = 'picdir';
$xmfone_image=start_upload($name_file,"/special/");
	}else{
$xmfone_image="";
	}
if(isset($_GET[edit])){
if(empty($xmfone_image)){

 $sql="UPDATE `{$dbpre}special` SET `sname` = '$_POST[sname]',
`spack` = '$_POST[spack]',
`sweight` = '$_POST[sweight]',
`sprice` = '$_POST[sprice]',
`sexpress` = '$_POST[sexpress]',
`sdescription` = '$_POST[sdescription]',
`sprovince` = '1',
`scity` = '$_POST[province]',
`scounty` = '$_POST[city]',
`sdate` = '".mktime()."',`sflag` = '$_POST[sflag]' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";

}else{
 $sql="UPDATE `{$dbpre}special` SET `sname` = '$_POST[sname]',
`spack` = '$_POST[spack]',
`sweight` = '$_POST[sweight]',
`sprice` = '$_POST[sprice]',
`sexpress` = '$_POST[sexpress]',
`sdescription` = '$_POST[sdescription]',
`sprovince` = '1',
`scity` = '$_POST[province]',
`scounty` = '$_POST[city]',
`spic` = '$xmfone_image',
`sdate` = '".mktime()."',`sflag` = '$_POST[sflag]' WHERE `id` ='$_GET[edit]' LIMIT 1 ;
";
}
$db->query($sql);
ShowMsg("�ɹ��޸��ز���Ϣ��","-1");
}else{
if(empty($xmfone_image)){
	ShowMsg("�����ϴ���ƷͼƬ��","-1");
}
$sql="INSERT INTO `{$dbpre}special` (
`id` ,
`sname` ,
`spack` ,
`sweight` ,
`sprice` ,
`sexpress` ,
`sdescription` ,
`sprovince` ,
`scity` ,
`scounty` ,
`spic` ,
`smpic` ,
`sclick` ,
`sdate` ,
`sflag`
)
VALUES (
NULL , '$_POST[sname]', '$_POST[spack]', '$_POST[sweight]', '$_POST[sprice]', '$_POST[sexpress]', '$_POST[sdescription]', '1', '$_POST[province]', '$_POST[city]', '".$xmfone_image."', '', '1', '".mktime()."', '$_POST[sflag]'
);

";
$db->query($sql);
ShowMsg("�ɹ����һ���ز���Ϣ��","add_special.php");

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
		$sql="SELECT * FROM `{$dbpre}special` WHERE `id`='$_GET[edit]'";
		$query=$db->query($sql);
		$con=$db->fetch_array($query);
		if(!empty($con[spic])){
		$previmg="..".$con[spic];
		}else{
		$previmg="../admin/images/pview.gif";
		}


}
?>
<form method="post" name="form1" action="" enctype="multipart/form-data" >

<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
            <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">�����ز����ҳ��</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">���ڵ�����</td>
                <td width="92%">
                <div style="float:left">
                    <select name="province" size="1" id="province" onChange="addSelect(this.options[this.selectedIndex].value,'city');">
                        <option value="0">ѡ�����...</option>
                        <?php
                 $result = $db->query("select * from `{$dbpre}class_city`");
                 while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[scity]){
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

                if(!empty($con[scounty])){
                	echo "<select name=\"city\"  id=\"city\" >";
                	$result = $db->query("select * from `xm_class_county` WHERE `pid`=$con[scity]");
                	while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[scounty]){
                 	 echo "<option value=\"".$row['id']."\" selected=\"selected\">".$row['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                 	 }
                 	}
                 	echo "</select>";
                }
                ?>

                </div>
                <input name=pic type=hidden value="<?php echo $con[spic]; ?>"/>                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��Ʒ���ƣ�</td>
                <td>
                <input name="sname" type=text class="text" size="50"  value="<?php echo $con[sname]; ?>"/>   &nbsp;&nbsp;�Ƿ�Ϊ�Ƽ���<select name="sflag">
<option value="0" <?php if($con[sflag]=="0") echo "selected='selected'"?>>��</option>
<option value="1" <?php if($con[sflag]=="1") echo "selected='selected'"?>>��</option>

</select>             </td>
              </tr>

			    <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��װ��ʽ��</td>
                <td>
                <select name="spack">
				<option value="1" <?php if($con[spack]=="1") echo "selected='selected'"?>>��װ</option>
				<option value="2" <?php if($con[spack]=="2") echo "selected='selected'"?>>��װ</option>
				<option value="3" <?php if($con[spack]=="3") echo "selected='selected'"?>>ɢװ</option>
				</select>
				</td>
              </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��Ʒ������</td>
                <td>
                <input name="sweight" type=text class="text"  value="<?php echo $con[sweight]; ?>"/>                </td>
              </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��Ʒ�۸�</td>
                <td>
                <input name="sprice" type=text class="text"  value="<?php echo $con[sprice]; ?>"/>Ԫ                </td>
              </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��ݷ��ã�</td>
                <td>
                <input name="sexpress" type=text class="text"  value="<?php echo $con[sexpress]; ?>"/>Ԫ                </td>
              </tr>



              <tr bgcolor="#DEE5FA" >
                <td align="right" valign="top">��Ʒ����ͼ��</td>
                <td><input type=file name=picdir size="45" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  ֧���ϴ������ͣ�png,jpg,gif,jpeg��ͼƬ�ߴ磺 * </td>
              </tr>
              <tr bgcolor="#DEE5FA">
                <td align="right" valign="top">Ԥ������</td>
                <td><img src="<?php echo $previmg; ?>" width="150" id="picview" name="picview" /></td>
              </tr>


			   <tr bgcolor="#DEE5FA" >
                <td width="8%" align="right" valign="center">��ϸ˵����</td>
                <td>
<?php
$ed= new FCKeditor('sdescription');
$ed->BasePath=$sBasePath;
$ed->Value=$con[sdescription];
$ed->Create();

?>
				</td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="�ύ����" name="special_submit"></center>
</form>
</BODY>
</HTML>