/**
 * 文件名称：info_com_account.js
 * 功能描述：账户信息功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_com_account').click(function(){
       i_mdi_open('info_com_account.htm?a=view&x=' + m.xid);
    });

    $('#a_com_password').click(function(){
       i_mdi_open('info_com_password.htm?a=edit&x=' + m.xid);
    });
}

function m_info_set_plug() {
//    m_com_account_set();
}

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

//function m_com_account_set(){
//    $.ajax({
//        url : i_act + 'a=info_read&x=' +  m.xid,
//        success : function(txt){
//            m.info = i_json2js(txt);
//            i_obj_set('d_fname', m.info['fname']);
//            i_obj_set('d_loginid', m.info['loginid']);
//            i_obj_set('d_user_tate', m.info['user_tate']);
//            i_obj_set('d_reg_time', m.info['reg_time']);
//            i_obj_set('d_email', m.info['email']);
//            i_obj_set('d_login_time', m.info['login_time']);
//            i_obj_set('d_login_hits', m.info['login_hits']);
//            i_obj_set('d_aip', m.info['aip']);
//        }
//    });
//
//}



