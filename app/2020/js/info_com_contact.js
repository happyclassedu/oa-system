/**
* 文件名称：info_com_contact.js
* 功能描述：修改公司联系方式功能的前台程序。
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

    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_com_basic').click(function(){
        $('#a_com_basic').attr('href', './info_com_basic.htm?a=edit&x=' + m.xid);
    });

    $('#a_com_contact').click(function(){
        $('#a_com_contact').attr('href', './info_com_contact.htm?a=edit&x=' + m.xid);
    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


function m_info_edit_plug() {
    i_obj_set('d_relation_state', 1);
}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_linkman');
    if ('' == m.tmp) {
        m_error_msg('d_error_linkman', '联系人不能为空，请填写！', '0');
        return false;
    } else {
        m_error_msg('d_error_linkman', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel2');
    if('' == m.tmp){
        m_error_msg('d_error_tel2', '手机不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkMobilePhone(m.tmp)) {
            m_error_msg('d_error_tel2', '手机格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_tel2', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_tel1');
    if('' == m.tmp){
        m_error_msg('d_error_tel1', '固定电话不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_tel1', '固定电话格式不正确，请重新填写！', '0');
            return false;
        } else {
            m_error_msg('d_error_tel1', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_fax');
    if('' != m.tmp){
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_fax', '传真格式不正确，请重新填写！', '0');
            return false;
        } else {
            m_error_msg('d_error_fax', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        m_error_msg('d_error_email', '电子邮箱不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_postid');
    if('' == m.tmp){
        m_error_msg('d_error_postid', '邮政编码不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkPostCode(m.tmp)) {
            m_error_msg('d_error_postid', '邮政编码格式不正确，请重新输入!', '0');
            return false;
        } else {
            m_error_msg('d_error_postid', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_postaddr');
    if('' == m.tmp){
        m_error_msg('d_error_postaddr', '邮政地址不能为空，请填写!', '0');
        return false;
    } else {
        m_error_msg('d_error_postaddr', '通过', '2');
    }
    return true;
}

function m_error_init(){
    m_error_msg('d_error_relation_state', '如果选择不公开，则求职者看不到贵公司的任何联系方式信息', '1');
    m_error_msg('d_error_tel1', '固定电话格式必须是区号+号码，例如：029-82270XXX', '1');
    m_error_msg('d_error_fax', '传真格式必须是区号+号码，例如：029-82270XXX', '1');
    m_error_msg('d_error_mobile', '手机号码仅在我中心与贵公司紧急联系时使用，不会再互联网上公开', '1');
    m_error_msg('d_error_email', '此邮箱将作为接收简历的邮箱，请准确填写', '1');
    m_error_msg('d_error_postaddr', '最多可输入100汉字、数字、字母', '1');
}
