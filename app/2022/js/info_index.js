/**
* 文件名称：info_index.js
* 功能描述：英才网首页的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/

var array_occupation = new Array(

    ["1000", "计算机硬件"],
    ["1001", "计算机软件"],
    ["1002", "互联网开发及应用"],
    ["1003", "IT_管理"],
    ["1004", "IT-品管/技术支持"],
    ["1005", "通信技术"],
    ["1006", "电子/电器/半导体/仪器仪表"],
    ["1007", "销售管理"],
    ["1008", "销售人员"],
    ["1009", "服务/技术支持"],
    ["1010", "财务/审计/税务"],
    ["1011", "证劵/金融/投资"],
    ["1012", "银行"],
    ["1013", "保险"],
    ["1014", "生产/运营"],
    ["1015", "工程/机械/能源"],
    ["1016", "汽车"],
    ["1017", "技工"],
    ["1018", "医院/医疗/护士"],
    ["1019", "广告"],
    ["1020", "公关/媒介"],
    ["1021", "市场营销"],
    ["1022", "媒体/影视"],
    ["1023", "艺术/设计"],
    ["1024", "建筑工程"],
    ["1025", "房地产"],
    ["1026", "物流管理"],
    ["1027", "人力资源"],
    ["1028", "高级管理"],
    ["1029", "行政后勤"],
    ["1030", "律师/法务"],
    ["1031", "教师"],
    ["1032", "餐饮/娱乐/旅游"],
    ["1033", "百货/连锁/零售服务"],
    ["1034", "交通运输服务"],
    ["1035", "保安/家政/其他服务"]

    );

var array_job = new Array(
    ["2000", "1000", "全部计算机硬件"],
    ["2001", "1000", "高级硬件工程师"],
    ["2002", "1000", "硬件工程师"],
    ["2003", "1000", "其他"],

    ["2004", "1001", "全部计算机软件"],
    ["2005", "1001", "高级软件工程师"],
    ["2006", "1001", "软件工程师"],
    ["2007", "1001", "需求工程师"],
    ["2008", "1001", "仿真应用工程师"],
    ["2009", "1001", "软件UI设计师/工程师"],
    ["2010", "1001", "系统集成工程师"],
    ["2011", "1001", "系统分析员"],
    ["2012", "1001", "系统构架设计师"],
    ["2013", "1001", "数据库工程师/管理员"],
    ["2014", "1001", "ERP实施工程师"],
    ["2015", "1001", "其他"],

    ["2016", "1002", "全部互联网开发及应用"],
    ["2017", "1002", "互联网开发及应用工程师"],
    ["2018", "1002", "多媒体/游戏开发工程师"],
    ["2019", "1002", "网络工程师"],
    ["2020", "1002", "网络维护工程师"],
    ["2021", "1002", "ＵＩ设计师/工程师"],
    ["2022", "1002", "网站构架师"],
    ["2023", "1002", "网站策划师"],
    ["2024", "1002", "网页设计/美工"],
    ["2025", "1002", "网络信息安全师"],
    ["2026", "1002", "系统管理员"],
    ["2027", "1002", "其他"],

    ["2028", "1003", "全部IT_管理"],
    ["2029", "1003", "技术总监/经理"],
    ["2030", "1003", "信息技术经理/主管"],
    ["2031", "1003", "项目总监"],
    ["2032", "1003", "项目经理"],
    ["2033", "1003", "项目主管"],
    ["2034", "1003", "其他"],

    ["2035", "1004", "IT-品管/技术支持"],
    ["2036", "1004", "技术支持/维护工程师"],
    ["2037", "1004", "品质经理"],
    ["2038", "1004", "系统测试"],
    ["2039", "1004", "软件测试"],
    ["2040", "1004", "文档工程师"],
    ["2041", "1004", "技术员协助"],
    ["2042", "1004", "其他"],

    ["2043", "1005", "全部通信技术"],
    ["2044", "1005", "通信技术工程师"],
    ["2045", "1005", "数据通信工程师"],
    ["2046", "1005", "其他"],

    ["2047", "1006", "全部电子/电器/半导体/仪器仪表"],
    ["2048", "1006", "电子工程师/技术员"],
    ["2049", "1006", "电子/电器维修工程师/技师"],
    ["2050", "1006", "电气工程师/技术员"],
    ["2051", "1006", "电声/音响工程师/技术员"],
    ["2052", "1006", "微光/光电技术"],
    ["2053", "1006", "半导体技术"],
    ["2054", "1006", "电子软件开发"],
    ["2055", "1006", "工艺工程师"],
    ["2056", "1006", "其他"],

    ["2057", "1007", "全部销售管理"],
    ["2058", "1007", "销售总监"],
    ["2059", "1007", "销售经理"],
    ["2060", "1007", "销售主管"],
    ["2061", "1007", "业务主管/经理"],
    ["2062", "1007", "大客户经理"],
    ["2063", "1007", "区域销售主管/经理"],
    ["2064", "1007", "其他"],

    ["2065", "1008", "全部销售人员"],
    ["2066", "1008", "销售代表"],
    ["2067", "1008", "客户代表"],
    ["2068", "1008", "销售工程师"],
    ["2069", "1008", "其他"],

    ["2070", "1009", "全部服务/技术支持"],
    ["2071", "1009", "服务总监"],
    ["2072", "1009", "服务经理"],
    ["2073", "1009", "售前/售后技术支持工程师"],
    ["2074", "1009", "咨询热线/呼叫中心服务人员"],
    ["2075", "1009", "其他"],

    ["2076", "1010", "全部财务/审计/税务"],
    ["2077", "1010", "财务经理/主管"],
    ["2078", "1010", "会计"],
    ["2079", "1010", "出纳员"],
    ["2080", "1010", "财务/会计协理"],
    ["2081", "1010", "会计文员"],
    ["2082", "1010", "财务分析经理/主管"],
    ["2083", "1010", "财务分析员"],
    ["2084", "1010", "审计经理/主管"],
    ["2085", "1010", "审计员/协理"],
    ["2086", "1010", "税务经理/主管"],
    ["2087", "1010", "税务员/协理"],
    ["2088", "1010", "统计员"],
    ["2089", "1010", "其他"],

    ["2090", "1011", "全部证劵/金融/投资"],
    ["2091", "1011", "证劵/期货/外汇经纪人"],
    ["2092", "1011", "证劵分析师"],
    ["2093", "1011", "股票/期货操盘手"],
    ["2094", "1011", "投资/理财顾问"],
    ["2095", "1011", "融资经理/主管"],
    ["2096", "1011", "融资员"],
    ["2097", "1011", "其他"],

    ["2098", "1012", "行长/副行长"],
    ["2099", "1012", "个人业务经理/主管"],
    ["2100", "1012", "公司业务经理/主管"],
    ["2101", "1012", "综合业务经理/主管"],
    ["2102", "1012", "综合业务专员"],
    ["2103", "1012", "信贷管理"],
    ["2104", "1012", "风险控制"],
    ["2105", "1012", "进出口/信用证结算"],
    ["2106", "1012", "外汇交易"],
    ["2107", "1012", "清算人员"],
    ["2108", "1012", "客户经理/主管/专员"],
    ["2109", "1012", "业务大堂经理"],
    ["2110", "1012", "银行柜员"],
    ["2111", "1012", "其他"],

    ["2112", "1013", "保险业务经理"],
    ["2113", "1013", "保险代理/经纪人/客户经理"],
    ["2114", "1013", "保险培训师"],
    ["2115", "1013", "保险业务员"],
    ["2116", "1013", "其他"],

    ["2117", "1014", "厂长/厂长经理/副厂长"],
    ["2118", "1014", "总工程师/副总工程师"],
    ["2119", "1014", "项目总监"],
    ["2120", "1014", "项目工程师"],
    ["2121", "1014", "项目经理/主管"],
    ["2122", "1014", "运营经理/主管"],
    ["2123", "1014", "生产总监"],
    ["2124", "1014", "生产经理/车间主任"],
    ["2125", "1014", "生产主管/督导/领班/组长"],
    ["2126", "1014", "生产文员"],
    ["2127", "1014", "安检/品检员"],
    ["2128", "1014", "其他"],

    ["2129", "1015", "技术研发经理/主管"],
    ["2130", "1015", "技术研发员"],
    ["2131", "1015", "产品规划工程师"],
    ["2132", "1015", "实验室负责人/工程师"],
    ["2133", "1015", "工程/设备经理/主管"],
    ["2134", "1015", "工程/设备工程师"],
    ["2135", "1015", "机械工程师/技师"],
    ["2136", "1015", "机电工程师/技师"],
    ["2137", "1015", "工业工程师/技师"],
    ["2138", "1015", "结构工程师/技师"],
    ["2139", "1015", "模具工程师/技师"],
    ["2140", "1015", "维修工程师/技师"],
    ["2141", "1015", "工程/机械制图员"],
    ["2142", "1015", "铸造/锻造工程师/技师"],
    ["2143", "1015", "装配工程师/技师"],
    ["2144", "1015", "焊接工程师/技师"],
    ["2145", "1015", "冲压工程师/技师"],
    ["2146", "1015", "锅炉工程师/技师"],
    ["2147", "1015", "船舶工程师/技师"],
    ["2148", "1015", "轨道工程师/技术员"],
    ["2149", "1015", "飞行器设计/制造工程师"],
    ["2150", "1015", "水利/水电工程师"],
    ["2151", "1015", "石油/天然气技术员"],
    ["2152", "1015", "矿产勘探/地质勘测工程师"],
    ["2153", "1015", "其他"],

    ["2154", "1016", "汽车设计/制造工程师"],
    ["2155", "1016", "汽车配置装配工程师"],
    ["2156", "1016", "汽车修理员"],
    ["2157", "1016", "汽车销售员"],
    ["2158", "1016", "其他"],

    ["2159", "1017", "技工"],
    ["2160", "1017", "钳工/机械工/钣金工"],
    ["2161", "1017", "电焊工"],
    ["2162", "1017", "车工/磨工/冲压工/切割机工/叉车工"],
    ["2163", "1017", "模具工/电工/水工/木工/漆工"],
    ["2164", "1017", "修理工/普工"],
    ["2165", "1017", "其他"],

    ["2166", "1018", "院长/副院长"],
    ["2167", "1018", "医院管理人员"],
    ["2168", "1018", "内科医生"],
    ["2169", "1018", "外科医生"],
    ["2170", "1018", "牙科医生"],
    ["2171", "1018", "儿科医生"],
    ["2172", "1018", "针灸/推拿"],
    ["2173", "1018", "美容师"],
    ["2174", "1018", "营养师"],
    ["2175", "1018", "护士长/主任"],
    ["2176", "1018", "护士/医护人员"],
    ["2177", "1018", "验光师"],
    ["2178", "1018", "兽医"],
    ["2179", "1018", "其他"],

    ["2180", "1019", "广告客户经理"],
    ["2181", "1019", "广告设计员"],
    ["2182", "1019", "美术指导"],
    ["2183", "1019", "文案/策划"],
    ["2184", "1019", "其他"],

    ["2185", "1020", "公关经理"],
    ["2186", "1020", "公关专员"],
    ["2187", "1020", "媒介经理/主管"],
    ["2188", "1020", "媒介专员"],
    ["2189", "1020", "其他"],

    ["2190", "1021", "市场营销/开拓经理"],
    ["2191", "1021", "市场营销/开拓专员"],
    ["2192", "1021", "市场分析/调查人员"],
    ["2193", "1021", "企业主管/经理"],
    ["2194", "1021", "市场策划员"],
    ["2195", "1021", "促销专员"],
    ["2196", "1021", "导购"],
    ["2197", "1021", "其他"],

    ["2198", "1022", "影视策划/制片人"],
    ["2199", "1022", "导演/编者"],
    ["2200", "1022", "艺术/设计总监"],
    ["2201", "1022", "演员/支持人/模特"],
    ["2202", "1022", "摄影师"],
    ["2203", "1022", "音响师"],
    ["2204", "1022", "化妆师/造型师"],
    ["2205", "1022", "其他"],

    ["2206", "1023", "平面设计总监"],
    ["2207", "1023", "平面设计师"],
    ["2208", "1023", "多媒体设计师"],
    ["2209", "1023", "工业/产品设计"],
    ["2210", "1023", "包装设计"],
    ["2211", "1023", "家具设计"],
    ["2212", "1023", "其他"],

    ["2213", "1024", "建筑工程师"],
    ["2214", "1024", "结构/土建/土木工程师"],
    ["2215", "1024", "公路/桥梁/隧道/港口工程师"],
    ["2216", "1024", "安防工程师"],
    ["2217", "1024", "规划/设计"],
    ["2218", "1024", "园林/园艺/景观设计"],
    ["2219", "1024", "建筑制图"],
    ["2220", "1024", "工程造价师/预算专员"],
    ["2221", "1024", "工程监理"],
    ["2222", "1024", "安检员"],
    ["2223", "1024", "材料员"],
    ["2224", "1024", "施工员"],
    ["2225", "1024", "其他"],

    ["2226", "1025", "房地产开发/策划经理"],
    ["2227", "1025", "房地产项目招标员"],
    ["2228", "1025", "房地产开发/策划员"],
    ["2229", "1025", "房地产评估员"],
    ["2230", "1025", "房地产中介/交易"],
    ["2231", "1025", "房地产销售员"],
    ["2232", "1025", "其他"],

    ["2233", "1026", "高教物业顾问"],
    ["2234", "1026", "物业顾问"],
    ["2235", "1026", "物业经理/主管"],
    ["2236", "1026", "物业管理专员/助理"],
    ["2237", "1026", "物业设施管理人员"],
    ["2238", "1026", "物业维修人员"],
    ["2239", "1026", "其他"],

    ["2240", "1027", "人事经理/主管"],
    ["2241", "1027", "人事专员"],
    ["2242", "1027", "人事助理"],
    ["2243", "1027", "招聘经理/主管"],
    ["2244", "1027", "招聘专员"],
    ["2245", "1027", "招聘助理"],
    ["2246", "1027", "培训专员"],
    ["2247", "1027", "薪资福利专员/助理"],
    ["2248", "1027", "绩效考核专员/助理"],
    ["2249", "1027", "企业文化/员工关系/公会管理"],
    ["2250", "1027", "其他"],

    ["2251", "1028", "首席执行官CEO/总裁/总经理"],
    ["2252", "1028", "部门经理"],
    ["2253", "1028", "副经理/副经理"],
    ["2254", "1028", "合作人"],
    ["2255", "1028", "总裁助理/总经理助理"],
    ["2256", "1028", "其他"],

    ["2257", "1029", "行政总监"],
    ["2258", "1029", "行政经理/办公室主任/主管"],
    ["2259", "1029", "行政员/助理"],
    ["2260", "1029", "经理助理/秘书"],
    ["2261", "1029", "前台接待/总待/接待生"],
    ["2262", "1029", "后勤部长"],
    ["2263", "1029", "图书管理员"],
    ["2264", "1029", "电脑操作员/打字员"],
    ["2265", "1029", "其他"],

    ["2266", "1030", "律师/法律顾问"],
    ["2267", "1030", "律师助理"],
    ["2268", "1030", "法务专员/主管"],
    ["2269", "1030", "法务助理"],
    ["2270", "1030", "其他"],

    ["2271", "1031", "校长"],
    ["2272", "1031", "讲师/助教"],
    ["2273", "1031", "家教"],
    ["2274", "1031", "技师"],
    ["2275", "1031", "院校教务管理人员"],
    ["2276", "1031", "其他"],

    ["2277", "1032", "餐饮/娱乐领班/部长"],
    ["2278", "1032", "餐饮/娱乐服务员"],
    ["2279", "1032", "川菜主管/传菜员"],
    ["2280", "1032", "礼仪/迎宾"],
    ["2281", "1032", "司仪"],
    ["2282", "1032", "厨师/面点师"],
    ["2283", "1032", "调酒师/吧台员"],
    ["2284", "1032", "茶艺师"],
    ["2285", "1032", "酒店/宾馆经理"],
    ["2286", "1032", "宴会管理员"],
    ["2287", "1032", "大堂经理"],
    ["2288", "1032", "行李员"],
    ["2289", "1032", "其他"],

    ["2290", "1033", "店长/楼面经理/卖场经理"],
    ["2291", "1033", "店员/营业员"],
    ["2292", "1033", "安防主管"],
    ["2293", "1033", "防损员"],
    ["2294", "1033", "收银员/主管"],
    ["2295", "1033", "理货员/收货员/陈列员"],
    ["2296", "1033", "导购员"],
    ["2297", "1033", "兼职店员"],
    ["2298", "1033", "其他"],

    ["2299", "1034", "机长"],
    ["2300", "1034", "空乘人员"],
    ["2301", "1034", "地勤人员"],
    ["2302", "1034", "列车长"],
    ["2303", "1034", "列车司机"],
    ["2304", "1034", "船员/船长"],
    ["2305", "1034", "其他"],

    ["2306", "1035", "保安"],
    ["2307", "1035", "话务员"],
    ["2308", "1035", "搬运工"],
    ["2309", "1035", "清洁工"],
    ["2310", "1035", "家政服务/保姆"],
    ["2311", "1035", "其他"]

    );

//省
var array_province = new Array(
    ["1000", "北京市"],
    ["1001", "天津市"],
    ["1002", "上海市"],
    ["1003", "重庆市"],
    ["1004", "河南省"],
    ["1005", "山西省"],
    ["1006", "内蒙古"],
    ["1007", "辽宁省"],
    ["1008", "吉林省"],
    ["1009", "黑龙江省"],
    ["1010", "江苏省"],
    ["1011", "浙江省"],
    ["1012", "安徽省"],
    ["1013", "福建省"],
    ["1014", "江西省"],
    ["1015", "山东省"],
    ["1016", "广东省"],
    ["1017", "广西省"],
    ["1018", "海南省"],
    ["1019", "河南省"],
    ["1020", "湖北省"],
    ["1021", "湖南省"],
    ["1022", "陕西省"],
    ["1023", "甘肃省"],
    ["1024", "青海省"],
    ["1025", "宁夏省"],
    ["1026", "新疆省"],
    ["1027", "四川省"],
    ["1028", "贵州省"],
    ["1029", "云南省"],
    ["1030", "西藏省"],
    ["1031", "台湾"],
    ["1032", "香港"],
    ["1033", "澳门"]

    );
    
//$(document).ready(function(){
//
//    });

function m_load() {
    m_info_occupation_plug();
    m_info_province_plug();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_login').click(function(){

        var username = i_obj_val('d_username');
        var password = i_obj_val('d_password');

        m.arr = new Object();
        m.arr['loginid'] = username;
        m.arr['loginpw'] = password;

        var rbn_type = i_obj_val('rbn_type');
        if('com' == rbn_type){
            m_com_login();
        } else if('person' == rbn_type) {
            m_person_login();
        } else {
            alert('操作错误，正在关闭！');
            i_mdi_close();
        }

    });

        $('#a_info_register').click(function(){

        var rbn_type = i_obj_val('rbn_type');
        if('com' == rbn_type){
            i_mdi_open('../../2020/htm/info_com_register.htm?a=add');
        } else if('person' == rbn_type) {
            i_mdi_open('../../2021/htm/info_person_register.htm?a=add');
        } else {
            alert('操作错误，正在关闭！');
            i_mdi_close();
        }

    });

    $('#btn_search').click(function(){
        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }

        var big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }
        var small_classification = i_obj_val('d_small_classification');
        if('' == small_classification){
            small_classification = '0';
        }
        var addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }
        
        var job_day = i_obj_val('d_job_day');
        if('' == job_day){
            job_day = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('../../2021/htm/list_search.htm?a=list&jobtype=' + big_classification +',' + small_classification + '&workplace=' + addr1 +',0&publishdate=' + job_day + '&key=' + key);
        }
    });



    
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//    return true;
//}

function m_person_login(){
    $.ajax({
        url : i_act + 'a=info_plogin',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
            switch (txt) {
                case 'err_u_null' :
                    alert('用户名不能为空，请填写！');
                    break;
                case 'err_pwd_null' :
                    alert('密码不能为空，请填写！');
                    break;
                case 'err_pwd_no' :
                    alert('密码不正确，请重新填写！');
                    break;
                case 'err_u_nexist' :
                    alert('用户不存在，请注册！');
                    break;
                //                case '6' :
                //                    alert('对不起，该用户已登录！');
                //                    break;
                case 'err_session_inval' :
                    alert('session失效，请检查！');
                    break;
                case 'err_longin' :
                    i_mdi_open('../../2021/htm/info_person_usercenter.htm?a=ucenter', '个人中心', 1);
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}

function m_com_login(){
    if('' ==   m.arr['loginid']){
        alert('用户名不能为空，请填写！');
    }

    $.ajax({
        url : i_act + 'a=info_clogin',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
            m.info = i_json2js(txt);
            if('' == m.info || 'undefined' == m.info){
                alert('用户：' + m.arr['loginid'] + '不存在！');
            } else {
                if(m.arr['loginid'] != m.info['loginid']){
                    alert('用户：' + m.arr['loginid'] + '不存在！');
                } else {
                    if(i_obj_val('d_password') != m.info['loginpw']){
                        alert('用户密码不正确！');
                    } else {
                        if(i_obj_val('d_password') == m.info['loginpw'] && '' !=  m.info['loginpw'] && i_obj_val('d_username') == m.info['loginid'] && '' !=  m.info['loginid']){
                            i_mdi_open('../../2020/htm/info_com_usercenter.htm?a=ucenter', '企业中心', 1);
                        }
                    }
                }
            }
        }
    });

}

function m_info_occupation_plug(){
    $('#d_big_classification').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="0" selected="selected">职能不限</option>';
    for(var i=0 ; i<array_occupation.length; i++) {
        option_txt += '<option value="'+ array_occupation[i]['0'] +'">'+ array_occupation[i]['1'] + '</option>';
    }
    $('#d_big_classification').append(option_txt);

    $('#d_big_classification').change( function() {
          m.tmp  = $('#d_big_classification').val();
          m_info_job_plug();
//         var checkText=$('#d_big_classification').find("option:selected").text();
    });
}

function m_info_job_plug(){
    $('#d_small_classification').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="0" selected="selected">职位不限</option>';
    for(var i=0 ; i<array_job.length; i++) {
        if(m.tmp == array_job[i]['1']){
            option_txt += '<option value="'+ array_job[i]['0'] +'">'+ array_job[i]['2'] + '</option>';
        }
    }
    $('#d_small_classification').append(option_txt);
}


function m_info_province_plug(){
    $('#d_addr1').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="0" selected="selected">地区不限</option>';
    for(var i=0 ; i<array_province.length; i++) {
        option_txt += '<option value="'+ array_province[i]['0'] +'">'+ array_province[i]['1'] + '</option>';
    }
    $('#d_addr1').append(option_txt);
}
////获取session中的id
//function m_get_session(){
//    var rbn_type = i_obj_val('rbn_type');
//    $.ajax({
//        url : i_act + 'a=info_session&type=' + rbn_type,
//        success : function(txt){
//            m.xid = txt;
//        }
//    });
//}

function asecBoard(n)
{
    for(i=1;i<n;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}


