<?
require_once('../lib07/auto_load.php');

if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$global_websitename;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
window.status="欢迎使用<?=$global_websitename;?>！";
</script>

</head>

<body style="margin:0px 0px 0px 0px;" >
<?require_once('../inc/head.inc.php');?>

<table  class="allbody" border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" nowrap  id="frmTitle"  class="class_left" name="frmTitle">
   	 <?require_once('base_left.php');?>    	

    	
    </td>
    <td width="8" id="switchPoint" title="开启关闭左侧导航栏" class="class_bar"   onClick="switchSysBar()"><img src=../myimages/1/toggler_2.gif></td>
    <td align="center" valign="top"  class="class_right">

 <script language="javascript">
<!--
function FormCheck() 
{

  if (myform.companyname.value=="")
  {
    alert("请您填写公司名称！");
    document.myform.companyname.focus();
    return false;
  }
  
  
   
        
 
  return true;  
}

//-->
</script>


</head>



<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;基础数据->增加供应商</td>
  </tr>
</table>
<br>

<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmatable" style="padding:0px auto;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;增加供应商</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
  	
	<form name="myform" method="post" action="provide_addto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td width=15%  class="provideuser_1"><font color="#FF0000">*</font>公司名称：</td>
            <td width=45%  class="provideuser_2"><input name="companyname" type="text" id="companyname" size="30" maxlength="40"></td>
            <td width=40%; class="provideuser_3">必填写项</td>
          </tr>
          <tr id=chinaaddress1> 
            <td  width=15%  class="provideuser_1">所在地区：</td>
            <td bgcolor="#FFFFFF" class="provideuser_2" width=45% > <script language=javascript src='/lib07/area.js'></script> 
              <SELECT id=chinacomprovince 
      onchange=changeProvince(this,true) name=sheng>
                <OPTION value="" 
        selected>请选择省份</OPTION>
                <OPTION value=Beijing>北京市</OPTION>
                <OPTION 
        value=Tianjin>天津市</OPTION>
                <OPTION value=Hebei>河北省</OPTION>
                <OPTION 
        value=Shanxi>山西省</OPTION>
                <OPTION value=InnerMongolia>内蒙古自治区</OPTION>
                <OPTION value=Liaoning>辽宁省</OPTION>
                <OPTION value=Jilin>吉林省</OPTION>
                <OPTION value=Heilongjiang>黑龙江省</OPTION>
                <OPTION 
        value=Shanghai>上海市</OPTION>
                <OPTION value=Jiangsu>江苏省</OPTION>
                <OPTION 
        value=Zhejiang>浙江省</OPTION>
                <OPTION value=Anhui>安徽省</OPTION>
                <OPTION 
        value=Fujian>福建省</OPTION>
                <OPTION value=Jiangxi>江西省</OPTION>
                <OPTION 
        value=Shandong>山东省</OPTION>
                <OPTION value=Henan>河南省</OPTION>
                <OPTION 
        value=Hubei>湖北省</OPTION>
                <OPTION value=Hunan>湖南省</OPTION>
                <OPTION 
        value=Guangdong>广东省</OPTION>
                <OPTION value=Guangxi>广西壮族自治区</OPTION>
                <OPTION value=Hainan>海南省</OPTION>
                <OPTION value=Chongqing>重庆市</OPTION>
                <OPTION value=Sichuan>四川省</OPTION>
                <OPTION value=Guizhou>贵州省</OPTION>
                <OPTION value=Yunnan>云南省</OPTION>
                <OPTION value=Tibet>西藏自治区</OPTION>
                <OPTION value=Shaanxi>陕西省</OPTION>
                <OPTION value=Gansu>甘肃省</OPTION>
                <OPTION value=Qinghai>青海省</OPTION>
                <OPTION 
        value=Ningxia>宁夏回族自治区</OPTION>
                <OPTION value=Xinjiang>新疆维吾尔自治区</OPTION>
                <OPTION value=Hongkong>香港特别行政区</OPTION>
                <OPTION 
        value=Macao>澳门特别行政区</OPTION>
                <OPTION value=Taiwan>台湾省</OPTION>
              </SELECT> <SELECT id=chinacomcity onchange=changeAreaCodeByCity(this) name=chinacomcity>
                <OPTION value="" selected>请选择城市</OPTION>
              </SELECT></td>
            <td width=40% class="provideuser_3">&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>固定电话：</td>
            <td bgcolor="#FFFFFF" id=areacodetd class="provideuser_2" width=45%><TABLE class=stepIn cellSpacing=0 cellPadding=0 border=0>
                <SPAN 
        class=info></SPAN> 
                <TBODY>
                  <TR> 
                    <TD><INPUT id=telcountrycode maxLength=8 size=6 value=86 
            name=telcountrycode>
                      -</TD>
                    <TD id=areacodetd1><INPUT id=telareacode maxLength=40 size=6 
            name=telareacode>
                      -</TD>
                    <TD><INPUT id=tel maxLength=40 size=15 
      name=tel></TD>
                  </TR>
                </TBODY>
              </TABLE></td>
            <td  class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td class="provideuser_1" width=15%>传真：</td>
            <td bgcolor="#FFFFFF" class="provideuser_2" width=45%> <TABLE class=stepIn cellSpacing=0 cellPadding=0 border=0>
                <TBODY>
                  <TR> 
                    <TD><input id=faxcountrycode maxlength=8 size=6 value=86 
            name=faxcountrycode>
                      -</TD>
                    <TD id=areacodetd2><INPUT id=faxareacode maxLength=8 size=6 
            name=faxareacode>
                      -</TD>
                    <TD><INPUT maxLength=40 size=15 
  name=fax></TD>
                  </TR>
                </TBODY>
              </TABLE></td>
            <td class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%><font color="#FF0000">*</font>联系人：</td>
            <td   class="provideuser_2" width=45%><input name="linkname" type="text" id="linkname" size="20" maxlength="30"></td>
            <td   class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>联系人手机：</td>
            <td   class="provideuser_2" width=45%><input name="mobile" type="text" id="mobile" size="20" maxlength="30"></td>
            <td   class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>联系EMAIL：</td>
            <td   class="provideuser_2" width=45%><input name="email" type="text" id="email" size="30" maxlength="40"></td>
            <td   class="provideuser_3" width=40%>请填写正确格式</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>详细地址：</td>
            <td   class="provideuser_2" width=45%><input name="address" type="text" id="address" size="40" maxlength="50"></td>
            <td   class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>邮编：</td>
            <td   class="provideuser_2" width=45%><input name="postcode" type="text" id="postcode" size="10" maxlength="20"></td>
            <td   class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>主要供应产品：</td>
            <td   class="provideuser_2" width=45%><input name="mainproduct" type="text" id="mainproduct" size="40" maxlength="50"></td>
            <td   class="provideuser_3" width=40%>用半角逗号分隔，如“,”</td>
          </tr>
          <tr> 
            <td   class="provideuser_1" width=15%>备注：</td>
            <td   class="provideuser_2" width=45%> 
              <input name="beiz" type="text" id="beiz" size="40" maxlength="80"></td>
            <td   class="provideuser_3" width=40%>&nbsp;</td>
          </tr>
          <tr align="center"> 
            <td colspan="3"   style="text-align:center;height:25px;line-height:25px;padding:2px;width:15%;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;"><input type="submit" name="Submit" class="submit" value="-增加-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
              <input type="hidden" name="code" value="<?echo $code;?>"> </td>
          </tr>
        </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、供应商信息根据企业实际应用情况填写，详细程度自己掌握。</td>
  </tr>
</table>


    </td>
  </tr>
</table>

</body>
</html>