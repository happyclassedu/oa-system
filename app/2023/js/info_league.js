/**
 * 文件名称：info_league.js
 * 功能描述：团员信息登记管理增加,修改，查看功能的前台程序。
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
    i_read_js('function');
    i_read_css('m_list', 0);
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    m.src_iframe = '';
    i_tr_css($('#list_tb tbody tr'));
    i_obj_hide('iframe');

//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_shift').click(function(){
        m.tmp = './info_league_shift.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_league_pay').click(function(){
        m.tmp = './info_league_pay.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_league_identity').click(function(){
        m.tmp = './info_league_identity.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
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

    $('#btn_balance').click(function(){
        ytype = i_js2json('财务结算');
        m_info_num();
    });

    $('#btn_league').click(function(){
        ytype = i_js2json('团员管理');
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
        m_checkCardID('d_cardid', '', 'd_sex', 'd_birth');
    });

    $('#d_birth').jdate({
//                    showButtonPanel: false,
//                    changeMonth: false,
//                    changeYear: false,
//                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

     $('#d_join_time').jdate({
//                    showButtonPanel: false,
//                    changeMonth: false,
//                    changeYear: false,
//                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_pay_deadtime').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_shift_out_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_tel_0').change(function(){
        m.tmp = i_obj_val('d_tel_0');
        if (!m_checkMobilePhone(m.tmp) && '' != m.tmp) {
            alert('手机格式不正确，请重新输入！');
        }
    });

    $('#d_tel_1').change(function(){
         m.tmp = i_obj_val('d_tel_1');
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

    $('#d_postcode').change(function(){
        m.tmp = i_obj_val('d_postcode');
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
    i_obj_disable('btn_shift');
    i_obj_disable('btn_league_pay');
    i_obj_disable('btn_league_identity');
    i_obj_hide('hidden_v1');
    i_obj_hide('list_tb');
}

function m_info_btn_setname(){
    //迁入/迁出户籍关系 // && (m_date_comp('', 'd_party_pay_deadtime'))
    if('在库' == i_obj_val('d_league_state') ){
        i_obj_set('btn_shift', '转出团关系');
    }else if('调出' == i_obj_val('d_league_state') || '' == i_obj_val('d_league_state')){
        i_obj_set('btn_shift', '转入团关系');
    }
}




//function m_info_add_plug() {
//}

function m_info_edit_plug() {
    i_obj_disable('btn_shift');
    i_obj_disable('btn_league_pay');
    i_obj_disable('btn_league_identity');
    i_obj_hide('hidden_v1');
    i_obj_hide('list_tb');
}

function m_info_view_plug() {
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

    m.tmp = i_obj_val('d_unit');
    if ('' == m.tmp) {
        alert('组织不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_join_time');
    if ('' == m.tmp) {
        alert('入团时间不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_league_state');
    if ('' == m.tmp) {
        alert('入团状态不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_pay_deadtime');
    if ('' == m.tmp) {
        alert('团费缴止日期不能为空，请填写！');
        return false;
    }

    return true;
}

function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num_loh&x=' + m.xid + '&ytype=' + ytype,
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
        url : i_act + 'a=list_read_loh&show_num=' + show_num + '&page_now=' + page_now + '&x=' + m.xid + '&ytype=' + ytype,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
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
        m.xtr.children(':eq(1)').html(m.arr[i]['atime']);
        m.xtr.children(':eq(2)').html(m.arr[i]['uname']);
        m.xtr.children(':eq(3)').html(m.arr[i]['i_type']);
        m.xtr.children(':eq(4)').html(m.arr[i]['name']);
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
