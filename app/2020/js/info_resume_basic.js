/**
 * 文件名称：info_resume_basic.js
 * 功能描述：填写简历个人信息功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */
var rid = '';

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    rid = i_get('rid');
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}

//function m_info_add_plug() {
//}

//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    i_mdi_open('./info_resume_wish.htm?a=edit&x=' + rid + '&rid='+ rid, '简历--职业概况/求职意向', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
          m_error_msg('d_error_name', '姓名不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_sex');
    if ('' == m.tmp) {
          m_error_msg('d_error_sex', '性别不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_sex', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr');
    if ('' == m.tmp) {
          m_error_msg('d_error_addr', '现居住地不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_addr', '通过', '2');
    }

    m.tmp = i_obj_val('d_hukou');
    if ('' == m.tmp) {
          m_error_msg('d_error_hukou', '户口所在地不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_hukou', '通过', '2');
    }

    m.tmp = i_obj_val('d_card_type');
    if ('' == m.tmp) {
          m_error_msg('d_error_card', '证件类型不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_card', '通过', '2');
    }

    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
          m_error_msg('d_error_card', '证件号码不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_card', '通过', '2');
    }
    
    m.tmp = i_obj_val('d_degree');
    if ('' == m.tmp) {
          m_error_msg('d_error_degree', '教育程度不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_degree', '通过', '2');
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        m_error_msg('d_error_email', '邮箱地址不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_qq');
    if (!m_checkQQ(m.tmp) && '' != m.tmp) {
        m_error_msg('d_error_qq', 'QQ格式不正确，请重新输入！', '0');
        return false;
    } else {
        m_error_msg('d_error_qq', '通过', '2');
    }

    m.tmp = i_obj_val('d_mobile');
    if('' == m.tmp){
        m_error_msg('d_error_mobile', '移动电话不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkMobilePhone(m.tmp)) {
            m_error_msg('d_error_mobile', '移动电话格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_mobile', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_tel');
    if (!m_checkTelephone(m.tmp) && ''!= m.tmp) {
        m_error_msg('d_error_tel', '固定电话格式不正确，请重新填写！', '0');
        return false;
    } else {
        m_error_msg('d_error_tel', '通过', '2');
    }

    m.tmp = i_obj_val('d_postid');
    if (!m_checkPostCode(m.tmp) && '' != m.tmp) {
        m_error_msg('d_error_postid', '邮政编码格式不正确，请重新输入！', '0');
        return false;
    } else {
        m_error_msg('d_error_postid', '通过', '2');
    }

    return true;
}


