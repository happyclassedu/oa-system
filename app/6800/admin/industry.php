<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
//=====================添加分类执行代码开始==============

if(isset($_POST['catsub'])){
	if(isset($_GET['mod'])){
    	if(trim($_POST['catname'])){
    		if($_GET['mod']==$_POST['parent']){
    		ShowMsg("不能以自己的ID为父类","-1");
    	     }
       $chk=CatIdCheck("{$dbpre}industry",$_GET['mod']);
        if(is_array($chk)){
        	foreach($chk as $val){
        		if($_POST['parent']==$val){
        			ShowMsg("不能改成自己的子类为父类！","-1");
        		}
        	}
        }
       $sql="UPDATE `{$dbpre}industry` SET `pid` = '".$_POST['parent']."',
`name` = '".$_POST['catname']."',
`sort` = '".$_POST['catorder']."' WHERE `id` ='".$_GET['mod']."' LIMIT 1 ;";
        $db->query($sql);
        ShowMsg("成功修改新闻分类！","industry.php");

    }else{
    	ShowMsg("分类名称不能为空。","industry.php");
    }
}else{

    if(trim($_POST['catname'])){
$cname=explode('|',$_POST['catname']);
$cname=array_filter($cname);
	if(empty($cname)){
		ShowMsg("请正确填写分类名称。","industry.php");
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
        ShowMsg("祝贺你成功添加了一项行业分类！","industry.php");
	}
    }else{
    	ShowMsg("请正确填写分类名称。","industry.php");
    }
 }

}
//=====================添加分类执行代码结束==============
 if(isset($_GET['del'])){
	$sql="SELECT * FROM `{$dbpre}industry` WHERE `pid`='".$_GET['del']."'";
	$query=$db->query($sql);
		if(mysql_num_rows($query)){
		    ShowMsg("请先删除该分类下的所有分类后再进行操作！","industry.php");
		}else{

		 	$sql="DELETE FROM `{$dbpre}industry` WHERE `id`='".$_GET['del']."'";
            $db->query($sql);
			ShowMsg("成功删除新闻分类。","industry.php");


		}
 }
//=====================读取分类代码开始=================
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
            echo "<tr bgcolor=\"#DEE5FA\"><td align=\"left\" class=\"txlrow\">".$space.$arrc[$i][2]."-[".$arrc[$i][3]."]</td><td align=center class=txlrow><a href=\"?mod=".$arrc[$i][0]."\">【修改】</a><a href=\"?del=".$arrc[$i][0]."\">【删除】</a></td></tr>";
            $space.="&nbsp;&nbsp;";
            fenlei($arrc[$i][0]);
            $space=substr($space,12);
          }
     }
}


//=====================读取分类代码结束=================


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
        <th align=left colspan=2 style="height: 23px">添加行业分类</th>
      </tr>

      <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">选择父类</td>
        <td width="80%" align="left" class="txlrow">
        <select name="parent">
		<option value='0' ><?php
		if($_GET[mod]){
			echo "转成大类";
		}else{
			echo "添加大类";
		}

		?></option>
       <?php option($_GET[mod],0); ?>
        </select>
        </td>

      </tr>





	  <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">分类名称</td>
        <td width="80%" align="left" class="txlrow">
       <input type="text" size="50" name="catname" value="<?php echo $row[name]; ?>">一次可添加多个分类格式为（分类1|分类2|分类3）。
        </td>

      </tr>






	  <tr align="center" bgcolor="#DEE5FA">
        <td width="20%" align="left" class="txlrow">显示排序</td>
        <td width="80%" align="left" class="txlrow">
       <input type="text" size="5" name="catorder" value="<?php echo $row[catsort]; ?>">*请填写数字
        </td>

      </tr>



     <tr align="center" bgcolor="#DEE5FA">
        <td colspan=2 align="left" class=txlrow>
        <input type="submit" name="catsub" value="保存设置"/>
        </td>
     </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan=2 align=center class=txlrow></td>
      </tr>
</tbody></table>
</form>



<?php
//===============上面为添加分类============
}
?>









<form name="form1" method="post" action="">
  <table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=2 style="height: 23px">中国行业分类管理</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="2" align="left" class=txlrow><a href="?act=add">【点击添加分类】</a></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="70%" align="left" class="txlHeaderBackgroundAlternate">行业分类名称</td>
        <td align="left" class="txlHeaderBackgroundAlternate">操作</td>
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