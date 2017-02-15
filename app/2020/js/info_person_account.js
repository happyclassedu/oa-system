/**
 * 文件名称：info_person_account.js
 * 功能描述：查看个人信息功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
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

//function m_info_save_plug() {
//    return true;
//}
















