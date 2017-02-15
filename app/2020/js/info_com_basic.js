/**
 * 文件名称：info_com_basic.js
 * 功能描述：修改公司基本信息功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});


function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    m_info_time();
    m_error_init();
    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
     $('#d_com_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#a_com_basic').click(function(){
       $('#a_com_basic').attr('href', './info_com_basic.htm?a=edit&x=' + m.xid);
    });

    $('#a_com_contact').click(function(){
       $('#a_com_contact').attr('href', './info_com_contact.htm?a=edit&x=' + m.xid);
    });

    $('#d_legalid').change(function(){
        m_checkCardID('d_legalid', 'd_error_legalid');
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

function m_act_url_plug() {
    i_mdi_open('./info_com_contact.htm?a=edit&x=' + m.xid);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_i_tmp0');
    if ('' == m.tmp) {
          m_error_msg('d_error_i_tmp0', '网络招聘会类型不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_i_tmp0', '通过', '2');
    }

    m.tmp = i_obj_val('d_fname');
    if ('' == m.tmp) {
          m_error_msg('d_error_fname', '公司名称不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_fname', '通过', '2');
    }

    m.tmp = i_obj_val('d_trade');
    if ('' == m.tmp) {
          m_error_msg('d_error_trade', '所属行业不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_trade', '通过', '2');
    }

    m.tmp = i_obj_val('d_type');
    if ('' == m.tmp) {
        m_error_msg('d_error_type','公司性质不能为空，请选择！','0');
        return false;
    }else {
        m_error_msg('d_error_type', '通过', '2');
    }

    m.tmp = i_obj_val('d_pnum');
    if ('' == m.tmp) {
         m_error_msg('d_error_pnum','公司规模不能为空，请选择！','0');
        return false;
    }else {
        m_error_msg('d_error_pnum', '通过', '2');
    }

    m.tmp = i_obj_val('d_com_time');
    if ('' == m.tmp) {
          m_error_msg('d_error_com_time','成立日期不能为空，请填写！','0');
        return false;
    }else {
        m_error_msg('d_error_com_time', '通过', '2');
    }

    m.tmp = i_obj_val('d_address');
    if ('' == m.tmp) {
         m_error_msg('d_error_address','所在地区不能为空，请填写！','0');
        return false;
    }else {
        m_error_msg('d_error_address', '通过', '2');
    }

    m.tmp = i_obj_val('d_intro');
    if ('' == m.tmp) {
        m_error_msg('d_error_intro','公司简介不能为空，请填写！','0');
        return false;
    }else {
        m_error_msg('d_error_intro', '通过', '2');
    }
    
    return true;


}

function m_error_init(){
    m_error_msg('d_error_fname', '如需修改公司名称，请与<A href="www.lhrc.com">网站客服人员</A>联系', '1');
    m_error_msg('d_error_legalid', '法人代表身份证由15-18字符（包括字母、数字）组成 ', '1');
}

function m_info_time(){
    $.ajax({
        url : i_act + 'a=info_time',
        success : function(txt){
            i_obj_set('d_reg_time', txt);
        }
    });
}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_industry_plug('d_trade');
}