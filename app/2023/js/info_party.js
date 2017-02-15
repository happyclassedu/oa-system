/**
 * 文件名称：info_party.js
 * 功能描述：党员信息登记管理增加,修改，查看功能的前台程序。
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
        m.tmp = './info_party_shift.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_party_clm').click(function(){
        m.tmp = './list_party_cl.htm?a=list';
        i_mdi_open(m.tmp, '党员材料管理');
    });

    $('#btn_party_clg').click(function(){
        m.tmp = './info_party_clg.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_party_zg').click(function(){
        m.tmp = './info_party_zg.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_party_pay').click(function(){
        m.tmp = './info_party_pay.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

    $('#btn_party_identity').click(function(){
        m.tmp = './info_party_identity.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
    });

//     $('#btn_party_bill').click(function(){
//        m.tmp = './list_party_bill.htm?a=list';
//        i_mdi_open(m.tmp, '缴费票据管理');
//    });

     $('#btn_party_print').click(function(){
        m.tmp = './info_party_print.htm?a=add&x=' + m.xid;
        m_load_iframe_acturl();
//        i_mdi_open(m.tmp, '打印预备党员名单');
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

    $('#btn_party').click(function(){
        ytype = i_js2json('党员管理');
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

    $('#d_shift_to_time').jdate({
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
    i_obj_disable('btn_party_clm');
    i_obj_disable('btn_party_clg');
    i_obj_disable('btn_party_zg');
    i_obj_disable('btn_party_pay');
    i_obj_disable('btn_party_identity');
    i_obj_disable('btn_party_bill');
    i_obj_disable('btn_party_print');
    i_obj_disable('d_party_state');
//    i_obj_disable('d_pay_deadtime');
    i_obj_hide('hidden_v1');
    i_obj_hide('list_tb');
    i_obj_set('d_political', '共产党员');
    i_obj_set('d_unit', '人事局人才交流中心党支部');
}

function m_info_btn_setname(){
    //迁入/迁出户籍关系 // && (m_date_comp('', 'd_party_pay_deadtime'))
//    if(('在库' == i_obj_val('d_party_state') || '归档' == i_obj_val('d_party_state'))){
//        i_obj_set('btn_shift', '转出党关系');
//    }else if('调出' == i_obj_val('d_party_state')){
//        i_obj_set('btn_shift', '转入党关系');
//    }
    i_obj_set('btn_shift', '转党关系');
}




//function m_info_add_plug() {
//}

function m_info_edit_plug() {
    i_obj_disable('btn_shift');
    i_obj_disable('btn_party_clm');
    i_obj_disable('btn_party_clg');
    i_obj_disable('btn_party_zg');
    i_obj_disable('btn_party_pay');
    i_obj_disable('btn_party_identity');
    i_obj_disable('btn_party_bill');
    i_obj_disable('btn_party_print');
    i_obj_disable('d_party_state');
//    i_obj_disable('d_pay_deadtime');
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

    m.tmp = i_obj_val('d_shift_to_time');
    if ('' == m.tmp) {
        alert('转入时间不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_join_time');
    if ('' == m.tmp) {
        alert('入党时间不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_party_type');
    if ('' == m.tmp) {
        alert('入党类型不能为空，请选择！');
        return false;
    }

    m.tmp = i_obj_val('d_pay_deadtime');
    if ('' == m.tmp) {
        alert('党费缴止日期不能为空，请填写！');
        return false;
    }

    return true;
}

function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num_poh&x=' + m.xid + '&ytype=' + ytype,
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
        url : i_act + 'a=list_read_poh&show_num=' + show_num + '&page_now=' + page_now + '&x=' + m.xid + '&ytype=' + ytype,
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
