<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
//=====================��ӷ���ִ�д��뿪ʼ==============

if(isset($_POST['catsub'])){
	if(isset($_GET['mod'])){
    	if(trim($_POST['catname'])){
    		if($_GET['mod']==$_POST['parent']){
    		ShowMsg("�������Լ���IDΪ����","-1");
    	     }
       $chk=CatIdCheck("{$dbpre}industry",$_GET['mod']);
        if(is_array($chk)){
        	foreach($chk as $val){
        		if($_POST['parent']==$val){
        			ShowMsg("���ܸĳ��Լ�������Ϊ���࣡","-1");
        		}
        	}
        }
       $sql="UPDATE `{$dbpre}industry` SET `pid` = '".$_POST['parent']."',
`name` = '".$_POST['catname']."',
`sort` = '".$_POST['catorder']."' WHERE `id` ='".$_GET['mod']."' LIMIT 1 ;";
        $db->query($sql);
        ShowMsg("�ɹ��޸����ŷ��࣡","industry.php");

    }else{
    	ShowMsg("�������Ʋ���Ϊ�ա�","industry.php");
    }
}else{

    if(trim($_POST['catname'])){
$cname=explode('|',$_POST['catname']);
$cname=array_filter($cname);
	if(empty($cname)){
		ShowMsg("����ȷ��д�������ơ�","industry.php");
	}else{
		foreach($cname as $val){

       $sql="INSERT INTO `{$dbpre}industry` (
`id` ,
`pid` ,
`name` ,
`sort`
)
VALUES (
NULL , '".$_POST['parent']."', '".trim($val)."',  '".$_POST['catorder']."'
);";
        $db->query($sql);
		}
        ShowMsg("ף����ɹ������һ����ҵ���࣡","industry.php");
	}
    }else{
    	ShowMsg("����ȷ��д�������ơ�","industry.php");
    }
 }

}
//=====================��ӷ���ִ�д������==============
 if(isset($_GET['del'])){
	$sql="SELECT * FROM `{$dbpre}industry` WHERE `pid`='".$_GET['del']."'";
	$query=$db->query($sql);
		if(mysql_num_rows($query)){
		    ShowMsg("����ɾ���÷����µ����з�����ٽ��в�����","industry.php");
		}else{

		 	$sql="DELETE FROM `{$dbpre}industry` WHERE `id`='".$_GET['del']."'";
            $db->query($sql);
			ShowMsg("�ɹ�ɾ�����ŷ��ࡣ","industry.php");


		}
 }
//=====================��ȡ������뿪ʼ=================
$sql="SELECT * FROM `{$dbpre}industry` order by `sort`,`id`";
$query=$db->query($sql);
if(mysql_num_rows($query)){
while($row=$db->fetch_array($query)){
	$arrc[]=array($row[id],$row[pid],$row[name],$row[sort]);
	}
}
function fenlei($parentid=0){
global $arrc;
    for($i=0;$i<count($arrc);$i++){
        static $space="";
         if($arrc[$i][1]==$parentid){
            echo "<tr bgcolor=\"#DEE5FA\"><td align=\"left\" class=\"txlrow\">".$space.$arrc[$i][2]."-[".$arrc[$i][3]."]</td><td align=center class=txlrow><a href=\"?mod=".$arrc[$i][0]."\">���޸ġ�</a><a href=\"?del=".$arrc[$i][0]."\">��ɾ����</a></td></tr>";
            $space.="&nbsp;&nbsp;";
            fenlei($arrc[$i][0]);
            $space=substr($space,12);
          }
     }
}


//=====================��ȡ����������=================


function option($mod,$id=0){
	global $dbpre,$db;
	if($mod){
	$sql="SELECT * FROM `{$dbpre}industry` WHERE `id`=$mod";
	$query=mysql_query($sql);
	$row=$db->fetch_array($query);
    $m=$row[pid];
	}
	static $sp="";
	$sql="SELECT * FROM `{$dbpre}industry` WHERE `pid`=$id";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		   if($row[id]==$m){
		echo "<option value='$row[id]' selected='selected'>$sp$row[name]</option>";
		   }else{
		echo "<option value='$row[id]'>$sp$row[name]</option>";
		   }
		$sp.="&nbsp;&nbsp;";
		option($mod,$row[id]);
		$sp=substr($sp,12);
	}
}


?>
<html>
<head>
<link rel="stylesheet" href="inc/css.css" type="text/css" />
</head>
<html>
<body>

<?php
if(isset($_GET['act'])&&$_GET['act']=="add"||isset($_GET['mod'])){

	if(isset($_GET['mod'])){
		$sql="SELECT * FROM `{$dbpre}industry` WHERE `id`='".$_GET['mod']."'";
		$query=$db->query($sql);
		$row=$db->fetch_array($query);
	}



?>

<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=left colspan=2 style="height: 23px">�����ҵ����</th>
      </tr>

      <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">ѡ����</td>
        <td width="80%" align="left" class="txlrow">
        <select name="parent">
		<option value='0' ><?php
		if($_GET[mod]){
			echo "ת�ɴ���";
		}else{
			echo "��Ӵ���";
		}

		?></option>
       <?php option($_GET[mod],0); ?>
        </select>
        </td>

      </tr>





	  <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">��������</td>
        <td width="80%" align="left" class="txlrow">
       <input type="text" size="50" name="catname" value="<?php echo $row[name]; ?>">һ�ο���Ӷ�������ʽΪ������1|����2|����3����
        </td>

      </tr>






	  <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">��ʾ����</td>
        <td width="80%" align="left" class="txlrow">
       <input type="text" size="5" name="catorder" value="<?php echo $row[catsort]; ?>">*����д����
        </td>

      </tr>



     <tr align="center" bgcolor="#DEE5FA">
        <td colspan=2 align="left" class=txlrow>
        <input type="submit" name="catsub" value="��������"/>
        </td>
     </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=2 align=center class=txlrow></td>
      </tr>
</tbody></table>
</form>



<?php
//===============����Ϊ��ӷ���============
}
?>









<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">�й���ҵ�������</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="2" align="left" class=txlrow><a href="?act=add">�������ӷ��ࡿ</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="70%" align="left" class="txlHeaderBackgroundAlternate">��ҵ��������</td>
        <td align="left" class="txlHeaderBackgroundAlternate">����</td>
      </tr>

<?php fenlei(); ?>
      <tr bgcolor="#DEE5FA">
        <td colspan=2 align=center class=txlrow></td>
      </tr>
    </tbody>
  </table>
</form>


</body>
</html>