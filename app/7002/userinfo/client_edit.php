<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
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
   	 <?require_once('crm_left.php');?>    	

    	
    </td>
    <td width="8" id="switchPoint" title="开启关闭左侧导航栏" class="class_bar"   onClick="switchSysBar()"><img src=../myimages/1/toggler_2.gif></td>
    <td align="center" valign="top"  class="class_right">
 



    </td>
  </tr>
</table>

</body>
</html> 
<script language="JavaScript1.1" type="text/JavaScript">
function province(countryName,provinceId,provinceName)
{
	this.countryName = countryName;
	this.provinceId = provinceId;
	this.provinceName = provinceName;
	this.firstClassCityArr = new Array();
	this.addFirstClassCity = addFirstClassCity;
	this.getFirstClassCitis = getFirstClassCitis;
}

function addFirstClassCity(city)
{
	this.firstClassCityArr = this.firstClassCityArr.concat(city);
}

function getFirstClassCitis()
{
	var tmp = new Array();
	for(var i = 0;i < this.firstClassCityArr.length;i++)
	{
		var b = this.firstClassCityArr[i];
		tmp[i] = b;
	}
	return tmp;
}


function firstClassCity(provinceName,cityId,cityName,cityCode) 
{
	this.provinceName = provinceName;
	this.cityId = cityId;
	this.cityName = cityName;
	this.cityCode=cityCode;
	this.secendClassCityArr = new Array();
	this.addSecendClassCity = addSecendClassCity;
	this.getSecendClassCitis = getSecendClassCitis;
}

function addSecendClassCity(cityId,cityName) 
{
	this.secendClassCityArr = this.secendClassCityArr.concat(new Option(cityName,cityId));
}
	
	
function getSecendClassCitis() 
{
	var tmp = new Array();
	for(var i=0; i < this.secendClassCityArr.length;i++) 
	{
		var b = this.secendClassCityArr[i];
		tmp[i]= b;
	}
	return tmp;
}
						

var provincesListArr=new  Array();
var cityListArr=new Array();
var p1;
var city;

			p1=new province("CN","Beijing","北京市");

					city=new firstClassCity("北京市","Beijing_Beijing","北京市","010");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Tianjin","天津市");

					city=new firstClassCity("天津市","Tianjin_Tianjin","天津市","022");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Hebei","河北省");

					city=new firstClassCity("河北省","Hebei_Shijiazhuang","石家庄市","0311");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Baoding","保定市","0312");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Tangshan","唐山市","0315");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Cangzhou","沧州市","0317");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Qinhuangdao","秦皇岛市","0335");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Xingtai","邢台市","0319");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Handan","邯郸市","0310");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Zhangjiakou","张家口市","0313");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Chengde","承德市","0314");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Langfang","廊坊市","0316");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河北省","Hebei_Hengshui","衡水市","0318");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Shanxi","山西省");

					city=new firstClassCity("山西省","Shanxi_Taiyuan","太原市","0351");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Datong","大同市","0352");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Yangquan","阳泉市","0353");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Changzhi","长治市","0355");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Jincheng","晋城市","0356");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Shuozhou","朔州市","0349");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Jinzhong","晋中市","0354");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Yuncheng","运城市","0359");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Xinzhou","忻州市　","0350");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Linfen","临汾市","0357");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山西省","Shanxi_Lvliang","吕梁市","0358");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","InnerMongolia","内蒙古自治区");

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Hohhot","呼和浩特市","0471");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Baotou","包头市","0472");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Wuhai","乌海市","0473");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Chifeng","赤峰市","0476");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Tongliao","通辽市","0475");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Erdos","鄂尔多斯市","0477");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_HulunBuir","呼伦贝尔市","0470");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Baynnur","巴彦淖尔市","0478");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_UlaanChab","乌兰察布市","0474");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Xilingol","锡林郭勒盟","0479");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Xingan","兴安盟","0482");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("内蒙古自治区","InnerMongolia_Alxa","阿拉善盟","0483");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Liaoning","辽宁省");

					city=new firstClassCity("辽宁省","Liaoning_Shenyang","沈阳市","024");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Dalian","大连市","0411");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Anshan","鞍山市","0412");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);


					city=new firstClassCity("辽宁省","Liaoning_Fushun","抚顺市","0413");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Benxi","本溪市","0414");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Dandong","丹东市","0415");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Jinzhou","锦州市","0416");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Yingkou","营口市","0417");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Fuxin","阜新市","0418");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Liaoyang","辽阳市","0419");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Panjin","盘锦市","0427");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Tieling","铁岭市","0410");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Chaoyang","朝阳市","0421");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("辽宁省","Liaoning_Huludao","葫芦岛市","0429");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Jilin","吉林省");

					city=new firstClassCity("吉林省","Jilin_Changchun","长春市","0431");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Jilin","吉林市","0432");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Siping","四平市","0434");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Liaoyuan","辽源市","0437");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Tonghua","通化市","0435");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Baishan","白山市","0439");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Songyuan","松原市","0438");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Baicheng","白城市","0436");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("吉林省","Jilin_Yanbian","延边朝鲜族自治州","0433");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Heilongjiang","黑龙江省");

					city=new firstClassCity("黑龙江省","Heilongjiang_Harbin","哈尔滨市","0451");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Qiqihar","齐齐哈尔市","0452");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Hegang","鹤岗市","0468");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Shuangyashan","双鸭山市","0469");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Jixi","鸡西市","0467");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Daqing","大庆市","0459");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Yichun","伊春市","0458");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Mudanjiang","牡丹江市","0453");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Jiamusi","佳木斯市","0454");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Qitaihe","七台河市","0464");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Heihe","黑河市","0456");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Suihua","绥化市","0455");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("黑龙江省","Heilongjiang_Daxinganling","大兴安岭地区","0457");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Shanghai","上海市");

					city=new firstClassCity("上海市","Shanghai_Shanghai","上海市","021");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Jiangsu","江苏省");

					city=new firstClassCity("江苏省","Jiangsu_Nanjing","南京市","025");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Wuxi","无锡市","0510");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Xuzhou","徐州市","0516");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Suzhou","苏州市","0512");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Changzhou","常州市","0519");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Yangzhou","扬州市","0514");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Taizhou","泰州市","0523");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Zhenjiang","镇江市","0511");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Lianyungang","连云港市","0518");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Huaian","淮安市","0517");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Yancheng","盐城市","0515");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Suqian","宿迁市","0527");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江苏省","Jiangsu_Nantong","南通市","0513");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Zhejiang","浙江省");

					city=new firstClassCity("浙江省","Zhejiang_Hangzhou","杭州市","0571");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Ningbo","宁波市","0574");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Wenzhou","温州市","0577");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Jiaxing","嘉兴市","0573");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Shaoxing","绍兴市","0575");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Huzhou","湖州市","0572");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Jinhua","金华市","0579");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Quzhou","衢州市","0570");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Taizhou","台州市","0576");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Zhoushan","舟山市","0580");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("浙江省","Zhejiang_Lishui","丽水市","0578");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Anhui","安徽省");

					city=new firstClassCity("安徽省","Anhui_Hefei","合肥市","0551");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Wuhu","芜湖市","0553");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Bengbu","蚌埠市","0552");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Huainan","淮南市","0554");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Maanshan","马鞍山市","0555");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Huaibei","淮北市","0561");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Tongling","铜陵市","0562");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Anqing","安庆市","0556");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Huangshan","黄山市","0559");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Chuzhou","滁州市","0550");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Fuyang","阜阳市","0558");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Suzhou","宿州市","0557");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Chaohu","巢湖市","0565");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Liuan","六安市","0564");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Bozhou","亳州市","0558");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Chizhou","池州市","0566");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("安徽省","Anhui_Xuancheng","宣城市","0563");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Fujian","福建省");

					city=new firstClassCity("福建省","Fujian_Fuzhou","福州市","0591");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Xiamen","厦门市","0592");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Putian","莆田市","0594");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Sanming","三明市","0598");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Quanzhou","泉州市","0595");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Zhangzhou","漳州市","0596");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Nanping","南平市","0599");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Longyan","龙岩市","0597");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("福建省","Fujian_Ningde","宁德市","0593");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Jiangxi","江西省");

					city=new firstClassCity("江西省","Jiangxi_Nanchang","南昌市","0791");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Jingdezhen","景德镇市","0798");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Pingxiang","萍乡市","0799");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Jiujiang","九江市","0792");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Xinyu","新余市","0790");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Yingtan","鹰潭市","0701");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Ganzhou","赣州市","0797");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Jian","吉安市","0796");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Yichun","宜春市","0795");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Fuzhou","抚州市","0794");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("江西省","Jiangxi_Shangrao","上饶市","0793");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Shandong","山东省");

					city=new firstClassCity("山东省","Shandong_Jinan","济南市","0531");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Qingdao","青岛市","0532");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Dezhou","德州市","0534");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Zibo","淄博市","0533");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Weifang","潍坊市","0536");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Yantai","烟台市","0535");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Weihai","威海市","0631");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Jining","济宁市","0537");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Zaozhuang","枣庄市","0632");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Dongying","东营市","0546");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Taian","泰安市","0538");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Rizhao","日照市","0633");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Laiwu","莱芜市","0634");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Linyi","临沂市","0539");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Liaocheng","聊城市","0635");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Binzhou","滨州市","0543");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("山东省","Shandong_Heze","菏泽市","0530");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Henan","河南省");

					city=new firstClassCity("河南省","Henan_Zhengzhou","郑州市","0371");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Kaifeng","开封市","0378");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Luoyang","洛阳市","0379");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Pingdingshan","平顶山市","0375");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Anyang","安阳市","0372");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Hebi","鹤壁市","0392");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Xinxiang","新乡市","0373");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Jiaozuo","焦作市","0391");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Puyang","濮阳市","0393");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Xuchang","许昌市","0374");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Luohe","漯河市","0395");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Sanmenxia","三门峡市","0398");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Nanyang","南阳市","0377");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Shangqiu","商丘市","0370");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Xinyang","信阳市","0376");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Zhoukou","周口市","0394");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Zhumadian","驻马店市","0396");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("河南省","Henan_Jiyuan","济源市","0391");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Hubei","湖北省");

					city=new firstClassCity("湖北省","Hubei_Wuhan","武汉市","027");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Huangshi","黄石市","0714");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Shiyan","十堰市","0719");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Jingzhou","荆州市","0716");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Yichang","宜昌市","0717");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Xiangfan","襄樊市","0710");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Ezhou","鄂州市","0711");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Jingmen","荆门市","0727");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Xiaogan","孝感市","0712");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Huanggang","黄冈市","0713");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Suizhou","随州市","0722");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Xianning","咸宁市","0715");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Enshi","恩施土家族苗族自治州","0718");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Xiantao","仙桃市","0728");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Tianmen","天门市","0728");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Qianjiang","潜江市","0728");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖北省","Hubei_Shennongjia","神农架林区","0719");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Hunan","湖南省");

					city=new firstClassCity("湖南省","Hunan_Changsha","长沙市","0731");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Zhuzhou","株洲市","0733");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Xiangtan","湘潭市","0732");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Hengyang","衡阳市","0734");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Shaoyang","邵阳市","0739");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Yueyang","岳阳市","0730");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Changde","常德市","0736");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Zhangjiajie","张家界市","0744");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Yiyang","益阳市","0737");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Chenzhou","郴州市","0735");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Yongzhou","永州市","0746");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Huaihua","怀化市","0745");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Loudi","娄底市","0738");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("湖南省","Hunan_Xiangxi","湘西土家族苗族自治州","0743");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Guangdong","广东省");

					city=new firstClassCity("广东省","Guangdong_Guangzhou","广州市","020");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Shenzhen","深圳市","0755");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Zhuhai","珠海市","0756");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Shantou","汕头市","0754");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Shaoguan","韶关市","0751");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Foshan","佛山市","0757");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Zhanjiang","湛江市","0759");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Maoming","茂名市","0668");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Jiangmen","江门市","0750");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Zhaoqing","肇庆市","0758");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Huizhou","惠州市","0752");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Meizhou","梅州市","0753");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Shanwei","汕尾市","0660");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Heyuan","河源市","0762");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Yangjiang","阳江市","0662");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Qingyuan","清远市","0763");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Dongguan","东莞市","0769");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Zhongshan","中山市","0760");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Chaozhou","潮州市","0768");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Jieyang","揭阳市","0663");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广东省","Guangdong_Yunfu","云浮市","0766");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Guangxi","广西壮族自治区");

					city=new firstClassCity("广西壮族自治区","Guangxi_Nanning","南宁市","0771");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Liuzhou","柳州市","0772");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Guilin","桂林市","0773");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Wuzhou","梧州市","0774");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Beihai","北海市","0779");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Fangchenggang","防城港市","0770");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Qinzhou","钦州市","0777");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Guigang","贵港市","0775");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Yulin","玉林市","0775");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Baise","百色市","0776");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Hezhou","贺州市","0774");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Hechi","河池市","0778");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Laibin","来宾市","0772");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("广西壮族自治区","Guangxi_Chongzuo","崇左市","0771");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Hainan","海南省");

					city=new firstClassCity("海南省","Hainan_Haikou","海口市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Sanya","三亚市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Wuzhishan","五指山市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Qionghai","琼海市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Danzhou","儋州市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Wenchang","文昌市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Wanning","万宁市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Dongfang","东方市","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Chengmai","澄迈县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Dingan","定安县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Tunchang","屯昌县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Lingao","临高县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Baisha","白沙黎族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Changjiang","昌江黎族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Ledong","乐东黎族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Lingshui","陵水黎族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Baoting","保亭黎族苗族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("海南省","Hainan_Qiongzhong","琼中黎族苗族自治县","0898");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Chongqing","重庆市");

					city=new firstClassCity("重庆市","Chongqing_Chongqing","重庆市","023");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Sichuan","四川省");

					city=new firstClassCity("四川省","Sichuan_Chengdu","成都市","028");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Zigong","自贡市","0813");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Panzhihua","攀枝花市","0812");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Luzhou","泸州市","0830");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Deyang","德阳市","0838");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Mianyang","绵阳市","0816");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Guangyuan","广元市","0839");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Suining","遂宁市","0825");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Neijiang","内江市","0832");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Leshan","乐山市","0833");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);


					city=new firstClassCity("四川省","Sichuan_Nanchong","南充市","0817");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Meishan","眉山市","0833");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Yibin","宜宾市","0831");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Guangan","广安市","0826");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Dazhou","达州市","0818");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Yaan","雅安市","0835");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Bazhong","巴中市","0827");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Ziyang","资阳市","0832");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Aba","阿坝藏族羌族自治州","0837");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Ganzi","甘孜藏族自治州","0836");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("四川省","Sichuan_Liangshan","凉山彝族自治州","0834");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Guizhou","贵州省");

					city=new firstClassCity("贵州省","Guizhou_Guiyang","贵阳市","0851");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Liupanshui","六盘水市","0858");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Zunyi","遵义市","0852");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Anshun","安顺市","0853");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Tongren","铜仁地区","0856");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Bijie","毕节地区","0857");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Qianxinan","黔西南布依族苗族自治州","0859");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Qiandongnan","黔东南苗族侗族自治州","0855");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("贵州省","Guizhou_Qiannan","黔南布依族苗族自治州","0854");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Yunnan","云南省");

					city=new firstClassCity("云南省","Yunnan_Kunming","昆明市","0871");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Qujing","曲靖市","0874");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Yuxi","玉溪市","0877");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Baoshan","保山市","0875");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Zhaotong","昭通市","0870");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Lijiang","丽江市","0888");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Simao","思茅市","0879");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Lincang","临沧市","0883");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Wenshan","文山壮族苗族自治州","0876");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Honghe","红河哈尼族彝族自治州","0873");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Xishuangbanna","西双版纳傣族自治州","0691");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Chuxiong","楚雄彝族自治州","0878");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Dali","大理白族自治州","0872");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Dehong","德宏傣族景颇族自治州","0692");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Nujiang","怒江傈僳族自治州","0886");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("云南省","Yunnan_Diqing","迪庆藏族自治州","0887");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Tibet","西藏自治区");

					city=new firstClassCity("西藏自治区","Tibet_Lhasa","拉萨市","0891");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Nagqu","那曲地区","0896");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Chamdo","昌都地区","0895");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Shannan","山南地区","0893");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Xigaze","日喀则地区","0892");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Ngari","阿里地区","08073");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("西藏自治区","Tibet_Nyingchi","林芝地区","0894");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Shaanxi","陕西省");

					city=new firstClassCity("陕西省","Shaanxi_Xian","西安市","029");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Tongchuan","铜川市","0919");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Baoji","宝鸡市","0917");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Xianyang","咸阳市","0910");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Weinan","渭南市","0913");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Yanan","延安市","0911");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Hanzhong","汉中市","0916");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Yulin","榆林市","0912");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Ankang","安康市","0915");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("陕西省","Shaanxi_Shangluo","商洛市","0914");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Gansu","甘肃省");

					city=new firstClassCity("甘肃省","Gansu_Lanzhou","兰州市","0931");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Jinchang","金昌市","0935");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Baiyin","白银市","0943");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Tianshui","天水市","0938");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Jiayuguan","嘉峪关市","0937");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Wuwei","武威市","0935");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Zhangye","张掖市","0936");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Pingliang","平凉市","0933");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Jiuquan","酒泉市","0937");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Qingyang","庆阳市","0934");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Dingxi","定西市","0932");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Longnan","陇南市","0939");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Linxia","临夏回族自治州","0930");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("甘肃省","Gansu_Gannan","甘南藏族自治州","0941");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Qinghai","青海省");

					city=new firstClassCity("青海省","Qinghai_Xining","西宁市","0971");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Haidong","海东地区","0972");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Haibei","海北藏族自治州","0970");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Huangnan","黄南藏族自治州","0973");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Hainan","海南藏族自治州","0974");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Golog","果洛藏族自治州","0975");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Yushu","玉树藏族自治州","0976");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("青海省","Qinghai_Haixi","海西蒙古族藏族自治州","0977");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Ningxia","宁夏回族自治区");

					city=new firstClassCity("宁夏回族自治区","Ningxia_Yinchuan","银川市","0951");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("宁夏回族自治区","Ningxia_Shizuishan","石嘴山市","0952");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("宁夏回族自治区","Ningxia_Wuzhong","吴忠市","0953");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("宁夏回族自治区","Ningxia_Guyuan","固原市","0954");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("宁夏回族自治区","Ningxia_Zhongwei","中卫市","0955");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Xinjiang","新疆维吾尔自治区");

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Urumqi","乌鲁木齐市","0991");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Karamay","克拉玛依市","0990");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Turpan","吐鲁番地区","0995");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Hami","哈密地区","0902");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Hetian","和田地区","0903");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Aksu","阿克苏地区","0997");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Kashgar","喀什地区","0998");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_KizilsuKirgiz","克孜勒苏柯尔克孜自治州","0908");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Bayingolin","巴音郭楞蒙古自治州","0996");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Changji","昌吉回族自治州","0994");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Bortala","博尔塔拉蒙古自治州","0909");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Ili","伊犁哈萨克自治州","0999");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Tacheng","塔城地区","0901");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Altay","阿勒泰地区","0906");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Shihezi","石河子市","0993");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Alar","阿拉尔市","0997");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Tumushuke","图木舒克市","0998");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("新疆维吾尔自治区","Xinjiang_Wujiaqu","五家渠市","0994");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Hongkong","香港特别行政区");

					city=new firstClassCity("香港特别行政区","Hongkong_HongKong","香港特别行政区","852");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Macao","澳门特别行政区");

					city=new firstClassCity("澳门特别行政区","Macao_Macao","澳门特别行政区","853");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);

			p1=new province("CN","Taiwan","台湾省");

					city=new firstClassCity("台湾省","Taiwan_Taipeishi","台北市","02");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Kaohsiungshi","高雄市","07");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Keelung","基隆市","02");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Taichungshi","台中市","04");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Tainanshi","台南市","06");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Hsinchushi","新竹市","03");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Chiayishi","嘉义市","05");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Taipeixian","台北县","02");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Yilan","宜兰县","03");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Hsinchuxian","新竹县","03");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Taoyuan","桃园县","03");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Miaoli","苗栗县","037");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Taichungxian","台中县","04");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Changhua","彰化县","04");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Nantou","南投县","049");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Chiayixian","嘉义县","05");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Yunlin","云林县","05");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Tainanxian","台南县","06");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Kaohsiungxian","高雄县","07");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Pingtung","屏东县","08");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Taitung","台东县","089");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Hualien","花莲县","03");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

					city=new firstClassCity("台湾省","Taiwan_Kinmen","澎湖县","06");
					cityListArr=cityListArr.concat(city);
					p1.addFirstClassCity(city);

		provincesListArr = provincesListArr.concat(p1);


			
var selectedProvinceName;
var selectedCityName;
var selectProvinceId;
			
function changeProvince(province_p,flag)
{
    var city_p=document.getElementById('chinacomcity');
	var index = province_p.selectedIndex;
	var len2=city_p.options.length;
	for(var i = len2-1;i>0;i--)
	{
		city_p.options[i] = null;
	}
	if(index<=0)
	{
		selectedProvinceName="";
		selectedCityName="";
		city_p.options[0].selected=true;
	}
	else
	{
		var province = province_p.options[index].value;
		selectProvinceId = province;
		var len=provincesListArr.length;
		var provinceTemp;
		for(var i=0;i<len;i++)
		{
			provinceTemp=provincesListArr[i];
			if(selectProvinceId==provinceTemp.provinceId)
			{
				var len1=city_p.options.length;
				for(var i = len1-1;i>0;i--)
				{
					city_p.options[i] = null;
				}
				var firstClassCitis = provinceTemp.getFirstClassCitis();
				for(var i=0;i<firstClassCitis.length;i++)
				{
					city_p.options[i+1] = new Option(firstClassCitis[i].cityName,firstClassCitis[i].cityId);
				}
				break;
			}
		}
		city_p.options[1].selected=true;
		selectedProvinceName = province_p.options[index].text;
	}
	if(flag)
	{
		changeAreaCodeByCity(city_p);
	}
}
			
			
			
function changeAreaCodeByCity(city_p)
{
    var telcountrycode_p=document.getElementById("telcountrycode");
    var faxcountrycode_p=document.getElementById("faxcountrycode");
    var province_p=document.getElementById("chinacomprovince");
    var tel_p=document.getElementById("telareacode");
	var fax_p=document.getElementById("faxareacode");
	var areacodetd=document.getElementById("areacodetd");
	var areacodetd1=document.getElementById("areacodetd1");
	var areacodetd2=document.getElementById("areacodetd2");
	var index=city_p.selectedIndex;
	var value=city_p.options[index].value;
	var len=cityListArr.length;
	if(index<=0)
	{
		tel_p.value="";
		fax_p.value="";
	}
	else
	{
	    if((province_p.value=="Hongkong")||(province_p.value=="Macao"))
	    {
	     	
	    	areacodetd.style.display="none";
	    	areacodetd1.style.display="none";
	    	areacodetd2.style.display="none";
	        tel_p.style.display="none";
	        fax_p.style.display="none";
	        for(var i=0;i<len;i++)
			{
				var cityTemp=cityListArr[i];
				if(value==cityTemp.cityId)
				{
					var code=cityTemp.cityCode;
					if(code.indexOf("0")==0)
					{
						code=code.substring(0,code.length);
					}
				telcountrycode_p.value=code;
				faxcountrycode_p.value=code;
				break;
				}
			}
	    }
	    else
	    {
	        areacodetd.style.display="";
	        areacodetd1.style.display="";
	        areacodetd2.style.display="";
	        tel_p.style.display="";
	        fax_p.style.display="";
	        if(province_p.value=="Taiwan")
	        {
	        	telcountrycode_p.value="886";
	        	faxcountrycode_p.value="886";
	        }
	        else
	        {
	        	telcountrycode_p.value="86";
	        	faxcountrycode_p.value="86";
	        }
	        for(var i=0;i<len;i++)
			{
				var cityTemp=cityListArr[i];
				if(value==cityTemp.cityId)
				{
					var code=cityTemp.cityCode;
					if(code.indexOf("0")==0)
					{
						code=code.substring(0,code.length);
					}
				tel_p.value=code;
				fax_p.value=code;
				break;
				}
			}
	    }
		
	}
}

try
{
	var china_province_p=document.getElementById("chinacomprovince");
	if(china_province_p!=null)
	{
		changeProvince(china_province_p,false);
		var china_city_p=document.getElementById("chinacomcity");
		//alert (document.getElementById("chinacomcitys").value);
		china_city_p.value="<?=$rs->chinacomcity;?>";
		if(china_city_p.selectedIndex<1)
		{
			china_city_p.options[0].selected=true;
		}
		if((china_province_p.value=="Hongkong")||(china_province_p.value=="Macao"))
	    {
	    	document.getElementById("telareacode").style.display="none";
			document.getElementById("faxareacode").style.display="none";
			document.getElementById("areacodetd").style.display="none";
			document.getElementById("areacodetd1").style.display="none";
			document.getElementById("areacodetd2").style.display="none";
	    }
	}
}
catch(e)
{
}

</script>