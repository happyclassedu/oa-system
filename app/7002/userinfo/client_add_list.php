<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$userid=$_SESSION["userdlname"];
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script> 
<script language="javascript">
<!--
function FormCheck() 
{

  if (myform.clientname.value=="")
  {
    alert("客户名称不能为空！");
    document.myform.clientname.focus();
    return false;
  }
  if (myform.hangy.value=="")
  {
    alert("请选择客户所属行业");
    document.myform.hangy.focus();
    return false;
  }  
 
  if (myform.sheng.value=="")
  {
    alert("请您选择客户所在省！");
    document.myform.sheng.focus();
    return false;
  }  
  
  if (myform.yuangrs.value=="")
  {
    alert("请您选择员工人数！");
    document.myform.yuangrs.focus();
    return false;
  } 
    
  if (myform.tel.value=="")
  {
    alert("请您填写客户固定电话号码！");
    document.myform.tel.focus();
    return false;
  }    

  if (myform.yye.value=="")
  {
    alert("请您填写营业额！");
    document.myform.yye.focus();
    return false;
  } 	
 
  if (myform.address.value=="")
  {
    alert("请您填写客户详细地址！");
    document.myform.address.focus();
    return false;
  }         
 
 
    
  return true;  
}



function textLimitCheck(thisArea, maxLength)
{
    if (thisArea.value.length > maxLength)
	{
      alert(maxLength + ' 个字限制. \r超出的将自动去除.');
      thisArea.value = thisArea.value.substring(0, maxLength);
      thisArea.focus();
    }
    /*回写span的值，当前填写文字的数量*/
   
  }


//-->
</script>

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
          <td>&nbsp;客户资源管理->增加客户</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;增加客户(<font color="#FF0000">*必填写</font>)</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="client_addto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td   class="crm_td">客户所有者：</td>
            <td   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly></td>
            <td align="right"   class="crm_td">等级：</td>
            <td   class="crm_tdright"> 
              <select name=dengji size=1 id="dengji" class="crm_select">
                <OPTION value="无" selected>-无-</OPTION>
                <OPTION value="已获得" >-已获得-</OPTION>
                <OPTION value="有效的" >-有效的-</OPTION>
                <OPTION value="市场失败" >-市场失败-</OPTION>
                <OPTION value="项目取消" >-项目取消-</OPTION>
                <OPTION value="关闭" >-关闭-</OPTION>
              </select></td>
          </tr>
          <tr> 
            <td width="15%"   class="crm_td"> 
              <font color="#FF0000">*</font>客户名：</td>
            <td width="45%"   class="crm_input"> 
              <input name="clientname" type="text" id="clientname" size="30" maxlength="40" > 
            </td>
            <td width="40%" align="right"   class="crm_td">客户类型：</td>
            <td width="40%"   class="crm_tdright"> 
              <select name=kehlx size=1 id="kehlx" class="crm_select">
                <OPTION value="无" selected>-无-</OPTION>
                <OPTION value="分析师" >-分析师-</OPTION>
                <OPTION value="竞争者" >-竞争者-</OPTION>
                <OPTION value="客户" >-客户-</OPTION>
                <OPTION value="经销商" >-经销商-</OPTION>
                <OPTION value="集成商" >-集成商-</OPTION>
                <OPTION value="投资者" >-投资者-</OPTION>
                <OPTION value="大众媒体" >-大众媒体-</OPTION>
                <OPTION value="潜在客户" >-潜在客户-</OPTION>
                <OPTION value="分销商" >-分销商-</OPTION>
                <OPTION value="供应商" >-供应商-</OPTION>
                <OPTION value="其他" >-其他-</OPTION>
              </select> </tr>
          <tr> 
            <td   class="crm_td">所有权：</td>
            <td   class="crm_input"> 
              <select name=suoyq size=1 id="suoyq" class="crm_select">
                <OPTION value="无" selected>-无-</OPTION>
                <OPTION value="私有" >-私有-</OPTION>
                <OPTION value="公共" >-公共-</OPTION>
              </select> </td>
            <td align="right"   class="crm_td"><font color="#FF0000">*</font>行业：</td>
            <td   class="crm_tdright"> 
              <select name=hangy size=1 id="hangy" class="crm_select">
                <OPTION value="" selected>-请选择行业-</OPTION>
                <OPTION value="中小企业" >-中小企业-</OPTION>
                <OPTION value="大企业" >-大企业-</OPTION>
                <OPTION value="应用服务提供商" >-应用服务提供商-</OPTION>
                <OPTION value="数据电信OEM" >-数据电信OEM-</OPTION>
                <OPTION value="政府或军队" >-政府或军队-</OPTION>
                <OPTION value="软件提供商" >-软件提供商-</OPTION>
                <OPTION value="管理服务提供商" >-管理服务提供商-</OPTION>
                <OPTION value="服务提供商" >-服务提供商-</OPTION>
              </select> </td>
          </tr>
          <tr id=chinaaddress1> 
            <td   class="crm_td"><font color="#FF0000">*</font>所在地区：</td>
            <td   class="crm_input"><script language=javascript src='../lib07/area.js'></script> 
              <SELECT id=chinacomprovince 
      onchange=changeProvince(this,true) name=sheng class="crm_select">
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
              </SELECT> <SELECT id=chinacomcity onchange=changeAreaCodeByCity(this) name=chinacomcity class="crm_select">
                <OPTION value="" selected>请选择城市</OPTION>
              </SELECT> </td>
            <td align="right"   class="crm_td"><font color="#FF0000">*</font>员工人数：</td>
            <td   class="crm_input"><SELECT 
      name=yuangrs size=1 id="yuangrs" class="crm_select">
                <OPTION value="" selected>-请选择员工人数-</OPTION>
                <OPTION 
        value=5>&lt; 5</OPTION>
                <OPTION value=50>5 -- 50</OPTION>
                <OPTION 
        value=200>51 -- 200</OPTION>
                <OPTION value=500>201 -- 500</OPTION>
                <OPTION 
        value=1000>501 -- 1000</OPTION>
                <OPTION 
        value=2000>1001 -- 2000</OPTION>
                <OPTION value=2001>&gt; 2000</OPTION>
              </SELECT> </td>
          </tr>
          <tr> 
            <td   class="crm_td"><font color="#FF0000">*</font>固定电话：</td>
            <td  id=areacodetd class="crm_input"><TABLE class=stepIn cellSpacing=0 cellPadding=0 border=0>
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
            <td align="right"   class="crm_td">客户网址：</td>
            <td   class="crm_tdright"><input name="web" type="text"  id="web" size="30" maxlength="80"></td>
          </tr>
          <tr> 
            <td   class="crm_td">传真：</td>
            <td   class="crm_input"><TABLE class=stepIn cellSpacing=0 cellPadding=0 border=0>
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
            <td align="right"   class="crm_td"><font color="#FF0000">*</font>年营业额：</td>
            <td   class="crm_tdright"><SELECT 
      name=yye size=1 id="yye" class="crm_select">
                <OPTION value="" selected>-请选择年营业额-</OPTION>
                <OPTION 
        value=1>少于1百万</OPTION>
                <OPTION 
        value=2>1百万 -- 5百万</OPTION>
                <OPTION 
        value=3>5百万 -- 1千万</OPTION>
                <OPTION value=4>1千万 -- 3千万</OPTION>
                <OPTION 
        value=5>3千万 -- 5千万</OPTION>
                <OPTION value=6>5千万 -- 1个亿</OPTION>
                <OPTION 
        value=7>1个亿 -- 5个亿</OPTION>
                <OPTION value=8>5个亿 -- 10个亿</OPTION>
                <OPTION 
        value=9>10个亿 -- 50个亿</OPTION>
                <OPTION 
        value=10>100个亿以上</OPTION>
              </SELECT>
              (元/人民币) </td>
          </tr>
          <tr> 
            <td   class="crm_td"><font color="#FF0000">*</font>客户详细地址：</td>
            <td   class="crm_input"><input name="address" type="text" id="address" size="35" maxlength="40" ></td>
            <td align="right"   class="crm_td">邮编：</td>
            <td   class="crm_tdright"><input name="postcode"  type="text"  id="postcode" size="10"  maxlength="10"></td>
          </tr>
          <tr> 
            <td   class="crm_td">备注：</td>
            <td colspan="3"   class="crm_input"><textarea name="beiz" cols="85" rows="5"  id="beiz" onkeyUp="textLimitCheck(this, 500);"></textarea>
              最多500汉字； </td>
          </tr>
          <tr align="center"> 
            <td colspan="5"   class="crm_submit"> 
              <input type="submit" name="Submit" class="submit" value="-确定新建-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
            </td>
          </tr>
        </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、为保证客户信息有效管理，请尽量详细填写 <font color="#FF0000">*</font>为必须填写。<br>
      2、做为销售人员，您也应该尽可能详细的了解企业的信息。</td>
  </tr>
</table>