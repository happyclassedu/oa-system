<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
require_once("upfile.fun.php");
if(isset($_GET[del])){
if($_GET[del]==data){
$ID_Dele= implode(",",$_POST['xm']);
$db->query("DELETE FROM `{$dbpre}focus` WHERE `id` in (".$ID_Dele.")");
ShowMsg("����ͼƬɾ���ɹ�","-1");
}else{
$db->query("DELETE FROM `{$dbpre}focus` WHERE `id` = $_GET[del]");
ShowMsg("����ͼƬɾ���ɹ�","-1");
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
ShowMsg("�ɹ��޸Ľ���ͼƬ��","upfocus.php");
}else{
if(empty($xmfone_image)){
	ShowMsg("��ѡ����Ҫ��ת�Ľ���ͼƬ��","-1");
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
ShowMsg("�ɹ���ӽ���ͼƬ��","upfocus.php");

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
		alert("������ѡ��1����Ϣ!");
	}
	else{
		if(confirm("ȷ��Ҫɾ��ѡ�����Ϣ��\n�˲��������Իָ���")){
			form.action="?del=data";
			form.submit();
		}
	}
}
function CheckSubmit()
  {
     if(document.form1.order.value==""){
	     alert("����ͼ˳����Ϊ�գ�");
	     document.form1.order.focus();
	     return false;
     }
     if(document.form1.introduce.value==""){
	     alert("ͼƬ˵������Ϊ�գ�");
	     document.form1.introduce.focus();
	     return false;
     }
     if(document.form1.targeturl.value==""){
	     alert("��ת��ַ����Ϊ�գ�");
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
        <th align=center colspan=7 style="height: 23px">��վ��ҳͼƬ����б�</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="7" align="left" class=txlrow><a href="?focus=add">��������ͼƬ��桿</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="3%" align="center" class="txlHeaderBackgroundAlternate">����</td>
        <td width="24%" align="center" class=txlHeaderBackgroundAlternate>ͼƬ·��</td>
        <td width="24%" align="center" class=txlHeaderBackgroundAlternate>Ŀ����վ</td>
        <td width="26%" align="center" class=txlHeaderBackgroundAlternate>����˵��</td>
        <td width="10%" align="center" class=txlHeaderBackgroundAlternate>���ʱ��</td>
        <td width="6%" align="center" class=txlHeaderBackgroundAlternate>����</td>
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
        <td align="center" class=txlrow><a href="?edit=<?php echo $row[id] ?>">�༭</a> <a href="?del=<?php echo $row[id] ?>">ɾ��</a></td>
        <td align="center" class=txlrow><input type=checkbox value=<?php echo $row[id] ?> name="xm[]" onClick=Checked(form)></td>
</tr>
<?php
}
?>

    <tr bgcolor="#DEE5FA">
        <td colspan="6"  align=center bgcolor="#DEE5FA" class=txlrow>&nbsp;</td>
        <td align=center bgcolor="#DEE5FA" class=txlrow>
     <INPUT type=button title=ɾ�� onclick=DelAll()  value=ɾ�� name=Submit>		</td>
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
        <th align=center colspan=2 style="height: 23px">�ϴ���վ����ͼƬ</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">ͼƬ˳��</td>
                <td>
                <input name=order type=text class="text" value="<?php echo $row[order]; ?>"/>
                <input name=pic type=hidden value="<?php echo $row[picdir]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">ͼƬ˵����</td>
                <td>
                <input name=introduce type=text class="text"  value="<?php echo $row[introduce]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="15%" align="right" valign="center">��ת��ַ��</td>
                <td>
                <input name=targeturl type=text class="text" value="<?php echo $row[targeturl]; ?>"/>
                </td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td align="right" valign="top">ѡ���ϴ���ͼƬ��</td>
                <td><input type=file name=picdir size="45" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br /><br />
                  ֧���ϴ������ͣ�png,jpg,gif,jpeg��ͼƬ�ߴ磺 * </td>
              </tr>
              <tr bgcolor="#DEE5FA">
                <td align="right" valign="top">Ԥ������</td>
                <td><img src="<?php echo $previmg; ?>" width="150" id="picview" name="picview" /></td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="�� ��" name="focus_submit"></center>
</form>

<?php
}

?>





</BODY>
</HTML>