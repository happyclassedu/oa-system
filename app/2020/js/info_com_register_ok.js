/**
 * 文件名称：info_com_register_ok.js
 * 功能描述：填写注册信息（企业）的前台程序。
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

    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


//function m_btn_load_plug() {
//
//}

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
    i_mdi_open('../htm/info_com_usercenter.htm?a=ucenter', '管理中心', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {

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

     m.tmp = i_obj_val('d_linkman');
    if ('' == m.tmp) {
        m_error_msg('d_error_linkman', '联系人不能为空，请填写', '0');
        return false;
    } else {
        m_error_msg('d_error_linkman', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if('' == m.tmp){
        m_error_msg('d_error_tel', '固定电话不能为空，请重新输入', '0');
        return false;
    } else {
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_tel', '固定电话格式不正确，请重新填写', '0');
            return false;
        } else {
            m_error_msg('d_error_tel', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_fax');
    if('' != m.tmp){
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_fax', '传真格式不正确，请重新填写', '0');
            return false;
        } else {
            m_error_msg('d_error_fax', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        m_error_msg('d_error_email', '电子邮箱不能为空，请重新输入', '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新输入', '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_postid');
    if('' == m.tmp){
        m_error_msg('d_error_postid', '邮政编码不能为空，请重新输入', '0');
        return false;
    } else {
        if (!m_checkPostCode(m.tmp)) {
            m_error_msg('d_error_postid', '邮政编码格式不正确，请重新输入', '0');
            return false;
        } else {
            m_error_msg('d_error_postid', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_addrcity');
    if('' == m.tmp){
        m_error_msg('d_error_addrcity', '邮政地址不能为空，请重新输入', '0');
        return false;
    } else {
        m_error_msg('d_error_addrcity', '通过', '2');
    }

    return true;


}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_industry_plug('d_trade');
}