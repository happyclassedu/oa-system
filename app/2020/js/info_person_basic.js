/**
 * 文件名称：info_person_basic.js
 * 功能描述：修改基本信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_person_account').click(function(){
       i_mdi_open('info_person_account.htm?a=view&x=' + m.xid);
    });

    $('#a_person_basic').click(function(){
       i_mdi_open('info_person_basic.htm?a=edit&x=' + m.xid);
    });

    $('#a_person_password').click(function(){
       i_mdi_open('info_person_password.htm?a=edit&x=' + m.xid);
    });

    $('#a_person_email').click(function(){
       i_mdi_open('info_person_email.htm?a=edit&x=' + m.xid);
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
    
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if( '' == m.tmp || (m.tmp).length < 0){
        m_error_msg('d_error_name', '姓名不能为空，请填写',  '0');
        return false;
    } else {
        m_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_tel', '联系电话不能为空，请填写',  '0');
        return false;
    } else {
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_tel', '联系电话格式不正确，请重新填写',  '0');
            return false;
        } else {
            m_error_msg('d_error_tel', '通过', '2');
        }
    }
    
    return true;
}

//function m_error_init(){
//
//}