<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
<title>ϵͳ������ҳ  - powered by elinstudio</title>
<STYLE type=text/css>
BODY {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: ����; BACKGROUND-COLOR: #d6dff7
}
A {
	FONT: 12px ����; COLOR: #000000; TEXT-DECORATION: none
}
A:hover {
	COLOR: #428eff
}
TD {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: ����
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
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,����
}
SELECT {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,����
}
TEXTAREA {
	FONT-SIZE: 12px; LINE-HEIGHT: 15px; FONT-FAMILY: Tahoma,Verdana,����
}
</STYLE>
</head>
<body >
<div class='bodytitle'>
    <div class='bodytitleleft'></div>
    <div class='bodytitletxt'>ϵͳ������ҳ</div>
    <div class='bodytitleright'></div>
</div>
<div class="clear"></div>
			<div class="ccc2">
			<ul>
			����! <font color="#FF6600"><strong><?php echo $arr[userid]; ?></strong></font>������IP�ǣ�<font color="#FF6600"><strong><?php echo GetIp(); ?></strong></font>������Ա�ʺ���<font color="#FF6600"><strong><?php echo $arr[userid];?></strong></font>������Ա������<font color="#FF6600"><strong><?php echo $arr[title]?></strong></font>
			</ul>
			</div>
			<div> </div>
			<div>


<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">���������йز���</th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">PHP�汾��</td>
      <td class="td_bg" width="83%"><?php echo "PHP".PHP_VERSION; ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">MYSQL�汾��</td>
      <td class="td_bg" width="83%"><?php echo mysql_get_server_info(); ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">����������</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER['SERVER_NAME']; ?></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">������IP��</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["HTTP_HOST"]; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">�������˿ڣ�</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["SERVER_PORT"]; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">������ʱ�䣺</td>
      <td class="td_bg" width="83%"><?php echo date("Y-m-d H:i:s");?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">����������ϵͳ��</td>
      <td class="td_bg" width="83%"><?php echo PHP_OS; ?></td>
    </tr>
	  <tr>
      <td class="td_bg" width="17%" height="23">վ������·����</td>
      <td class="td_bg" width="83%"><?php echo $_SERVER["DOCUMENT_ROOT"]; ?></td>
    </tr>












  </tbody>
</table>
<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">��վ����ϵͳ�汾</th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">��ǰ�汾<span class="TableRow2"></span></td>
      <td width="83%" class="td_bg"><strong>Ʒ����.V2.0 <span class="TableRow1"></span></strong></td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">��Ȩ����<span class="TableRow2"></span></td>
      <td class="td_bg" width="83%">1�������Ϊ�������,δ��������Ȩ���������κε������ṩ�����ϵͳ; <br>
        2���û�����ѡ���Ƿ�ʹ��,��ʹ���г����κ�������ɴ���ɵ�һ����ʧ���߽����е��κ�����; <br>
        3�������ԶԱ�ϵͳ�����޸ĺ������������뱣�������İ�Ȩ��Ϣ;  ��<br>
      4����������л����񹲺͹�������Ȩ����������������������������ط��ɡ����汣�������߱���һ��Ȩ����</td>
    </tr>
  </tbody>
</table>
<table class="table" cellspacing="1" cellpadding="2" width="99%" align="center"
border="0">
  <tbody>
    <tr>
      <th class="bg_tr" align="left" colspan="2" height="25">��վ����ϵͳ���� </th>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">��������<span class="TableRow2"></span></td>
      <td width="83%" class="td_bg"><strong>�����Ƽ�</strong></td>
    </tr>
    <tr>
      <td class="td_bg" height="23">��ϵ��ʽ<span class="TableRow2"></span></td>
      <td class="td_bg">E_mail��781282886@qq.com    QQ��781282886 (����ʹ�õ����з���BUG����صĽ�����Ժ�����ϵ��) </td>
    </tr>
    <tr>
      <td class="td_bg" width="17%" height="23">������ҳ<span class="TableRow2"></span></td>
      <td class="td_bg" width="83%"><a href="http://www.erlitech.com" target="_blank">www.erlitech.com</a><a href="http://www.865171.cn" target="_blank"></a>����ҵ��վԴ�����ء�</td>
    </tr>
  </tbody>
</table>
</body>