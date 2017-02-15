<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
include_once("../include/FCKeditor/fckeditor.php");
if(isset($_GET[edit])&&!empty($_GET[edit])){
	$sql="SELECT * FROM `{$dbpre}user_add_company` WHERE `id`='$_GET[edit]'";
	$query=mysql_query($sql);
	$con=mysql_fetch_array($query);
	$sql="SELECT * FROM `{$dbpre}member`";
    $query=$db->query($sql);
    while($row=mysql_fetch_array($query)){
       $user[$row[id]]=$row[userid];
    }
}
if(isset($_POST[verify_submit])){
	if(!empty($_GET[edit])&&!empty($_POST[cname])&&!empty($_POST[cadd])&&!empty($_POST[ctel])){
		$sql="INSERT INTO `{$dbpre}company` (
`id` ,
`uid` ,
`cname` ,
`cadd` ,
`ctel` ,
`cmail` ,
`cweb` ,
`industry` ,
`nature` ,
`cnumber` ,
`capital` ,
`setup` ,
`brief` ,
`products` ,
`province` ,
`city` ,
`local` ,
`click` ,
`update` ,
`keyword` ,
`description`,
`injointime`
)
VALUES (
NULL , '$_POST[uid]', '$_POST[cname]', '$_POST[cadd]', '$_POST[ctel]', '$_POST[cmail]', '$_POST[cweb]', '$_POST[sub_industry]', '$_POST[nature]', '$_POST[cnumber]', '$_POST[capital]', '$_POST[setup]', '$_POST[brief]', '$_POST[products]', '1', '$_POST[province]', '$_POST[city]', '1', '".mktime()."', '$_POST[keyword]', '$_POST[description]', '".mktime()."'
);
";
	$db->query($sql);
	$sql="DELETE FROM `{$dbpre}user_add_company` WHERE `id`= '$_GET[edit]' AND `uid`='$_POST[uid]'";
	$db->query($sql);
	ShowMsg("审核成功一条企业信息！","user_company.php");
	}else{

		ShowMsg("公司名称、公司地址、公司电话不能为空","qyhy_verify.php?edit=$_GET[edit]");
	}




}
?>
<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<link rel="stylesheet" href="inc/css.css" type="text/css" />
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

createXMLHttpRequest();
var url = "../admin/include/select.php?sid=" + sid;
xmlHttp.onreadystatechange = function(){onStateChange()};
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}
function onStateChange(oElement){
    if(xmlHttp.readyState == 4){
        if(xmlHttp.status == 200){
   var returntxt=xmlHttp.responseText;
   		if(returntxt!=""){
   var htmltxt = '<select name="city" id="city">' + returntxt + '</select>';
    document.getElementById("citybox").innerHTML=htmltxt;
	}else{
	document.getElementById("citybox").innerHTML="";
	}
        }
    }
}


function addSelectindustry(sid,elementID) {
     createXMLHttpRequest();
var url = "../admin/include/select1.php?sid=" + sid;
xmlHttp.onreadystatechange = function(){onStateChangeindustry()};
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}
function onStateChangeindustry(eElement){
    if(xmlHttp.readyState == 4){
        if(xmlHttp.status == 200){
   var returntxt=xmlHttp.responseText;
   if(returntxt!=""){
   var htmltxt = '<select name="sub_industry" id="sub_industry">' + returntxt + '</select>';
    document.getElementById("industrybox").innerHTML=htmltxt;
	}else{
	document.getElementById("industrybox").innerHTML="";
	}
        }
    }
}
//-->
</script>
</head>
<body>

<form method="post" name="form1" action="" enctype="multipart/form-data" >

<table width="1052" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
            <tbody>
      <tr>
        <th align=center colspan=4 style="height: 23px">企业信息审核页面</th>
      </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">提交用户：</td>
                <td colspan="3">
				<input type="text" name="userid" disabled="disabled" value="<?php echo $user[$con[uid]]; ?>"/>
				<input type="hidden" name="uid"  value="<?php echo $con[uid]; ?>" />
				</td>
              </tr>
              <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司名称：</td>
                <td colspan="3">
                <input name="cname" type=text class="text" size="50"  value="<?php echo $con[cname]; ?>"/> 最后更新时间：<?php echo date("Y-m-d",$con[update]); ?>               </td>
              </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">所在地区：</td>
                <td colspan="3">
               <div style="float:left">
                    <select name="province" size="1" id="province" onChange="addSelect(this.options[this.selectedIndex].value,'city');">
                        <option value="0">选择城市...</option>
                        <?php
                 $result = $db->query("select * from `{$dbpre}class_city`");
                 while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[city]){
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

                if(!empty($con[local])){
                	echo "<select name=\"city\"  id=\"city\" >";
                	$result = $db->query("select * from `{$dbpre}class_county` WHERE `pid`=$con[city]");
                	while($row2 = $db->fetch_array($result)){
                 	 if($row2[id]==$con[local]){
                 	 echo "<option value=\"".$row2['id']."\" selected=\"selected\">".$row2['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row2['id']."\">".$row2['name']."</option>";
                 	 }
                 	}
                 	echo "</select>";
                }
                ?>
                </div>			                  </td>
              </tr>


			    <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司地址：</td>
                <td width="41%">
                <input name="cadd" type=text class="text"  value="<?php echo $con[cadd]; ?>" size="60"/>                </td>
                <td width="8%" align="center">所属行业：</td>
                <td width="44%">
				<div style="float:left">
                    <select name="industry" size="1" id="industry" onChange="addSelectindustry(this.options[this.selectedIndex].value,'sub_industry');">
                        <option value="0">选择行业...</option>
                        <?php
                if(!empty($con[industry])){
				$s_sql="SELECT * FROM `{$dbpre}industry` WHERE `id`=$con[industry]";
				$s_query=$db->query($s_sql);
				$s_industry=$db->fetch_array($s_query);
                }

                 $result = $db->query("select * from `{$dbpre}industry` WHERE `pid`='0'");
                 while($row = $db->fetch_array($result)){
                 	 if($row[id]==$s_industry[pid]){
                 	 echo "<option value=\"".$row['id']."\" selected=\"selected\">".$row['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                 	 }
                 }
            ?>
                    </select>
                </div>
                <div id="industrybox" style="float:left; padding-left:5px;">
                <?php

                if(!empty($con[industry])){
                	echo "<select name=\"sub_industry\"  id=\"sub_industry\" >";
                	$result = $db->query("select * from `{$dbpre}industry` WHERE `pid`=$s_industry[pid]");
                	while($row = $db->fetch_array($result)){
                 	 if($row[id]==$con[industry]){
                 	 echo "<option value=\"".$row['id']."\" selected=\"selected\">".$row['name']."</option>";
                 	 }else{
                     echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
                 	 }
                 	}
                 	echo "</select>";
                }
                ?>
                </div>

				</td>
		      </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司电话：</td>
                <td>
                <input name="ctel" type=text class="text"  value="<?php echo $con[ctel]; ?>" size="50"/>                </td>
                <td  align="center">公司性质：</td>
                <td><input name="nature" type=text class="text"  value="<?php echo $con[nature]; ?>"/></td>
			  </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司邮箱：</td>
                <td>
                <input name="cmail" type=text class="text"  value="<?php echo $con[cmail]; ?>" size="40"/>                </td>
                <td  align="center">公司人数：</td>
                <td><input name="cnumber" type=text class="text"  value="<?php echo $con[cnumber]; ?>" size="10"/></td>
			  </tr>

			  <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司网址：</td>
                <td>
                <input name="cweb" type=text class="text"  value="<?php echo $con[cweb]; ?>" size="40"/>                </td>
                <td align="center"> SEO关键词： </td>
                <td><input name="keyword" type=text class="text"  value="<?php echo $con[keyword]; ?>" size="60"/></td>
			  </tr>

              <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">成立时间：</td>
                <td>
                <input name="setup" type=text class="text"  value="<?php echo $con[setup]; ?>"/>                </td>
                <td align="center">SEO描述语：</td>
                <td><input name="description" type=text class="text"  value="<?php echo $con[description]; ?>" size="60"/></td>
              </tr>

              <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">注册资金：</td>
                <td>
                <input name="capital" type=text class="text"  value="<?php echo $con[capital]; ?>"/>                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

			    <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司简介：</td>
                <td colspan="3">
<?php
$ed= new FCKeditor('brief');
$ed->BasePath=$sBasePath;
$ed->Value=$con[brief];
$ed->Create();

?>				</td>
              </tr>




			   <tr bgcolor="#DEE5FA" >
                <td width="7%" align="right" valign="center">公司主营：</td>
                <td colspan="3">
<?php
$ed= new FCKeditor('products');
$ed->BasePath=$sBasePath;
$ed->Value=$con[products];
$ed->Create();

?>				</td>
              </tr>
            </tbody>
          </table>

<center><input type="submit" value="提交保存" name="verify_submit"></center>
</form>
</BODY>
</HTML>