/**
 * 文件名称：info_medi.js
 * 功能描述：参保人员管理增加,修改，查看功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    i_read_css('m_list', 0);
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    m.src_iframe = '';
    i_tr_css($('#list_tb tbody tr'));

//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_shift').click(function(){
        m.tmp = './info_moh_shift.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_print').click(function(){
        m.tmp = './info_moh_print.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_pay').click(function(){
        m.tmp = './info_moh_pay.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_mcard').click(function(){
        m.tmp = './info_moh_mcard.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_mtext').click(function(){
        m.tmp = './info_moh_mtext.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_retire').click(function(){
        m.tmp = './info_moh_retire.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_apply').click(function(){
        m.tmp = './info_moh_apply.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_medi').click(function(){
        alert('医保管理');
    });

    $('#btn_base').click(function(){
        alert('基本业务');
    });
    
    $('#btn_all').click(function(){
        alert('全部业务');
    });

    $('#d_idcard').change(function(){
        m_checkCardID();
    });

    $('#d_birth').jdate({
        //                    showButtonPanel: false,
        //                    changeMonth: false,
        //                    changeYear: false,
        //                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_jmedi_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_pay_deadtime').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_ori_medi_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_ori_pay_deadtime').jdate({
        dateFormat: 'yy-mm-dd'
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
    i_obj_disable('btn_shift');
    i_obj_disable('btn_print');
    i_obj_disable('btn_pay');
    i_obj_disable('btn_mcard');
    i_obj_disable('btn_mtext');
    i_obj_disable('btn_retire');
    i_obj_disable('btn_apply');
    i_obj_hide('hidden_v1');
    i_obj_hide('hidden_v2');
    i_obj_hide('list_tb');
    
    //默认状态
    i_obj_set('d_medi_type', '在职');
    i_obj_set('d_medi_state', '在库');
    i_obj_set('d_medi_book_state', '未办理');
    i_obj_set('d_medi_card_state', '未办理');
    
    m_info_btn_setname();  
}

function m_info_btn_setname(){
    //转入转出关系
    if('在库' == i_obj_val('d_medi_state')){
        i_obj_set('btn_shift', '转出医疗关系');
    }else if('转出' == i_obj_val('d_medi_state')){
        i_obj_set('btn_shift', '转入医疗关系');
    }

    //办理/领取医保卡
    if('未办理' == i_obj_val('d_medi_card_state')) {
        i_obj_set('btn_mcard', '办理医保卡');
    } else if('已办理' == i_obj_val('d_medi_card_state')) {
        i_obj_set('btn_mcard', '领取医保卡');
    }else if('已领取' == i_obj_val('d_medi_card_state')) {
        i_obj_disable('btn_mcard');
    }

    //办理/领取医保本
    if('未办理' == i_obj_val('d_medi_book_state')) {
        i_obj_set('btn_mtext', '办理医保本');
    } else if('已办理' == i_obj_val('d_medi_book_state')) {
        i_obj_set('btn_mtext', '领取医保本');
    }else if('已领取' == i_obj_val('d_medi_book_state')) {
        i_obj_disable('btn_mtext');
    }
}

function m_info_edit_plug() {
    m_info_cue();
    i_obj_disable('btn_shift');
    i_obj_disable('btn_print');
    i_obj_disable('btn_pay');
    i_obj_disable('btn_mcard');
    i_obj_disable('btn_mtext');
    i_obj_disable('btn_retire');
    i_obj_disable('btn_apply');
    i_obj_hide('hidden_v1');
    i_obj_hide('hidden_v2');
    i_obj_hide('list_tb');
    m_info_num();
}

function m_info_view_plug() {
    m_info_cue();
    m_info_num();
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        alert('姓名不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
        alert('身份证不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_birth');
    if ('' == m.tmp) {
        alert('出生日期不能为空，请填写！');
        return false;
    }
    
    m.tmp = i_obj_val('d_medi_type');
    if ('' == m.tmp) {
        alert('医保类别不能为空，请选择！');
        return false;
    }

    m.tmp = i_obj_val('d_medi_state');
    if ('' == m.tmp) {
        alert('医保状态不能为空，请选择！');
        return false;
    }

    m.tmp = i_obj_val('d_jmedi_time');
    if ('' == m.tmp) {
        alert('参保时间不能为空，请填写！');
        return false;
    }
    return true;
}

function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num_moh&x=' + m.xid,
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
    $.ajax({
        url : i_act + 'a=list_read_moh&show_num=' + show_num + '&page_now=' + page_now + '&x=' + m.xid,
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
        m.xtr.children(':eq(5)').html(m.arr[i]['ytext']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}

/*根据参保人员缴纳医保费的时间算起，
 *如果此人在截止缴费日三个月后还未补交费，
 *给出提示，“提示此人已三给月未缴费”。
 *或者将此人信息页面变色*/

function m_info_cue(){
    $.ajax({
        url : i_act + 'a=info_cue&x=' + m.xid,
        success : function(txt){
            m.arr = i_json2js(txt);
            if(m.arr['month_num'] > 3){
                i_obj_set('d_month_num', m.arr['name']+ '已经' + m.arr['month_num'] + '个月未缴费');
//                $('tr[class^=tb_title]').attr('className', 'tb_title5');
//                $('#list_tb thead tr').css('background-image', 'url("../img/tb_title5.png")');
            } else {
                i_obj_set('d_month_num', '');
            }
        }
    });
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

function m_checkCardID() {
    var cardid = i_obj_val('d_idcard');
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
    var area={
        11:"北京",
        12:"天津",
        13:"河北",
        14:"山西",
        15:"内蒙古",
        21:"辽宁",
        22:"吉林",
        23:"黑龙江",
        31:"上海",
        32:"江苏",
        33:"浙江",
        34:"安徽",
        35:"福建",
        36:"江西",
        37:"山东",
        41:"河南",
        42:"湖北",
        43:"湖南",
        44:"广东",
        45:"广西",
        46:"海南",
        50:"重庆",
        51:"四川",
        52:"贵州",
        53:"云南",
        54:"西藏",
        61:"陕西",
        62:"甘肃",
        63:"青海",
        64:"宁夏",
        65:"新疆",
        71:"台湾",
        81:"香港",
        82:"澳门",
        91:"国外"
    }

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


