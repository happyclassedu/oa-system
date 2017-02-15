/**
 * 文件名称：info_person_mail.js
 * 功能描述：修改信箱功能的前台程序。
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
    m_btn_load_plug();
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

    $('#btn_edit_email').click(function(){
       if(m_info_validate_plug()){
           m_info_edit_email_plug();
        }
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
//
//    return true;
//}



function m_info_validate_plug(){
    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_email', '邮箱不能为空，请填写',  '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新填写',  '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }
    return true;
}


function m_info_edit_email_plug () {
     $.ajax({
            url : i_act + 'a=' + 'info_email&x=' + m.xid,
            data : 'arr='+ i_js2json(i_obj_val("d_email_x")),
            success : function(txt){
               if('1' == txt){
                   alert('修改成功！');
               } else {
                   alert('修改失败！');
               }
            }
        });
}
