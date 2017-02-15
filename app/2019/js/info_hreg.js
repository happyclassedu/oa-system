/**
 * 文件名称：info_hreg.js
 * 功能描述：户籍信息登记管理增加,修改，查看功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */
var ytype = '';

//$(document).ready(function(){
//
//    });

function m_load() {
    i_read_css('m_list', 0);
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    m.src_iframe = '';
    i_tr_css($('#list_tb tbody tr'));
    i_obj_hide('iframe');

//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_hjshift').click(function(){
        m.tmp = './info_hoh_hjshift.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_hjcard').click(function(){
        m.tmp = './info_hoh_hjcard.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_hjpro').click(function(){
        m.tmp = './info_hoh_hjpro.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_hypro').click(function(){
        m.tmp = './info_hoh_hypro.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_dspro').click(function(){
        m.tmp = './info_hoh_dspro.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

//    $('#btn_sypro').click(function(){
//        m.tmp = './info_hoh_sypro.htm?a=add&x=' + m.xid;
//        m_load_iframe_acturl();
//    });

    $('#btn_zspro').click(function(){
        m.tmp = './info_hoh_zspro.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

     $('#btn_jspro').click(function(){
        m.tmp = './info_hoh_jspro.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

     $('#btn_yldj').click(function(){
        m.tmp = './info_hoh_yldj.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

//     $('#btn_print_jspro').click(function(){
//        m.tmp = './info_hoh_print.htm?a=add&x=' + m.xid;
//        i_mdi_open(m.tmp, 1);
//    });

    $('#a_btn_excel').click(function(){
        m_list_down();
    });

    $('#btn_record').click(function(){
        ytype = i_js2json('档案管理');
        m_info_num();
    });

    $('#btn_hreg').click(function(){
        ytype = i_js2json('户籍管理');
        m_info_num();
    });

    $('#btn_agreement').click(function(){
        ytype = i_js2json('协议报到');
        m_info_num();
    });

    $('#btn_balance').click(function(){
        ytype = i_js2json('财务结算');
        m_info_num();
    });

    $('#btn_base').click(function(){
        ytype = i_js2json('基本业务');
        m_info_num();
    });

    $('#btn_all').click(function(){
        ytype = '';
        m_info_num();
    });

    $('#d_cardid').change(function(){
        m_checkCardID();
    });

    $('#d_birth').jdate({
//                    showButtonPanel: false,
//                    changeMonth: false,
//                    changeYear: false,
//                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_gradtime').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_getm_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_inbreed_birth_1').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_inbreed_birth_2').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_mobile').change(function(){
        m.tmp = i_obj_val('d_mobile');
        if (!m_checkMobilePhone(m.tmp) && '' != m.tmp) {
            alert('手机格式不正确，请重新输入！');
        }
    });

    $('#d_tel').change(function(){
         m.tmp = i_obj_val('d_tel');
        if (!m_checkTelephone(m.tmp) && '' != m.tmp) {
            alert('固定电话格式不正确，请重新输入！');
        }
    });

    $('#d_email').change(function(){
        m.tmp = i_obj_val('d_email');
        if (!m_checkEmail(m.tmp) && '' != m.tmp) {
            alert('邮箱格式不正确，请重新输入！');
        }
    });

    $('#d_qq').change(function(){
        m.tmp = i_obj_val('d_qq');
        if (!m_checkQQ(m.tmp) && '' != m.tmp) {
            alert('QQ的格式不正确，请重新输入！');
        }
    });

    $('#d_postid').change(function(){
        m.tmp = i_obj_val('d_postid');
        if (!m_checkPostCode(m.tmp) && '' != m.tmp) {
            alert('邮政编码格式不正确，请重新输入！');
        }
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_save').click();
        }
    });

}

function m_info_set_plug() {
    m_info_btn_setname();
}

function m_info_add_plug() {
    i_obj_disable('btn_hjshift');
    i_obj_disable('btn_hjcard');
    i_obj_disable('btn_hjpro');
    i_obj_disable('btn_hypro');
    i_obj_disable('btn_dspro');
    i_obj_disable('btn_sypro');
    i_obj_disable('btn_zspro');
    i_obj_disable('btn_jspro');
    i_obj_disable('btn_yldj');
    i_obj_disable('btn_print_jspro');
    i_obj_hide('hidden_v1');
    i_obj_hide('hidden_v2');
    i_obj_hide('hidden_v3');
    i_obj_hide('hidden_v4');
    i_obj_hide('hidden_v5');
    i_obj_hide('hidden_v6');
    i_obj_hide('hidden_v7');

    i_obj_hide('list_tb');

    //默认状态
    i_obj_set('d_hjstate', '在库');


    m_info_btn_setname();
}

function m_info_btn_setname(){
    //迁入/迁出户籍关系
    if('在库' == i_obj_val('d_hjstate') || '' == i_obj_val('d_hjstate')){
        i_obj_set('btn_hjshift', '迁出户籍关系');
    }else if('迁出' == i_obj_val('d_hjstate') || '借出' == i_obj_val('d_hjstate')){
        i_obj_set('btn_hjshift', '迁入户籍关系');
    }

    //借出/归还户籍卡
    if('在库' == i_obj_val('d_hjstate')){
        i_obj_set('btn_hjcard', '借出户籍卡');
    }else if('借出' == i_obj_val('d_hjstate') || '' == i_obj_val('d_hjstate')){
        i_obj_set('btn_hjcard', '归还户籍卡');
    } else if('迁出' == i_obj_val('d_hjstate')) {
        i_obj_hide('btn_hjcard');
    }
}

//function m_info_add_plug() {
//}

function m_info_edit_plug() {

    i_obj_disable('btn_hjshift');
    i_obj_disable('btn_hjcard');
    i_obj_disable('btn_hjpro');
    i_obj_disable('btn_hypro');
    i_obj_disable('btn_dspro');
    i_obj_disable('btn_sypro');
    i_obj_disable('btn_zspro');
    i_obj_disable('btn_jspro');
    i_obj_disable('btn_yldj');
    i_obj_disable('btn_print_jspro');
    i_obj_hide('hidden_v1');
    i_obj_hide('hidden_v2');
    i_obj_hide('hidden_v3');
    i_obj_hide('hidden_v4');
    i_obj_hide('hidden_v5');
    i_obj_hide('hidden_v6');
    i_obj_hide('hidden_v7');
    i_obj_hide('list_tb');
    m_info_num();
}

function m_info_view_plug() {
    m_info_num();
    m_info_da_val();
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_cname');
    if ('' == m.tmp) {
        alert('姓名不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_hjid');
    if ('' == m.tmp) {
        alert('户籍编号不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_hjstate');
    if ('' == m.tmp) {
        alert('户籍状态不能为空，请选择！');
        return false;
    }
    
    return true;
}

function m_list_down() {
    i_mdi_open(i_act + 'a=list_read4excel&x=' + m.xid + '&type=' + ytype, '操作日志下载', 1);
}

/**
 * 检查输入的手机号码格式是否正确
 * 输入:str  字符串
 * 返回:true 或 flase; true表示格式正确
 */
function m_checkMobilePhone(str){
    if (str.match(/^(?:13\d|15[89])-?\d{5}(\d{3}|\*{3})$/) == null) {
        return false;
    }
    else {
        return true;
    }
}

/**
 * 检查输入的固定电话号码是否正确
 * 输入:str  字符串
 * 返回:true 或 flase; true表示格式正确
 */
function m_checkTelephone(str){
    if (str.length < 7) {
        return false;
    }
    else {
        return true;
    }
}

/**
 * 检查输入的邮箱格式是否正确
 * 输入:str  字符串
 * 返回:true 或 flase; true表示格式正确
 */
function m_checkEmail(str){
    if (str.match(/[A-Za-z0-9_-]+[@](\S*)(net|com|cn|org|cc|tv|[0-9]{1,3})(\S*)/g) == null) {
        return false;
    }
    else {
        return true;
    }
}


/**
 * 检查QQ的格式是否正确
 * 输入:str  字符串
 *  返回:true 或 flase; true表示格式正确
 */
function m_checkQQ(str){
    if (str.match(/^\d{5,10}$/) == null) {
        return false;
    }
    else {
        return true;
    }
}

/**
 * 检查输入的邮政编码格式是否正确
 * 输入:str  字符串
 * 返回:true 或 flase; true表示格式正确
 */
function m_checkPostCode(str){
    if (str.match(/^[0-9]{6,6}$/) == null) {
        return false;
    }
    else {
        return true;
    }
}


function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num_hoh&x=' + m.xid + '&ytype=' + ytype,
        success : function(text){
            m_jpage_load(text);
        }
    });
}

function m_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : m_list_read
    });
}

m_list_read = function(show_num, page_now) {
//    alert('m.xid' + m.xid);
    $.ajax({
        url : i_act + 'a=list_read_hoh&show_num=' + show_num + '&page_now=' + page_now + '&x=' + m.xid + '&ytype=' + ytype,
        success : function(text){
            m.arr = i_json2js(text);  //将php文件进行解密，并返回到js
            m_read_list_val();
            i_tr_css($('#list_tb tbody tr'));
        }
    });
}

function m_read_list_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(i + 1);
        m.xtr.children(':eq(1)').html(m.arr[i]['time']);
        m.xtr.children(':eq(2)').html(m.arr[i]['uname']);
        m.xtr.children(':eq(3)').html(m.arr[i]['ytype']);
        m.xtr.children(':eq(4)').html(m.arr[i]['yname']);
        m.xtr.children(':eq(5)').html(m.arr[i]['operating_record']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}

function m_load_iframe_acturl(){
    if (m.src_iframe == m.tmp) {
        $('#iframe').toggle();
    } else {
        m.src_iframe = m.tmp;
        i_obj_show('iframe');
        $("#iframe").attr("src",m.tmp);
        //iframe高度随内容自动调整
        $('#iframe').load(function(){
            $(this).height($(this).contents().find("body").attr('scrollHeight'));
        });
    }
}

function m_info_da_val(){
    $.ajax({
        url : i_act + 'a=info_read&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);  //将php文件进行解密，并返回到js
            i_obj_set('d_daidold', m.info['daidold']); //档案号
            i_obj_set('d_dastate', m.info['dastate']); //档案状态
            i_obj_set('d_datime', m.info['datime']); //档案年份
            i_obj_set('d_bdid', m.info['bdid']); //报到号
            i_obj_set('d_bdstate', m.info['bdstate']); //报到状态
            i_obj_set('d_daletter', m.info['daletter']); //干部介绍信
            i_obj_set('d_hjid_cp', m.info['hjid']); //户籍号
            i_obj_set('d_hjstate_cp', m.info['hjstate']); //户籍状态
            i_obj_set('d_jyletter', m.info['jyletter']); //就业介绍信
            i_obj_set('d_xyid', m.info['xyid']); //协议号
            i_obj_set('d_xystate', m.info['xystate']); //协议状态
            i_obj_set('d_dafee', m.info['dafee']); //财务状态
        }
    });
}
function m_checkCardID() {
	var cardid = i_obj_val('d_cardid');
//	var cardid = "61052819840504062X";  //测试用例
	var checkResult = m_checkCID(cardid);
	if (checkResult!="ok") {
		alert(checkResult);
		return false;
	}
	m_CIDshowSex(cardid,"d_sex");
	m_CIDshowBirthday(cardid,"d_birth");
}






function m_checkCID(cardid){  //检测身份证号码是否合法
	var Errors=new Array(
		"ok",
		"身份证号码位数不对!",
		"身份证号码出生日期超出范围或含有非法字符!",
		"身份证号码校验错误!",
		"身份证地区非法!"
	);
	var area={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"}

	var cardid,Y,JYM;
	var S,M;
	var cardid_array = new Array();
		cardid_array = cardid.split("");

	//地区检验
	if(area[parseInt(cardid.substr(0,2))]==null) return Errors[4];

	//身份号码位数及格式检验
	switch(cardid.length){
		case 15:  //15位身份号码检测
			if ( (parseInt(cardid.substr(6,2))+1900) % 4 == 0 || ((parseInt(cardid.substr(6,2))+1900) % 100 == 0 && (parseInt(cardid.substr(6,2))+1900) % 4 == 0 )){
				ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/;//测试出生日期的合法性
			} else {
				ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/;//测试出生日期的合法性
			}

			if(ereg.test(cardid)) return Errors[0];
			else return Errors[2];
			break;
		case 18:  //18位身份号码检测
			if ( parseInt(cardid.substr(6,4)) % 4 == 0 || (parseInt(cardid.substr(6,4)) % 100 == 0 && parseInt(cardid.substr(6,4))%4 == 0 )){
				ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/;//闰年出生日期的合法性正则表达式
			} else {
				ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/;//平年出生日期的合法性正则表达式
			}

			if(ereg.test(cardid)){  //测试出生日期的合法性
				//计算校验位
				S = (parseInt(cardid_array[0]) + parseInt(cardid_array[10])) * 7
				+ (parseInt(cardid_array[1]) + parseInt(cardid_array[11])) * 9
				+ (parseInt(cardid_array[2]) + parseInt(cardid_array[12])) * 10
				+ (parseInt(cardid_array[3]) + parseInt(cardid_array[13])) * 5
				+ (parseInt(cardid_array[4]) + parseInt(cardid_array[14])) * 8
				+ (parseInt(cardid_array[5]) + parseInt(cardid_array[15])) * 4
				+ (parseInt(cardid_array[6]) + parseInt(cardid_array[16])) * 2
				+ parseInt(cardid_array[7]) * 1
				+ parseInt(cardid_array[8]) * 6
				+ parseInt(cardid_array[9]) * 3 ;
				Y = S % 11;
				M = "F";
				JYM = "10X98765432";
				M = JYM.substr(Y,1);//判断校验位
				var cardid17 = cardid_array[17];
				if (cardid17=="x") cardid17="X";
				if(M == cardid17) return Errors[0]; //检测ID的校验位
				else return Errors[3];
			}
			else return Errors[2];
			break;
		default:
			return Errors[1];
			break;
	}
}

function m_CIDshowBirthday(cardid,objName) {  //从身份证号码中读取出生年月日赋值到obj
	var CID = cardid;
	var Birthday;
	if(15==CID.length) { //15位身份证号码
		Birthday = CID.charAt(6)+CID.charAt(7);
		if(parseInt(Birthday)<28) {
			Birthday = '20'+Birthday;
		} else {
			Birthday = '19'+Birthday;
		}
		Birthday = Birthday+'-'+CID.charAt(8)+CID.charAt(9)+'-'+CID.charAt(10)+CID.charAt(11);
		i_obj_set(objName,Birthday);   //调用外部函数

	}
	if(18==CID.length) { //18位身份证号码
		Birthday = CID.charAt(6)+CID.charAt(7)+CID.charAt(8)+CID.charAt(9)+'-'+CID.charAt(10)+CID.charAt(11)+'-'+CID.charAt(12)+CID.charAt(13);
		i_obj_set(objName,Birthday);   //调用外部函数
	}
}

function m_CIDshowSex(cardid,objName) {  //从身份证号码中读取性别赋值到obj
	var CID = cardid;
	if(15==CID.length) { //15位身份证号码
		if(parseInt(CID.charAt(14)/2)*2!=CID.charAt(14)) {
			i_obj_set(objName, '男');  //调用外部函数
		} else {
			i_obj_set(objName, '女');  //调用外部函数
		}
	}
	if(18==CID.length) { //18位身份证号码
		if(parseInt(CID.charAt(16)/2)*2!=CID.charAt(16)) {
			i_obj_set(objName, '男'); //调用外部函数
		} else {
			i_obj_set(objName, '女');  //调用外部函数
		}
	}
}