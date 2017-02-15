<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>系统管理首页  - powered by elinstudio</title>
<STYLE type=text/css>
BODY {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: 宋体; BACKGROUND-COLOR: #d6dff7
}
A {
	FONT: 12px 宋体; COLOR: #000000; TEXT-DECORATION: none
}
A:hover {
	COLOR: #428eff
}
TD {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: 宋体
}
TH {
	FONT-WEIGHT: bold; FONT-SIZE: 12px; BACKGROUND-IMAGE: url(images/admin_bg_1.gif); COLOR: white; BACKGROUND-COLOR: #4455aa
}
TD.txlHeaderBackgroundAlternate {
	COLOR: #ffffff; BACKGROUND-COLOR: #799ae1
}
#TableTitleLink A:link {
	COLOR: #ffffff; TEXT-DECORATION: none
}
#TableTitleLink A:visited {
	COLOR: #ffffff; TEXT-DECORATION: none
}
#TableTitleLink A:active {
	COLOR: #ffffff; TEXT-DECORATION: none
}
#TableTitleLink A:hover {
	COLOR: #ffffff; TEXT-DECORATION: underline
}
TD.txlRow {
	BACKGROUND-COLOR: #dee5fa
}
TD.txlRowHighlight {
	BACKGROUND-COLOR: #d4def9
}
.tableBorder {
	BORDER-RIGHT: #6595d6 1px solid; BORDER-TOP: #6595d6 1px solid; BORDER-LEFT: #6595d6 1px solid; BORDER-BOTTOM: #6595d6 1px solid; BACKGROUND-COLOR: #ffffff
}
INPUT {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,宋体
}
SELECT {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,宋体
}
TEXTAREA {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,宋体
}
</STYLE>
</head>
<body >
<div class='bodytitle'>
    <div class='bodytitleleft'></div>
    <div class='bodytitletxt'>系统管理首页</div>
    <div class='bodytitleright'></div>
</div>
<div class="clear"></div>
			<div class="ccc2">
			<ul>
			您好! <font color="#FF6600"><strong><?php echo $arr[userid]; ?></strong></font>。您的IP是：<font color="#FF6600"><strong><?php echo GetIp(); ?></strong></font>，管理员帐号是<font color="#FF6600"><strong><?php echo $arr[userid];?></strong></font>，管理员级别是<font color="#FF6600"><strong><?php echo $arr[title]?></strong></font>
			</ul>
			</div>
			<div> </div>
			<div>


<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">服务器的有关参数</th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">PHP版本：</td>
      <td class="td_bg" width="83%"><?php echo "PHP".PHP_VERSION; ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">MYSQL版本：</td>
      <td class="td_bg" width="83%"><?php echo mysql_get_server_info(); ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">服务器名：</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER['SERVER_NAME']; ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">服务器IP：</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["HTTP_HOST"]; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">服务器端口：</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["SERVER_PORT"]; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">服务器时间：</td>
      <td class="td_bg" width="83%"><?php echo date("Y-m-d H:i:s");?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">服务器操作系统：</td>
      <td class="td_bg" width="83%"><?php echo PHP_OS; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">站点物理路径：</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["DOCUMENT_ROOT"]; ?></td>
    </tr>












  </tbody>
</table>
<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">网站管理系统版本</th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">当前版本<span class="TableRow2"></span></td>
      <td width="83%" class="td_bg"><strong>品牌网.V2.0 <span class="TableRow1"></span></strong></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">版权声明<span class="TableRow2"></span></td>
      <td class="td_bg" width="83%">1、本软件为共享软件,未经书面授权，不得向任何第三方提供本软件系统; <br>
        2、用户自由选择是否使用,在使用中出现任何问题和由此造成的一切损失作者将不承担任何责任; <br>
        3、您可以对本系统进行修改和美化，但必须保留完整的版权信息;  　<br>
      4、本软件受中华人民共和国《著作权法》《计算机软件保护条例》等相关法律、法规保护，作者保留一切权利。</td>
    </tr>
  </tbody>
</table>
<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">网站管理系统开发 </th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">程序制作<span class="TableRow2"></span></td>
      <td width="83%" class="td_bg"><strong>而立科技</strong></td>
    </tr>
    <tr>
      <td class="td_bg" height="23">联系方式<span class="TableRow2"></span></td>
      <td class="td_bg">E_mail：781282886@qq.com    QQ：781282886 (如在使用当中有发现BUG及相关的建议可以和我联系！) </td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">程序主页<span class="TableRow2"></span></td>
      <td class="td_bg" width="83%"><a href="http://www.erlitech.com" target="_blank">www.erlitech.com</a><a href="http://www.865171.cn" target="_blank"></a>【企业网站源码下载】</td>
    </tr>
  </tbody>
</table>
</body>